<?php
include 'header2.php';

echo <<<END


<div class="btn-toolbar">
    <a class="btn btn" href="createAgent.php" >添加代理</a>
    <a class="btn" href="queryAgentByArea.php">按区域查询</a>
    <a class="btn"href="queryAgentById.php">按用户名查询</a>
</div>

<div class="well">
	<form action="queryAgentByArea.php" method="POST">
	请输入要查询的地址:<div class="control-group">
	      <label class="control-label" for="user_area">请选择代理区域：</label>
	      <div class="controls">
	      			<select id="user_area" name="user_area" class="input-xlarge">
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
	      </div>
	    </div>
	<input type="submit" value="查询">
	</form>
</div>
END;




$default_psize = 10;
$page_size = $default_psize;
//页大小
$baserow = 0;
//记录偏移
$page_no = 0;
//当前页号码
$row_no = 1;

$total_count = 0;
$page_count = 0;

//-----获取传递过来的页大小--------------------------------

if (isset($_GET["page_size"]) && $_GET["page_size"] != "") {
	$page_size = $_GET['page_size'];
} else {
	$page_size = $default_psize;
}
//-----获取传递过来的页号-------------------------------
if (isset($_GET["page_no"]) && $_GET["page_no"] != "") {
	$page_no = $_GET['page_no'];
} else {
	$page_no = 0;
}

//------------计算当期页号、总页号、基编号、偏移量---------------------
$offset = $page_size;

if (!is_numeric($page_no))//不是数字的话，默认为1
{
	$page_no = 1;
	$baserow = 0;
}

//获取总记录数

$query_sql = "select count(*) from tbl_user";
//有查询条件的话，将条件加入
$result = $sqlconn -> prepare($query_sql);
//预处理

$result -> execute();
$result -> bind_result($total_count);
//绑定结果

if (!$result -> fetch())//没有记录
{
	$total_count = 0;
}
$result -> close();

$page_result = array();
if ($total_count > 0) {

	$page_count = (int)(($total_count + $page_size - 1) / $page_size);

	if ($page_count < 1) {
		$page_count = 1;
	}

	if ($page_no > $page_count) {
		$page_no = $page_count;
	}

	$baserow = $page_no * $page_size;

	$row_no = $page_no * $page_size + 1;
	//每页起始行号

	$row_no++;



}


echo <<<END
		
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>代理ID</th>
          <th>代理用户名</th>
          <th>代理创建时间</th>
          <th>代理区域</th>
          <th>用户状态</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
END;

$error = $user_area = "";

if(isset($_POST['user_area'])){
	$user_area = sanitizeString($_POST['user_area']);
	$query_sql = "select user_id,user_name,user_when,user_area,user_state from tbl_user where user_area like '%".$user_area."%'";
	$result = $sqlconn -> prepare($query_sql);//SQL预处理
	$result -> execute();//执行
	$result -> bind_result($user_id, $user_name, $user_when, $user_area, $user_state);//绑定结果


//如果查到了
while ($result -> fetch()) {
	if($user_state == 1){
		$zt = "禁用";
	} 
	if($user_state == 0){
		$zt = "可用";
	}
	echo <<<END
    <tr>
		<td  height="25" align="center" valign="middle"  >$user_id </td>
		<td align="center" valign="middle"  >$user_name </td>
		<td align="center" valign="middle"  >$user_when</td>
		<td align="center" valign="middle"  >$user_area </td>
		<td align="center" valign="middle"  >$zt </td>
		 <td>
               <a href="editAgent.php?user_area=$user_area&account=$user_id"><i class="icon-pencil"></i></a>
               <a href="disableBusiness.php?user_state=$user_state&user_id=$user_id"><i class="icon-user"></i></a>
          	   <a href="deleteBusiness.php?user_id=$user_id"><i class="icon-remove"></i></a>
          	                 
         </td>
           </tr>
END;

}


//以下为前端输出语法，推荐后来者在HTML里写PHP，不要像我一样在PHP里写HTML，太麻烦了，但是我懒得改了
echo <<<END

      </tbody>
    </table>
</div>


                  <td width="50%">
END;

if ($total_count > 0) {

	echo <<<END
                    共 <span class="right-text09">
END;
	echo $page_count;
	echo <<<END
                    </span> 页 | 第 <span class="right-text09">
END;
	echo $page_no + 1;
	echo <<<END
                    </span> 页
END;
} else {
	echo "0条结果";
}
echo <<<END
                  </td>
                  <td width="49%" align="right">[
END;

if ($page_no > 0) {
	echo <<<END
        <a href="?page_no=0">首页</a>
END;
}
echo "|";
if ($page_no > 0) {
	echo <<<END
					<a href="?page_no=
END;
	echo $page_no - 1;
	echo <<<END
					 ">上一页</a>
END;
} echo "|";
if ($page_no < $page_count - 1) {
	echo <<<END
				   <a href="?page_no=
END;
	echo $page_no + 1;
	echo <<<END
">下一页</a>
                    
END;
} echo "|";
if ($page_no < $page_count - 1) {
	echo <<<END
                    <a href="?page_no=
END;
	echo $page_count - 1;
	echo <<<END
                     ">尾页</a>
END;
} echo "]";
echo <<<END
                    </td>
                    
<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">关闭</button>
        <h3 id="myModalLabel">ȷ��</h3>
    </div>
    <div class="modal-body">
        <p class="error-text">....</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">ȡ��</button>
        <button class="btn btn-danger" data-dismiss="modal">ɾ��</button>
    </div>
</div>

END;
$result->close();
//关闭连接
$sqlconn->close();
}
include 'bottom.php';
?>

