<?php
$check_outcome=$_REQUEST['SUCCESS'];
if($check_outcome=="-1")
{
echo "Sorry your transaction was not processed successfully,either your PIN or Serial No was not entered correctly <br/>";
echo "<a href='demo_etransact.php'>Click here to try again </a>";
}
else
{
$rn=$_GET['RECEIPT_NO'];

$pc=$_REQUEST['PAYMENT_CODE'];
$ti=$_REQUEST['TELLER_ID'];
$ta=$_REQUEST['TRANS_AMOUNT'];
$td=$_REQUEST['TRANS_DATE'];
$ca=$_REQUEST['CUSTOMER_ADDRESS'];

echo "Your transaction has been succesfully processed and below are some of the transaction details

<br/>
PAYMENT CODE :$pc
<br/>
TELLER ID: $ti
<br/>
TRANSACTION AMOUNT: $ta
<br/>
TRANSACTION DATE: $td
<br/>
CUSTOMER ADDRESS :$ca
<br/>


";



}


?>