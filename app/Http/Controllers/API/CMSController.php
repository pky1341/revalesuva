<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ContentManagementSystem;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Validator;


class CMSController extends Controller
{
    use ApiResponser;
    public function getCMS(){
        $cms = ContentManagementSystem::all();
        if (!$cms) {
            return $this->errorResponse('No CMS found.', 404);
        }
        return $this->successResponse($cms,'CMS is available',200);
    }
}
