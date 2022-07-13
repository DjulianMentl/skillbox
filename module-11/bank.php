<?php

class Bank
{
    private $accounts = [];
    private $corrAccount;
    private $bankCode;

    public function __construct($bankCode, $corrAccount)
    {
        $this->bankCode = $bankCode;
        $this->corrAccount = $corrAccount;
    }

    public function createAccount($accNumber)
    {
        $this->accounts[] = $accNumber;
    }

    public function showAccountsList()
    {
        print_r($this->accounts);
    }
}

$sberBank = new Bank('324235632462362','SB321');
$sberBank->createAccount('2325242');
$sberBank->createAccount('5555555555555');

$alfaBank = new Bank('7777777777777777777','alf63');
$alfaBank->createAccount('999999999999999999');
$alfaBank->createAccount('101010110101101101');

$sberBank->showAccountsList();
$alfaBank->showAccountsList();