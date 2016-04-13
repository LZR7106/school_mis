<?php
include 'functions.php';

$username =$error= "";
//调用function的对字符串处理函数
if(isset($_GET['id']))
{
	$id = sanitizeString ( $_GET['id'] );
	//一系列判断
	if ($id == "") {
		$error = "用户名为空";
	} else {
		$query_sql = " delete from class_c where id = ?";
		
		$result = $sqlconn -> prepare($query_sql);//SQL预处理
		$result -> bind_param("s", $id);//绑定参数
		$result -> execute();//执行
		
		$link = mysqli_affected_rows($sqlconn);//输出所影响记录行数
		
		if ($link == '') {			
			$error = "未选定行";
		} else {
			$error = "影响一行";
		}
		
		redirect('schedule.php');
	}
}

?>