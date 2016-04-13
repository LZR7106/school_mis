<?php
include 'header.php';

echo <<<END

END;

$id = $name = $place = $faculty = $error= "";

//调用function中的对字符串处理函数
if (isset($_POST['name']))
 {
	//$id = sanitizeString ( $_POST ['id'] );
	$name = sanitizeString ( $_POST ['name'] );
	$place = sanitizeString ( $_POST ['place'] );
	$faculty = sanitizeString ( $_POST ['faculty'] );
	
	//一些列判断
	if ($name == "" || $place == "")
		$error = "课程不能为空";
	else {
		
		$query_sql = "update class_c set place = ?, faculty = ? where name = ? ";
		
		$result = $sqlconn -> prepare($query_sql);//SQL预处理
		$result -> bind_param("sss",$place, $faculty, $name);//绑定参数
		$result -> execute();//执行
		
		$error = "更新成功";
		redirect('schedule.php');
	}
}
else
{
	if(isset($_GET['name']))
	{
		$name = sanitizeString ( $_GET['name'] );
	
		if ($name == "") {
			$error = "课程不能为空";
		} else {
			$query_sql = " select name, place, faculty from class_c where name = ?";
	
		 	$result = $sqlconn -> prepare($query_sql);//SQL预处理
			$result -> bind_param("s", $name);//绑定参数
			$result -> execute();//执行
		}
	}
}
		
		
echo <<<END
<div class="well">
<form class="form-horizontal" action='editClass.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">编辑</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="name">课程名</label>
      <div class="controls">
        <input type="text" id="name" name="name" value="$name" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="place">上课地点</label>
      <div class="controls">
        <input type="text" id="place" name="place" value="$place" placeholder="" class="input-xlarge" required>
        <p class="help-block"></p>
      </div>
    </div>
 
	    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">所属学院</label>
      <div class="controls">
        <input id="faculty" name="faculty" value="$faculty" placeholder="" class="input-xlarge" type="text">
        <p class="help-block"></p>
      </div>
    </div>

		
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">提交</button> &nbsp;&nbsp;
        <a class="btn" href='schedule.php'>学生列表</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>