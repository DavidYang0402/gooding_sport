<?php
    require_once("dbtools.inc.php");

    $name = $_POST["name"];
    $phoneNum = $_POST['phoneNum'];
    $sport = $_POST['sport'];
    $chNum = $_POST['chNum'];
    $chTime = $_POST['chTime'];
    $idcls = $_POST['idCls'];

    $link = create_connection();

    

    // $sql = "INSERT INTO `phonenum_gooding`(`id`, `name`, `phoneNum`, `sport`, `chNum`, `site_way`, `chDate`, `chTIme`) 
    //     SELECT $id,'$name',$phoneNum,'$sport', $chNum, bmt_site.site_num, '$chTime','$chTime'
    //     FROM `bmt_site` 
    //     WHERE bmt_site.bsite_status = 'empty' LIMIT 1";
    // $result=execute_sql($link,'pdsports',$sql);
    // $sql = "UPDATE `bmt_site` SET `bsite_status`='using' WHERE bmt_site.bsite_status = 'empty' ORDER BY bmt_site.site_num  LIMIT 1";
    // $result=execute_sql($link,'pdsports',$sql);

    // mysqli_free_result($result);
        if($sport == 'Badminton'){
            $id = time() + rand(1,2022) + rand(12,24);
            $sql = "call gooding_bmt('$id','$name','$phoneNum','$sport', '$chNum', '$chTime','$chTime','$idcls')";
            $result=execute_sql($link,'pdsports',$sql);
        }else if($sport == 'Basketball'){
            $id = time() + rand(1,2022) + rand(12,24);
            $sql = "call gooding_bkb('$id','$name','$phoneNum','$sport', '$chNum', '$chTime','$chTime','$idcls')";
            $result=execute_sql($link,'pdsports',$sql);
        }else{
            $id = time() + rand(1,2022) + rand(12,24);
            $sql = "call gooding_other('$id','$name','$phoneNum','$sport', '$chNum', '$chTime','$chTime','$idcls')";
            $result=execute_sql($link,'pdsports',$sql);
        }
    

    mysqli_close($link);

    header('Refresh:0.1;url=index.php');

?>