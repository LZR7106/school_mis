<?php
	include 'header.php';
	header("Content-type: text/html; charset=utf-8");
	
	$username = $nickname = $password = $rePwd = $faculty = $email = $remark = $error = "";
	$stauts = 0;
	//如果以下存在，对其调用function里的字符串处理方法
	if (isset($_POST['username']) && isset($_POST['password'])) {
		
		$username = sanitizeString($_POST['username']);
		$nickname = sanitizeString($_POST['nickname']);
		$password = sanitizeString($_POST['password']);
		$faculty = sanitizeString($_POST['faculty']);
		$rePwd = sanitizeString($_POST['rePwd']);
		$email = sanitizeString($_POST['email']);
		$status = sanitizeString($_POST['status']);
		$remark = sanitizeString($_POST['remark']);
		
		//一系列判断
		if ($username == "" || $password == "" || $status == "") {
			echo "<script language='javascript'> alert('用户名密码不能为空');</script>";
			$error = "用户名密码不能为空";
		} elseif (strlen($username) != 10) {
			echo "<script language='javascript'> alert('学号长度不正确');</script>";
		}else if ($password != $rePwd) {
			echo "<script language='javascript'> alert('两次输入的密码不一致');</script>";
			$error = "两次输入的密码不一致";
		} else if (mysqli_num_rows(mysqli_query($sqlconn, "SELECT * FROM student WHERE sno=$username"))) {
			echo "<script language='javascript'> alert('学号已经存在');</script>";
			$error = "学号已经存在";
		} else {
			$query_sql = "INSERT INTO student(sno,nickname,user_pwd,faculty,email,status,remark) VALUES(?,?,?,?,?,?,?)";//SQL插入语句
	
			$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> bind_param("sssssss", $username, $nickname, $password, $faculty, $email, $status, $remark);//绑定参数
			$result -> execute();//执行
	
			redirect('userlist.php');
		}
	}
	
echo <<<END
	<div class="well">
	<form class="form-horizontal" action='createuser.php' method="POST">
	  <fieldset>
	    <div id="legend">
	      <legend class="">添加学生</legend>
	    </div>
	    <div class="control-group">
	      <!-- 用户名,用正则限制只能使用数字 -->	      
	      <label class="control-label"  for="username">学号：</label>
	      <div class="controls">
	        <input type="text" id="username" name="username" value="$username" onkeyup="this.value=this.value.replace(/[^\d]/g,'') " onafterpaste="this.value=this.value.replace(/[^\d]/g,'') " class="input-xlarge"  required/>
	        <p class="help-block">比如1111111111</p>
	      </div>
	    </div>
	 
	  <div class="control-group">
	      <!-- Username -->
	      <label class="control-label"  for="nickname">昵称：</label>
	      <div class="controls">
	        <input type="text" id="nickname" name="nickname" value="$nickname" placeholder="" class="input-xlarge"  required>
	        <p class="help-block">比如Jack</p>
	      </div>
	    </div>
	    
	    <div class="control-group">
	      <!-- Password-->
	      <label class="control-label" for="password">密码：</label>
	      <div class="controls">
	        <input type="password" id="password" name="password" value="$password" placeholder="" class="input-xlarge" required>
	        <p class="help-block">输入你的密码</p>
	      </div>
	    </div>
	    
	    <div class="control-group">
	      <!-- rePassword-->
	      <label class="control-label" for="rePwd">再次输入密码：</label>
	      <div class="controls">
	        <input type="password" id="rePwd" name="rePwd" value="$rePwd" placeholder="" class="input-xlarge" required>
	        <p class="help-block">请再次输入密码</p>
	      </div>
	    </div>
	 
	  <div class="control-group">
	      <!--faculty-->
	      <label class="control-label" for="faculty">请选择学院：</label>
	      <div class="controls">
	      			<select id="faculty" name="faculty" value="$faculty"class="input-xlarge">
	    				<option value="信息工程学院">信息工程学院</option>
						<option value="人文学院">人文学院</option>
						<option value="外国语学院">外国语学院</option>
						<option value="机械与材料工程学院">机械与材料工程学院</option>
						<option value="化学工程学院">化学工程学院</option>
						<option value="生物与环境工程学院">生物与环境工程学院</option>
						<option value="经济管理学院">经济管理学院</option>					
						<option value="艺术学院">艺术学院</option>
						<option value="师范学院">师范学院</option>
						<option value="政治学院">政治学院</option>
						<option value="文化艺术教育中心">文化艺术教育中心</option>
						<option value="继续教育学院">继续教育学院</option>			
	    			</select>
	        <p class="help-block">请选择你的学院</p>
	      </div>
	    </div>
	 
		    <div class="control-group">
	      <!-- E-mail -->
	      <label class="control-label" for="email">E-mail</label>
	      <div class="controls">
	        <input id="email" name="email" value="$email" placeholder="" class="input-xlarge" type="email">
	        <p class="help-block">请输入你的邮箱</p>
	      </div>
	    </div>
	
	    <div class="control-group">
			  <label class="control-label" for="status" >性别</label>
	          <div class="controls">
	            <select id="status" name="status" class="input-xlarge">
	              <option value="1">男</option>
	              <option value="0">ͣ女</option>
	            </select>
	          </div>
		</div>
			
	   <div class="control-group">
	      <!-- remark -->
	      <label class="control-label"  for="remark">备注</label>
		  <div class="controls">
	        <textarea rows="4" class="" id="remark" name="remark" value="$remark" placeholder="" > </textarea>
			<p class="help-block">爱写啥写啥</p>
	      </div>
	    </div>
			
	    <div class="control-group">
	      <!-- 按钮 -->
	      <div class="controls">
	        <button type="submit" class="btn btn-primary">提交</button> &nbsp;&nbsp;
			<input type="reset" class="btn btn-primary" value="清空"/> &nbsp;&nbsp;
	        <a class="btn" href='userlist.php'>查看已有学生</a>
	        <span class='error'>$error</span> 
	      </div>
	    </div>
	  </fieldset>
	</form>
	</div>
	
END;
	
	include 'bottom.php';
?>
