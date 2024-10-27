<?php

declare(strict_types=1);

namespace Omnipay\TelcellWallet\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class CompletePurchaseResponse
 *
 * @package Omnipay\Telcell\Message
 */
class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful(): bool
    {
        return true;
    }
}
