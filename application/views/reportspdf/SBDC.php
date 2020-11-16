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
            <table id="customers" style="width:100%">
                <?php 
                if(!empty($arrAllServicesInfo)){
                    foreach ($arrAllServicesInfo as $key => $arrServiceItemInfo) {
                        ?><tr>
                            <th style="font-size:12px">Service</th>
                            <th style="font-size:12px">Qty</th>
                            <th style="font-size:12px;">Cost</th>
                            <th style="font-size:12px">Service charge (AED)</th>
                            <th style="font-size:12px;">Total Cost (AED)</th>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <strong><?php echo ucwords(strtolower($key)); ?></strong>
                            </td>
                        </tr><?php
                        $intQntyTot = 0;
                        $intCostTot = 0;
                        $arrClusterServieTot = array();
                        $arrClusterFullTot = array();
                        foreach ($arrServiceItemInfo as $key1 => $value) {
                            $intQntyTot += $value['qnty'];
                            $intCostTot += number_format($value['totalPrice'], 2, '.', '');
                            ?><tr>
                                <td style="font-size:12px"><?php echo ucwords(strtolower($key1)); ?></td>
                                <td style="font-size:12px"><?php echo $value['qnty']; ?></td>
                                <td style="font-size:12px;"><?php echo number_format($value['totalPrice'], 2); ?></td>
                                <td style="font-size:12px"><?php 

                                    foreach ($arrClusterInfo as $clusterId => $clusterName) {
                                        echo $clusterName . " (";
                                        if(!isset($value['serviceCharge'][$clusterId])){
                                            $value['serviceCharge'][$clusterId] = 0;
                                        }
                                        if(!isset($arrClusterServieTot[$clusterId])){
                                            $arrClusterServieTot[$clusterId] = number_format($value['serviceCharge'][$clusterId], 2, '.', '');
                                        }
                                        else{
                                            $arrClusterServieTot[$clusterId] += number_format($value['serviceCharge'][$clusterId], 2, '.', '');
                                        }
                                        echo number_format($value['serviceCharge'][$clusterId], 2);
                                        echo ")<br/>";
                                    }
                                ?></td>
                                <td style="font-size:12px"><?php 

                                    foreach ($arrClusterInfo as $clusterId => $clusterName) {
                                        echo $clusterName . " (";
                                        if(!isset($value['grnadTotalPrice'][$clusterId])){
                                            $value['grnadTotalPrice'][$clusterId] = 0;
                                        }
                                        if(!isset($arrClusterFullTot[$clusterId])){
                                            $arrClusterFullTot[$clusterId] = number_format($value['grnadTotalPrice'][$clusterId], 2, '.', '');
                                        }
                                        else{
                                            $arrClusterFullTot[$clusterId] += number_format($value['grnadTotalPrice'][$clusterId], 2, '.', '');
                                        }
                                        echo number_format($value['grnadTotalPrice'][$clusterId], 2);
                                        echo ")<br/>";
                                    }
                                ?></td>
                            </tr><?php
                        }
                        ?><!-- total -->
                        <tr style="background-color: #f2f2f2;">
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo $intQntyTot; ?></strong></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php echo number_format($intCostTot, 2); ?></strong>
                            </td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php 
                                foreach ($arrClusterInfo as $clusterId => $clusterName) {
                                    echo $clusterName . " (";
                                    if(!isset($arrClusterServieTot[$clusterId])){
                                        $arrClusterServieTot[$clusterId] = 0;
                                    }
                                    echo number_format($arrClusterServieTot[$clusterId], 2);
                                    echo ")<br/>";
                                }
                            ?></strong></td>
                            <td style="border-top: 2px solid #333; border-bottom: 2px solid #333;"><strong><?php 
                                foreach ($arrClusterInfo as $clusterId => $clusterName) {
                                    echo $clusterName . " (";
                                    if(!isset($arrClusterFullTot[$clusterId])){
                                        $arrClusterFullTot[$clusterId] = 0;
                                    }
                                    echo number_format($arrClusterFullTot[$clusterId], 2);
                                    echo ")<br/>";
                                }
                            ?></strong></td>
                        </tr>
                        <!-- total --><?php
                    }
                }
                else{
                    ?><tr>
                        <th style="font-size:12px">Service</th>
                        <th style="font-size:12px">Qty</th>
                        <th style="font-size:12px;">Cost</th>
                        <th style="font-size:12px">Service charge (AED)</th>
                        <th style="font-size:12px;">Total Cost (AED)</th>
                    </tr><?php
                }
                
                ?>
            </table>

        </div>
    </div>

</body>

</html>