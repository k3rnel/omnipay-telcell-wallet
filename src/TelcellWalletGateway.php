<?php

declare(strict_types=1);

namespace Omnipay\TelcellWallet;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * @method NotificationInterface acceptNotification(array $options = array())
 * @method RequestInterface authorize(array $options = array())
 * @method RequestInterface completeAuthorize(array $options = array())
 * @method RequestInterface capture(array $options = array())
 * @method RequestInterface purchase(array $options = array())
 * @method RequestInterface completePurchase(array $options = array())
 * @method RequestInterface refund(array $options = array())
 * @method RequestInterface fetchTransaction(array $options = [])
 * @method RequestInterface void(array $options = array())
 * @method RequestInterface createCard(array $options = array())
 * @method RequestInterface updateCard(array $options = array())
 * @method RequestInterface deleteCard(array $options = array())
 */
class TelcellWalletGateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'TelcellWallet';
    }

    /**
     * Gateway default parameters.
     *
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'shopId'   => null,
            'shopKey'  => null,
            'testMode' => true,
        ];
    }

    /**
     * @return string|null
     */
    public function getShopId(): ?string
    {
        return $this->getParameter('shopId');
    }

    /**
     * @param string|null $shopId
     *
     * @return \Omnipay\TelcellWallet\TelcellWalletGateway
     */
    public function setShopId(?string $shopId): TelcellWalletGateway
    {
        return $this->setParameter('shopId', $shopId);
    }

    /**
     * @return string|null
     */
    public function getShopKey(): ?string
    {
        return $this->getParameter('shopKey');
    }

    /**
     * @param string|null $shopKey
     *
     * @return \Omnipay\TelcellWallet\TelcellWalletGateway
     */
    public function setShopKey(?string $shopKey): TelcellWalletGateway
    {
        return $this->setParameter('shopKey', $shopKey);
    }
}
