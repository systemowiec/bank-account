<?php

namespace App\BankAccount;

/**
 * @copyright 2016 Jarosław Stańczyk <jaroslaw@stanczyk.co.uk>. All rights reserved.
 */
abstract class BankDefaultAccount implements BankAccount
{
    /**
     * @var string
     */
    protected $accountStatus;

    /**
     * @var float|int
     */
    protected $overdraft = 0;

    /**
     * @var float|int
     */
    protected $balance;

    /**
     * @return float|int
     */
    public function balance()
    {
        return $this->balance;
    }

    /**
     * @return float|int
     */
    public function overdraft()
    {
        return $this->overdraft;
    }

    /**
     * @param float $amount
     *
     * @throws BankAccountException
     */
    public function setOverdraft($amount)
    {
        if ($amount < 0) {
            throw new BankAccountException(
                "Cannot set overdraft less than zero:" . $this->balance->getAmount(),
                BankAccountErrorCode::EXCEED_OVERDRAFT_LIMIT
            );
        }
        $this->overdraft = $amount;
    }

    /**
     * @param float $amount
     *
     * @throws BankAccountException
     */
    public function withdraw($amount)
    {
        if ($amount > $this->balance->getAmount() + $this->overdraft) {
            throw new BankAccountException(
                "Cannot withdraw more than actual balance:" . $this->balance->getAmount(),
                BankAccountErrorCode::EXCEED_AVAILABLE_FUNDS
            );
        }
        $this->balance->decrease($amount);
    }

    /**
     * @param float $amount
     */
    public function deposit($amount)
    {
        $this->balance->increase($amount);
    }

    /**
     * @return void
     */
    public function reopenAccount()
    {
        $this->accountStatus = AccountStatus::ACTIVE;
    }

    /**
     * @return void
     */
    public function closeAccount()
    {
        $this->accountStatus = AccountStatus::CLOSED;
    }
}
