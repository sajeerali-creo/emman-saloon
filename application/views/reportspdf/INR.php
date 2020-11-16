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
                        <strong style="font-size:24px; margin-bottom: 20px;">Inventory Report</strong>
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
            <!-- header -->
            <table id="customers" style="width:100%">
                <tr>
                    <th style="font-size:10px">ID</th>
                    <th style="font-size:10px">Supplier Name</th>
                    <th style="font-size:10px">Category</th>
                    <th style="font-size:10px">Product Name</th>
                    <th style="font-size:10px">Total Qty</th>
                    <th style="font-size:10px">Date of add</th>
                    <th style="font-size:10px">Cost of Buy (AED)</th>
                    <th style="font-size:10px">Buy Tax (%)</th>
                    <th style="font-size:10px">Cost Sales (AED)</th>
                    <th style="font-size:10px">Sell Tax (%)</th>
                    <th style="font-size:10px">Profit</th>
                    <th style="font-size:10px">Qty Instock</th>
                    <th style="font-size:10px;">Status</th>
                </tr><?php 
                $intCount = 1;
                foreach ($dataRecords as $productId => $value) {
                    ?><tr>
                        <td style="font-size:10px"><?php echo $intCount++; ?></td>
                        <td style="font-size:10px"><?php echo ($supplierRecords[$value->suppliers_id] ? $supplierRecords[$value->suppliers_id]['title'] : ''); ?></td>
                        <td style="font-size:10px"><?php echo $value->category_id; ?></td>
                        <td style="font-size:10px"><?php echo $value->title; ?></td>
                        <td style="font-size:10px"><?php echo number_format($value->quantity); ?></td>
                        <td style="font-size:10px"><?php echo $value->date_of_add; ?></td>
                        <td style="font-size:10px"><?php echo number_format($value->cost_of_buy, 2); ?></td>
                        <td style="font-size:10px"><?php echo $value->buy_tax; ?></td>
                        <td style="font-size:10px"><?php echo number_format($value->cost_of_sell, 2); ?></td>
                        <td style="font-size:10px"><?php echo $value->sell_tax; ?></td>
                        <td style="font-size:10px"><?php echo number_format($value->cost_of_sell - $value->cost_of_buy); ?></td>
                        <td style="font-size:10px"><?php echo number_format($value->remaining_quantity); ?></td><?php
                        if($value->status == 'AC'){
                            ?><td style="font-size:10px" class="text-success">In Stock</td><?php
                        }
                        else{
                            ?><td style="font-size:10px" class="text-danger">Out of Stock</td><?php
                        }
                    ?></tr><?php
                }
            ?></table>
        </div>
    </div>

</body>

</html>