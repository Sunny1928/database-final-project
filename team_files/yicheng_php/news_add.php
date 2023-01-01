<!-- 新增公告-功能 -->
<?php 
    session_start();
    require_once('./connect_db.php');
    $conn = connect_db();
    
    $account = $_SESSION["account"];
    $content = $_POST["content"];
    $sql= "INSERT INTO news (account , content) VALUE($account,'$content')";
    $result = $conn->query($sql);

    header('Location: ./news_view.php'); 
    
?>