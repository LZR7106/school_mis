<?php
include 'header.php';
		$status=$_GET["status"];
		$account=$_GET["account"];
		if ($status == 1) {
			$status = 0;
			$query_sql = "update student set status = 0 where sno = $account";
			$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> execute();//执行
		} 
		else {
			$status = 1;
			$query_sql = "update student set status = 1 where sno = $account";
			$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> execute();//执行
		}
				
		$error = "更新成功";	
		redirect('userlist.php');


?>



	

