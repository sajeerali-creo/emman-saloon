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
                        <strong style="font-size:24px; margin-bottom: 20px;">Stock Received</strong>
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
            <?php

            $totAllUnitCost = 0;
            $totAllDiscount = 0;
            $totAllCost = 0;
            $totAllVat = 0;
            $totAllTotal = 0;

            $intTotSuppliers = count($arrAllStockInfo);
            $intCount = 0;
            foreach ($arrAllStockInfo as $supplier => $arrItemValue) {
                $intCount++;
                ?><table style="width:100%">
                    <tr>
                        <td style="width:100%">
                            <table style="font-size:12px; margin-top: 20px; margin-bottom:20px;">
                                <tr>
                                    <td colspan="2">
                                        <strong style="color:#8443ff"><?php echo $supplier; ?></strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!-- end header -->
                <hr>
                <table id="customers" style="width:100%">
                    <tr>
                        <th style="font-size:12px">Product</th>
                        <th style="font-size:12px">Barcode</th>
                        <th style="font-size:12px">Ordered:</th>
                        <th style="font-size:12px">Received:</th>
                        <th style="font-size:12px">Note</th>
                        <th style="font-size:12px;">Qty</th>
                        <th style="font-size:12px;">Unit Cost</th>
                        <!-- <th style="font-size:12px;">Discount</th> -->
                        <th style="font-size:12px;">Cost</th>
                        <th style="font-size:12px; text-align: right">VAT 5%</th>
                        <th style="font-size:12px; text-align: right">Total</th>
                    </tr><?php 

                    $totCatUnitCost = 0;
                    $totCatDiscount = 0;
                    $totCatCost = 0;
                    $totCatVat = 0;
                    $totCatTotal = 0;
                    foreach ($arrItemValue as $productId => $value) {
                        ?><tr>
                            <td style="font-size:12px"><?php echo $value['name']; ?></td>
                            <td style="font-size:12px"><?php echo $value['invoice']; ?></td>
                            <td style="font-size:12px"><?php echo $value['addDate']; ?></td>
                            <td style="font-size:12px"><?php echo $value['addDate']; ?></td>
                            <td style="font-size:12px"><?php echo $value['notes']; ?></td>
                            <td style="font-size:12px"><?php echo number_format($value['quantity'], 2); ?></td>
                            <td style="font-size:12px"><?php echo number_format($value['unitPrice'], 2); ?></td>
                            <!-- <td style="font-size:12px"><?php echo $value['discount']; ?></td> -->
                            <td style="font-size:12px"><?php echo number_format($value['totPriceExTax'], 2); ?></td>
                            <td style="font-size:12px"><?php echo number_format($value['totTax'], 2); ?></td>
                            <td style="font-size:12px; text-align:right"><?php echo number_format($value['totalPrice'], 2); ?></td>
                        </tr><?php

                        $totCatUnitCost += $value['unitPrice'];
                        $totCatDiscount += $value['discount'];
                        $totCatCost += $value['totPriceExTax'];
                        $totCatVat += $value['totTax'];
                        $totCatTotal += $value['totalPrice'];
                    }

                    $totAllUnitCost += $totCatUnitCost;
                    $totAllDiscount += $totCatDiscount;
                    $totAllCost += $totCatCost;
                    $totAllVat += $totCatVat;
                    $totAllTotal += $totCatTotal;
                    ?>

                    <!-- total -->
                    <tr>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong></strong></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong></strong>
                        </td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong></strong></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($totCatUnitCost, 2); ?></strong>
                        </td>
                        <!-- <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($totCatDiscount, 2); ?></strong> -->
                        </td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($totCatCost, 2); ?></strong>
                        </td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($totCatVat, 2); ?></strong>
                        </td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; text-align: right">
                            <strong><?php echo number_format($totCatTotal, 2); ?></strong>
                        </td>
                    </tr>
                    <!-- total -->
                    <?php 
                    if($intCount == $intTotSuppliers){
                        ?><!-- total -->
                        <tr>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;"></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;"></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;"></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;"><strong></strong></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;"><strong></strong>
                            </td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;"><strong></strong></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;  font-size: 14px;"><strong><?php echo number_format($totAllUnitCost, 2); ?></strong>
                            </td>
                            <!-- <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;  font-size: 14px;"><strong><?php echo number_format($totAllDiscount, 2); ?></strong>
                            </td> -->
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;  font-size: 14px;"><strong><?php echo number_format($totAllCost, 2); ?></strong>
                            </td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; background-color: #f1f1f1;  font-size: 14px;"><strong><?php echo number_format($totAllVat, 2); ?></strong>
                            </td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; text-align: right; background-color: #f1f1f1; font-size: 14px;"><strong><?php echo number_format($totAllTotal, 2); ?></strong>
                            </td>
                        </tr>
                        <!-- total --><?php
                    }
                    ?>
                </table><?php
            }
            ?>
        </div>
    </div>

</body>

</html>