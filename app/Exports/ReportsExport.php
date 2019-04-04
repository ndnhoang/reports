<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use App\Report;
use Str;


class ReportsExport implements FromView, WithEvents
{
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function registerEvents(): array
    {
        $styleArray = [
            'font' => [
                'size' => 10,
                'name' => 'Times New Roman',
            ],
            'alignment' => [
                'horizontal' => 'right',
                'vertical' => 'center',
                'wrapText' => true,
            ]
        ];

        return [
            BeforeSheet::class => function(BeforeSheet $event) use ($styleArray) {
                
            },
            AfterSheet::class => function(AfterSheet $event) use ($styleArray) {

                $event->sheet->getStyle('A1:U27')->applyFromArray($styleArray);  

                $event->sheet->getStyle('A3')->getFont()->setBold(true);
                $event->sheet->getStyle('T1')->getFont()->setBold(true);
                $event->sheet->getStyle('A5:U8')->getFont()->setBold(true);
                $event->sheet->getStyle('A12:U12')->getFont()->setBold(true);
                $event->sheet->getStyle('A16:U16')->getFont()->setBold(true);
                $event->sheet->getStyle('A20:U20')->getFont()->setBold(true);
                $event->sheet->getStyle('A24:U24')->getFont()->setBold(true);

                $event->sheet->getStyle('C7:U7')->getFont()->setItalic(true);
                $event->sheet->getStyle('A4')->getFont()->setItalic(true);
                $event->sheet->getStyle('R2')->getFont()->setItalic(true);

                $event->sheet->getColumnDimension('B')->setWidth(30);
                $event->sheet->getColumnDimension('C')->setWidth(12);

                $event->sheet->getRowDimension(3)->setRowHeight(40);
                $event->sheet->getRowDimension(6)->setRowHeight(100);

                $event->sheet->getStyle('T1')->getAlignment()->setHorizontal('left');
                $event->sheet->getStyle('A3')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('A5:U7')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('A8:A27')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('B8:B27')->getAlignment()->setHorizontal('left');


                $event->sheet->getStyle('A5:U27')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                
            }
        ];
    }

    public function view(): View
    {
        $report = Report::find($this->id);
        $name = Str::upper($report->name);
        return view('admin.export.report', compact(['report', 'name']));
    }
}

