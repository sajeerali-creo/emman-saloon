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
            margin: 0cm 0cm;
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
            font-size: 8px;
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
                        <strong style="font-size:24px; margin-bottom: 20px;">Transactions by Employee</strong>
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

            <table style="width:100%">
                <tr>
                    <td>
                        <table style="font-size:12px;">
                            <tr>
                                <td><strong>For Employees:</strong></td>
                                <td><?php echo $employeeName; ?></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
            <table style="width:100%">
                <tr>
                    <td>
                        <table style="font-size:12px; ">
                            <tr>
                                <td><strong>For Services, Products, Sundry, Series, Membership</strong></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
            <hr><?php

            foreach ($arrEmployeeServiceInfo as $empId => $arrEmpValue) {

                $intPersonTransTot = 0;
                $intPersonAmtTot = 0;
                $intPersonDisTot = 0;
                $intPersonSerChgTot = 0;
                $intPersonVatTot = 0;
                $intPersonTotAmtTot = 0;

                ?> <!-- each employee loop start here -->
                <table id="customers" style="width:100%; margin-bottom: 20px;">
                    <tr>
                        <th style="font-size:8px">Date</th>
                        <th style="font-size:8px">Tranc</th>
                        <th style="font-size:8px">Client</th>
                        <th style="font-size:8px">Item</th>
                        <th style="font-size:8px;">Amount</th>
                        <th style="font-size:8px;">Discount</th>
                        <th style="font-size:8px;">Service Charge</th>
                        <th style="font-size:8px;">Vat(5%)</th>
                        <th style="font-size:8px;text-align: right">Total Amount Session</th>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <strong><?php echo $arrEmpValue['empName']; ?></strong>
                        </td>
                    </tr><?php

                    foreach ($arrEmpValue['services'] as $cartMasterId => $arrServiceInfo) {
                        $intServiceTransTot = 0;
                        $intServiceAmtTot = 0;
                        $intServiceDisTot = 0;
                        $intServiceSerChgTot = 0;
                        $intServiceVatTot = 0;
                        $intServiceTotAmtTot = 0;

                        $intServiceTransTot = $arrServiceInfo['trans'];
                        $strServiceName = '';
                        $strServiceAmt = '';
                        $strServiceDis = '';
                        $strServiceSerChg = '';
                        $strServiceVat = '';
                        $strServiceTotAmt = '';

                        foreach ($arrServiceInfo['service'] as $cartId => $value) {
                            $strServiceName .= $value['serviceName'] . "<br/>";
                            $strServiceAmt .= number_format($value['price'], 2) . "<br/>";
                            $strServiceDis .= number_format($value['discount'], 2) . "<br/>";
                            $strServiceSerChg .= number_format($value['serviceCharge'], 2) . "<br/>";
                            $strServiceVat .= number_format($value['vat'], 2) . "<br/>";
                            $strServiceTotAmt .= number_format($value['total'], 2) . "<br/>";

                            $intServiceAmtTot += $value['price'];
                            $intServiceDisTot += $value['discount'];
                            $intServiceSerChgTot += $value['serviceCharge'];
                            $intServiceVatTot += $value['vat'];
                            $intServiceTotAmtTot += $value['total'];
                        }

                        ?><tr>
                            <td style="font-size:8px"><?php echo $arrServiceInfo['addDate']; ?></td>
                            <td style="font-size:8px"><?php echo $arrServiceInfo['trans']; ?></td>
                            <td style="font-size:8px"><b><?php echo $arrServiceInfo['client_name']; ?></b><br><?php echo $arrServiceInfo['address']; ?></td>
                            <td style="font-size:8px"><?php echo $strServiceName; ?></td>
                            <td style="font-size:8px;"><?php echo $strServiceAmt; ?></td>
                            <td style="font-size:8px;"><?php echo $strServiceDis; ?></td>
                            <td style="font-size:8px;"><?php echo $strServiceSerChg; ?></td>
                            <td style="font-size:8px;"><?php echo $strServiceVat; ?></td>
                            <td style="font-size:8px; text-align: right"><?php echo $strServiceTotAmt; ?></td>
                        </tr>
                        <?php

                        ?><!-- total -->
                        <tr style="background-color: #f2f2f2;">
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo $intServiceTransTot; ?></strong></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intServiceAmtTot, 2); ?></strong>
                            </td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intServiceDisTot, 2); ?></strong></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intServiceSerChgTot, 2); ?></strong></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intServiceVatTot, 2); ?></strong></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; text-align: right">
                                <strong><?php echo number_format($intServiceTotAmtTot, 2); ?></strong></td>
                        </tr>
                        <!-- total --><?php

                        $intPersonTransTot += $intServiceTransTot;
                        $intPersonAmtTot += $intServiceAmtTot;
                        $intPersonDisTot += $intServiceDisTot;
                        $intPersonSerChgTot += $intServiceSerChgTot;
                        $intPersonVatTot += $intServiceVatTot;
                        $intPersonTotAmtTot += $intServiceTotAmtTot;
                    }

                    ?><!-- grand total -->
                    <tr>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-size: 12px;">
                                <strong><?php echo $intPersonTransTot; ?></strong>
                            </td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-size: 12px;">
                            <strong><?php echo number_format($intPersonAmtTot, 2); ?></strong>
                        </td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-size: 12px;">
                            <strong><?php echo number_format($intPersonDisTot, 2); ?></strong></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-size: 12px;">
                            <strong><?php echo number_format($intPersonSerChgTot, 2); ?></strong></td>
                        <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-size: 12px;">
                            <strong><?php echo number_format($intPersonVatTot, 2); ?></strong></td>
                        <td
                            style="border-top: 2px solid #333; border-bottom: 2px solid #333; text-align: right; font-size: 12px;">
                            <strong><?php echo number_format($intPersonTotAmtTot, 2); ?></strong></td>
                    </tr>
                    <!-- grand total -->
                </table><?php
            }
            ?>
        </div>
    </div>

</body>

</html>