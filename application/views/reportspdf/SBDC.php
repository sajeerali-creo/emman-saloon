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
                        <strong style="font-size:24px; margin-bottom: 20px;">Service Breakdown by Category</strong>
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
            <table id="customers" style="width:100%">
                <tr>
                    <th style="font-size:12px">Service</th>
                    <th style="font-size:12px">Qty</th>
                    <th style="font-size:12px;">Cost</th>
                    <th style="font-size:12px">Service charge (AED)</th>
                    <th style="font-size:12px;">Total Cost (AED)</th>
                </tr>
                <tr>
                    <td colspan="6">
                        <strong>Blowdry Extra Long</strong>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
            </table>
            
            <table id="customers" style="width:100%">
                <tr>
                    <th style="font-size:12px">Service</th>
                    <th style="font-size:12px">Qty</th>
                    <th style="font-size:12px;">Cost</th>
                    <th style="font-size:12px">Service charge (AED)</th>
                    <th style="font-size:12px;">Total Cost (AED)</th>
                </tr>
                <tr>
                    <td colspan="6">
                        <strong>Blowdry Extra Long</strong>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:12px">Blowdry Extra Long</td>
                    <td style="font-size:12px">1</td>
                    <td style="font-size:12px;">100</td>
                    <td style="font-size:12px">
                        Dubai (10)<br>
                        Abu Dhabi (10)<br>
                        Sharjah (10)<br>
                        Al Ain (10)<br>
                        Ajman (10)<br>
                        RAK City (10)<br>
                        Fujairah (10)<br>
                        Umm Al Quwain (10)<br>
                    </td>
                    <td style="font-size:12px">
                        Dubai (110)<br>
                        Abu Dhabi (110)<br>
                        Sharjah (110)<br>
                        Al Ain (110)<br>
                        Ajman (110)<br>
                        RAK City (110)<br>
                        Fujairah (110)<br>
                        Umm Al Quwain (110)<br>
                    </td>
                </tr>
            </table>

        </div>
    </div>

</body>

</html>