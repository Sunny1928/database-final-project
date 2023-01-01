<!-- 公告-介面 -->
<center>

    <form method="post" action="./news_update.php">

        <label>内容：</label><br>
        <textarea name="content" style="resize:none;width:600px;height:200px;" required><?php echo $_GET["content"] ?></textarea>
        <input type="hidden" name="account" value =<?php echo $_GET["account"];?> >
        <input type="hidden" name="news_id" value=<?php echo $_GET["news_id"];?>>
        <br>
        <br>
        <input type="submit" value="更新">
        <input type="button" value="返回" onclick="location.href='./news_view.php'">

    </form>
</center>

