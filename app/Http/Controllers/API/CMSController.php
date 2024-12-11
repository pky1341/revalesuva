<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;
use App\Models\CMS;

class CMSController extends Controller
{
    use ApiResponser;
    public function getCMS()
    {
        $getCMS=CMS::get()->all();

        if ($createCMS) {
            return $this->successResponse("cms created successfully", 200);
        } else {
            return $this->errorResponse("Failed to create cms", 500);
        }
    }
}
