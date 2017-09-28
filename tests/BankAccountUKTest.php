<?php

namespace App\tests;

use PHPUnit_Framework_TestCase;
use App\BankAccount\AccountStatus;
use App\BankAccount\BankAccountErrorCode;
use App\BankAccount\BankAccountUK;
use App\BankAccount\BankAccountException;

/**
 * @copyright 2016 Jarosław Stańczyk <jaroslaw@stanczyk.co.uk>. All rights reserved.
 */
class BankAccountUKTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Should Create New Account
     */
    public function testShouldCreateNewAccount()
    {
        // given
        $bankAccount = new BankAccountUK();

        // when
        $initialBalance = $bankAccount->balance();

        // then
        $this->assertEquals($bankAccount->getAccountStatus(), AccountStatus::ACTIVE);
        $this->assertEquals($initialBalance->getAmount(), 0);
        $this->assertEquals($initialBalance->getCurrency(), 'GBP');
    }

    /**
     * Test Should Deposit Founds To Account
     */
    public function testShouldDepositFundsToAccount()
    {
        // given
        $bankAccount = new BankAccountUK();
        // when
        $bankAccount->deposit(100);
        $bankAccount->deposit(250);

        // then
        $this->assertEquals(350, $bankAccount->balance()->getAmount());
        $this->assertEquals('GBP', $bankAccount->balance()->getCurrency());
    }

    /**
     * Test Should Withdraw Founds From Account
     */
    public function testShouldWithdrawFundsFromAccount()
    {
        // given
        $bankAccount = new BankAccountUK();
        // when
        $bankAccount->deposit(500);
        $bankAccount->withdraw(100);

        // then
        $this->assertEquals(400, $bankAccount->balance()->getAmount());
        $this->assertEquals('GBP', $bankAccount->balance()->getCurrency());
    }

    /**
     * Test Should Withdraw Founds From Account With Overdraft Limit
     */
    public function testShouldWithdrawFundsFromAccountWithOverdraftLimit()
    {
        // given
        $bankAccount = new BankAccountUK();
        $bankAccount->setOverdraft(400);
        // when
        $bankAccount->withdraw(100);

        // then
        $this->assertEquals(-100, $bankAccount->balance()->getAmount());
        $this->assertEquals('GBP', $bankAccount->balance()->getCurrency());
    }

    /**
     * Test Should Withdraw Founds From Account With Overdraft That Match Exact Limit
     */
    public function testShouldWithdrawFundsFromAccountWithOverdraftThatMatchExactLimit()
    {
        // given
        $bankAccount = new BankAccountUK();
        $bankAccount->setOverdraft(400);
        // when
        $bankAccount->withdraw(400);

        // then
        $this->assertEquals(-400, $bankAccount->balance()->getAmount());
        $this->assertEquals('GBP', $bankAccount->balance()->getCurrency());
    }

    /**
     * Test Should Withdraw Founds From Account With Overdraft That Is More Than Limit
     */
    public function testShouldWithdrawFundsFromAccountWithOverdraftThatIsMoreThanLimit()
    {
        // given
        $bankAccount = new BankAccountUK();
        $bankAccount->setOverdraft(400);

        // when
        $notAvailableFunds = false;
        try {
            $bankAccount->withdraw(400.01);
        } catch (BankAccountException $e) {
            $notAvailableFunds = true;
            $this->assertEquals($e->getErrorCode(), BankAccountErrorCode::EXCEED_AVAILABLE_FUNDS);
        }

        // then
        $this->assertTrue($notAvailableFunds);
    }

    /**
     * Test Should Close Account
     */
    public function testShouldCloseAccount()
    {
        // given
        $bankAccount = new BankAccountUK();

        // when
        $bankAccount->closeAccount();

        // then
        $this->assertEquals($bankAccount->getAccountStatus(), AccountStatus::CLOSED);
    }

    /**
     * Test Should Reopen Account
     */
    public function testShouldReopenAccount()
    {
        // given
        $bankAccount = new BankAccountUK();

        // when
        $bankAccount->closeAccount();

        // then
        $this->assertEquals($bankAccount->getAccountStatus(), AccountStatus::CLOSED);

        // when
        $bankAccount->reopenAccount();

        // then
        $this->assertEquals($bankAccount->getAccountStatus(), AccountStatus::ACTIVE);
    }
}
