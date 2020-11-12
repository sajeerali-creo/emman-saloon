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

    .footer {
        position: fixed;
        bottom: 0px;
    }

    .pagenum:before {
        content: counter(page);
    }

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
    <div class="divFooter footer" style="font-size:12px; width: 100%">
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
                        <strong style="font-size:24px; margin-bottom: 20px;">Employee Monthly Breakdown</strong>
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
            <table style="width:100%">
                <tr>
                    <td style="width:100%">
                        <table style="font-size:12px; margin-top: 20px; margin-bottom:20px;">
                            <tr>
                                <td>
                                    <strong>
                                        For Employee:
                                    </strong>
                                </td>
                                <td><?php echo $employeeName; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- end header -->






            <table id="customers" style="width:100%">
                <tr>
                    <th style="font-size:12px">Date</th>
                    <th style="font-size:12px">Clients</th>
                    <th style="font-size:12px">Services</th>
                    <th style="font-size:12px">Total Job</th>
                    <th style="font-size:12px;">Amount w/o VAT</th>
                    <th style="font-size:12px;">VAT Amount</th>
                    <th style="font-size:12px; text-align: right">Amount w/ VAT</th>
                </tr>
                <?php
                $totalClients = 0; 
                $totalJobs = 0; 
                $totalWOAmount = 0; 
                $totalVatAmount = 0; 
                $totalAmount = 0; 
                foreach ($arrEmployeeServiceInfo as $date => $value) {
                    $strCol1Html = '';
                    $strCol2Html = '';
                    $strCol3Html = '';
                    $strCol4Html = '';
                    $strCol5Html = '';
                    foreach ($value['services'] as $catName => $serInfo) {
                        $strCol1Html .= '<div style="font-size:12px;">' . $catName . '</div><br>';
                        $strCol2Html .= '<div style="font-size:12px;">' . $serInfo['serviceQnty'] . '</div><br>';
                        $strCol3Html .= '<div style="font-size:12px;">' . number_format($serInfo['servicePrice'], 2) . '</div><br>';
                        $strCol4Html .= '<div style="font-size:12px;">' . number_format($serInfo['vatPrice'], 2) . '</div><br>';
                        $strCol5Html .= '<div style="font-size:12px; text-align: right">' . number_format($serInfo['totalPrice'], 2) . '</div><br>';

                        $totalJobs += $serInfo['serviceQnty']; 
                        $totalWOAmount += $serInfo['servicePrice']; 
                        $totalVatAmount += $serInfo['vatPrice']; 
                        $totalAmount += $serInfo['totalPrice']; 
                    }
                    $totalClients += $value['client']; 
                    ?><tr>
                        <td style="font-size:12px;"><?php echo $date; ?></td>
                        <td style="font-size:12px;"><?php echo $value['client']; ?></td>
                        <td style="font-size:12px;"><?php echo(rtrim($strCol1Html, "<br>")); ?></td>
                        <td style="font-size:12px;"><?php echo(rtrim($strCol2Html, "<br>")); ?></td>
                        <td style="font-size:12px;"><?php echo(rtrim($strCol3Html, "<br>")); ?></td>
                        <td style="font-size:12px;"><?php echo(rtrim($strCol4Html, "<br>")); ?></td>
                        <td style="font-size:12px;"><?php echo(rtrim($strCol5Html, "<br>")); ?></td>
                    </tr><?php
                }
                ?>
                <!-- total -->
                <tr>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;">Totals</td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo $totalClients; ?></strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo $totalJobs; ?></strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($totalWOAmount, 2); ?></strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($totalVatAmount, 2); ?></strong>
                    </td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; text-align: right">
                        <strong><?php echo number_format($totalAmount, 2); ?></strong>
                    </td>

                </tr>
                <!-- total -->
            </table>

        </div>
    </div>

</body>

</html>