<?php
include "config5.php";
unset($_SESSION['access_token']);
$client->revokeToken();
session_destroy();
redirect('Ctrl_events');
exit();
?>