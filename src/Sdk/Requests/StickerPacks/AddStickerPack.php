<?php

declare(strict_types=1);

namespace UseTheFork\Signal\Sdk\Requests\StickerPacks;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * Add Sticker Pack.
 *
 * In order to add a sticker pack, browse to https://signalstickers.org/ and select the sticker pack
 * you want to add. Then, press the "Add to Signal" button. If you look at the address bar in your
 * browser you should see an URL in this format:
 * https://signal.art/addstickers/#pack_id=XXX&pack_key=YYY, where XXX is the pack_id and YYY is the
 * pack_key.
 */
class AddStickerPack extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/v1/sticker-packs/{$this->number}";
    }

    /**
     * @param  mixed  $number  Registered Phone Number
     */
    public function __construct(
        protected mixed $number,
    ) {}
}
