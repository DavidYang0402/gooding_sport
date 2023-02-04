<?php
    require_once("dbtools.inc.php");

    $time = $_POST['time'];
    $date = $_POST['date'];

    $link = create_connection();

    $sql = "call refresh_today('$date','$time')";
    $result=execute_sql($link,'pdsports',$sql);
    

    mysqli_close($link);

    header('Refresh:0.1;url=index.php');

?>