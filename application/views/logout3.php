<?php
include "config4.php";
unset($_SESSION['access_token']);
$client->revokeToken();
session_destroy();
redirect('Ctrl_projects');
exit();
?>