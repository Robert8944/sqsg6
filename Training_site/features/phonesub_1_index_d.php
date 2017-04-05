<?php
/**
This erroneous version wipes out any error messages that should have appeared.
*/
$_SESSION['SMSReport'] = " ";
$_SESSION['SubscriptionReport'] = " ";
echo '<meta http-equiv="refresh" content="0; ../index.php" />';
?>
