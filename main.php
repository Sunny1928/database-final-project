<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
  <title>Database Final Project</title>
</head>

<body>
  <!-- Sidebar -->
  <header>
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white p-0">
      <div class="position-sticky">
        <div class="mt-4">
          <div id="header-content" class="w-auto">
            <div class="d-flex justify-content-center">
              <img src="baby.jpg" alt="avatar" class="rounded-circle img-fluid mb-3 m-auto" style="max-width: 100px;">
            </div>
            <h4 class="text-center">
              <span style="white-space: nowrap;">Ann Smith</span>
            </h4>
            <p class="text-center">ann_s@mdbootstrap.com</p>
          </div>
          <hr class="mb-0">
        </div>
        <div class="list-group list-group-flush mx-3 mt-4">
          <a class="list-group-item list-group-item-action py-2 ripple pb-2 active" id="tab-dashboard"
            data-mdb-toggle="pill" href="#pills-dashboard" role="tab" aria-controls="pills-dashboard"
            aria-selected="true">
            <i class="fas fa-user-circle pe-3"></i>DashBoard
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-news" data-mdb-toggle="pill"
            href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="false">
            <i class="fas fa-envelope pe-3"></i>公告
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-message" data-mdb-toggle="pill"
            href="#pills-message" role="tab" aria-controls="pills-message" aria-selected="false">
            <i class="fas fa-paper-plane pe-3"></i>留言板
          </a>
          <a href="#" class="list-group-item list-group-item-action py-2 ripple pb-2 pt-2">
            <i class="fas fa-user-astronaut pe-3"></i>Log out
          </a>
        </div>
    </nav>
  </header>

  <!--Main layout-->
  <main>
    <div class="tab-content" style="max-height: 100vh;">
      <!--dashboard-->
      <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel" aria-labelledby="tab-dashboard">
        <?php
          session_start();
          echo "<h1>Hello!". $_SESSION['name']."</h1>";
        ?>
      </div>

      <!--News-->
      <div class="tab-pane fade h-100" id="pills-news" role="tabpanel" aria-labelledby="tab-news">
        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">公告</h4>
            <?php 
              if( $_SESSION["permission"] != "student"){
                echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addNewsModal'><i class='fa fa-add me-1'></i> 新增</button>";
              }
            ?>
          </div>
        </div>

        <!-- 顯示所有公告顯示 -->
        <?php
          require_once('./service/connect_db.php');
          $conn = connect_db();

          $sql= "SELECT * FROM news";
          $result = $conn->query($sql);
          
          while($row=mysqli_fetch_array($result)){
              
            $date = mb_split(" ",$row[1]);
            $time = mb_split(":",$date[1]);
            $content = $row[0];
            $news_id = $row[2];
            $account = $row[3];
            
            # 判斷是不是本人和身分是否為學生 , 都符合的人不能編輯其他使用者的公告
            if( $_SESSION["permission"] == "student"){
              echo "
              <div class='card m-2'>
                <div class='card-header'>$date[0] $time[0]:$time[1]</div>
                <div class='card-body'>
                  <blockquote class='blockquote mb-0'>
                    <p name='content'>$content</p>
                  </blockquote>
                </div>
              </div>";
            }
            else {
              echo "
              <div class='card m-2'>
                <div class='card-header'>$date[0] $time[0]:$time[1]</div>
                <div class='card-body'>
                  <blockquote class='blockquote mb-0'>
                    <p name='content'>$content</p>
                  </blockquote>
                  <div class='d-flex'>
                      <button type='button' class='btn btn-tertiary me-2' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#updateNewsModal$news_id'>編輯</button>
                      <button type='button' class='btn btn-tertiary' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#deleteNewsModal$news_id'>刪除</button>
                  </div>
                </div>
              </div>";
            }

            // Update News Modal
            echo "
              <div class='modal fade' id='updateNewsModal$news_id' tabindex='-1' aria-labelledby='updateNewsModalLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                  <div class='modal-content'>

                    <form method='post' action='./service/news_update.php'>
                    <div class='modal-header'>
                      <h5 class='modal-title' id='updateNewsModalLabel'>修改公告</h5>
                    </div>
                    <div class='modal-body'>
                      <div class='form-outline'>
                        <textarea name='content' class='form-control border' id='textAreaExample' rows='4' required>$content</textarea>
                        <!-- <label class='form-label' for='textAreaExample'>内容</label> -->
                        <input type='hidden' name='account' value='$account'>
                        <input type='hidden' name='news_id' value='$news_id'>
                      </div>
                    </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                      <button type='submit' class='btn btn-primary'>確認</button>
                    </div>
                    </form>

                  </div>
                </div>
              </div>";

              
              // Delete News Modal
              echo "
                <div class='modal fade' id='deleteNewsModal$news_id' tabindex='-1' aria-labelledby='deleteNewsModalLabel' aria-hidden='true'>
                  <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='deleteNewsModalLabel'>刪除公告</h5>
                      </div>
                      <div class='modal-body'>您確認要刪除公告嗎？</div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                        <button type='button' class='btn btn-primary' onclick='location.href=\"./service/news_delete.php?news_id=$news_id&account=$account\"'>確認</button>
                      </div>
                    </div>
                  </div>
                </div>";
          };?>
        <!-- Add News Modal -->
        <div class='modal fade' id='addNewsModal' tabindex='-1' aria-labelledby='addNewsModalLabel' aria-hidden='true'>
          <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title' id='addNewsModalLabel'>新增公告</h5>
                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
              </div>
              <form method='post' action='./service/news_add.php'>
                <div class='modal-body'>
                  <div class='form-outline'>
                    <textarea name='content' class='form-control border' id='textAreaExample' rows='4'
                      required></textarea>
                    <label class='form-label' for='textAreaExample'>内容</label>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                  <button type='submit' class='btn btn-primary'>確認</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Message -->
      <div class="tab-pane fade h-100" id="pills-message" role="tabpanel" aria-labelledby="tab-message">
        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">留言板</h4>
          </div>
        </div>

        <div class="m-2 h-70" style="background-color: #eee;">
          <div class="card h-70" id="chat2">
            <div class="card-body h-70" style="position: relative; height: 770px; overflow: scroll;">

              <?php
                $sql =  "SELECT * FROM comment";
                $result = $conn->query($sql);
                
                while($row=mysqli_fetch_array($result)){
                    
                  $date = mb_split(" ",$row[0])[1];
                  $time = mb_split(":",$date);
                  $content = $row[1];
                  $comment_id = $row[2];
                  $account = $row[3];
                  
                  # 判斷是不是本人和身分是否為學生 , 都符合的人不能編輯其他使用者的留言
                  if($account != $_SESSION["account"] ){
                      if ($_SESSION["permission"]=="student"){
                        echo "
                        <div class='d-flex flex-row justify-content-start'>
                          <img src='https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp' alt='avatar 1' style='width: 45px; height: 100%;'>
                          <div>
                            <p class='small p-2 ms-3 mb-1 rounded-3' style='background-color: #f5f6f7;'>$content</p>
                            <p class='small ms-3 mb-2 rounded-3 text-muted'>$time[0]:$time[1]</p>
                          </div>
                        </div>
                        ";
                      }
                      else {
                        echo "
                        <div class='d-flex flex-row justify-content-start'>
                          <img src='https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp' alt='avatar 1' style='width: 45px; height: 100%;'>
                          <div>
                            <p class='small p-2 ms-3 mb-1 rounded-3' style='background-color: #f5f6f7;'>$content</p>
                            <div class='small mb-2 text-muted d-flex'>
                              <p class='ms-1 rounded-3 text-muted'>$time[0]:$time[1]</p>
                              <p class='ms-1 rounded-3' style='width: fit-content;' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#updateMessageModal$comment_id'>編輯</p>
                              <p class='ms-1 rounded-3' style='width: fit-content;' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#deleteMessageModal$comment_id'>刪除</p>
                            </div>
                          </div>
                        </div>
                        ";
                        // <div class='ms-1 rounded-3' onclick=\"location.href='./comment_update_view.php?comment_id=$comment_id&account=$account&content=$content'\">編輯</div>
                        // <div class='ms-1 rounded-3' onclick=\"location.href='./comment_delete.php?comment_id=$comment_id&account=$account'\">刪除</div>
                      }
                  } 
                  else {
                    # 本人可以對自己傳的訊息操作
                    echo "
                      <div class='d-flex flex-row justify-content-end pt-1'>
                        <div>
                          <p class='small p-2 me-3 mb-1 text-white rounded-3 bg-primary'>$content</p>
                          <div class='small mb-2 text-muted d-flex'>
                            <p class='me-1  rounded-3  d-flex justify-content-end'>$time[0]:$time[1]</p>
                            <p class='ms-1 rounded-3' style='width: fit-content;' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#updateMessageModal$comment_id'>編輯</p>
                            <p class='ms-1 rounded-3' style='width: fit-content;' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#deleteMessageModal$comment_id'>刪除</p>
                          </div>
                        </div>
                        <img src='https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp' alt='avatar 1' style='width: 45px; height: 100%;'>
                      </div>
                      ";
                  }

                  // Update Message Modal
                  echo "
                  <div class='modal fade' id='updateMessageModal$comment_id' tabindex='-1' aria-labelledby='updateMessageModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                      <div class='modal-content'>

                        <form method='post' action='./service/comment_update.php'>
                        <div class='modal-header'>
                          <h5 class='modal-title' id='updateMessageModalLabel'>修改留言</h5>
                        </div>
                        <div class='modal-body'>
                          <div class='form-outline'>
                            <textarea name='content' class='form-control border' id='textAreaExample' rows='4' required>$content</textarea>
                            <!-- <label class='form-label' for='textAreaExample'>内容</label> -->
                            <input type='hidden' name='account' value='$account'>
                            <input type='hidden' name='comment_id' value='$comment_id'>
                          </div>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                          <button type='submit' class='btn btn-primary'>確認</button>
                        </div>
                        </form>

                      </div>
                    </div>
                  </div>";

              
              // Delete Message Modal
              echo "
                <div class='modal fade' id='deleteMessageModal$comment_id' tabindex='-1' aria-labelledby='deleteMessageModalLabel' aria-hidden='true'>
                  <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='deleteMessageModalLabel'>刪除留言</h5>
                      </div>
                      <div class='modal-body'>您確認要刪除留言嗎？</div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                        <button type='button' class='btn btn-primary' onclick='location.href=\"./service/comment_delete.php?comment_id=$comment_id&account=$account\"'>確認</button>
                      </div>
                    </div>
                  </div>
                </div>";
                }
              ?>

              <!-- time 
              <div class="divider d-flex align-items-center mb-4">
                <p class="text-center mx-3 mb-0" style="color: #a2aab7;">Today</p>
              </div>
              -->
            </div>

            <!-- Add -->
            <form method="post" id="add_message" action="./service/comment_add.php">
              <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                <img src="baby.jpg" alt="avatar 3" style="width: 40px; height: 100%; border-radius: 100%;">
                <input name="content" required type="text" class="form-control form-control-lg"
                  id="exampleFormControlInput1" placeholder="Type message">
                <a class="ms-3" onclick="document.getElementById('add_message').submit();"><i
                    class="fas fa-paper-plane"></i></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>

