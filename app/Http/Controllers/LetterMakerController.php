<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class LetterMakerController extends Controller
{
    public function index(Request $request)
    {
        $filePath = public_path("storage/warning.pdf");
        $outputFilePath = public_path("storage/warning letter.pdf");
        $this->fillPDFFile($filePath, $outputFilePath);

        return response()->file($outputFilePath);
    }

    /**
      * Write code on Method
     \*
      * @return response()
     */
    public function fillPDFFile($file, $outputFilePath)
    {

        $pdf = new FPDI;

        $pdf->addPage('L');
        $pagecount = $pdf->setSourceFile($file);;
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        $pdf->SetFont('Times','',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 51);
        $pdf->Write(0, '20/07/2023');

        $pdf->SetFont('Times','',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 58.5);
        $pdf->Write(0, 'Elvis Deprins');

        $pdf->SetFont('Times','',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 63.5);
        $pdf->Write(0, 'ICT intern');

        $pdf->SetFont('Times','',11);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 68);
        $pdf->Write(0, 'Head Office');

        $pdf->SetFont('Times','',13);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 78);
        $pdf->Write(0, 'Dear Sir/Madam,');

        $pdf->SetFont('Times','B',15);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 95);
        $pdf->Cell(0, 0, 'RE: FIRST WARNING LETTER,', 0, 1, '', 0, '', 1);

        $pdf->SetFont('Times','',13);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(15, 100);
        $paragraph = "I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace. I am writing to address some serious concerns regarding your recent conduct at the workplace.  I am writing to address some serious concerns regarding your recent conduct at the workplace.  I am writing to address some serious concerns regarding your recent conduct at the workplace.  I am writing to address some serious concerns regarding your recent conduct at the workplace.  I am writing to address some serious concerns regarding your recent conduct at the workplace. ";
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

        $pdf->Output();

        return $pdf->Output($outputFilePath, 'F');
    }
}
