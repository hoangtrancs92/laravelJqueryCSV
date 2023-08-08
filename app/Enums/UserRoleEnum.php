<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case DIRECTOR = 0;
    case GROUP_LEADER = 1;
    case LEADER = 2;
    case MEMBER = 3;
}
