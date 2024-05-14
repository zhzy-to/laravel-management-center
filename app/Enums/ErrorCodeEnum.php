<?php

namespace App\Enums;

enum ErrorCodeEnum: int
{
    case TokenExpired = 401;

    case Forbidden = 403;
}
