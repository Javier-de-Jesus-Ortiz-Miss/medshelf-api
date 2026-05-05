<?php

namespace App\Core\Catalog\Product\Model\ValueObject;

enum ConsumptionType: string
{
    case UNITARY = 'unitary';
    case DOSE = 'dose';
}