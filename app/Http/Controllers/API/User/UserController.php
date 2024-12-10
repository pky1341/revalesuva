<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use App\Models\Weight;
use App\Models\BeforePicture;
use App\Models\BloodTest;
use App\Models\Circumference;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponser;
    public function update(Request $request)
    {
        $userId = $request->input("user_id");
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'dob' => ['required', 'date'],
            'contact_number' => ['nullable', 'string', 'max:15'],
            'height' => ['nullable', 'numeric'],
            'initial_weight' => ['nullable', 'numeric', 'between:0,999.99'],
            'gender' => ['nullable', 'string', 'max:10'],
            'regular_period' => ['nullable', 'integer', 'min:0'],
            'date_of_last_period' => ['nullable', 'date'],
            'street' => ['nullable', 'string', 'max:255'],
            'house' => ['nullable', 'string', 'max:255'],
            'apartment' => ['nullable', 'string', 'max:255'],
            'zipcode' => ['nullable', 'string', 'max:10'],
            'city' => ['nullable', 'string', 'max:100'],
            'personal_status' => ['nullable', 'string', 'max:100'],
            'occupation' => ['nullable', 'string', 'max:100'],
            'chest' => ['nullable', 'numeric', 'between:0,999.99'],
            'waist' => ['nullable', 'numeric', 'between:0,999.99'],
            'hip' => ['nullable', 'numeric', 'between:0,999.99'],
            'back_pic' => ['nullable', 'image', 'max:2048'],
            'side_pic' => ['nullable', 'image', 'max:2048'],
            'front_pic' => ['nullable', 'image', 'max:2048'],
            'blood_test_report' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:2048'],
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        $user = User::findOrFail($request->user_id);
        $user->update([
            "name" => trim($request['name']),
            "username" => trim($request['username']),
            "contact_number" => trim($request['contact_number']),
            'height' => number_format((float)$request['height'], 2, '.', ''),
            "initial_weight" => number_format((float)$request['initial_weight'], 2, '.', ''),
            "age" => (int)$request['age'],
            "profile_image" => $request->hasFile('profile_image') ? $request->file('profile_image')->store('images/profile_images', ['disk' => 'public']) : null,
            "gender" => trim($request['gender']),
            "regular_period" => $request['regular_period'],
            "date_of_last_period" => $request['date_of_last_period'],
            "street" => trim($request['street']),
            "house" => trim($request['house']),
            "apartment" => trim($request['apartment']),
            "zipcode" => trim($request['zipcode']),
            "city" => trim($request['city']),
            "personal_status" => trim($request['personal_status']),
            "occupation" => trim($request['occupation']),
        ]);

        if ($request->filled('initial_weight')) {
            Weight::create([
                "user_id" => $user->id,
                "weight" => number_format((float)$request['initial_weight'], 2, '.', ''),
            ]);
        }

        if ($request->filled('chest') || $request->filled('waist') || $request->filled('hip')) {
            Circumference::create([
                "user_id" => $user->id,
                "chest" => number_format((float)$request['chest'], 2, '.', ''),
                "waist" => number_format((float)$request['waist'], 2, '.', ''),
                "hip" => number_format((float)$request['hip'], 2, '.', ''),
            ]);
        }

        $backPicPath = null;
        $sidePicPath = null;
        $frontPicPath = null;

        if ($request->hasFile('back_pic')) {
            $backPicPath = $request->file('back_pic')->store('images/back_pics', ['disk' => 'public']);
        }

        if ($request->hasFile('side_pic')) {
            $sidePicPath = $request->file('side_pic')->store('images/side_pics', ['disk' => 'public']);
        }

        if ($request->hasFile('front_pic')) {
            $frontPicPath = $request->file('front_pic')->store('images/front_pics', ['disk' => 'public']);
        }

        if ($request->hasFile('back_pic') || $request->hasFile('front_pic') || $request->hasFile('side_pic')) {
            BeforePicture::create([
                "user_id" => $user->id,
                "back_pic" => isset($backPicPath) ? asset($backPicPath) : null,
                "side_pic" => isset($sidePicPath) ? asset($sidePicPath) : null,
                "front_pic" => isset($frontPicPath) ? asset($frontPicPath) : null,
            ]);
        }

        if ($request->hasFile('blood_test_report')) {
            foreach ($request->file('blood_test_report') as $file) {
                $bloodTestReportPath = $file->store('documents/blood_tests', ['disk' => 'public']);
                BloodTest::create([
                    "user_id" => $user->id,
                    "blood_test_report" => asset($bloodTestReportPath),
                ]);
            }
        }


        try {
            $token = $user->createToken('LaravelAuthApp')->accessToken;

            return $this->successResponse([
                "token" => $token,
            ], "User updated successfully.");
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred while creating token.', 500);
        }
    }

    public function getUser(Request $request)
    {
        try{
            $user_id=Auth::user();
            if (!$user_id) {
                return $this->errorResponse('Unauthorized: Token is invalid or expired.',401);
            }
            $user = User::with('weights','circumferences','bloodTests','beforePictures')->findOrFail($user_id->id);
            if($user) {
                return $this->successResponse($user);
            }
            return $this->successResponse($user);
        }catch(\Exception $e) {
            return $this->errorResponse('something went wrong',500);
        }
    }

    public function checkUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $exists = User::where('username', $request->username)->exists();

        if ($exists) {
            return $this->errorResponse('The username already exists.', 409);
        }

        return $this->successResponse([], 'The username is available.');
    }
}
