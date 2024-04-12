<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Admin\Traits\ResponseTrait;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use ResponseTrait;

    public function getId(): int|string|null
    {
        return Auth::guard('admin')->id();
    }
}
