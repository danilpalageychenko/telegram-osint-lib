<?php

namespace TelegramOSINT\TLMessage\TLMessage\ClientMessages\Shared;

use TelegramOSINT\TLMessage\TLMessage\Packer;
use TelegramOSINT\TLMessage\TLMessage\TLClientMessage;

/**
 * @see https://core.telegram.org/method/help.getConfig
 */
class get_config implements TLClientMessage
{
    const CONSTRUCTOR = -990308245; // 0xC4F9186B

    /**
     * @return string
     */
    public function getName()
    {
        return 'get_config';
    }

    /**
     * @return string
     */
    public function toBinary()
    {
        return Packer::packConstructor(self::CONSTRUCTOR);
    }
}
