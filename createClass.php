<?php
	include 'header.php';
	header("Content-type: text/html; charset=utf-8");
echo <<<END
	

END;
	
	$name = $place = $faculty = $classNature = $error = "";
	//如果以下存在，对其调用function里的字符串处理方法
	if (isset($_POST['name'])) {
		
		$name = sanitizeString($_POST['name']);
		$place = sanitizeString($_POST['place']);
		$faculty = sanitizeString($_POST['faculty']);
		$classNature = sanitizeString($_POST['classNature']);

		
		//一系列判断
		if ($name == "" || $place == "" || $faculty == "" || $classNature == "") {
			echo "<script language='javascript'> alert('课程信息不能为空');</script>";
			$error = "课程信息不能为空";
	
		} else if (mysqli_num_rows(mysqli_query($sqlconn, "SELECT * FROM class_c WHERE name=$name"))) {
			echo "<script language='javascript'> alert('课程已经存在');</script>";
			$error = "课程已经存在";
		} else {
			$query_sql = "INSERT INTO class_c(name,place,faculty,classNature) VALUES(?,?,?)";//SQL插入语句
	
			$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> bind_param("ssss", $name, $place, $faculty, $classNature);//绑定参数
			$result -> execute();//执行
	
			redirect('schedule.php');
		}
	}
	
echo <<<END
	<div class="well">
	<form class="form-horizontal" action='createClass.php' method="POST">
	  <fieldset>
	    <div id="legend">
	      <legend class="">添加课程</legend>
	    </div>
	    <div class="control-group">
	      <!-- 用户名,用正则限制只能使用数字 -->	      
	      <label class="control-label"  for="name">课程名：</label>
	      <div class="controls">
	        <input type="text" id="name" name="name" value="$name"  class="input-xlarge"  required/>
	        <p class="help-block">比如计算机英语</p>
	      </div>
	    </div>
	 
	  <div class="control-group">
	      <!-- Username -->
	      <label class="control-label"  for="place">上课地点：</label>
	      <div class="controls">
	        <input type="text" id="place" name="place" value="$place" placeholder="" class="input-xlarge"  required>
	        <p class="help-block">比如H0420</p>
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
	        <p class="help-block">请选择课程所在的学院</p>
	      </div>
	    </div>
	    
		 <div class="control-group">
	      <!-- classNature -->
	      <label class="control-label"  for="classNature">课程性质：</label>
	      <div class="controls">
	        <input type="text" id="classNature" name="classNature" value="$classNature" placeholder="" class="input-xlarge"  required>
	        <p class="help-block">必修课还是选修课</p>
	      </div>
	    </div>	
			
	    <div class="control-group">
	      <!-- 按钮 -->
	      <div class="controls">
	        <button type="submit" class="btn btn-primary">提交</button> &nbsp;&nbsp;
			<input type="reset" class="btn btn-primary" value="清空"/> &nbsp;&nbsp;
	        <a class="btn" href='schedule.php'>查看课程</a>
	        <span class='error'>$error</span> 
	      </div>
	    </div>
	  </fieldset>
	</form>
	</div>
	
END;
	
	include 'bottom.php';
?>