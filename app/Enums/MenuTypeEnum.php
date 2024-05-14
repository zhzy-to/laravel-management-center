<?php

namespace App\Enums;

/**
 * 菜单类型
 */
enum MenuTypeEnum: string
{
    case Menu = "M";
    case Button = "B";
    case Link = "L";
    case Iframe = "I";
}
