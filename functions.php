<?php

	$dbhost  = '127.0.0.1';    // 服务器主机
	$dbname  = 'myself';       // 数据库名字
	$dbuser  = 'root';   // 数据库用户名
	$dbpass  = 'iloveprogramming';   // 数据库密码
	//$dbport = '3306'; //数据库端口号


	$sqlconn = new mysqli($dbhost,$dbuser,$dbpass,$dbname);//sqli连接方法
	mysqli_query($sqlconn,"SET NAMES utf8");
	//输出连接失败提示
	if (mysqli_connect_error()) { 
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	//创建数据库表
	function createTable($name, $query)
	{
    	queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    	echo "Table '$name' created or already exists.<br />";
	}
	//数据库查询方法
	function queryMysql($query)
	{
	    $result = mysql_query($query) or die(mysql_error());
		 return $result;
	}
	//Session过期方法
	function destroySession()
	{
	    $_SESSION=array();
	    
	    if (session_id() != "" || isset($_COOKIE[session_name()]))
	        setcookie(session_name(), '', time()-2592000, '/');
	
	    session_destroy();
	}
	//对字符串的处理方法，防止有人恶意破坏
	function sanitizeString($var)
	{
	  //  $var = strip_tags($var);
	   // $var = htmlentities($var);
	  ///  $var = stripslashes($var);
	  //  return mysql_real_escape_string($var);
	  return $var;
	}
	//跳转方法
	function redirect($url)
	{
		echo "正在处理";
		echo "<script type=text/javascript>window.location.href='$url';</script>";
	}
?>
