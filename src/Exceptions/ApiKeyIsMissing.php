<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Exceptions;

use InvalidArgumentException;

/**
 * @internal
 */
final class ApiKeyIsMissing extends InvalidArgumentException
{
    /**
     * Create a new exception instance.
     */
    public static function create(): self
    {
        return new self(
            'The Signal API url is missing. Please publish the [signal.php] configuration file and set the [api_host].'
        );
    }
}
