<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>體育場地預約</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>SPORT 場地預約系統</h1>
</header>

<div id="tab">
  <ul class="tab-title">
      <li><a href="#tab01">tab01</a></li>
        <li><a href="#tab02">tab02</a></li>
    </ul>
    <div id="tab01" class="tab-inner">
      <main>
    <div class="container">
        <div class="gooding choice"><!-- 選擇預約 -->
            <div class="choiceform">
                <h1>場地選擇</h1>
                <hr>
                <div class="item">
                    <label for="">學號 :</label>
                    <input type="text" name="Cls" id="inCls">
                </div>
                <div class="item">
                    <label for="">姓名 :</label>
                    <input type="text" name="name" id="inName">
                </div> 
                <div class="item">
                    <label>手機號碼 : </label>
                    <input type="text" id="inPhNum" minlength="10" maxlength="11">
                </div>   
                <div class="item typebt">
                    <label for="">場地項目 : </label>
                    <input type="button" value="Badminton" id="type1">
                    <input type="button" value="Gym" id="type2">
                    <input type="button" value="Basketball" id="type 3">
                    <input type="button" value="Swim" id="type 4">
                </div>
                <div class="item">
                    <label id="changeLb">人數/場地數 : </label>
                    <select name="numSl" id="num">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="item">
                    <label for="">選擇時間</label>
                    <input type="datetime-local" id="time">
                </div class="item">
                <button id="check">確認選項</button>
            </div>
            <div class="statusform">
                <h1>現在場地狀態</h1>
                <hr>
                <?php
                require_once("dbtools.inc.php");

                $records_per_page = 20;

                $link = create_connection();

                $sql = "SELECT sports.sport_name, site_status.status_used AS '位置數量'
                FROM sports LEFT JOIN site_status 
                ON sports.sport_id = site_status.sport_id";

                $result=execute_sql($link,'pdsports',$sql);
                    
                    //取得欄位數
                    $total_fields = mysqli_num_fields($result);
                    
                    //顯示欄位名稱
                    echo "<table border='1' align='center' width='auto'>";
                    echo "<tr align='center'>";    
                    echo "<td width='100px'>";     
   
                    for ($i = 1; $i < $total_fields; $i++)
                        // $fieldinfo =    mysqli_fetch_field_direct($result, $i);
                        echo "<td>" .  mysqli_field_name($result,$i) . "</td>";                  
                    //echo "</tr>";
                    
                    //顯示記錄
                    $j = 1;
                    while ($row = mysqli_fetch_row($result) and $j <= $records_per_page)
                    {
                        echo "<tr>";      
                        for($i = 0; $i < $total_fields; $i++)
                        
                        echo "<td>$row[$i]</td>"; 
                                    
                        $j++;
                        echo "</tr>";     
                    }
                    echo "</table>" ;
                    
                    //釋放記憶體空間
                    mysqli_free_result($result);

                mysqli_close($link)
                ?>
                <form action="reTodayNow.php" method="post" style="margin-bottom: 20px;">
                    <div class="checkbb">
                        <input type="date" id="checkb" name="date">
                        <input type="time" id="checkb" name="time">
                        <input type="submit" id="checkb" value="查詢時間場地狀態" class="refresh"> 
                    </div>                   
                </form>
                <?php
                require_once("dbtools.inc.php");

                $records_per_page = 20;

                $link = create_connection();

                $sql = "SELECT sports.sport_name, site_price.price FROM `sports` LEFT JOIN site_price on sports.sport_id = site_price.id";

                $result=execute_sql($link,'pdsports',$sql);
                    
                    //取得欄位數
                    $total_fields = mysqli_num_fields($result);
                    
                    //顯示欄位名稱
                    echo "<table border='1' align='center' width='auto'>";
                    echo "<tr align='center'>";    
                    echo "<td width='100px'>";         
                    for ($i = 1; $i < $total_fields; $i++)
                        // $fieldinfo =    mysqli_fetch_field_direct($result, $i);
                        echo "<td>" .  mysqli_field_name($result,$i) . "</td>";                  
                    //echo "</tr>";
                    
                    //顯示記錄
                    $j = 1;
                    while ($row = mysqli_fetch_row($result) and $j <= $records_per_page)
                    {
                        echo "<tr>";      
                        for($i = 0; $i < $total_fields; $i++)
                        
                        echo "<td>$row[$i]</td>"; 
                                    
                        $j++;
                        echo "</tr>";     
                    }
                    echo "</table>" ;
                    
                    //釋放記憶體空間
                    mysqli_free_result($result);

                mysqli_close($link)
                ?>
            </div>
        </div>


        <div class="gooding status"><!-- 預約狀態 -->
            <h1>預約資訊</h1>
            <hr>
            <form action="gooding.php" method="post">
                <div class="item">
                    <label>學號 : </label>
                    <input type="text" name="idCls" id="outCls" readonly>
                </div>
                <div class="item">
                    <label>姓名 : </label>
                    <input type="text" name="name" id="outName" readonly>
                </div>
                <div class="item">
                    <label>手機號碼 : </label>
                    <input type="text" name="phoneNum" id="outPhNum" readonly>
                </div>
                <div class="item">
                    <label>項目 : </label>
                    <input type="text" value="" id="cType" name="sport" readonly>
                </div>
                <div class="item">
                    <label id="changeLb">人數 : </label>
                    <input type="text" value="" id="nType" name="chNum" readonly>
                </div>
                <div class="item">
                    <label>時間 : </label>
                    <input type="text" value="" id="tType" name="chTime" readonly>
                </div>

                <input type="submit" value="送出">
            </form>
        </div>
    </div>
