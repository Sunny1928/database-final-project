<?php 
    session_start();

    require_once('./connect_db.php');
    $conn = connect_db();

?>

<form method = "post" action="./comment_add.php"> 
        
    <table border="1">
        
        <tr><font size="4" face="標楷體"color=black>
        <td><font size="4" face="標楷體"color=black>內容</td>
        <td><input type=text maxLength="12" size="12" name="content"required></td>
        <td><input type="submit" value="傳送" ></td>
        </tr>
    
    </table>

</form>

<center>

    <table border="1">

    <tr><font size="4" face="標楷體"color=black>
        
    <td><font size="4" face="標楷體"color=black>時間</td>
    <td><font size="4" face="標楷體"color=black >內容</td>
    <td><font size="4" face="標楷體"color=black>帳號名稱</td>
    <td><font size="4" face="標楷體"color=black></td>
    
    </tr>
    <?php
        $sql =  "SELECT * FROM comment";
        $result = $conn->query($sql);
        
        while($row=mysqli_fetch_array($result)){
            
            # 切時間成(時:分)
            $date = mb_split(" ",$row[0])[1];
            $time = mb_split(":",$date);
            $content = $row[1];
            $comment_id = $row[2];
            $account = $row[3];
            
            echo'<tr>';
            
            echo "<td><font size= '4' face='標楷體' color= black> $time[0]:$time[1]</td>";
            echo "<td><font size= '4' face='標楷體' color= black> $content </td>";
            echo "<td><font size= '4' face='標楷體' color= black> $account </td>";
            
            #學生只能修改自己的留言 ， 而其他身分可以更動全部人的
            if (($_SESSION["permission"]=="student" && $_SESSION["account"]==$account) || $_SESSION["permission"]!="student" ){ 
                echo "<td><font size= '4' face='標楷體' color= black><a href='./comment_delete.php?comment_id=$comment_id&account=$account'>刪除</a></td>";
            }
            echo'</tr>';
            
        }
    ?>
    </table>
</center>

<!-- <form method="post" action="./update.php">
    
    <label>内容：</label><br>
    <textarea name="content">
        
    </textarea><br>
    <input type="submit" value="修改">
</form> -->
