<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Console;

use Illuminate\Console\Command;
use Propaganistas\LaravelPhone\PhoneNumber;
use UseTheFork\Signal\Sdk\SignalConnector;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\note;
use function Laravel\Prompts\select;
use function Laravel\Prompts\spin;
use function Laravel\Prompts\text;
use function Laravel\Prompts\warning;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'signal:setup
                            {select=foo : Launch menu of commands for setup tools.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Line interface for managing your signal numbers via the API.';

    public function __construct(
        private readonly SignalConnector $signalConnector,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

        info('💬 Welcome to Signal Setup!');

        $option = select(
            label: 'What would you like to do?',
            options: [
                'health' => '/v1/health: API Health Check.',
                'register' => '/v1/register: Register a NEW phone number with the signal network.',
            ]
        );

        switch ($option) {
            case 'health':
                $this->doHealthCheck();
            case 'register':
                $this->doRegisterNumber();
        }

    }

    private function doHealthCheck(): void
    {
        $response = spin(
            callback: fn () => $this->signalConnector->general()->apiHealthCheck()->status(),
            message: 'Fetching response...',
        );
        info("Received health check: {$response}");
    }

    private function doRegisterNumber(): void
    {

        // +1-860-809-5563

        $result = $this->doRegistering();
        $number = $result['number'];

        if (
            $result['response']->status() === 200
        ) {
            info('WOO! verification code sent.');
            $option = select(
                label: 'Did you get it?',
                options: [
                    0 => 'Yes! I got the PIN!.',
                    1 => 'Try again with SMS.',
                    2 => 'Try again with Voice.',
                ]
            );

            switch ($option) {
                case 0:
                    $token = text(
                        label   : 'What was the Verification Code?',
                        required: true,
                        validate: ['code' => 'string'],
                    );

                    $response = spin(
                        callback: fn () => $this->signalConnector->devices()->verifyRegisteredPhoneNumber(
                            number : $number,
                            token: $token
                        ),
                        message : 'Verify das code.',
                    );

                    dd($response);

                    return;
                case 1:
                    $result = $this->doRegistering();
                case 2:
                    $result = $this->doRegistering(true);

            }

            //        $confirmed = confirm("{$number} ");

            //$response->json()
        } else {
            error($result['response']->asArray()['error']);
        }
    }

    private function doRegistering(bool $useVoice = false): array
    {

        $number = '';
        $captcha = '';
        $confirmed = false;

        while (! $confirmed) {
            $number = text(
                label   : 'What is the phone number?',
                required: true,
                validate: ['number' => 'phone:INTERNATIONAL'],
                hint    : 'Should start with a `+` IE: +18881112222'
            );

            $number = (new PhoneNumber($number))->formatE164();
            $confirmed = confirm("{$number} is this correct?");

            // Modified instructions from https://blog.aawadia.dev/2023/04/24/signal-api/
            warning('Captcha required for verification');
            note('To get the token, go to ');
            warning('https://signalcaptchas.org/registration/generate.html');
            note('After solving the captcha, right-click on the `Open Signal` link and copy the link.');
            $captcha = text('Copied Captcha Value (starts with `signalcaptcha://`):');

        }

        //first we attempt to register using SMS
        $response = spin(
            callback: fn () => $this->signalConnector->devices()->registerPhoneNumber(
                number : $number,
                captcha: $captcha,
                useVoice: $useVoice
            ),
            message : 'Lets GOO! aka registering a new account.',
        );

        return [
            'number' => $number,
            'response' => $response,
        ];

    }
}
