<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataController extends Controller
{
    public function storeUser(Request $request){

        $user_exists = User::where('job_id',$request->job_information['EmployeeId'])->first();

        if ($user_exists == '') {

            if (str_contains('U', $request->job_information['EmployeeId'])) {
                $country = 'UG';
            } else {
                $country = 'KE';
            }

            $carbonDate = Carbon::parse($request->personal_information['dob']); 

            $user = User::create([
                "name" =>  $request->user['name'],
                "email" =>  $request->user['email'],
                "site" =>  $request->user['site'],
                "gender" =>  $request->user['email'],
                "department" =>  $request->user['department'],
                "phone_number" =>  $request->personal_information['Hphone'],
                "marital_status" =>  $request->personal_information['status'],
                "date_of_birth" =>  $carbonDate,
                "job_title" =>  $request->job_information['title'],
                "job_id" => $request->job_information['EmployeeId'],
                "country" =>  $country,
                'password' => Hash::make('password'),
            ]);
        }

        return response([
            'message' => 'Request received successfully'
        ]);
    }
}
