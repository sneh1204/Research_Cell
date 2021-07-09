<?php
include "config3.php";
unset($_SESSION['access_token']);
$client->revokeToken();
session_destroy();
redirect('Ctrl_sform');
exit();
?>