<?php
	include 'header2.php';
	header("Content-type: text/html; charset=utf-8");
echo <<<END
	

END;
	$user_state = 0;
	$user_id = $user_area = $user_name = $user_pwd = $user_rePwd = $user_img  = $user_where = $user_department = $user_main_sales = $user_class = $user_where1 = $user_where2 = $is_agent= $error = "";
	$user_when = date('y-m-d');
	//如果以下存在，对其调用function里的字符串处理方法
	if (isset($_POST['user_id']) && isset($_POST['user_pwd'])) {
		
		$user_id = sanitizeString($_POST['user_id']);
		$user_name = sanitizeString($_POST['user_name']);
		$user_pwd = sanitizeString($_POST['user_pwd']);
		$user_rePwd = sanitizeString($_POST['user_rePwd']);
		$user_where1 = sanitizeString($_POST['user_where1']);
		$user_where2 = sanitizeString($_POST['user_where2']);
		$user_department = sanitizeString($_POST['user_department']);
		$user_main_sales = sanitizeString($_POST['user_main_sales']);
		$user_class = sanitizeString($_POST['user_class']);
		$user_area = sanitizeString($_POST['user_area']);
		$is_agent = sanitizeString($_POST['is_agent']);
		
		$user_where = $user_where1.$user_where2;
		
		//一系列判断
		if ($user_id == "" || $user_name == "" || $user_pwd == "") {
			echo "<script language='javascript'> alert('用户名和密码不能为空');</script>";
			$error = "用户名和密码不能为空";
		} else if (strlen($user_id) != 10) {
			echo "<script language='javascript'> alert('学号长度应为10');</script>";
		}else if ($user_pwd != $user_rePwd) {
			echo "<script language='javascript'> alert('两次输入的密码不一致');</script>";
			$error = "两次输入的密码不一致";
		} else if (mysqli_num_rows(mysqli_query($sqlconn, "SELECT * FROM tbl_user WHERE user_id=$user_id"))) {
			echo "<script language='javascript'> alert('学号已经存在');</script>";
			$error = "学号已经存在";
		}else if (mysqli_num_rows(mysqli_query($sqlconn, "SELECT * FROM tbl_user WHERE user_name=$user_name"))) {
			echo "<script language='javascript'> alert('该用户名已经存在');</script>";
			$error = "用户名已经存在"; 
		} else {
			$query_sql = "INSERT INTO tbl_user(user_id,user_name,user_pwd,user_when,user_where,user_department,user_main_sales,user_state,user_area,is_agent,user_class) VALUES(?,?,?,?,?,?,?,?,?,?,?)";//SQL插入语句
	
			$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> bind_param("sssssssssss", $user_id, $user_name, $user_pwd, $user_when, $user_where, $user_department, $user_main_sales, $user_state,$user_area,$is_agent, $user_class);//绑定参数
			$result -> execute();//执行
	
			redirect('businessList.php');
		}
	}
	
