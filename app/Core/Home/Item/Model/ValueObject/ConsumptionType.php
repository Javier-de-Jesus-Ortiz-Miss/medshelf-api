<?php

namespace App\Core\Home\Item\Model\ValueObject;

enum ConsumptionType: string
{
    case UNITARY = 'unitary';
    case DOSE = 'dose';
}
