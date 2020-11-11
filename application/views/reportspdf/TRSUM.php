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
        Printed on: <?php echo date("l, d F, Y H:i:s A"); ?><br/>Page: <span class="pagenum"></span>
    </div>
    <!-- end footer -->
    <div class="page">
        <div class="subpage">

            <!-- header -->
            <table style="width:100%">
                <tr>
                    <td style="width:50%">
                        <strong style="font-size:24px; margin-bottom: 20px;">Trading Summary</strong>
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
                                <td><?php echo ($datePeriod); ?> Day</td>
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

            <table style="width:100%; margin-bottom: 20px;">
                <tr>
                    <!-- Takings -->
                    <td style="width:30%; padding: 0px;">
                        <table id="customers">
                            <tr>
                                <th style="font-size:12px">Takings</th>
                            </tr>
                            <!-- cash -->
                            <tr>
                                <td style="padding:0px;">
                                    <table style="border:none; width:100%">
                                        <tr>
                                            <td style="width:50%">Cash</td>
                                            <td style="width:50%; text-align: right"><?php echo number_format($takings_cash, 2); ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- end cash -->
                            <!-- card -->
                            <tr>
                                <td style="padding:0px;">
                                    <table style="border:none; width:100%">
                                        <tr>
                                            <td style="width:50%">Card</td>
                                            <td style="width:50%; text-align: right"><?php echo number_format($takings_card, 2); ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- end card -->
                            <!-- total -->
                            <tr>
                                <td style="padding:0px;">
                                    <table style="border:none; width:100%">
                                        <tr>
                                            <td
                                                style="width:50%;border-top: 2px solid #333; border-bottom: 2px solid #333;">
                                                <strong>Total Takings</strong>
                                            </td>
                                            <td
                                                style="width:50%; text-align: right; border-top: 2px solid #333;border-bottom: 2px solid #333;">
                                                <strong><?php echo ($takings_total); ?></strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- end total -->
                            <!-- total -->
                            <tr>
                                <td style="padding:0px;">
                                    <table style="border:none; width:100%">
                                        <tr>
                                            <td style="width:50%; border-bottom: 2px solid #333;">
                                                <strong>Net Receipts</strong>
                                            </td>
                                            <td style="width:50%; text-align: right; border-bottom: 2px solid #333;">
                                                <strong><?php echo ($takings_total); ?></strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- end total -->
                        </table>
                    </td>
                    <!-- end Takings -->

                    <!-- Sales -->
                    <td style="width:70%" valign="top">
                        <table id="customers">
                            <tr>
                                <th style="font-size:12px">Sales</th>
                                <th style="font-size:12px">Qty</th>
                                <th style="font-size:12px">Ex-Tax</th>
                                <th style="font-size:12px; text-align: right">Inc-Tax</th>
                            </tr>
                            <!-- cash -->
                            <tr>
                                <td>Service</td>
                                <td><?php echo $service_qty; ?></td>
                                <td><?php echo $service_exTax_price; ?></td>
                                <td style="text-align: right"><?php echo $service_total; ?></td>
                            </tr>
                            <tr>
                                <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;">
                                    <strong>Total Sales (revenue)</strong>
                                </td>
                                <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                                <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;">
                                    <strong><?php echo $service_exTax_price; ?></strong>
                                </td>
                                <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;text-align: right">
                                    <strong><?php echo $service_total; ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;">
                                    <strong>Total Tax Payable</strong>
                                </td>
                                <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                                <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                                <td
                                    style="border-top: 2px solid #333; border-bottom: 2px solid #333; text-align: right">
                                    <strong><?php echo $service_total_tax; ?></strong>
                                </td>
                            </tr>

                        </table>
                    </td>
                    <!-- end Sales -->
                </tr>
            </table>


            <table id="customers" style="width:100%">
                <tr>
                    <th style="font-size:12px">Employee</th>
                    <th style="font-size:12px">Products Sales</th>
                    <th style="font-size:12px">Service Cost</th>
                    <th style="font-size:12px;">Service Charge</th>
                    <th style="font-size:12px;">Total</th>
                    <th style="font-size:12px;">%Total</th>
                    <th style="font-size:12px;">Employee Time</th>
                    <th style="font-size:12px; text-align: right">Serv. Sales/Hr</th>
                </tr><?php 
                    $intCount = 0;
                    $intTotPS = 0;
                    $intTotSCost = 0;
                    $intTotSCharge = 0;
                    $intTot = 0;
                    $intTotEmpTime = 0;
                    $intTotServiceSaleHr = 0;
                    foreach ($employeeSalesReport as $key => $value) {
                        ?><tr>
                            <td style="font-size:12px;"><?php echo $value['name']; ?></td>
                            <td style="font-size:12px;"><?php echo $value['product_sale']; ?></td>
                            <td style="font-size:12px;"><?php echo $value['serviceCost']; ?></td>
                            <td style="font-size:12px;"><?php echo $value['serviceCharge']; ?></td>
                            <td style="font-size:12px;"><?php echo $value['total']; ?></td>
                            <td style="font-size:12px;"><?php echo $value['totPercentage']; ?>%</td>
                            <td style="font-size:12px;"><?php echo $value['strTotalTime']; ?></td>
                            <td style="font-size:12px; text-align: right"><?php echo $value['serviceSaleInHr']; ?></td>
                        </tr><?php
                        $intTotPS += $value['product_sale'];
                        $intTotSCost += $value['serviceCost'];
                        $intTotSCharge += $value['serviceCharge'];
                        $intTot += $value['total'];
                        $intTotEmpTime += $value['totalTime'];
                        $intTotServiceSaleHr += $value['serviceSaleInHr'];

                        $intCount++;
                    }
                    if($intCount == 0){
                        $intCount = 1;
                    }
                ?><!-- total -->
                <tr>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo $intTotPS; ?></strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo $intTotSCost; ?></strong>
                    </td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo $intTotSCharge; ?></strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo $intTot; ?></strong>
                    </td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo floor($intTotEmpTime / 60) . " Hrs " . ($intTotEmpTime % 60) . " Mins"; ?></strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; text-align: right"><strong><?php echo number_format($intTotServiceSaleHr / $intCount, 2); ?></strong></td>
                </tr>
                <!-- total -->
            </table>
        </div>
    </div>

</body>

</html>