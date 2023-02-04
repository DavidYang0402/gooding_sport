<?php
    require_once("dbtools.inc.php");

    $id = $_POST['id'];

    $link = create_connection();

    $sql = "DELETE FROM `phonenum_gooding` 
    WHERE phonenum_gooding.id ='$id' AND (phonenum_gooding.chDate >= DATE(phonenum_gooding.chDate - 1))";
    $result=execute_sql($link,'pdsports',$sql);

    

    mysqli_close($link);	
   

    header('Refresh:0.1;url=index.php');

?>