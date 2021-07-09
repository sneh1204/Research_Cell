<?php
include "config.php";
unset($_SESSION['access_token']);
$client->revokeToken();
session_destroy();
redirect('Ctrl_tform');
exit();
?>