<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReportsExport implements FromView, WithEvents
{
    public function registerEvents(): array
    {
        $styleArray = [
            'font' => [
                'bold' => true
            ],
            'alignment' => [
                'horizontal' => 'center'
            ]
        ];

        return [
            AfterSheet::class => function(AfterSheet $event) use ($styleArray) {

                $event->sheet->getStyle('A4:U6')->applyFromArray($styleArray);  

                $event->sheet->getStyle('A1:U26')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A1:A23')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A12:U12')->getFont()->setBold(true);
                $event->sheet->getStyle('A16:U16')->getFont()->setBold(true);
                $event->sheet->getStyle('A20:U20')->getFont()->setBold(true);
                $event->sheet->getStyle('A20:U20')->getFont()->setBold(true);

                $event->sheet->getColumnDimension('B')->setWidth(30);
                $event->sheet->getStyle('A1:U23')->getAlignment()->setWrapText(true);

                $event->sheet->getStyle('A4:U26')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                $event->sheet->getStyle('A4:U4')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_DOTTED);
                
            }
        ];
    }

    public function view(): View
    {
        return view('admin.export.report');
    }
}
