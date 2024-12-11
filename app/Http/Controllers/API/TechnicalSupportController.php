<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;
use App\Models\TechnicalSupport;
use Illuminate\Validation\Rule;

class TechnicalSupportController extends Controller
{
    use ApiResponser;
    public function technicalSupport(Request $request){
        $validator = Validator::make($request->all(), [
            "user_id"=> ['required',Rule::exists('users', 'id')],
            "help_question"=> ["required","string"],
            "help_details"=> ["required","string"],
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(),422);
        }
        $create=TechnicalSupport::create([
            "user_id"=> $request['user_id'],
            'help_question'=> $request['help_question'],
            'help_details'=> $request['help_details'],
        ]);
        if(!$create) {
            return $this->errorResponse('Technical Support Request Failed', 500);
        }
        
        return $this->successResponse('Technical Support Request received', 200);
    }
}
