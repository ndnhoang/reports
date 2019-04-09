<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php 

if ($report_metas->period && $report_metas->period->period_from && $report_metas->period->period_to && $report_metas->last_year) {
    $period_from = $report_metas->period->period_from;
    $period_to = $report_metas->period->period_to;
    $last_year = $report_metas->last_year;
    $valueCurrentCols = $last_year - $period_from + 1;
    $valueFutureCols = $period_to - $last_year;
    $valueCols = $valueCurrentCols * 2 + $valueFutureCols;
} else {
    $period_from = 0;
    $period_to = 0;
    $last_year = 0;
    $valueCols = 0;
    $valueCurrentCols = 0;
    $valueFutureCols = 0;
}
$totalCols = $valueCols + 3;
?>
<table>
    <thead>
        <tr>
            @for ($i = 0; $i < $totalCols - 2; $i++) 
                <th></th>
            @endfor
            <th colspan="2">{{ $report->report_type->name }}</th>
        </tr>
        <tr>
            @for ($i = 0; $i < $totalCols - 4; $i++) 
            <th></th>
            @endfor
            <th colspan="4">(Số liệu tính đến ngày 31/12/{{ $report_metas->last_year }})</th>
        </tr>
        <tr>
            <th colspan="{{ $totalCols }}">
                @uppercase($report->name) GIAI ĐOẠN {{ $report_metas->period ? $report_metas->period->period_from : ''}}-{{ $report_metas->period ? $report_metas->period->period_to : ''}}<br>
                (Kèm theo công văn số   /UBND-TH ngày     /{{ $report_metas->dispatch_date }} của UBND tỉnh Thừa Thiên Huế)
            </th>
        </tr>
        <tr>
            <th colspan="{{ $totalCols }}">Đơn vị tính: Triệu đồng</th>
        </tr>
        <tr>
            <th rowspan="2">TT</th>
            <th rowspan="2">Nguồn thu của Quỹ</th>
            <th rowspan="2">Chi tiết (tỷ lệ % hoặc mức đóng góp, đối tượng nộp và nội dung nguồn thu của Quỹ)</th>
            @if ($period_from > 0 && $period_to > 0 && $last_year > 0)
                @for ($i = $period_from; $i <= $last_year; $i++)
                    <th colspan="2">Năm {{ $i }}</th>
                @endfor

                @for ($i = $last_year + 1; $i <= $period_to; $i++)
                    <th rowspan="2">Kế hoạch {{ $i }}</th>
                @endfor
            @endif
        </tr>
        <tr>
            @if ($period_from > 0 && $last_year > 0)
                @for ($i = 0; $i < $valueCurrentCols; $i++)
                    <th>KH</th>
                    <th>TH</th>
                @endfor
            @endif
        </tr>
        <tr>
            <th>A</th>
            <th>B</th>
            <td>1</td>
            @if ($period_from > 0 && $period_to > 0 && $last_year > 0)
                @for ($i = 2; $i <= $valueCols + 1; $i++)
                    <td>{{ $i }}</td>
                @endfor
            @endif
        </tr>
    </thead>
    <tbody>
        @if ($departments_selected)
            @foreach ($departments_selected as $key => $item)
                <?php $item = App\Department::find($item) ?>
                <tr>
                    <th><?php echo NumConvert::roman($key + 1); ?></th>
                    <th>@uppercase($item->name)</th>
                    <th></th>
                    @if ($period_from > 0 && $last_year > 0)
                        @for ($i = 0; $i < $valueCurrentCols * 2; $i++)
                            <th></th>
                        @endfor
                        @for ($i = 0; $i < $valueFutureCols; $i++)
                            <th></th>
                        @endfor
                    @endif
                </tr>
                <?php $meta_value = $item->reports()->where('report_id', $report->id)->first()->pivot->value ?>
                @if ($meta_value)
                    <?php $meta_value = json_decode($meta_value) ?>

                    @foreach($meta_value as $index => $value)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $value }}</td>
                            <?php $value_data = $item->reports()->where('report_id', $report->id)->first()->pivot->value_data ?>
                            <?php $value_data = json_decode($value_data) ?> 
                            <?php $departmentTmp = $item->id ?>
                            <?php $count_key = $value_data ? count($value_data->$departmentTmp->detail) : 0; ?>
                            <td>{{ ($index < $count_key) ? str_replace('.', '', $value_data->$departmentTmp->detail[$index]) : '' }}</td>
                            @for ($i = $period_from; $i <= $last_year; $i++)
                                <?php $year = 'year_'.$i ?>
                                <?php $count_kh = $value_data ? count($value_data->$departmentTmp->$year->kh) : 0 ?>
                                <?php $count_th = $value_data ? count($value_data->$departmentTmp->$year->th) : 0 ?>
                                <td>{{ ($index < $count_kh) ? str_replace('.', '', $value_data->$departmentTmp->$year->kh[$index]) : '' }}</td>
                                <td>{{ ($index < $count_th) ? str_replace('.', '', $value_data->$departmentTmp->$year->th[$index]) : '' }}</td>
                            @endfor
                            @for ($i = $last_year + 1; $i <= $period_to; $i++)
                                <?php $year = 'year_'.$i ?>
                                <?php $count_kh = $value_data ? count($value_data->$departmentTmp->$year->kh) : 0 ?>
                                <td>{{ ($index < $count_kh) ? str_replace('.', '', $value_data->$departmentTmp->$year->kh[$index]) : '' }}</td>
                            @endfor
                        </tr>
                    @endforeach
                @endif
                <?php $departmentChilds = App\Department::where('parent', $item->id)->get(); ?>
                @if ($departmentChilds)
                    @foreach ($departmentChilds as $key_child => $child)
                        <tr>
                            <th><?php echo NumConvert::roman($key + 1); ?>.{{ $key_child + 1 }}</th>
                            <th>{{ $child->name }} (tách ra từ <?php echo NumConvert::roman($key + 1); ?>)</th>
                            <th></th>
                            @if ($period_from && $last_year)
                                @for ($i = 0; $i < $valueCurrentCols * 2; $i++)
                                    <th></th>
                                @endfor
                                @for ($i = 0; $i < $valueFutureCols; $i++)
                                    <th></th>
                                @endfor
                            @endif
                        </tr>
                        @if ($meta_value)
                            @foreach($meta_value as $index => $value)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $value }}</td>
                                    <?php $departmentTmp = $child->id ?>
                                    <?php $count_key = $value_data ? count($value_data->$departmentTmp->detail) : 0; ?>
                                    <td>{{ ($index < $count_key) ? str_replace('.', '', $value_data->$departmentTmp->detail[$index]) : '' }}</td>
                                    @for ($i = $period_from; $i <= $last_year; $i++)
                                        <?php $year = 'year_'.$i ?>
                                        <?php $count_kh = $value_data ? count($value_data->$departmentTmp->$year->kh) : 0 ?>
                                        <?php $count_th = $value_data ? count($value_data->$departmentTmp->$year->th) : 0 ?>
                                        <td>{{ ($index < $count_kh) ? str_replace('.', '', $value_data->$departmentTmp->$year->kh[$index]) : '' }}</td>
                                        <td>{{ ($index < $count_th) ? str_replace('.', '', $value_data->$departmentTmp->$year->th[$index]) : '' }}</td>
                                    @endfor
                                    @for ($i = $last_year + 1; $i <= $period_to; $i++)
                                        <?php $year = 'year_'.$i ?>
                                        <?php $count_kh = $value_data ? count($value_data->$departmentTmp->$year->kh) : 0 ?>
                                        <td>{{ ($index < $count_kh) ? str_replace('.', '', $value_data->$departmentTmp->$year->kh[$index]) : '' }}</td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endif
    </tbody>
</table>
</body>
</html>