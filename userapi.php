<?php
echo json_encode(
		array(
				"value" => $_REQUEST["value"],
				"valid" => preg_match("/^[A-Z].*$/", $_REQUEST["value"]),
				"message" => urlencode(iconv('utf-8','utf-8','字符串')) 
		)
);

?>