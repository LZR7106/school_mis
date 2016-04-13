<?php
session_start();
include 'functions.php';

if (isset($_SESSION['user']))
{
	destroySession();//调用SESSION过期方法
}

redirect('login.php');

?>