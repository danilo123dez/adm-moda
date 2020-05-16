<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class LancamentosExport implements FromView, ShouldAutoSize, WithTitle, WithEvents
{
    use Exportable, RegistersEventListeners;

    protected $data;
    protected $view;
    protected $title;

    public function __construct($data)
    {

        $this->data = $data;
        $this->view = 'export.lancamentos';
        $this->title = 'relatorio';
    }

    public function view(): View
    {
        return view($this->view)->with(['data' => $this->data]);
    }

    public function title(): string
    {
        return $this->title;

    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('C')->setAutoSize(false);
            },
        ];
    }
}
