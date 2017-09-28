<?php

namespace App\BankAccount;

use Exception;

/**
 * @copyright 2016 Jarosław Stańczyk <jaroslaw@stanczyk.co.uk>. All rights reserved.
 */
class BankAccountException extends Exception
{
    /**
     * @var int
     */
    private $errorCode;

    /**
     * @param string $message
     * @param int    $errorCode
     */
    public function __construct($message, $errorCode)
    {
        $this->errorCode = $errorCode;
        parent::__construct($message);
    }

    /**
     * @return number
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
