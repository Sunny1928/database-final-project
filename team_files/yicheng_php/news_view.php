<!-- 公告-主介面 -->
<?php 
    session_start(); 
    require_once('./connect_db.php');
    $conn = connect_db();
?>
<style>
    .option{
            display:inline-block; 
        }
</style>

<!-- 新增按鈕 -->
<input type="button" value="新增" onclick="location.href='./news_add_view.php'">

<center>
    
    <div>
        <!-- 顯示所有公告顯示 -->
        <?php
            $sql= "SELECT * FROM news";
            $result = $conn->query($sql);
            
            
            while($row=mysqli_fetch_array($result)){
                
                $date = mb_split(" ",$row[1]);
                $time = mb_split(":",$date[1]);
                $content = $row[0];
                $news_id = $row[2];
                $account = $row[3];
                
                # 判斷是不是本人和身分是否為學生 , 都符合的人不能編輯其他使用者的公告
                if($account != $_SESSION["account"] && $_SESSION["permission"] == "student"){
            
                    echo "
                    <div>
                        <div class='option'> $date[0] $time[0]:$time[1]</div>
                    </div>
                    ";
                    echo "<textarea name='content' style='resize:none;width:600px;height:200px;' readonly>$content</textarea><br>";
                }
                else {
                    echo "
                    <div>
                        <div class='option'> $date[0] $time[0]:$time[1]</div>
                        <div class='option' onclick=\"location.href='./news_update_view.php?news_id=$news_id&account=$account&content=$content'\">編輯</div>
                        <div class='option' onclick=\"location.href='./news_delete.php?news_id=$news_id&account=$account'\">刪除</div>
                    </div>
                    ";
                    echo "<textarea name='content' style='resize:none;width:600px;height:200px;' readonly>$content</textarea><br>";
                }
            }
        ?>
    </div>

    
    
</center>
