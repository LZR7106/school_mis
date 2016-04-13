<?php
session_start ();
include 'functions.php';

echo <<<END

<!DOCTYPE html >
<html lang="en">
  <head>
    <title>Xian WenLi</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
	<link href="css/login.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
  
END;

$error = $user = $pass = "";



$row=0;//
//在function里处理字符串然后就是一系列判断
if (isset($_POST['user'])) {

	$user = sanitizeString($_POST['user']);
	$pass = sanitizeString($_POST['pass']);
	if ($user != "" || $pass != "") {
		$query_sql = "select sno, user_pwd from student where sno = ? and user_pwd = ? limit 1";
		
		$result = $sqlconn -> prepare($query_sql);//SQL预处理
		$result -> bind_param("ss", $user, $pass);//绑定参数
		$result -> execute();//执行
		if($result ->fetch()){//如果查到了
			$row=1;	
		}		
		$result->close();
		$sqlconn ->close();
		//如果没有查到
		if ($row != 0) {
			$_SESSION['user'] = $user;
			$_SESSION['pass'] = $pass;
			redirect('index.php');
		} else {
			$error = "<span class='error'>用户名密码错误</span>";
		}
	} else {
		$error = "<span class='error'>用户名密码不能为空</span>";
	}
}

echo <<<END
    <div class="container">
      <form class="form-signin" method='post' action='login.php'>
        <h2 class="form-signin-heading">移动文理</h2>
		       用户名： <input type="text"  name='user' value=''  class="input-block-level" placeholder="请输入用户名">
		       密码： <input type="password"  name='pass' value=''  class="input-block-level" placeholder="请输入密码">
        <button class="btn btn-large btn-primary" type="submit">移动文理</button> &nbsp;&nbsp; $error
       </form>

    </div> <!-- /container -->

    <!-- Le javascript================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>

  </body>
</html>
END;

?>
