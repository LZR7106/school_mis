<?php
include 'header2.php';
		$user_state=$_GET["user_state"];
		$user_id=$_GET["user_id"];
		if ($user_state == 1) {
			$user_state = 0;
			$query_sql = "update tbl_user set user_state = 0 where user_id = $user_id";
			$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> execute();//执行
		} 
		else {
			$user_state = 1;
			$query_sql = "update tbl_user set user_state = 1 where user_id = $user_id";
			$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> execute();//执行
		}
				
		$error = "更新成功";	
		redirect('businessList.php');


?>



	

