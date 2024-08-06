<?php

namespace App\Http\Controllers;

use App\Models\CustomizedMessage;
use App\Models\User;
use App\Services\MessagingService;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    protected $messagingService;

    public function __construct(MessagingService $messagingService)
    {
        $this->messagingService = $messagingService;
    }

    public function index()
    {
        $data = CustomizedMessage::with("user")->get();

        return Inertia::render('Dashboard', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $users = User::orderBy('name','asc')->pluck('name','id');

        return Inertia::render(
            'Messages/Create',[
                'users' => $users
            ]
        );
    }

    public function store(Request $request)
    {
        $data =  $validated = $request->validate([
            'type' => 'required',
            'prompt' => 'required',
            'delivery_mode'=> 'required',
            'employee' =>'required'
        ]);

        $user = User::find($data['employee']);

        $open_ai = new OpenAi(env('OPENAI_API_KEY'));


            $result =  $open_ai->completion([
                'model' => 'text-davinci-003',
                'temperature' => 0.9,
                'max_tokens' => 400,
                'frequency_penalty' => 0,
                'presence_penalty' => 0.6,
                'prompt' => 'Generate a' . $data['type'] .  $data['delivery_mode'] . 'from BETTER GLOBE FORESTRY LTD for our employee named' . $user->name . $data['prompt'],
            ]);
    
            $d = json_decode($result);
    
            $generated_message = $d->choices[0]->text;

        $message = CustomizedMessage::create([
            "user_id" => auth()->id(),
            "employee_id" => $data['employee'],
            "type" => $data['type'],
            "message" => $generated_message,
            "delivery_mode" => $data['delivery_mode'],
        ]);


        return Inertia::location('/message/edit/' . $message->id,compact('message'));
    }

    public function edit($id)
    {
        $message = CustomizedMessage::with('user')->find($id);

        return Inertia::render(
            'Messages/Edit',
            [
                "message" => $message
            ]
        );
    }

    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'type' => 'required|max:255',
            'message' => 'required',
        ]);
        
        $record = CustomizedMessage::find($id);

        $record->update(
            $data
        );

        return redirect()->route('dashboard')->with('status','success');
    }

    public function destroyMessage($id)
    {
        $message = CustomizedMessage::find($id)->delete();

        return redirect()->route('dashboard')->with('status','success');
    }

    public function send($id,Request $request)
    {
        $data =  $validated = $request->validate([
            'type' => 'required',
            'message' => 'required',
        ]);

        $message = CustomizedMessage::find($id);

        $message->update([
            "type" => $data['type'],
            "message" => $data['message'],
        ]);

        $user = User::find($message->employee_id);
        
        if($message->delivery_mode == 'sms'){

            $this->messagingService->sendMessage($user, $message);
            
        } elseif($message->delivery_mode == 'letter'){

            $this->messagingService->index($user, $message);

        }
        else{
            $data = [
                'intro' => 'Dear ' . $user->name . ',',
                'content' =>  strip_tags($message->message), 
                'name' => $user->name,
                'email' => $user->email, 
                'subject' => $data['type'].' email'
            ];
            Mail::send('messaging.mail', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                ->cc('lydia@betterglobeforestry.com')
                ->replyTo('lydia@betterglobeforestry.com','DDHR')
                ->subject($data['subject']);
            });
        }

        return redirect()->route('dashboard')->with('status','success');
    }

    public function sendForReview($id,Request $request)
    {
        $data =  $request->validate([
            'type' => 'required',
            'message' => 'required',
        ]);

        $message = CustomizedMessage::find($id);

        $message->update([
            "type" => $data['type'],
            "message" => $data['message'],
        ]);
        
        $data = [
            'intro' => 'Dear HOD,',
            'content' =>  strip_tags($message->message), 
            'name' => 'HOD',
            'email' => 'jpd@betterglobeforestry.com', 
            'subject' => "Requested review for ".$data['type'],
        ];
        Mail::send('messaging.mail', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])
            ->cc('lydia@betterglobeforestry.com')
            ->subject($data['subject']);
        });

        return redirect()->route('dashboard')->with('status','success');
    }

    public function regenerate(Request $request, $id)
    {
        $data =  $validated = $request->validate([
            'type' => 'required',
            'message' => 'required',
        ]);

        $initial_message = CustomizedMessage::find($id);

        $user = User::find($initial_message->user_id);

        $open_ai = new OpenAi(env('OPENAI_API_KEY'));


            $result =  $open_ai->completion([
                'model' => 'text-davinci-003',
                'temperature' => 0.9,
                'max_tokens' => 400,
                'frequency_penalty' => 0,
                'presence_penalty' => 0.6,
                'prompt' => $data['message'],
            ]);
    
            $d = json_decode($result);
    
            $generated_message = $d->choices[0]->text;

        $initial_message->update([
            "type" => $data['type'],
            "message" => $generated_message,
        ]);

        $message =  CustomizedMessage::find($id);


        return Inertia::location('/message/edit/' . $initial_message->id,compact('message'));
    }

    public function users()
    {
        $data = User::get();

        return Inertia::render('Users/Users', [
            'data' => $data
        ]);
    }

    public function destroyUser($id)
    {
        $message = User::find($id)->delete();

        return redirect()->route('users');
    }



}

