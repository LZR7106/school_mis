<?php
include 'header2.php';
$user_id = $user_area1 = $user_area2 = $user_area =  $error = "";
//class="active" 为活动的 ， 可以选择的
	if(isset($_GET['account']) && isset($_GET['user_area']))
	{
		$user_id = sanitizeString ( $_GET['account'] );
		$userArea = sanitizeString ( $_GET['user_area'] );
		
		// if ($user_id == "") {
			// $error = "用户名不能为空";
		// } else {
			// $query_sql = "select * from tbl_user where user_id = ?";
		 	// $result = $sqlconn -> prepare($query_sql);//SQL预处理
			// $result -> bind_param("s", $account);//绑定参数
			// $result -> execute();//执行
		// }
	}


//调用function中的对字符串处理函数
if (isset($_POST['user_id'])) {
		
		$user_id = sanitizeString($_POST['user_id']);
		$user_area1 = sanitizeString($_POST['user_area1']);
		$user_area2 = sanitizeString($_POST['user_area2']);
		
	
		if ($user_area2 == "no") {
			$update_sql = "update tbl_user set user_area = ? where user_id = ? ";
			$result = $sqlconn -> prepare($update_sql);//SQL预处理
			$result -> bind_param("ss",$user_area1,$user_id);//绑定参数
			$result -> execute();//执行
			$error = "更新成功";
			redirect('agentList.php');		
			return;
		} else {	
				$user_area = $user_area1.' '.$user_area2;
				$update_sql = "update tbl_user set user_area = ? where user_id = ? ";
				$result = $sqlconn -> prepare($update_sql);//SQL预处理
				$result -> bind_param("ss",$user_area, $user_id	);//绑定参数
				$result -> execute();//执行
				$error = "更新成功";
				redirect('agentList.php');		
			}
			
	
}
echo <<<END
<div class="well">
<form class="form-horizontal" action='editAgent.php' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">修改用户基本信息请从商家页面进入</legend>
    </div>
    
	
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="user_id">学号</label>
      <div class="controls">
        <input type="text" id="user_id" name="user_id" value="$user_id" placeholder="" class="input-xlarge" >
        <p class="help-block"></p>
      </div>
    </div>
    
	
    <div class="control-group">
	      <!-- 地点 -->
	      <label class="control-label" for="user_area">更改代理区域：</label>
	      <div class="controls">
	      			<select id="user_area1" name="user_area1" class="input-xlarge">
	      				<option value="$userArea">$userArea</option>
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
	      <!-- 地点 -->
	      <label class="control-label" for="user_where">增加代理区域：</label>
	      <div class="controls">
	      			<select id="ser_area2" name="user_area2" value="$user_area2"class="input-xlarge">
	      				<option value="no">不增加新代理区</option>
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
      <!-- Button -->
      <div class="controls">
        <button type="submit" class="btn btn-primary">提交</button> &nbsp;&nbsp;
        <a class="btn" href='agentList.php'>商家列表</a>
        <span class='error'>$error</span> 
      </div>
    </div>
  </fieldset>
</form>
</div>

END;

include 'bottom.php';
?>