<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private $domPDF;

    public function __construct() {
        $this->domPDF = new domPdf();

        $pdfOptions = new Options();

        $this->domPDF->setPaper('A4', 'orientation');

        $pdfOptions->set('defaultFont', 'Courier');

        $this->domPDF->setOptions($pdfOptions);
    }

    public function showPdfFile($html) {
        $this->domPDF->loadHtml($html);
        $this->domPDF->render();
        $this->domPDF->stream("Contrat.pdf", [
            'Attachement' => false
        ]);
    }


    public function generateBinaryPDF($html) {
        $this->domPDF->loadHtml($html);
        $this->domPDF->render();
        $this->domPDF->output();
    }
}