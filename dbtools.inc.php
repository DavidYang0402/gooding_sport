<?php
  error_reporting(E_ALL ^ E_DEPRECATED);
  function create_connection()
  {
    $link = mysqli_connect("localhost", "root", "")
      or die("無法建立資料連接<br><br>" . mysqli_connect_error());
	  
    mysqli_query($link,"SET NAMES utf8");
			   	
    return $link;
  }
	
  function execute_sql($link, $database, $sql)
  {
  $db_selected = mysqli_select_db($link, $database);
  if(!$db_selected){
    error_log("開啟資料庫失敗<br><br>" . mysqli_error($link));
    die('伺服器錯誤');
  }
						 
    $result = mysqli_query($link, $sql);
		
    return $result;
  }
?>