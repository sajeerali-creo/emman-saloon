<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            margin-bottom: 1cm;
            margin-top: 1cm;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        .divFooter {
            position: fixed;
            bottom: 0cm; 
            left: 0.5cm; 
            right: 0cm;
            height: 1cm;
        }

        .footer { position: fixed; bottom: 0px; }
        .pagenum:before { content: counter(page); }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 20cm;
            min-height: 29.7cm;
            padding: 0.5cm;
            margin: 0px;
            border-radius: 5px;
            background: white;
        }


        @page {
            size: A4;
            margin: 0cm;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            padding: 8px;
            font-size: 12px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #8443ff;
            color: white;
        }

        @media print {
            .divFooter {
                position: fixed;
                bottom: 0;
            }
        }
    </style>
</head>

<body>
    <!-- footer -->
    <div class="divFooter footer" style="font-size:12px; padding: 20px 0px; width: 100%">
        <hr>
        <table style="width:100%">
            <tr>
                <td style="width:50%" align="left">Printed on: <?php echo date("l, d F, Y h:i:s A"); ?></td>
                <td style="text-align-right width:50%;" align="right">Page: <span class="pagenum"></span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
    </div>
    <!-- end footer -->
    <div class="page">
        <div class="subpage">

            <!-- header -->
            <table style="width:100%">
                <tr>
                    <td style="width:50%">
                        <strong style="font-size:24px; margin-bottom: 20px;">Professional Stock Usage</strong>
                        <table style="font-size:12px; margin-top: 20px; margin-bottom:20px;">
                            <tr>
                                <td>From:</td>
                                <td><?php echo $fromDate; ?></td>
                            </tr>
                            <tr>
                                <td>To:</td>
                                <td><?php echo $toDate; ?></td>
                            </tr>
                            <tr>
                                <td>Time Period:</td>
                                <td><?php echo ($datePeriod); ?></td>
                            </tr>
                            <tr>
                                <td st>For:</td>
                                <td>All Companies Usage.</td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align:right; width:50%" align="right">
                        <img src="<?php echo $logo; ?>" alt="" style="width:90px"><br>
                        <b style="font-size:12px">E M A N Ladies Beauty Saloon</b>
                    </td>
                </tr>
            </table>
            <!-- end header -->
            <hr>



        


            <table id="customers" style="width:100%">
                <tr>
                    <th style="font-size:12px">Product Name</th>
                    <th style="font-size:12px">Qty</th>
                    <th style="font-size:12px;">Average Product Cost</th>
                    <th style="font-size:12px;">Total Product Cost</th>
                    <th style="font-size:12px">Note</th>
                    <th style="font-size:12px; text-align: right">Amount w/o VAT</th>
                    <th style="font-size:12px; text-align: right">VAT Amount</th>
                    <th style="font-size:12px; text-align: right">Amount w/ VAT</th>
                </tr><?php

                $intTotalQnty = 0;
                $intTotalAvgCost = 0;
                $intTotalCost = 0;
                $intTotalExTax = 0;
                $intTotalTax = 0;
                $intTotalPrice = 0;
                foreach ($productInfo as $key => $value) {
                    $itemTotalPrice = number_format($value['total'], 2, '.', '');
                    $itemExTaxPrice = number_format($value['totalExcludeTax'], 2, '.', '');
                    $itemTaxPrice = number_format($value['totalTax'], 2, '.', '');
                    $averagePrice = number_format(($itemTotalPrice/$value['quantity']), 2, '.', '');
                    ?><tr>
                        <td style="font-size:12px"><?php echo $value['productName']; ?></td>
                        <td style="font-size:12px"><?php echo number_format($value['quantity'], 2); ?></td>
                        <td style="font-size:12px"><?php echo number_format($averagePrice, 2); ?></td>
                        <td style="font-size:12px;"><?php echo number_format($itemTotalPrice, 2); ?></td>
                        <td style="font-size:12px;">Saloon use</td>
                        <td style="font-size:12px; text-align: right"><?php echo number_format($value['totalExcludeTax'], 2); ?></td>
                        <td style="font-size:12px; text-align: right"><?php echo number_format($value['totalTax'], 2); ?></td>
                        <td style="font-size:12px; text-align: right"><?php echo number_format($itemTotalPrice, 2); ?></td>
                    </tr><?php

                    $intTotalQnty += $value['quantity'];
                    $intTotalAvgCost += $averagePrice;
                    $intTotalCost += $itemTotalPrice;
                    $intTotalExTax += $itemExTaxPrice;
                    $intTotalTax += $itemTaxPrice;
                    $intTotalPrice += $itemTotalPrice;
                }
                ?>
                <!-- total -->
                <tr>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intTotalQnty, 2); ?></strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intTotalAvgCost, 2); ?></strong>
                    </td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intTotalCost, 2); ?></strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong></strong>
                    </td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intTotalExTax, 2); ?></strong>
                    </td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intTotalTax, 2); ?></strong>
                    </td>
              
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; text-align: right"><strong><?php echo number_format($intTotalPrice, 2); ?></strong></td>
                </tr>
                <!-- total -->
            </table>
        </div>
    </div>

</body>

</html>