<script>
  document.querySelectorAll('.form-outline').forEach((formOutline) => {
    new mdb.Input(formOutline).init();
  });

  if (location.hash === "#pills-news") {
    const triggerEl = document.querySelector('a[href="#pills-news"]');
    if (triggerEl) {
      let instance = mdb.Tab.getInstance(triggerEl)
      if (!instance) {
        instance = new mdb.Tab(triggerEl);
      }
      instance.show();
    }
  } else if (location.hash === "#pills-message") {
    const triggerEl = document.querySelector('a[href="#pills-message"]');
    if (triggerEl) {
      let instance = mdb.Tab.getInstance(triggerEl)
      if (!instance) {
        instance = new mdb.Tab(triggerEl);
      }
      instance.show();
    }
  }
</script>


<style>
  body {
    background-color: #fbfbfb;
  }

  @media (min-width: 800px) {
    main {
      padding-left: 280px;
    }
  }

  /* Sidebar */
  .sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    padding: 58px 0 0;
    /* Height of navbar */
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
    width: 280px;
    z-index: 600;
  }

  @media (max-width: 800px) {
    .sidebar {
      width: 100%;
    }
  }

  .sidebar .active {
    border-radius: 5px;
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
  }

  .sidebar-sticky {
    position: relative;
    top: 0;
    height: calc(100vh - 48px);
    padding-top: 0.5rem;
    overflow-x: hidden;
    overflow-y: auto;
    /* Scrollable contents if viewport is shorter than content. */
  }

  #chat2 .form-control {
    border-color: transparent;
  }

  #chat2 .form-control:focus {
    border-color: transparent;
    box-shadow: inset 0px 0px 0px 1px transparent;
  }

  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
  }
</style>