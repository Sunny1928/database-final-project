
<?php 
    session_start(); 
    require_once('./connect_db.php');
    $conn = connect_db();
?>


<center>
    
    <table border="1">

    <tr><font size="4" face="標楷體"color=black>
    <td><font size="4" face="標楷體"color=black >時間</td>
    <td><font size="4" face="標楷體"color=black >公告人</td>
    <td><font size="4" face="標楷體"color=black >內容</td>
    <td><font size="4" face="標楷體"color=black ></td>
    <td><font size="4" face="標楷體"color=black ></td>
    
    </tr>
    
    <?php
        $sql= "SELECT * FROM news";
        $result = $conn->query($sql);

        while($row=mysqli_fetch_array($result)){
            
            $date = mb_split(" ",$row[1]);
            $time = mb_split(":",$date[1]);
            $content = $row[0];
            $news_id = $row[2];
            $account = $row[3];
            
            echo'<tr>';
            
            echo "<td><font size= '4' face='標楷體' color= black> $date[0] $time[0]:$time[1]</td>";
            echo "<td><font size= '4' face='標楷體' color= black> $account </td>";
            echo "<td><font size= '4' face='標楷體' color= black> $content </td>";

            if (($_SESSION["permission"]=="student" && $_SESSION["account"]==$account) || $_SESSION["permission"]!="student" ){ 
                echo "<td><font size= '4' face='標楷體' color= black><a href='./news_update_view.php?news_id=$news_id&account=$account&content=$content'>編輯</a></td>";
                echo "<td><font size= '4' face='標楷體' color= black><a href='./news_delete.php?news_id=$news_id&account=$account'>刪除</a></td>";
            }
            echo'</tr>';
            
        }
    ?>

    </table>
    <input type="button" value="新增" onclick="location.href='./news_add_view.php'">
</center>

