<?php
include 'header2.php';
//class="active" 为活动的 ， 可以选择的
echo <<<END


<div class="btn-toolbar">
    <a class="btn btn" href="createProduct.php" >添加商品</a>
    <a class="btn" href="#.php">按__查询</a>
    <a class="btn"href="#.php">按__查询</a>
</div>
END;
$user_id = $product_id = $product_name = $product_note = $product_note  = $product_price = $product_img = $product_category = $category  = $error = "";

	if (isset($_POST['user_id'])) {
		
	
}
else{
	if(isset($_GET['user_id']))
	{
		$user_id = sanitizeString ( $_GET['user_id'] );
	
		
	}

}	

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

$query_sql = "select count(*) from tbl_product";
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
          <th>商家ID</th>
          <th>商品ID</th>
          <th>商品名称</th>
          <th>商品种类</th>
		  <th>商品价格</th>
          <th>商品介绍</th>
          <th></th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
END;



$category = '';
$query_sql = "select * from tbl_product where user_id = $user_id";
$result = $sqlconn -> prepare($query_sql);//SQL预处理
$result -> execute();//执行
$result -> bind_result($user_id, $product_id, $product_name, $product_note, $product_price, $product_img, $product_category);//绑定结果如果查到了
while ($result -> fetch()) {
	switch ($product_category) {
		case '1':
			$category = 1;
			break;
		case '2':
			$category = 2;
			break;
		case '3':
			$category = 3;
			break;
		case '4':
			$category = 4;
			break;
		case '5':
			$category = 5;
			break;			
		case '6':
			$category = 6;
			break;
		case '7':
			$category = 7;
			break;
		case '8':
			$category = 8;
			break;	
		default:			
			break;
	}

echo <<<END
    <tr>
		<td  height="25" align="center" valign="middle"  >$user_id </td>
		<td align="center" valign="middle"  >$product_id </td>
		<td align="center" valign="middle"  >$product_name</td>
		<td align="center" valign="middle"  >$category </td>
		<td align="center" valign="middle" >$product_price </td>
		<td align="center" valign="middle"  ><img src="../xwl_market/tbl_product/product_img/$product_img" width="64" height="64"> </td>
		<td align="center" valign="middle"  >$product_note </td>
		 <td>
               <a href="editProduct.php?account=$user_id"><i class="icon-pencil"></i></a>
          	   <a href="deleteProduct.php?user_id=$user_id"><i class="icon-remove"></i></a>
          	                 
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
        <a href="?user_id=$user_id&page_no=0">首页</a>
END;
}
echo "|";
if ($page_no > 0) {
	echo <<<END
					<a href="?user_id=$user_id&page_no=
END;
	echo $page_no - 1;
	echo <<<END
					 ">上一页</a>
END;
} echo "|";
if ($page_no < $page_count - 1) {
	echo <<<END
				   <a href="?user_id=$user_id&page_no=
END;
	echo $page_no + 1;
	echo <<<END
">下一页</a>
                    
END;
} echo "|";
if ($page_no < $page_count - 1) {
	echo <<<END
                    <a href="?user_id=$user_id&page_no=
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
include 'bottom.php';
?>
