<?php

namespace App\Enums;

enum ProjectTab: string
{
    case All = 'all';
    case Mine = 'mine';
    case Invited = 'invited';
}