echo <<<END
	<div class="well">
	<form class="form-horizontal" action='createBusiness.php' method="POST">
	  <fieldset>
	    <div id="legend">
	      <legend class="">添加商家</legend>
	    </div>
	    <div class="control-group">
	      <!-- 用户名,用正则限制只能使用数字 -->	      
	      <label class="control-label"  for="user_id">学号：</label>
	      <div class="controls">
	        <input type="text" id="user_id" name="user_id" value="$user_id" onkeyup="this.value=this.value.replace(/[^\d]/g,'') " onafterpaste="this.value=this.value.replace(/[^\d]/g,'') " class="input-xlarge"  required/>
	        <p class="help-block">比如1111111111</p>
	      </div>
	    </div>
	 
	  <div class="control-group">
	      <!-- Username -->
	      <label class="control-label"  for="user_name">用户名：</label>
	      <div class="controls">
	        <input type="text" id="user_name" name="user_name" value="$user_name" placeholder="" class="input-xlarge"  required>
	        <p class="help-block">比如Jack</p>
	      </div>
	    </div>
	    
	    <div class="control-group">
	      <!-- Password-->
	      <label class="control-label" for="user_pwd">密码：</label>
	      <div class="controls">
	        <input type="password" id="user_pwd" name="user_pwd" value="$user_pwd" placeholder="" class="input-xlarge" required>
	        <p class="help-block">输入你的密码</p>
	      </div>
	    </div>
	    
	    <div class="control-group">
	      <!-- rePassword-->
	      <label class="control-label" for="user_rePwd">再次输入密码：</label>
	      <div class="controls">
	        <input type="password" id="user_rePwd" name="user_rePwd" value="$user_rePwd" placeholder="" class="input-xlarge" required>
	        <p class="help-block">请再次输入密码</p>
	      </div>
	    </div>
	 
	  <div class="control-group">
	      <!--faculty-->
	      <label class="control-label" for="user_department">请选择所属：</label>
	      <div class="controls">
	      			<select id="user_department" name="user_department" value="$user_department"class="input-xlarge">
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
						<option value="来自校外">来自校外</option>			
	    			</select>
	        <p class="help-block">请选择你的学院</p>
	      </div>
	    </div>
	 
	 	<div class="control-group">
	      <!-- rePassword-->
	      <label class="control-label" for="user_rePwd">请问你是否为代理：</label>
	      <div class="controls">
	        <label><input type="radio" id="is_agent" name="is_agent" value="1" placeholder="" class="input-xlarge" required>不是代理</label>
	        <label><input type="radio" id="is_agent" name="is_agent" value="0" placeholder="" class="input-xlarge" required>是代理</label>
	        <p class="help-block">商家请选择否</p>
	      </div>
	    </div>
	 
		 <div class="control-group">
	      <!-- 地点 -->
	      <label class="control-label" for="user_where">请输入店面地点：</label>
	      <div class="controls">
	      			<select id="user_where1" name="user_where1" value="$user_where1"class="input-xlarge">
	      				<option value="无">无</option>
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
	    			<input type="text" id="user_where2" name="user_where2" value="$user_where2" placeholder="" class="input-xlarge"  />
	        <p class="help-block">请店家填详细地址</p>
	      </div>
	    </div>
		 
		 
		 <div class="control-group">
	      <!-- 地点 -->
	      <label class="control-label" for="user_where">请输入代理区域：</label>
	      <div class="controls">
	      			<select id="ser_area" name="user_area" value="$user_area"class="input-xlarge">
	      				<option value="无">无</option>
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
	        <p class="help-block">请代理选择区域</p>
	      </div>
	    </div>
		 
		 
		 
		  <div class="control-group">
	      <!-- 经营类别 -->
	      <label class="control-label" for="user_class">请选择经营类别：</label>
	      <div class="controls">
	      			<select id="user_class" name="user_class" value="$user_class"class="input-xlarge">
	      				<option value="NULL">无</option>
	    				<option value="美食">美食</option>
						<option value="饮品">饮品</option>
						<option value="服务">服务</option>
						<option value="电子">电子</option>
						<option value="其他">其他</option>
						<option value=""></option>			
	    			</select>
	        <p class="help-block">请店家选择经营类别</p>
	      </div>
	    </div>
		
		
	    
			
	   <div class="control-group">
	      <!-- remark -->
	      <label class="control-label"  for="user_main_sales">商店主营：</label>
		  <div class="controls">
	        <textarea rows="4" class="" id="user_main_sales" name="user_main_sales" value="$user_main_sales" placeholder="" > </textarea>
			<p class="help-block">店面简介</p>
	      </div>
	    </div>
			
	    <div class="control-group">
	      <!-- 按钮 -->
	      <div class="controls">
	        <button type="submit" class="btn btn-primary">提交</button> &nbsp;&nbsp;
			<input type="reset" class="btn btn-primary" value="清空"/> &nbsp;&nbsp;
	        <a class="btn" href='businesslist.php'>查看已有商家</a>
	        <span class='error'>$error</span> 
	      </div>
	    </div>
	  </fieldset>
	</form>
	</div>
	
END;
	
	include 'bottom.php';
?>
