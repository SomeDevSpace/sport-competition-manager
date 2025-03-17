<?php

namespace App\Enum;

enum PaymentMethods: string
{
    case CREDIT_CARD = 'credit_card';
    case BANK_TRANSFER = 'bank_transfer';
    case CASH = 'cash';
}
