<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;
use App\Models\InquiryService;
use Illuminate\Validation\Rule;

class ServiceInquiryController extends Controller
{
    use ApiResponser;
    public function inquirySercvice(Request $request){
        $validator = Validator::make($request->all(), [
            "user_id"=> ['required',Rule::exists('users', 'id')],
            "help_question"=> ["required","string"],
            "help_details"=> ["required","string"],
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(),422);
        }
        $create=InquiryService::create([
            "user_id"=> $request['user_id'],
            'help_question'=> $request['help_question'],
            'help_details'=> $request['help_details'],
        ]);
        if(!$create) {
            return $this->errorResponse('Service Inquiry Request Failed', 500);
        }
        
        return $this->successResponse('Service Inquiry Request received', 200);
    }
}
