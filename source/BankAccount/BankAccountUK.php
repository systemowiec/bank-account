<?php

namespace App\BankAccount;

/**
 * @copyright 2016 Jarosław Stańczyk <jaroslaw@stanczyk.co.uk>. All rights reserved.
 */
class BankAccountUK extends BankDefaultAccount
{
    const DEFAULT_CURRENCY = 'GBP';

    public function __construct()
    {
        $this->balance = new Balance(0, self::DEFAULT_CURRENCY);
        $this->accountStatus = AccountStatus::ACTIVE;
    }

    /**
     * @return array
     */
    public function displayBalance()
    {
        $balanceDetails = [
            'balance' => $this->balance->getAmount(),
            'currency' => $this->balance->getCurrency(),
        ];

        return $balanceDetails;
    }

    /**
     * @return string
     */
    public function getAccountStatus()
    {
        return $this->accountStatus;
    }
}
