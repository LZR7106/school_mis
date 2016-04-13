<?php
session_start ();
include 'function2.php';

echo <<<END

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>移动文理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
	  
	  .error{
	  color: Red;
	  font-size: 16px;
	  }
    </style>
    
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
  $(function CheckMail(mail) {
	 	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (filter.test(mail)) 
			return true;
		
	 	else {
	 		alert('您的电子邮件格式不正确');
			 return false;
		}
	});

</script>
		
  </head>

  <body>

END;
//如果Session存在
if (isset($_SESSION['user']))
{
	$user     = $_SESSION['user'];
	$loggedin = TRUE;
}
else $loggedin = FALSE;


//就显示以下信息
if ($loggedin)
{
	echo  <<<END

	    <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php"><img src = "./img/1.jpg" height="50px" width="50px"></a>
          <div class="nav-collapse collapse">
<!--            <p class="navbar-text pull-right">
             1111<a href="#" class="navbar-link">2222</a>
            </p>-->
             <ul class="nav">
              <li ><a href="index.php">欢迎</a></li>
              <li ><a href="about.php">关于</a></li>
              <li ><a href="contact.php">联系我们</a></li>
            </ul>
             <div class="pull-right">
                <ul class="nav pull-right">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">当前用户$user<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/preferences"><i class="icon-cog"></i> 属性</a></li>
                            <li><a href="/help/support"><i class="icon-envelope"></i> 留言</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-off"></i> 登出</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
          </div>
        </div>
      </div>
    </div>
	
	
	
	
	 <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
		<ul class="nav nav-list">
              <li class="nav-header">学生管理</li>
              		<li ><a href="createuser.php">添加学生</a></li>
              		<li><a href="userlist.php">查询学生</a></li>
              <li class="nav-header">课程管理</li>
              		<li><a href="createClass.php">添加课程</a></li>
              		<li><a href="schedule.php">查询课程</a></li>
              <li class="nav-header">帖子管理</li>
              		<li><a href="post.php">查询帖子</a></li>
              <li class="nav-header">商家管理</li>
              		<li><a href="createBusiness.php">添加商家/代理</a></li>
              		<li><a href="businessList.php">查询商家</a></li>
			<li class="nav-header">代理管理</li>
              		<li><a href="agentList.php">查询代理</a></li>
		</ul>
		</div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
END;
	
}
else
{
	redirect('login.php');
}

?>