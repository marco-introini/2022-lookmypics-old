<?php

namespace App\Enums;

enum AcceptanceStatus: string
{
    case ACCEPTED = 'ACCEPTED';
    case REJECTED = 'REJECTED';
    case NOT_DEFINED = 'NOT DEFINED';

}