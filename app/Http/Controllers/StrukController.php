<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\transaction as TransactionModel;
use Codedge\Fpdf\Fpdf\Fpdf;

class StrukController extends Controller
{
    private $fpdf;
    public $L;

    public function __construct()
    {

    }

    public function createPDF()
    {
        $L = 100;
        $this->fpdf = new Fpdf('P','mm',[$L,'75']);
        $this->fpdf->SetTopMargin(0);
        $this->fpdf->SetLeftMargin(5);
        $this->fpdf->SetRightMargin(5);
        $this->fpdf->SetFont('Courier', '', 10);
        $this->fpdf->SetAutoPageBreak(False,0);

        $this->fpdf->AddPage('P',['1','1']);

        $this->fpdf->Cell(0, 5, '',1,1,'C');
        $this->fpdf->Cell(0, 5, "Sumber Jaya",0,1,'C');
        $this->fpdf->Cell(0, 5, "Jl.sekiansekiansekian No.Sekian",0,1,'C');
        $this->fpdf->Cell(0, 5, "No.telp 11111111",0,1,'C');
        for($i=0; $i<50; $i++){
            $this->fpdf->Cell(0, 5, $i,1,1,'C');
            $L = $L+5;
        }

        $this->fpdf->AddPage('P',[$L-75,'75']);
        $this->fpdf->Cell(0, 5, '',1,1,'C');
        $this->fpdf->Cell(0, 5, "Sumber Jaya",0,1,'C');
        $this->fpdf->Cell(0, 5, "Jl.sekiansekiansekian No.Sekian",0,1,'C');
        $this->fpdf->Cell(0, 5, "No.telp 11111111",0,1,'C');
        for($i=0; $i<50; $i++){
            $this->fpdf->Cell(0, 5, $i,1,1,'C');
        }
        $this->fpdf->Close();
        $this->fpdf->Output();
        exit;
    }
}
