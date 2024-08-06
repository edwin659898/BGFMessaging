<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\User;
use Orhanerday\OpenAi\OpenAi;
use Carbon\Carbon;

class SendMessageController extends Controller
{
    public function sendMessage($user, $message)
    {
        $username = 'sandbox'; // use 'sandbox' for development in the test environment
        $apiKey   = '751a6d0a120fa15c3970d5462136d37bbdd912c9e9fe3aa9fc041301aac099fb'; // use your sandbox app API key for development in the test environment
        $AT       = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => $user->phone_number,
            'message' => $message
        ]);

        print_r($result);
    }

    public function getMessageFromChatGpt()
    {
        $user = User::whereDate('date_of_birth', '=', Carbon::now())->whereMonth('date_of_birth', '=', Carbon::now())->first();

        $open_ai = new OpenAi(env('OPENAI_API_KEY'));

        $result =  $open_ai->completion([
            'model' => 'text-davinci-003',
            'temperature' => 0.9,
            'max_tokens' => 150,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
            'prompt' => 'Generate a birthday message from BETTER GLOBE FORESTRY LTD for our employee named' . $user->name . 'who is in IT department and turns 20 years. make the message longer 5 sentences',
        ]);

        $d = json_decode($result);

        $message = $d->choices[0]->text;

        $this->sendMessage($user, $message);

        return 'success';
    }
}
