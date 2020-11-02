<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $pageTitle; ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/invoice/style.css" media="all" />
    </head>
    <body>
        <header class="clearfix">
            <div id="logo">
                <img src="<?php echo base_url(); ?>assets/invoice/logo.png">
            </div>
            <div id="company">
                <h2 class="name">Eman Saloon</h2>
                <div>Dubai, UAE,<br />
                    Phone (هاتف):+ 971 4 348 0009
                </div>
                <div>Email (اللكتروني البريد): info@emansalon.com</div>
                <div>TRN # 100021529100003</div>
            </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div style="text-align:center; font-size:22px;">
                    Invoice Tax (فاتورة ضريبية)
                </div>
                <br>
                <div id="client">
                    <div class="to">INVOICE TO:</div>
                    <h2 class="name"><?php echo $bookingInfo['customer_name']; ?></h2>
                </div>
                <div id="invoice">
                    <div>Receipt Number(رقم اليصال): <?php echo $bookingInfo['invoice_number']; ?></div>
                    <div class="date">Date of Invoice (تاريخ استلم
                        ): <?php echo $bookingInfo['invoiceGenDate']; ?>
                    </div>
                    <div class="date"><?php echo $bookingInfo['invoiceGenTime']; ?></div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no">#</th>
                        <th class="desc">Detail (تفاصيل)</th>
                        <th class="qty">Amount (مبلغ)</th>
                        <th class="unit">Qt(كمية)</th>
                        <th class="total">Total Amount (المبلغ الإجمالي)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $intCount = 1;
                    $intOrderTotal = 0;
                    $intVat = (empty($bookingInfo['tax']) ? 0 : $bookingInfo['tax']);
                    $intVatAmount = 0;
                    
                    $quantity   = $bookingInfo['quantity'];
                    $discount   = 0;
                    $price      = number_format($bookingInfo['item_price'], 2, '.', '');
                    $itemTotal  = ($price * $quantity);
                    $itemTotal -= $itemTotal * ($discount / 100);
                    $itemTotal  = (int)number_format($itemTotal, 2, '.', '');
                    $intOrderTotal += $itemTotal;
                    ?><tr>
                        <td class="no"><?php echo $intCount++; ?></td>
                        <td class="desc">
                            <h3><?php 
                                echo($bookingInfo['productName']);
                                if(isset($bookingInfo['productNameArabic']) && !empty($bookingInfo['productNameArabic'])){
                                    echo "(" . $bookingInfo['productNameArabic'] . ")";
                                }
                            ?></h3>
                            Product sold by: <?php echo($bookingInfo['teamMemberName']); ?> 
                        </td>
                        <td class="qty"><?php echo $price; ?> AED</td>
                        <td class="unit"><?php echo $quantity; ?></td>
                        <td class="total"><?php echo number_format($itemTotal, 2, '.', ','); ?> AED</td>
                    </tr><?php
                    
                    $intVatAmount = $intOrderTotal * ($intVat / 100);
                    $intVatAmount = number_format($intVatAmount, 2, '.', '');
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">SUBTOTAL</td>
                        <td><?php echo number_format($intOrderTotal, 2, '.', ',') ?> AED</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">TAX <?php echo $intVat; ?>%</td>
                        <td><?php echo number_format($intVatAmount, 2, '.', ',') ?> AED</td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">GRAND TOTAL</td>
                        <td><?php echo number_format(($intOrderTotal + $intVatAmount), 2, '.', ',') ?> AED</td>
                    </tr>
                </tfoot>
            </table>
            <div id="thanks">Thank you!</div>
        </main>
        <footer>
            Invoice was created on a computer and is valid without the signature and seal.
        </footer>
    </body>
</html>