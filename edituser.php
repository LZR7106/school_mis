<?php
include 'header.php';
//class="active" 为活动的 ， 可以选择的

$username = $password = $email = $stauts = $remark = $error= "";

//调用function中的对字符串处理函数
if (isset($_POST['username']))
 {
	$username = sanitizeString ( $_POST ['username'] );
	$password = sanitizeString ( $_POST ['password'] );
	$email = sanitizeString ( $_POST ['email'] );
	$status = sanitizeString ( $_POST ['status'] );
	$remark = sanitizeString ( $_POST ['remark'] );
	
	//一些列判断
	if ($username == "" || $password == "" || $status == "")
		$error = "用户名密码不能为空";
	else {
		
		$query_sql = "update student set user_pwd = ?, email = ?, status = ?, remark = ? where sno = ? ";
		
		$result = $sqlconn -> prepare($query_sql);//SQL预处理
		$result -> bind_param("sssss", $password, $email, $status, $remark, $username);//绑定参数
		$result -> execute();//执行
		
		$error = "更新成功";
		redirect('userlist.php');
	}
}
else
{
	if(isset($_GET['account']))
	{
		$username = sanitizeString ( $_GET['account'] );
	
		if ($username == "") {
			$error = "用户名不能为空";
		} else {
			$query_sql = " select sno, nickname, email, status, remark from student where sno = ?";
	
		 	$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> bind_param("s", $account);//绑定参数
			$result -> execute();//执行
		}
	}
}
		
		
echo <<<END
<div class="well">
<form class="form-horizontal" action='edituser.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">编辑</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">学号</label>
      <div class="controls">
        <input type="text" id="username" name="username" value="$username" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">新密码</label>
      <div class="controls">
        <input type="password" id="password" name="password" value="$password" placeholder="" class="input-xlarge" required>
        <p class="help-block">呵呵</p>
      </div>
    </div>
 
	    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">邮箱</label>
      <div class="controls">
        <input id="email" name="email" value="$email" placeholder="" class="input-xlarge" type="email">
        <p class="help-block"></p>
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
		<p class="help-block">...</p>
      </div>
    </div>
		
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">提交</button> &nbsp;&nbsp;
        <a class="btn" href='userlist.php'>学生列表</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>