<?php /** @copyright 2016 Jarosław Stańczyk <jaroslaw@stanczyk.co.uk>. All rights reserved. */

require __DIR__ . '/vendor/autoload.php';

use App\BankAccount\BankAccountUK;

// Open new account
$bankAccount = new BankAccountUK();
$bankAccount->deposit(100);
$bankAccount->withdraw(50);

// Display balance
var_dump($bankAccount->displayBalance());
