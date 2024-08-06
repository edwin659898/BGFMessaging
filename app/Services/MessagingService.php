<?php

namespace App\Services;

use AfricasTalking\SDK\AfricasTalking;
use App\Models\CustomizedMessage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use setasign\Fpdi\Fpdi;

class MessagingService
{
    public function sendMessage($user, $message)
    {
        if ($user->country == 'KE') {
            $username = env('USERNAME_KE');
            $apiKey   = env('PASS_KE');
            $from = env('SENDER_KE');
        } else {
            $username = env('USERNAME_UG');
            $apiKey   = env('PASS_UG');
            $from = env('SENDER_UG');
        }

        $AT = new AfricasTalking($username, $apiKey);

        $sms = $AT->sms();

        $result   = $sms->send([
            'from' => $from,
            'to' => $user->phone_number,
            'message' => $message
        ]);

    }

    public function index($user, $message)
    {
        $filePath = public_path("storage/warning.pdf");
        $outputFilePath = public_path("storage/".$user->name."/".time()."warning letter.pdf");
        $this->fillPDFFile($filePath, $outputFilePath, $user, $message);
    }


    public function fillPDFFile($file, $outputFilePath, $user, $message)
    {

        $pdf = new FPDI;

        $pdf->addPage('L');
        $pagecount = $pdf->setSourceFile($file);;
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        $pdf->SetFont('Times','',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 51);
        $pdf->Write(0, Carbon::today()->toDateString());

        $pdf->SetFont('Times','',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 58.5);
        $pdf->Write(0, $user->name);

        $pdf->SetFont('Times','',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 63.5);
        $pdf->Write(0, $user->job_title);

        $pdf->SetFont('Times','',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 68);
        $pdf->Write(0, $user->site);

        $pdf->SetFont('Times','',13);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 78);
        $pdf->Write(0, 'Dear '.$user->name.',');

        $number = CustomizedMessage::where('delivery_mode','letter')->where('employee_id',$user->id)->count();
        $word = $this->numberToWord($number);
        $pdf->SetFont('Times','B',15);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 95);
        $pdf->Cell(0, 0, 'RE: '.$word.' WARNING LETTER,', 0, 1, '', 0, '', 1);

        $pdf->SetFont('Times','',13);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 100);
        $paragraph = strip_tags($message->message);
        $pdf->MultiCell(0, 10, $paragraph, 0, 'L');

        if ($pdf->PageNo() === $pdf->PageNo()) {
            $pdf->addPage('L');
            $pdf->SetFont('Arial', '', 11);
            $signature1 = "Sincerely,";
            $pdf->SetXY(15, -200);
            $pdf->Cell(0, 10, $signature1, 0, 1, '');
        
            // Add the second signature below the first signature
            $signature2 = "Signature";
            $pdf->SetXY(15,-191);
            $pdf->Cell(0, 10, $signature2, 0, 1, '');

            $image = public_path("storage/sig.png");
            $pdf->Image($image,15,26);

            $pdf->SetFont('Times', 'B', 12);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(15, -170);
            $pdf->Write(0, 'Lydia Kubai');

            $pdf->SetFont('Times','B',12);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetXY(15, -165);
            $pdf->Write(0, 'Deputy Director Human resource');

            $pdf->SetFont('Times', 'B', 13);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(15, -155);
            $pdf->Write(0, 'Cc. Jean-Paul Deprins');

            $pdf->SetFont('Times', 'B', 13);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(15, -150);
            $pdf->Write(0, 'Managing Director');

            $pdf->SetFont('Times', 'B', 13);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetXY(15, -140);
            $pdf->Write(0, 'Cc. HOD for the respective departments');

        }

        $data = [
            'intro' => 'Dear ' . $user->name . ',',
            'content' =>  'Find attach warning letter for reading and signing then send back', 
            'name' => $user->name,
            'email' => $user->email, 
            'subject' => 'Warning letter for '.$user->name
        ];
        Mail::send('messaging.mail', $data, function ($message) use ($data, $outputFilePath, $pdf) {
            $message->to($data['email'], $data['name'])
            ->cc('lydia@betterglobeforestry.com', 'jpd@betterglobeforestry.com')
            ->replyTo('lydia@betterglobeforestry.com','DDHR')
            ->subject($data['subject'])
            ->attachData( $pdf->Output($outputFilePath, 'S'),'warning-letter.pdf');
        });
    }

    
    private function numberToWord($number) {
        switch ($number) {
            case 1:
                return 'FIRST';
            case 2:
                return 'SECOND';
            case 3:
                return 'THIRD';
            // Add more cases for other numbers if needed
            default:
                return 'LAST CHANCE';
        }
    }

}