</main>

    </div>
    <div id="tab02" class="tab-inner">
        <main>
            <div class="container">
                <div class="gooding choice" styl>
                    <form method="post" action="#">
                        <input type="submit" value="手機號碼查詢">
                        <input type="text" name="cphoneNum">
                    </form>
                    <?php
                    require_once("dbtools.inc.php");

                    $link = create_connection();


                    $phone = '';
                    if(isset( $_POST['cphoneNum'])){
                        $phone = mysqli_real_escape_string($link,$_POST['cphoneNum']);
                    }
                    // $phone= $_POST['cphoneNum'];

                    $records_per_page = 20;


                    $sql = "SELECT * FROM `phonenum_gooding` WHERE phonenum_gooding.phoneNum = '$phone'";
                    $result=execute_sql($link,'pdsports',$sql);
                        
                        //取得欄位數
                        $total_fields = mysqli_num_fields($result);
                        
                        //顯示欄位名稱
                        echo "<table border='1' align='center' width='auto' height=30px>";
                        echo "<tr align='center'>";    
                        echo "<td width='100px'>"; 
                        function mysqli_field_name($result, $field_offset)
                        {
                            $properties = mysqli_fetch_field_direct($result, $field_offset);
                            return is_object($properties) ? $properties->name : null;
                        }    
                        for ($i = 1; $i < $total_fields; $i++)
                            // $fieldinfo =    mysqli_fetch_field_direct($result, $i);
                            echo "<td>" .  mysqli_field_name($result,$i) . "</td>";                  
                        //echo "</tr>";
                        
                        //顯示記錄
                        $j = 1;
                        while ($row = mysqli_fetch_row($result) and $j <= $records_per_page)
                        {
                            echo "<tr>";      
                            for($i = 0; $i < $total_fields; $i++)
                            
                            echo "<td>$row[$i]</td>"; 
                                        
                            $j++;
                            echo "</tr>";     
                        }
                        echo "</table>" ;
                        
                        //釋放記憶體空間
                        mysqli_free_result($result);

                    mysqli_close($link)
                    ?>
                </div>
                <div class="gooding status">
                    <form action="check.php" method="post">
                        <input type="submit" value="取消預約" style="width: 100px;">
                        <label for=""> id: </label>
                        <input type="text" name="id">
                        <label style="width: auto;">只能在預約時間前取消</label>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
<footer>
    <p>&copy;2022/12/24 David Yang</p>
</footer>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="index.js" type="text/javascript"></script>

</body>
</html>