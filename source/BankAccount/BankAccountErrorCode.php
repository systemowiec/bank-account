<?php

namespace App\BankAccount;

/**
 * @copyright 2016 Jarosław Stańczyk <jaroslaw@stanczyk.co.uk>. All rights reserved.
 */
abstract class BankAccountErrorCode
{
    const EXCEED_OVERDRAFT_LIMIT = 1000;
    const EXCEED_AVAILABLE_FUNDS = 2000;
}
