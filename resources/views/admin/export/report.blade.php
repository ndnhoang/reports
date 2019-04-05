<?php 

if ($report_metas->period && $report_metas->period->period_from && $report_metas->period->period_to && $report_metas->last_year) {
    $valueCurrentCols = $report_metas->last_year - $report_metas->period->period_from + 1;
    $valueFutureCols = $report_metas->period->period_to - $report_metas->last_year;
    $valueCols = $valueCurrentCols * 2 + $valueFutureCols;
} else {
    $valueCols = 0;
    $valueCurrentCols = 0;
    $valueFutureCols = 0;
}
$totalCols = $valueCols + 3
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
            @if ($report_metas->period && $report_metas->period->period_from && $report_metas->period->period_to && $report_metas->last_year)
                @for ($i = $report_metas->period->period_from; $i <= $report_metas->last_year; $i++)
                    <th colspan="2">Năm {{ $i }}</th>
                @endfor

                @for ($i = $report_metas->last_year + 1; $i <= $report_metas->period->period_to; $i++)
                    <th rowspan="2">Kế hoạch {{ $i }}</th>
                @endfor
            @endif
        </tr>
        <tr>
            @if ($report_metas->period && $report_metas->period->period_from && $report_metas->last_year)
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
            @if ($report_metas->period && $report_metas->period->period_from && $report_metas->period->period_to && $report_metas->last_year)
                @for ($i = 2; $i <= $valueCols + 1; $i++)
                    <td>{{ $i }}</td>
                @endfor
            @endif
        </tr>
    </thead>
    <tbody>
        @if ($report_metas->money_sources)
            <?php $count = 0; ?>
            @foreach ($report_metas->money_sources as $key => $items)
                <?php $count++; ?>
                <tr>
                    <th><?php echo NumConvert::roman($count); ?></th>
                    <th>@uppercase(App\Department::find($key)->name)</th>
                    <th></th>
                    @if ($report_metas->period && $report_metas->period->period_from && $report_metas->last_year)
                        @for ($i = 0; $i < $valueCurrentCols * 2; $i++)
                            <th></th>
                        @endfor
                        @for ($i = 0; $i < $valueFutureCols; $i++)
                            <th></th>
                        @endfor
                    @endif
                </tr>
                @foreach($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item }}</td>
                        <td></td>
                        @for ($i = 0; $i < $valueCurrentCols * 2; $i++)
                            <td></td>
                        @endfor
                        @for ($i = 0; $i < $valueFutureCols; $i++)
                            <td></td>
                        @endfor
                    </tr>
                @endforeach
                <?php $departmentChilds = App\Department::where('parent', $key)->get(); ?>
                @if ($departmentChilds)
                    @foreach ($departmentChilds as $key_child => $child)
                        <tr>
                            <th><?php echo NumConvert::roman($count); ?>.{{ $key_child + 1 }}</th>
                            <th>{{ $child->name }} (tách ra từ <?php echo NumConvert::roman($count); ?>)</th>
                            <th></th>
                            @if ($report_metas->period && $report_metas->period->period_from && $report_metas->last_year)
                                @for ($i = 0; $i < $valueCurrentCols * 2; $i++)
                                    <th></th>
                                @endfor
                                @for ($i = 0; $i < $valueFutureCols; $i++)
                                    <th></th>
                                @endfor
                            @endif
                        </tr>
                        @foreach($items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item }}</td>
                                <td></td>
                                @for ($i = 0; $i < $valueCurrentCols * 2; $i++)
                                    <td></td>
                                @endfor
                                @for ($i = 0; $i < $valueFutureCols; $i++)
                                    <td></td>
                                @endfor
                            </tr>
                        @endforeach
                    @endforeach
                @endif
            @endforeach
        @endif
    </tbody>
</table>