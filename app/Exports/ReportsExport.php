<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use App\Report;
use App\ReportMeta;
use App\Department;


class ReportsExport implements FromView, WithEvents
{
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function registerEvents(): array
    {
        $cols = 3;
        $rows = 7;
        $rows_title = array();
        $report_meta_period = ReportMeta::where('report_id', $this->id)->where('meta_name', 'period')->first();
        if ($report_meta_period) {
            $report_meta_period = json_decode($report_meta_period->meta_value);
        }

        $report_meta_last_year = ReportMeta::where('report_id', $this->id)->where('meta_name', 'last_year')->first();
        if ($report_meta_last_year) {
            $report_meta_last_year = $report_meta_last_year->meta_value;
        }
        if ($report_meta_period && $report_meta_period->period_from && $report_meta_period->period_to && $report_meta_last_year) {
            $cols = $cols + ($report_meta_last_year - $report_meta_period->period_from + 1) * 2 + ($report_meta_period->period_to -  $report_meta_last_year);
        }

        $report_meta_departments = ReportMeta::where('report_id', $this->id)->where('meta_name', 'departments')->first();
        if ($report_meta_departments) {
            $report_meta_departments = json_decode($report_meta_departments->meta_value);
            foreach($report_meta_departments as $key => $items) {
                $rows += 1;
                $rows_title[] = $rows;
                foreach ($items as $item) {
                    $rows += 1;
                }
                $department_childs = Department::where('parent', $key)->get();
                if ($department_childs) {
                    foreach ($department_childs as $child) {
                        $rows += 1;
                        $rows_title[] = $rows;
                        foreach ($items as $item) {
                            $rows += 1;
                        }
                    }
                }
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
            BeforeSheet::class => function(BeforeSheet $event) use ($styleArray, $cols, $rows, $rows_title) {
                
            },
            AfterSheet::class => function(AfterSheet $event) use ($styleArray, $cols, $rows, $rows_title) {

                $event->sheet->getStyle('A1:'.Coordinate::stringFromColumnIndex($cols).$rows)->applyFromArray($styleArray);  

                $event->sheet->getStyle('A3')->getFont()->setBold(true);
                $event->sheet->getStyle(Coordinate::stringFromColumnIndex($cols -1).'1')->getFont()->setBold(true);
                $event->sheet->getStyle('A5:'.Coordinate::stringFromColumnIndex($cols).'7')->getFont()->setBold(true);
                foreach ($rows_title as $row) {
                    $event->sheet->getStyle('A'.$row.':'.Coordinate::stringFromColumnIndex($cols).$row)->getFont()->setBold(true);
                }
                $event->sheet->getStyle('C7:'.Coordinate::stringFromColumnIndex($cols).'7')->getFont()->setBold(false);

                $event->sheet->getStyle(Coordinate::stringFromColumnIndex($cols - 1).'1')->getFont()->setItalic(true);
                $event->sheet->getStyle('C7:'.Coordinate::stringFromColumnIndex($cols).'7')->getFont()->setItalic(true);
                $event->sheet->getStyle('A4')->getFont()->setItalic(true);
                $event->sheet->getStyle(Coordinate::stringFromColumnIndex($cols - 3).'2')->getFont()->setItalic(true);

                $event->sheet->getColumnDimension('B')->setWidth(30);
                $event->sheet->getColumnDimension('C')->setWidth(12);

                $event->sheet->getRowDimension(3)->setRowHeight(40);
                $event->sheet->getRowDimension(6)->setRowHeight(100);

                $event->sheet->getStyle(Coordinate::stringFromColumnIndex($cols - 1).'1')->getAlignment()->setHorizontal('left');
                $event->sheet->getStyle('A3')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('A5:'.Coordinate::stringFromColumnIndex($cols).'7')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('A8:A'.$rows)->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle('B8:B'.$rows)->getAlignment()->setHorizontal('left');


                $event->sheet->getStyle('A5:'.Coordinate::stringFromColumnIndex($cols).$rows)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                
            }
        ];
    }

    public function view(): View
    {
        $report = Report::find($this->id);
        
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

        return view('admin.export.report', compact(['report', 'departments_selected', 'report_metas']));
    }
}

