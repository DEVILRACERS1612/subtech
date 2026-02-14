<?php 
require '../config/config.inc.php';
require '../Model/class.login.php';

    $login->uname = $db->filterVar($_POST['username']);
    $login->pass = $db->filterVar($_POST['pass']);

    if($login->login_check()){
        echo '{"type":"success","message":"<div class=\"alert alert-success\">Login SuccessFull</div>"}';
    }
    else{
        echo '{"type":"fail","message":"<div class=\"alert alert-danger\">Invalid Credential</div>"}';
    }

?>