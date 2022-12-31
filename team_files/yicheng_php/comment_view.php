<!-- 訊息主介面 -->
<?php 
    session_start();

    require_once('./connect_db.php');
    $conn = connect_db();

?>

<style>
    .dialog{
        width:600px;
        height:500px;
        border:1px solid #666;
        margin:50px auto 0;
        background:#f9f9f9;
        word-wrap:break-word;
    }
    .talk_show{
        width:580px;
        height:420px;
        border:1px solid #666;
        background:#fff;
        margin:10px auto 0;
        overflow-y:auto;
    }
    .talk_input{
        width:580px;
        margin:10px auto 0;
    }

    .talk_word{
        width:420px;
        height:26px;
        padding:0px;
        float:left;
        margin-left:80px;
        outline:none;
        text-indent:10px;
    }        
    .talk_sub{
        width:56px;
        height:30px;
        float:left;
        margin-left:10px;
    }
    .left_dialog{
        margin:10px; 
        margin-left: 20px;
        margin-right: 80px;

    }
    .left_dialog .content{
        display: inline;
        background:#0181cc;
        border-radius:10px;
        color:#fff;
        padding:5px 10px;
    }
    .right_dialog{
        margin:10px;
        text-align:right;
        margin-left: 80px;
        margin-right: 20px;

    }
    .right_dialog .content{
        display: inline;
        background:#ef8201;
        border-radius:10px;
        color:#fff;
        padding:5px 10px;
    
    }
    .option{
        display:inline-block; 
    }
</style>


<!-- 對話框 -->
<div class="dialog">
    <div class="talk_show">

        <!-- 抓取對話訊息 -->
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
                
                # 判斷是不是本人和身分是否為學生 , 都符合的人不能編輯其他使用者的公告
                if($account != $_SESSION["account"] && $_SESSION["permission"]=="student"){
            
                    echo "
                        <div class='left_dialog'>
                            <div class='content'>$content</div>
                            <div >
                                <div class='option'>$time[0]:$time[1]</div>
                            </div>                            
                        </div>
                    ";
            
                } 
                else {
                    # 本人可以對自己傳的訊息操作
                    echo "
                        <div class='right_dialog'>
                            <div class='content'>$content</div>
                            <div >
                                <div class='option'>$time[0]:$time[1]</div>
                                <div class='option' onclick=\"location.href='./comment_update_view.php?comment_id=$comment_id&account=$account&content=$content'\">編輯</div>
                                <div class='option' onclick=\"location.href='./comment_delete.php?comment_id=$comment_id&account=$account'\">刪除</div>
                            </div>
                            
                        </div>
                    ";
                }
            }
        ?>
    </div>

    <!-- 傳送鍵 -->
    <div class="talk_input">
        <form method = "post" action="./comment_add.php"> 
            <input type=text class="talk_word"  size="12" name="content"required>
            <input type="submit" class="talk_sub"  value="傳送" >
        </form>
    </div>

</div>
