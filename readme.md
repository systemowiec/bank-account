### Purpose of this application
Basic bank account simulation using Object Oriented Principles. Bank account have the following functionality: Open Account, Close Account, Display Balance, Deposit Funds, Withdraw Funds, Apply agreed overdraft (Where an account is allowed to go into a pre-arranged negative balance).

## Requirements
php >= 5.3

composer >= 1.0

## Installation

``` php composer install ```

``` phpunit ```

## Usage

To print current balance
```` $ php run.php ````
Functionality
````
$bankAccount = new BankAccountUK();
$bankAccount->deposit(100);
$bankAccount->withdraw(50);
$bankAccount->displayBalance();
$bankAccount->closeAccount();
$bankAccount->reopenAccount();
$bankAccount->setOverdraft(500);
````

## Credits

Thank you!

@copyright 2016 Jarosław Stańczyk <jaroslaw@stanczyk.co.uk>. All rights reserved.