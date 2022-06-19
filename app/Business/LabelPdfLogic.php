<?php

namespace App\Business;

use App\Models\Label;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class LabelPdfLogic
{
    /**
     * @var Label[]
     */
    private array $labels;

    public function __construct(array $labels)
    {
        $this->labels = $labels;
    }

    public function createLabelPdf()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->setOptions(['defaultFont' => 'sans-serif']);
        $pdf->loadView('labelManagement.labelPdf', ['labels' => $this->labels]);

        return $pdf->stream();
    }
}
