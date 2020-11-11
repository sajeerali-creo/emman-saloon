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
                <td style="width:50%" align="left">Printed on: <?php echo date("l, d F, Y H:i:s A"); ?></td>
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
                                <td>Laxmi</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- end header -->






            <table id="customers" style="width:100%">
                <tr>
                    <th style="font-size:12px">Week Ending</th>
                    <th style="font-size:12px">Clients</th>
                    <th style="font-size:12px">Services</th>
                    <th style="font-size:12px;">Amount w/o VAT</th>
                    <th style="font-size:12px;">VAT Amount</th>
                    <th style="font-size:12px; text-align: right">Amount w/ VAT</th>
                </tr>
                <tr>
                    <td style="font-size:12px">07/01/2020</td>
                    <td style="font-size:12px">20</td>
                    <td style="font-size:12px">
                        <div style="font-size:12px;">BLEACH (Hair)</div><br>
                        <div style="font-size:12px;">MASSAG E/M.BATH</div><br>
                        <div style="font-size:12px;">BLOWDR Y/HAIRST</div><br>
                        <div style="font-size:12px;">HAIR COLORIN</div><br>
                        <div style="font-size:12px;">HAIR TREATME</div><br>
                        <div style="font-size:12px;">BOTOX TREATME </div><br>
                        <div style="font-size:12px;">MAKE-UP</div><br>
                        <div style="font-size:12px;">NAILS</div><br>
                        <div style="font-size:12px;">WAX/THR EADING/B</div><br>
                        <div style="font-size:12px;">HAIRCUT</div>
                    </td>

                    <td style="font-size:12px;">
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div>
                    </td>
                    <td style="font-size:12px;">
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div><br>
                        <div style="font-size:12px;">0.00</div>
                    </td>
                    <td style="font-size:12px;">
                        <div style="font-size:12px; text-align: right">0.00</div><br>
                        <div style="font-size:12px; text-align: right">0.00</div><br>
                        <div style="font-size:12px; text-align: right">0.00</div><br>
                        <div style="font-size:12px; text-align: right">0.00</div><br>
                        <div style="font-size:12px; text-align: right">0.00</div><br>
                        <div style="font-size:12px; text-align: right">0.00</div><br>
                        <div style="font-size:12px; text-align: right">0.00</div><br>
                        <div style="font-size:12px; text-align: right">0.00</div><br>
                        <div style="font-size:12px; text-align: right">0.00</div><br>
                        <div style="font-size:12px; text-align: right">0.00</div>
                    </td>
                </tr>




                <!-- total -->
                <tr>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;">Totals</td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong>0.00</strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong>0.00</strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong>5,056.22</strong>
                    </td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333; text-align: right">
                        <strong>5,056.22</strong>
                    </td>

                </tr>
                <!-- total -->
            </table>

        </div>
    </div>

</body>

</html>