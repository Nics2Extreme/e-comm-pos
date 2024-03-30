<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <title>Sales</title>
    <style>
        html {
            font-size: 0.65em;
            font-family: "Arial Black", "Arial Bold", "Gadget", sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <h4 class="text-center">SALES REPORT</h4>
    <table>
        <thead>
            <tr>
                <th colspan="2">Date/Time</th>
                <th colspan="2">Invoice Number</th>
                <th colspan="2">Customer ID</th>
                <th colspan="2">Total Products</th>
                <th colspan="2">Payment Type</th>
                <th colspan="2">Sub Total</th>
                <th colspan="2">VAT</th>
                <th colspan="2">Total Amount Due</th>
            </tr>
        </thead>
        <tbody id="rows">
            @foreach ($sales as $sale)
                <tr>
                    <td colspan="2">{{ $sale->order_date }}</td>
                    <td colspan="2">{{ $sale->invoice_no }}</td>
                    <td colspan="2">{{ $sale->customer_id }}</td>
                    <td colspan="2">{{ $sale->total_products }}</td>
                    <td colspan="2">{{ $sale->payment_type }}</td>
                    <td colspan="2">{{ $sale->sub_total }}</td>
                    <td colspan="2">{{ $sale->vat }}</td>
                    <td colspan="2">{{ $sale->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
<script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script('
            $text = sprintf(_("Page %d/%d"),  $PAGE_NUM, $PAGE_COUNT);
            // Uncomment the following line if you use a Laravel-based i18n
            //$text = __("Page :pageNum/:pageCount", ["pageNum" => $PAGE_NUM, "pageCount" => $PAGE_COUNT]);
            $font = null;
            $size = 9;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default

            // Compute text width to center correctly
            $textWidth = $fontMetrics->getTextWidth($text, $font, $size);

            $x = ($pdf->get_width() - $textWidth) / 2;
            $y = $pdf->get_height() - 35;

            $pdf->text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        '); // End of page_script
    }
</script>

</html>