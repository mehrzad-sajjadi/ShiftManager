<?php

namespace App\Enums;

enum Day : string
{
    case SATURDAY  = "شنبه";
    case SUNDAY    = "یک شنبه";
    case MONDAY    = "دو شنبه";
    case TUESDAY   = "سه شنبه";
    case WEDNESDAY = "چهار شنبه";
    case THURSDAY  = "پنج شنبه";
    case FRIDAY    = "جمعه";
}