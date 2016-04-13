<?php
include 'functions.php';

$username =$error= "";
//调用function的对字符串处理函数
if(isset($_GET['account']))
{
	$username = sanitizeString ( $_GET['account'] );
	//一系列判断
	if ($username == "") {
		$error = "用户名为空";
	} else {
		$query_sql = " delete from student where sno = ?";
		
		$result = $sqlconn -> prepare($query_sql);//SQL预处理
		$result -> bind_param("s", $username);//绑定参数
		$result -> execute();//执行
		
		$link = mysqli_affected_rows($sqlconn);//输出所影响记录行数
		
		if ($link == '') {			
			$error = "未选定行";
		} else {
			$error = "影响一行";
		}
		
		redirect('userlist.php');
	}
}

?>