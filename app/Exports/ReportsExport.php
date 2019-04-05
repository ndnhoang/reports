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
use App\ReportMeta;
use Str;


class ReportsExport implements FromView, WithEvents
{
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function registerEvents(): array
    {
        $report_meta_departments = ReportMeta::where('report_id', $this->id)->where('meta_name', 'departments')->first();
        $departments_selected = array();
        if ($report_meta_departments) {
            $report_meta_departments = json_decode($report_meta_departments->meta_value);
            foreach($report_meta_departments as $key => $item) {
                $departments_selected[] = $key;
            }
        }

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
                $event->sheet->getStyle('C7:U7')->getFont()->setBold(false);

                $event->sheet->getStyle('T1')->getFont()->setItalic(true);
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
        
        $report_meta_period = ReportMeta::where('report_id', $this->id)->where('meta_name', 'period')->first();
        if ($report_meta_period) {
            $report_meta_period = json_decode($report_meta_period->meta_value);
        }

        $report_meta_last_year = ReportMeta::where('report_id', $this->id)->where('meta_name', 'last_year')->first();
        if ($report_meta_last_year) {
            $report_meta_last_year = $report_meta_last_year->meta_value;
        }

        $report_meta_dispatch_date = ReportMeta::where('report_id', $this->id)->where('meta_name', 'dispatch_date')->first();
        if ($report_meta_dispatch_date) {
            $report_meta_dispatch_date = $report_meta_dispatch_date->meta_value;
        }

        $report_meta_departments = ReportMeta::where('report_id', $this->id)->where('meta_name', 'departments')->first();
        $departments_selected = array();
        if ($report_meta_departments) {
            $report_meta_departments = json_decode($report_meta_departments->meta_value);
            foreach($report_meta_departments as $key => $item) {
                $departments_selected[] = $key;
            }
        }

        $report_metas = json_decode(json_encode(array('period' => $report_meta_period, 'last_year' => $report_meta_last_year, 'dispatch_date' => $report_meta_dispatch_date, 'departments' => $departments_selected, 'money_sources' => $report_meta_departments)));

        return view('admin.export.report', compact(['report', 'name', 'departments_selected', 'report_metas']));
    }
}

