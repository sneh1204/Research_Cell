<?php 

include 'config.php';

if(isset($_SESSION['access_token'])){
  $client->setAccessToken($_SESSION['access_token']);
}
elseif(isset($_GET['code'])){
  try{
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
    $oauth = new Google_Service_Oauth2($client);
    $user = $oauth->userinfo_v2_me->get();
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name'];
    echo "<script>alert('Logged in!');window.location.href='".base_url()."index.php/Ctrl_tform/addPublication'; </script>";
  }catch(Google_Service_Exception $e){
    echo "<script>alert('Invalid request, relogin!');window.location.href='".base_url()."index.php/Ctrl_tform/'; </script>";
  }
}
else{
  echo "<script>alert('Invalid request, relogin!');window.location.href='".base_url()."index.php/Ctrl_tform/'; </script>";
}
echo "<script>alert('Logged in!');window.location.href='".base_url()."index.php/Ctrl_tform/addPublication'; </script>";
exit();

?>