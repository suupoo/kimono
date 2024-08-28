@props(['table','records', 'columns'])
{{--
  notes:
   style でカラム毎のスタイルを設定できる
   pdfColumnsと連動したクラス名となる
--}}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <style>
            body {
                margin: 0;
            }
            .cell{
                font-size: 0.5cm;
                width: 49.5%;
                height: 50mm;
                margin: 0.2mm;
                padding: 2mm;
                border: 0.1mm solid #000;
            }
            .customers.customer_name{
                font-size: 0.7cm;
                font-weight: bold;
            }
            .customers.post_code{
                font-size: 0.5cm;
                font-weight: bold;
            }
            .customers.address{
                font-size: 0.5cm;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>

    <div id="wrapper">
        <table style="width: 100%">
            @php
              $no = 0;
              $count = $records->count();
            @endphp

            @for($i = 0; $i < $count; $i+= 2)
                @php
                    $recordEven = $records->get($i);
                    $recordOdd  = $records->get($i + 1);
                    if ($recordEven == null && $recordOdd == null) break;
                @endphp
                {{-- ２行毎に出力 --}}
                <tr class="row">
                    <td class="cell even" >
                        @if($recordEven)
                            @foreach($columns as $column)
                            <div class="col {{$column}} {{$table}}">{{ $recordEven->{$column} }}</div>
                            @endforeach
                        @endif
                    </td>
                    <td class="cell odd" >
                        @if($recordOdd)
                            @foreach($columns as $column)
                            <div class="col {{$column}} {{$table}}">{{ $recordOdd->{$column} }}</div>
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endfor
        </table>
    </div>
</body>
</html>
