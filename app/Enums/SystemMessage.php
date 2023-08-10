<?php
namespace App\Enums;


enum SystemMessage : int
{
    case FAIL = 0;
    case SUCCESS = 1;
    case INTERNAL_ERROR = 10;
    case DATA_NOT_FOUND = 11;
    case PAGE_NOT_FOUND = 12;
    case BAD_DATA = 13;
}