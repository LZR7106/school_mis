<?php
	include 'header2.php';
	header("Content-type: text/html; charset=utf-8");
	
	$agent_name = $agent_pwd = $rePwd = $agent_phone = $agent_num = $agent_area = $error = "";
	$stauts = 0;
	//如果以下存在，对其调用function里的字符串处理方法
	if (isset($_POST['agent_name']) && isset($_POST['agent_pwd'])) {
		
		$agent_name = sanitizeString($_POST['agent_name']);
		$agent_pwd = sanitizeString($_POST['agent_pwd']);
		$agent_phone = sanitizeString($_POST['agent_phone']);
		$agent_num = sanitizeString($_POST['agent_num']);
		$agent_area = sanitizeString($_POST['agent_area']);
		
		//一系列判断
		if ($agent_name == "" || $agent_pwd == "" || $agent_phone == "") {
			echo "<script language='javascript'> alert('用户名密码或联系方式不能为空');</script>";
			$error = "用户名密码不能为空";
		}else if ($password != $rePwd) {
			echo "<script language='javascript'> alert('两次输入的密码不一致');</script>";
			$error = "两次输入的密码不一致";
		} else if (mysqli_num_rows(mysqli_query($sqlconn, "SELECT * FROM tbl_agent WHERE agent_name=$agent_name"))) {
			echo "<script language='javascript'> alert('用户名已经存在');</script>";
			$error = "用户名已经存在";
		} else {
			$query_sql = "INSERT INTO tbl_agent(agent_pwd,agent_name,agent_phone,agent_num,agent_area) VALUES(?,?.?,?,?)";//SQL插入语句
	
			$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> bind_param("sssss", $agent_name, $agent_pwd, $agent_phone, $agent_num, $agent_area);//绑定参数
			$result -> execute();//执行
	
			redirect('agentList.php');
		}
	}
	
echo <<<END
	<div class="well">
	<form class="form-horizontal" action='createAgent.php' method="POST">
	  <fieldset>
	    <div id="legend">
	      <legend class="">添加代理</legend>
	    </div>
	    <div class="control-group">
	      <!-- 用户名,用正则限制只能使用数字 -->	      
	      <label class="control-label"  for="agent_name">用户名：</label>
	      <div class="controls">
	        <input type="text" id="agent_name" name="agent_name" value="$agent_name" class="input-xlarge"  required/>
	        <p class="help-block">比如wtf123</p>
	      </div>
	    </div>
	 
	    
	    <div class="control-group">
	      <!-- Password-->
	      <label class="control-label" for="agent_pwd">密码：</label>
	      <div class="controls">
	        <input type="password" id="agent_pwd" name="agent_pwd" value="$agent_pwd" placeholder="" class="input-xlarge" required>
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
	      <!-- E-mail -->
	      <label class="control-label" for="agent_phone">联系方式</label>
	      <div class="controls">
	        <input id="agent_phone" name="agent_phone" value="$agent_phone" placeholder="" class="input-xlarge" type="text">
	        <p class="help-block">请输入你的电话</p>
	      </div>
	    </div>
			
	  <div class="control-group">
	      <!-- 学号,用正则限制只能使用数字 -->	      
	      <label class="control-label"  for="agent_name">学号：</label>
	      <div class="controls">
	        <input type="text" id="agent_num" name="agent_num" value="$agent_num" onkeyup="this.value=this.value.replace(/[^\d]/g,'') " onafterpaste="this.value=this.value.replace(/[^\d]/g,'') " class="input-xlarge"  />
	        <p class="help-block">若没有可不填写</p>
	      </div>
	    </div>
			
			<div class="control-group">
	      <!-- 地点 -->
	      <label class="control-label" for="user_where">请输入代理区域：</label>
	      <div class="controls">
	      			<select id="agent_area" name="agent_area" value="$agent_area"class="input-xlarge">
	    				<option value="东门">东门</option>
						<option value="西门">西门</option>
						<option value="南门">南门</option>
						<option value="北门">北门</option>
						<option value="老食堂">老食堂</option>
						<option value="新食堂">新食堂</option>
						<option value="一号公寓">一号公寓</option>
						<option value="二号公寓">二号公寓</option>
						<option value="三号公寓">三号公寓</option>
						<option value="四号公寓">四号公寓</option>
						<option value="五号公寓">五号公寓</option>
						<option value="六号公寓">六号公寓</option>
						<option value="七号公寓">七号公寓</option>
						<option value="八号公寓">八号公寓</option>
						<option value="九号公寓">九号公寓</option>
						<option value="十号公寓">十号公寓</option>
						<option value="十一号公寓">十一号公寓</option>
						<option value="十二号公寓">十二号公寓</option>
						<option value="十三号公寓">十三号公寓</option>
						<option value="东操场">东操场</option>
						<option value="西操场">西操场</option>
						<option value="篮球场">篮球场</option>
						<option value="电子商城">电子商城</option>
						<option value="沙井村">沙井村</option>
						<option value="甘家寨">甘家寨</option>
						<option value="其他">其他</option>			
	    			</select>
	        <p class="help-block">请选择面址</p>
	      </div>
	    </div>
			
			
			
	    <div class="control-group">
	      <!-- 按钮 -->
	      <div class="controls">
	        <button type="submit" class="btn btn-primary">提交</button> &nbsp;&nbsp;
			<input type="reset" class="btn btn-primary" value="清空"/> &nbsp;&nbsp;
	        <a class="btn" href='agentList.php'>查看已有代理</a>
	        <span class='error'>$error</span> 
	      </div>
	    </div>
	  </fieldset>
	</form>
	</div>
	
END;
	
	include 'bottom.php';
?>
