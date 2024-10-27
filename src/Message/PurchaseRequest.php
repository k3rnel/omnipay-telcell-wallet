<?php

declare(strict_types=1);

namespace Omnipay\TelcellWallet\Message;

use Omnipay\Common\Message\AbstractRequest;

use function base64_decode;
use function base64_encode;
use function md5;

/**
 * Class PurchaseRequest
 *
 * @package Omnipay\Telcell\Message
 */
class PurchaseRequest extends AbstractRequest
{
    protected const ACTION_POST_INVOICE = 'PostInvoice';

    /**
     * Sets the request shop id.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setShopId(string $value): static
    {
        return $this->setParameter('shopId', $value);
    }

    /**
     * Get the request shop id.
     *
     * @return string|null
     */
    public function getShopId(): ?string
    {
        return $this->getParameter('shopId');
    }

    /**
     * Sets the request shop key.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setShopKey(string $value): static
    {
        return $this->setParameter('shopKey', $value);
    }

    /**
     * Get the request shop key.
     *
     * @return string|null
     */
    public function getShopKey(): ?string
    {
        return $this->getParameter('shopKey');
    }

    /**
     * Sets the request buyer.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setBuyer(string $value): static
    {
        return $this->setParameter('buyer', $value);
    }

    /**
     * Get the request buyer.
     *
     * @return $this
     */
    public function getBuyer()
    {
        return $this->getParameter('buyer');
    }

    /**
     * Sets the request issuer id.
     *
     * @param $value
     *
     * @return mixed
     */
    public function setTransactionId($value)
    {
        return $this->setParameter('issuer_id', $value);
    }

    /**
     * Get Amount
     *
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->getParameter('issuer_id');
    }

    /**
     * Set the number of days the invoice is valid.
     *
     * @param int $value
     *
     * @return static
     */
    public function setValidDays(int $value): static
    {
        return $this->setParameter('valid_days', $value);
    }

    /**
     * Get the number of days the invoice is valid.
     *
     * @return mixed
     */
    public function getValidDays(): int
    {
        return $this->getParameter('valid_days');
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->getParameter('language');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setLanguage(string $value): static
    {
        return $this->setParameter('language', $value);
    }

    /**
     * Set custom data to get back as is
     *
     * @param array $value
     *
     * @return $this
     */
    public function setInfo(array $value = []): static
    {
        return $this->setParameter('info', $value);
    }

    /**
     * @return array|null
     */
    public function getInfo(): ?array
    {
        return $this->getParameter('info');
    }

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate(
            'issuer',
            'currency',
            'price',
            'product',
            'issuer_id',
            'valid_days',
            'info'
        );

        return [
            'issuer'        => $this->getShopId(),
            'action'        => self::ACTION_POST_INVOICE,
            'currency'      => $this->getCurrency(),
            'price'         => $this->getAmount(),
            'product'       => $this->getDescription(),
            'issuer_id'     => $this->getTransactionId(),
            'valid_days'    => $this->getValidDays(),
            'lang'          => $this->getLanguage(),
            'security_code' => $this->buildSecurityCode(),
            'info'          => $this->getInfo(),
        ];
    }

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    protected function buildSecurityCode(): string
    {
        $product = base64_encode($this->getDescription());
        $issuerId = base64_decode($this->getTransactionId());

        return md5(
            $this->getShopKey().
            $this->getIssuer().
            $this->getCurrency().
            $this->getAmount().
            $product.
            $issuerId.
            $this->getValidDays()
        );
    }

    /**
     * Send data and return response instance
     *
     * @param mixed $data
     *
     * @return \Omnipay\TelcellWallet\Message\PurchaseResponse
     */
    public function sendData($data): PurchaseResponse
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
