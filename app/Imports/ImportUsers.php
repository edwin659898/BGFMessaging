<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUsers implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {


        $user_exists = User::where('job_id', $row['employee_id'])->first();

        if ($user_exists == '') {


            if (strpos('U', $row['employee_id'])) {
                $country = 'UG';
            } else {
                $country = 'KE';
            }

            ini_set('max_execution_time', 240);

            $url = 'https://eportal.betterglobeforestry.co.ke/api/get/user/details';
            $data = [
                'employee_id' => $row['employee_id'],
            ];

            $response = Http::post($url, $data);

            $responseData = $response->json();
            $responseData;

            $carbonDate = Carbon::parse($responseData['personal_information']['dob']);

            $user = User::create([
                "name" =>  $responseData['user']['name'],
                "email" =>  $responseData['user']['email'],
                "site" =>  $responseData['user']['site'],
                "gender" =>  $responseData['user']['email'],
                "department" =>  $responseData['user']['department'],
                "phone_number" =>  $responseData['personal_information']['Hphone'],
                "marital_status" =>  $responseData['personal_information']['status'],
                "date_of_birth" =>  $carbonDate,
                "job_title" =>  $responseData['job_information']['title'],
                "job_id" => $row['employee_id'],
                "country" =>  $country,
                'password' => Hash::make('password'),
            ]);
        }
    }
}
