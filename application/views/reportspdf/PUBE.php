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
                        <strong style="font-size:24px; margin-bottom: 20px;">Product Use by Employees</strong>
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

            <table style="width:100%">
                <tr>
                    <td>
                        <table style="font-size:12px;">
                            <tr>
                                <td><strong>For Employees:</strong></td>
                                <td>All Employees</td>
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
            <hr>


            <!-- each employee loop start here -->
            <table id="customers" style="width:100%; margin-bottom: 20px;">
                <tr>
                    <th style="font-size:12px">Date</th>
                    <th style="font-size:12px">Product Name</th>
                    <th style="font-size:12px">Client</th>
                    <th style="font-size:12px">Qty</th>
                    <th style="font-size:12px;">Cost</th>
                </tr>
                <tr>
                    <td colspan="9">
                        <strong>Joy.</strong>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">
                        31/10/2020 03:18:04PM
                    </td>
                    <td style="font-size:12px">Loriyal Shampoo</td>
                    <td style="font-size:12px"><b>Arjun</b><br>Dubai, United Arab Emirates</td>
                    <td style="font-size:12px">
                       2
                    </td>
                    <td style="font-size:12px;">
                       70.00
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">
                        31/10/2020 03:18:04PM
                    </td>
                    <td style="font-size:12px">Loriyal Shampoo</td>
                    <td style="font-size:12px"><b>Arjun</b><br>Dubai, United Arab Emirates</td>
                    <td style="font-size:12px">
                       2
                    </td>
                    <td style="font-size:12px;">
                       70.00
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">
                        31/10/2020 03:18:04PM
                    </td>
                    <td style="font-size:12px">Loriyal Shampoo</td>
                    <td style="font-size:12px"><b>Arjun</b><br>Dubai, United Arab Emirates</td>
                    <td style="font-size:12px">
                       2
                    </td>
                    <td style="font-size:12px;">
                       70.00
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">
                        31/10/2020 03:18:04PM
                    </td>
                    <td style="font-size:12px">Loriyal Shampoo</td>
                    <td style="font-size:12px"><b>Arjun</b><br>Dubai, United Arab Emirates</td>
                    <td style="font-size:12px">
                       2
                    </td>
                    <td style="font-size:12px;">
                       70.00
                    </td>
                </tr>
                <!-- total -->
                <tr>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong></strong>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong></strong>
                    </td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong></strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong>0.00</strong></td>
                    <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong>0.00</strong></td>
       
                </tr>
             
            </table>
            <!-- end each employee loop start here -->
        </div>
    </div>

</body>

</html>