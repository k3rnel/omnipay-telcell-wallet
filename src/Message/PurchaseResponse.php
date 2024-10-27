<?php

declare(strict_types=1);

namespace Omnipay\TelcellWallet\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class PurchaseResponse
 *
 * @package Omnipay\Telcell\Message
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Gateway endpoint
     *
     * @var string
     */
    protected string $endpoint = 'https://telcellmoney.am/invoices';
    protected string $testEndpoint = 'https://telcellmoney.am/proto_test2/invoices';

    /**
     * Set successful to false, as transaction is not completed yet
     *
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return false;
    }

    /**
     * Mark purchase as redirect type
     *
     * @return bool
     */
    public function isRedirect(): bool
    {
        return true;
    }

    /**
     * Get redirect URL
     *
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->data['testMode'] ? $this->testEndpoint : $this->endpoint;
    }

    /**
     * Get redirect method
     *
     * @return string
     */
    public function getRedirectMethod(): string
    {
        return 'POST';
    }

    /**
     * Get redirect data
     *
     * @return array
     */
    public function getRedirectData(): array
    {
        return $this->data;
    }
}
