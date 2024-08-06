<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\User;
use Orhanerday\OpenAi\OpenAi;
use Carbon\Carbon;
use App\Services\MessagingService;

class sendMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send customised message';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(MessagingService $messagingService)
    {
        $users = User::whereDate('date_of_birth', '=', Carbon::now())->whereMonth('date_of_birth', '=', Carbon::now())->get();

        $open_ai = new OpenAi(env('OPENAI_API_KEY'));

        foreach($users as $user){


            $result =  $open_ai->completion([
                'model' => 'text-davinci-003',
                'temperature' => 0.9,
                'max_tokens' => 150,
                'frequency_penalty' => 0,
                'presence_penalty' => 0.6,
                'prompt' => 'Generate a birthday message from BETTER GLOBE FORESTRY LTD for our employee named ' . $user->name . ' who is in ' . $user->department . ' department and turns '.$user->age().' years. make the message longer 3 sentences',
            ]);
    
            $d = json_decode($result);
    
            $message = $d->choices[0]->text;
    
            $messagingService->sendMessage($user, $message);
        }


    }
}
