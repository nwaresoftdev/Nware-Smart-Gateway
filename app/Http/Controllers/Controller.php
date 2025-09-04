<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Services\Api\V1\HybridCryptoEncService;

abstract class Controller
{
    protected $authUser = null;
    public function __construct(){
        $this->authUser = auth()->user();
    }
}
