<?php session_start();
if (!isset($_SESSION["permission"])){
					
  Header("Location: ./index.php" , 301);
  die();
}?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
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
              <img src=<?php echo $_SESSION['icon']?> 
                alt="avatar" class="rounded-circle img-fluid mb-3 m-auto" style="max-width: 100px;">
            </div>
            <h4 class="text-center">
              <span style="white-space: nowrap;"><?php echo $_SESSION['name']?></span>
            </h4>
            <p class="text-center"><?php echo $_SESSION['email']?></p>
          </div>
          <hr class="mb-0">
        </div>
        <div class="list-group list-group-flush mx-3 mt-4">
          <a class="list-group-item list-group-item-action py-2 ripple pb-2 active" id="tab-dashboard"
            data-mdb-toggle="pill" href="#pills-dashboard" role="tab" aria-controls="pills-dashboard"
            aria-selected="true">
            <i class="fas fa-house pe-3"></i>主畫面
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-news" data-mdb-toggle="pill"
            href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="false">
            <i class="fas fa-envelope pe-3"></i>公告
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-message" data-mdb-toggle="pill"
            href="#pills-message" role="tab" aria-controls="pills-message" aria-selected="false">
            <i class="fas fa-comment pe-3"></i>留言板
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-violate-record"
            data-mdb-toggle="pill" href="#pills-violate-record" role="tab" aria-controls="pills-violate-record"
            aria-selected="false">
            <i class="fas fa-book pe-3"></i>違規紀錄
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-all" data-mdb-toggle="pill"
            href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="false">
            <i class="fas fa-house-chimney pe-3"></i>宿舍資料
          </a>
        </div>
        <div class="list-group list-group-flush mx-3">
          <a href="./index.php" class="list-group-item py-2 ripple pb-2">
            <i class="fas fa-right-from-bracket pe-3"></i>登出
          </a>
        </div>
        <div class=" text-center text-reset mt-5">
          <em><small>Copyright © 2023 - PYSY</small></em>
        </div>
    </nav>
  </header>

  <!--Main layout-->
  <main>
    <div class="tab-content" style="max-height: 100vh;">
      <!--dashboard-->
      <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel" aria-labelledby="tab-dashboard">
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">主畫面</h4>
          </div>
        </div>



        <?php
          require('./service/connect_db.php');
          $conn = connect_db();
          $account = $_SESSION['account'];
          $semester = 2;
          $academic_year = 112;
          $permission =  $_SESSION['permission'];

          if($permission == 'student')
          {
              //輸出申請住宿資料
              $sql = "SELECT * FROM `Apply_Data` where `student_account` = ? and academic_year = ? and semester = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("sii", $account, $academic_year, $semester);
              $stmt->execute();
              $result = $stmt->get_result();

              if (mysqli_num_rows($result) > 0) {
                  while($row=mysqli_fetch_array($result)){
                  $academic_year = $row[0];
                  $semester = $row[1];
                  $apply_date = $row[2];
                  $state = $row[3];
                  $pay_fee_or_not = $row[4];
                  $apply_data_id = $row[6];

                  echo "<div class='row row-eq-height m-1 py-2'>
                  <div class='col-md-6'>
                    <div class='card h-100'>
                      <div class='card-body'>
                        <h4 class='card-title mx-3'>宿舍申請進度</h4>
                        <div>
                          <ol class='c-stepper'>
                            <li class='c-stepper__item'>
                                <div class='c-stepper__content'>
                                    <h3 class='c-stepper__title'>步驟一：申請</h3>
                                    <p>對下學期的住宿提出申請</p>
                                </div>
                            </li>
                            <li class=";
                            if($state == '審核中'){
                              echo 'c-stepper__item_a';
                            } else{
                              echo 'c-stepper__item';
                            }
                            echo ">
                                <div class='c-stepper__content'>
                                    <h3 class='c-stepper__title'>步驟二：審核</h3>
                                    <p>會依照你的違規紀錄，抽宿舍，若你扣分的幾點越多，越難抽到</p>
                                </div>
                            </li>
                            <li class=";
                            if($state != '審核中'){
                              echo 'c-stepper__item_a';
                            } else{
                              echo 'c-stepper__item';
                            }
                            echo ">
                                <div class='c-stepper__content'>
                                    <h3 class='c-stepper__title'>步驟三：分發</h3>
                                    <p>你會收到核可通知，這時你再決定是否入住，若是請在期限內繳費</p>
                                </div>
                            </li>
                          </ol>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-6 '>
                    <div class='card h-100'>
                      <div class='card-body'>
                        <h4 class='card-title mb-4'>宿舍申請</h4>
                        
                        <form method='post' action='./service/apply_data_update.php'>
                          <div class='p-3 mb-2' style='border-radius:10px; background:#eee'>
                            <p class='fs-5 my-2'><strong>申請日期:</strong><span class='font-monospace'> $apply_date</span></p>
                            <p class='fs-5 my-2'><strong>申請狀態:</strong><span class='font-monospace'> $state</span></p>
                            <p class='fs-5 my-2'><strong>付款:</strong><span class='font-monospace'> $pay_fee_or_not</span></p>
                            <p class='fs-5 my-2'><strong>學年:</strong><span class='font-monospace'> $academic_year</span></p>
                            <p class='fs-5 '><strong>學期:</strong><span class='font-monospace'> $semester</span></p>
                          </div>
                          <div class='d-flex'>
                            <button type='button' class='btn btn-secondary btn-block' onclick=\"location.href='./service/apply_data_delete.php?apply_data_id=$apply_data_id'\">刪除</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  
                  
                </div>";
                // <button class='btn btn-primary mb-4 me-1 w-50' type='submit' value='Submit' >修改</button>

                  }
                }else{
                echo "<div class='row row-eq-height m-1 py-2'>
                  <div class='col-md-6'>
                    <div class='card h-100'>
                      <div class='card-body'>
                        <h4 class='card-title mx-3'>宿舍申請進度</h4>
                        <div>
                          <ol class='c-stepper'>
                            <li class='c-stepper__item_a'>
                                <div class='c-stepper__content'>
                                    <h3 class='c-stepper__title'>步驟一：申請</h3>
                                    <p>對下學期的住宿提出申請</p>
                                </div>
                            </li>
                            <li class='c-stepper__item'>
                                <div class='c-stepper__content'>
                                    <h3 class='c-stepper__title'>步驟二：審核</h3>
                                    <p>會依照你的違規紀錄，抽宿舍，若你扣分的幾點越多，越難抽到</p>
                                </div>
                            </li>
                            <li class='c-stepper__item'>
                                <div class='c-stepper__content'>
                                    <h3 class='c-stepper__title'>步驟三：分發</h3>
                                    <p>你會收到核可通知，這時你再決定是否入住，若是請在期限內繳費</p>
                                </div>
                            </li>
                          </ol>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-6'>
                    <div class='card h-100'>
                      <div class='card-body'>
                        <h4 class='card-title mb-4'>宿舍申請</h4>
                        <div class='m-2'>
                          <form method='post' action='./service/apply_data_add.php'>
                            <div class='form-outline mb-4'>
                              <input readonly name='academic_year' value='$academic_year' required type='number' class='form-control' id='academic_yeard' rows='4'
                                required>
                              <label class='form-label' for='academic_yeard'>學年</label>
                              <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                            </div>
                            <div class='form-outline mb-4'>
                              <input readonly name='semester' value='$semester' required type='text' class='form-control' id='semesterd' rows='4'
                                required>
                              <label class='form-label' for='semesterd'>學期</label>
                              <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                            </div>
                            <button type='submit' value='Submit' class='btn btn-primary btn-block mb-4'>申請</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
              }
          }

          else if($permission == 'system_manager')
          {
            $sql = "SELECT * FROM `Apply_Data`";
            $result = $conn->query($sql);

            echo "
              <div class='card m-2'>
                <section class='border p-4'>
                  <h5 class='m-2'>管理宿舍申請資料</h5>
                  <div id='datatable-custom' data-mdb-hover='true' class='datatable datatable-hover'>
                    <div class='datatable-inner table-responsive ps' style='overflow: auto; position: relative;'>
                      <table class='table datatable-table'>
                        <thead class='datatable-header'>
                          <tr>
                            <th scope='col'>學年</th>
                            <th scope='col'>學期</th>
                            <th scope='col'>日期</th>
                            <th scope='col'>狀態</th>
                            <th scope='col'>付款與否</th>
                            <th scope='col'>學生帳號</th>
                            <th scope='col'>操作</th>
                          </tr>
                        </thead>
                        <tbody class='datatable-body'>";

            while($row=mysqli_fetch_array($result))
            {
              $academic_year = $row[0];
              $semester = $row[1];
              $apply_date = $row[2];
              $state = $row[3];
              $pay_fee_or_not = $row[4];
              $apply_data_id = $row[6];
              $student_account = $row[7];

              echo "<tr>" .
                "<td> " . $academic_year . "</td>".
                "<td> " . $semester . "</td>".
                "<td> " . $apply_date . "</td>".
                "<td> " . $state . "</td>".
                "<td> " . $pay_fee_or_not . "</td>".
                "<td> " . $student_account . "</td>".
                "<td>
                  <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateRoomModal$apply_data_id'><i class='fa fa-pencil'></i></button>
                  <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteRoomModal$apply_data_id'><i class='fa fa-trash'></i></button>
                </td>".
                "</tr>";

                // Update Modal
                echo "
                <div class='modal fade' id='updateRoomModal$apply_data_id' tabindex='-1' aria-labelledby='updateRoomModalLabel' aria-hidden='true'>
                  <div class='modal-dialog modal-dialog-centered'>
                  <form method='post' action='./service/apply_data_update.php'>
                  <div class='modal-content'>
                      <input value='$apply_data_id' hidden name='apply_data_id'  />
                      <div class='modal-header'>
                        <h5 class='modal-title' id='updateRoomModalLabel'>修改宿舍申請資料</h5>
                        <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                        <div class='text-center mb-3'>
                          <div class='form-outline mb-4'>
                            <input value='$academic_year' readonly type='text' name='academic_year' id='academicYear' class='form-control' />
                            <label class='form-label' for='academicYear'>學年</label>
                            <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input readonly value='$semester' required type='text' name='semester' id='semester' class='form-control' />
                            <label class='form-label' for='semester'>學年</label>
                            <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                          </div>
                          <div class='form-outline mb-4'>
                            <input readonly value='$apply_date' required type='text' name='apply_date' id='applyDate' class='form-control' />
                            <label class='form-label' for='applyDate'>申請日期</label>
                            <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                          </div>
                          <select class='form-select mb-4' name=state required>
                            <option value=''>狀態</option>
                            <option value='審核中'"; if($state == '審核中') echo "selected"; echo">審核中</option>
                            <option value='審核失敗'"; if($state == '審核失敗') echo "selected"; echo">審核失敗</option>
                            <option value='審核成功'"; if($state == '審核成功') echo "selected"; echo">審核成功</option>
                          </select>
                          <select class='form-select mb-4' name=pay_fee_or_not required>
                            <option value=''>付款與否</option>
                            <option value='未付款'"; if($pay_fee_or_not == '未付款') echo "selected"; echo">未付款</option>
                            <option value='已付款'"; if($pay_fee_or_not == '已付款') echo "selected"; echo">已付款</option>
                          </select>
                          <div class='form-outline mb-4'>
                            <input readonly value='$student_account' required name='student_account' id='student_account' class='form-control' />
                            <label class='form-label' for='student_account'>學生帳號</label>
                            <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                          </div>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                        <button type='submit' class='btn btn-primary'>確認</button>
                      </div>
                  </div>
                  </form>
                  </div>
                </div>";

                // Delete Modal
                echo "
                <div class='modal fade' id='deleteRoomModal$apply_data_id' tabindex='-1' aria-labelledby='deleteRoomModalLabel' aria-hidden='true'>
                  <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='deleteRoomModalLabel'>刪除宿舍申請資料</h5>
                      </div>
                      <div class='modal-body'>您確認要刪除宿舍申請資料嗎？</div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                        <button type='button' class='btn btn-primary' onclick='location.href=\"./service/apply_data_delete.php?apply_data_id=$apply_data_id\"'>確認</button>
                      </div>
                    </div>
                  </div>
                </div>";
            }
            echo "
                        </tbody>
                      </table>
                      <div class='ps__rail-x' style='left: 0px; bottom: 0px;'>
                        <div class='ps__thumb-x' tabindex='0' style='left: 0px; width: 0px;'></div>
                      </div>
                      <div class='ps__rail-y' style='top: 0px; right: 0px;'>
                        <div class='ps__thumb-y' tabindex='0' style='top: 0px; height: 0px;'></div>
                      </div>
                    </div>
              <div class='datatable-pagination d-flex justify-content-end'>
                <div class='datatable-pagination-buttons'>
                  <button data-mdb-ripple-color='dark'
                    class='btn btn-link datatable-pagination-button datatable-pagination-left'><i
                      class='fa fa-chevron-left'></i></button>
                  <button data-mdb-ripple-color='dark'
                    class='btn btn-link datatable-pagination-button datatable-pagination-right'><i
                      class='fa fa-chevron-right'></i></button>
                </div>
              </div>
            </div>
            </section>
            </div>
            ";
          }
            

          // 學生住宿資料
          echo "
            <div>
              <div class='card m-2'>
                <section class='border p-4'>
                  <div class='m-2 d-flex justify-content-between'>
                    <h5>學生住宿資料</h5>";
                    if($permission == 'system_manager'){
                      echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addLiveInModal'><i
                        class='fa fa-add me-1'></i> 新增</button>";
                    }
          echo   "</div>
                    <div id='datatable-custom' data-mdb-hover='true' class='datatable datatable-hover'>
                      <div class='datatable-inner table-responsive ps' style='overflow: auto; position: relative;'>
                        <table class='table datatable-table'>
                          <thead class='datatable-header'>
                            <tr>
                              <th scope='col'>學年</th>
                              <th scope='col'>學期</th>
                              <th scope='col'>學生帳號</th>
                              <th scope='col'>房號</th>
                              <th scope='col'>登記帳號</th>";
                              if($permission == 'system_manager'){
                                echo "<th scope='col'>操作</th>";
                              }
                        echo "</tr>
                          </thead>
                          <tbody class='datatable-body'>";
                          if($permission == 'student'){
                            $student_account = $_SESSION['account'];
                            $sql = "SELECT * FROM live_in where student_account = '$student_account' ORDER BY academic_year DESC, semester DESC";
                          }else{
                            $sql = 'SELECT * FROM live_in ORDER BY academic_year DESC, semester DESC';
                          }
                            $result = $conn->query($sql);

                            if (mysqli_num_rows($result) > 0) 
                            {
                              while ($userinfo = mysqli_fetch_assoc($result)) 
                              {
                                $semester = $userinfo['semester'];
                                $academic_year = $userinfo['academic_year'];
                                $room_number = $userinfo['room_number'];
                                $student_account	 = $userinfo['student_account'];
                                $system_manager_account = $userinfo['system_manager_account'];
                                $account = $_SESSION['account'];
                                
                                echo "<tr>" .
                                  "<td> " . $academic_year . "</td>".
                                  "<td> " . $semester . "</td>".
                                  "<td> " . $student_account	 . "</td>".
                                  "<td> " . $room_number . "</td>".
                                  "<td> " . $system_manager_account . "</td>";
                                  if($permission == 'system_manager'){
                                    echo "<td>
                                      <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateLiveInModal$semester$academic_year$room_number$student_account'><i class='fa fa-pencil'></i></button>
                                      <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteLiveInModal$semester$academic_year$room_number$student_account'><i class='fa fa-trash'></i></button>
                                    </td>";
                                  }
                                echo "</tr>";

                                // Update Modal
                                echo "
                                <div class='modal fade' id='updateLiveInModal$semester$academic_year$room_number$student_account' tabindex='-1' aria-labelledby='updateLiveInModalLabel' aria-hidden='true'>
                                  <div class='modal-dialog modal-dialog-centered'>
                                  <form method='post' action='./service/live_in_update.php'>
                                  <div class='modal-content'>
                                      <div class='modal-header'>
                                        <h5 class='modal-title' id='updateLiveInModalLabel'>修改學生住宿</h5>
                                        <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                                      </div>
                                      <div class='modal-body'>
                                        <div class='text-center mb-3'>
                                          <div class='form-outline mb-4'>
                                            <input value='$academic_year' readonly required type='text' name='academic_year' id='liveinacademic_year' class='form-control' />
                                            <label class='form-label' for='liveinacademic_year'>學年</label>
                                            <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                          </div>
                                          <div class='form-outline mb-4'>
                                            <input value='$semester' readonly required type='text' name='semester' id='liveinsemester' class='form-control' />
                                            <label class='form-label' for='liveinsemester'>學期</label>
                                            <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                          </div>
                                          
                                          <div class='form-outline mb-4'>
                                            <input value='$student_account' readonly required type='text' name='student_account' id='liveinstudent_account' class='form-control' />
                                            <label class='form-label' for='liveinstudent_account'>學生帳號</label>
                                            <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                          </div>
                                          <div class='form-outline mb-4'>
                                            <input value='$room_number' required type='text' name='room_number' id='liveinroom_number' class='form-control' />
                                            <label class='form-label' for='liveinroom_number'>房號</label>
                                            <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                          </div>
                                          <input value='$account' hidden required name='system_manager_account' />
                                        </div>
                                      </div>
                                      <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                        <button type='submit' class='btn btn-primary'>確認</button>
                                      </div>
                                  </div>
                                  </form>
                                  </div>
                                </div>";

                                // Delete Modal
                                echo "
                                <div class='modal fade' id='deleteLiveInModal$semester$academic_year$room_number$student_account' tabindex='-1' aria-labelledby='deleteLiveInModalLabel' aria-hidden='true'>
                                  <div class='modal-dialog modal-dialog-centered'>
                                    <div class='modal-content'>
                                      <div class='modal-header'>
                                        <h5 class='modal-title' id='deleteLiveInModalLabel'>刪除學生住宿</h5>
                                      </div>
                                      <div class='modal-body'>您確認要刪除學生住宿嗎？</div>
                                      <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                        <button type='button' class='btn btn-primary' onclick='location.href=\"./service/live_in_delete.php?semester=$semester&academic_year=$academic_year&room_number=$room_number&student_account=$student_account\"'>確認</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>";
                              }
                            }
                        echo "</tbody>
                        </table>
                        <div class='ps__rail-x' style='left: 0px; bottom: 0px;'>
                          <div class='ps__thumb-x' tabindex='0' style='left: 0px; width: 0px;'></div>
                        </div>
                        <div class='ps__rail-y' style='top: 0px; right: 0px;'>
                          <div class='ps__thumb-y' tabindex='0' style='top: 0px; height: 0px;'></div>
                        </div>
                      </div>
                      <div class='datatable-pagination d-flex justify-content-end'>
                        <div class='datatable-pagination-buttons'>
                          <button data-mdb-ripple-color='dark'
                            class='btn btn-link datatable-pagination-button datatable-pagination-left'><i
                              class='fa fa-chevron-left'></i></button>
                          <button data-mdb-ripple-color='dark'
                            class='btn btn-link datatable-pagination-button datatable-pagination-right'><i
                              class='fa fa-chevron-right'></i></button>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>";

                echo "<div class='modal fade' id='addLiveInModal' tabindex='-1' aria-labelledby='addLiveInModalLabel'
                  aria-hidden='true'>
                  <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='addLiveInModalLabel'>新增學生住宿</h5>

                      </div>
                      <div class='modal-body'>
                        <form method='post' action='./service/live_in_add.php'>
                          <div class='modal-body'>
                            <div class='text-center mb-3'>
                              <div class='form-outline mb-4'>
                                <input required type='text' name='academic_year' id='liveinacademic_year'
                                  class='form-control' />
                                <label class='form-label' for='liveinacademic_year'>學年</label>
                                <div class='form-notch'>
                                  <div class='form-notch-leading' style='width: 9px;'></div>
                                  <div class='form-notch-middle' style='width: 114.4px;'></div>
                                  <div class='form-notch-trailing'></div>
                                </div>
                              </div>
                              <div class='form-outline mb-4'>
                                <input required type='text' name='semester' id='liveinsemester' class='form-control' />
                                <label class='form-label' for='liveinsemester'>學期</label>
                                <div class='form-notch'>
                                  <div class='form-notch-leading' style='width: 9px;'></div>
                                  <div class='form-notch-middle' style='width: 114.4px;'></div>
                                  <div class='form-notch-trailing'></div>
                                </div>
                              </div>

                              <div class='form-outline mb-4'>
                                <input required type='text' name='student_account' id='liveinstudent_account'
                                  class='form-control' />
                                <label class='form-label' for='liveinstudent_account'>學生帳號</label>
                                <div class='form-notch'>
                                  <div class='form-notch-leading' style='width: 9px;'></div>
                                  <div class='form-notch-middle' style='width: 114.4px;'></div>
                                  <div class='form-notch-trailing'></div>
                                </div>
                              </div>
                              <div class='form-outline mb-4'>
                                <input required type='text' name='room_number' id='liveinroom_number' class='form-control' />
                                <label class='form-label' for='liveinroom_number'>房號</label>
                                <div class='form-notch'>
                                  <div class='form-notch-leading' style='width: 9px;'></div>
                                  <div class='form-notch-middle' style='width: 114.4px;'></div>
                                  <div class='form-notch-trailing'></div>
                                </div>
                              </div>
                              <input value='$account' hidden required name='system_manager_account' />
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
              </div>";
          
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

          $sql= "SELECT * FROM News";
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
            <div class="card-body h-70" style="position: relative; height: 660px; overflow: scroll;">

              <?php
                $sql =  "SELECT * FROM Comment";
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
                          <img src='./image/user.png' alt='avatar' class='rounded-circle' style='width: 45px; height: 100%;'>
                          <div>
                            <p class='small p-2 ms-3 mb-1 rounded-3' style='background-color: #f5f6f7; max-width:950px;'>$content</p>
                            <p class='small ms-3 mb-2 rounded-3 text-muted'>$time[0]:$time[1]</p>
                          </div>
                        </div>
                        ";
                      }
                      else {
                        echo "
                        <div class='d-flex flex-row justify-content-start'>
                          <img src='./image/user.png' alt='avatar' class='rounded-circle' style='width: 45px; height: 100%;'>
                          <div>
                            <p class='small p-2 ms-3 mb-1 rounded-3' style='background-color: #f5f6f7; max-width:950px;'>$content</p>
                            <div class='small mb-2 text-muted d-flex'>
                              <p class='ms-1 rounded-3 text-muted'>$time[0]:$time[1]</p>
                              <p class='ms-1 rounded-3' style='width: fit-content;' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#updateMessageModal$comment_id'>編輯</p>
                              <p class='ms-1 rounded-3' style='width: fit-content;' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#deleteMessageModal$comment_id'>刪除</p>
                            </div>
                          </div>
                        </div>
                        ";
                      }
                  } 
                  else {
                    # 本人可以對自己傳的訊息操作
                    echo "
                      <div class='d-flex flex-row justify-content-end pt-1'>
                        <div>
                          <div class='align-item-end d-flex flex-row-reverse'>
                            <p class='small p-2 me-3 mb-1 text-white rounded-3 bg-primary' style='max-width:950px;'>$content</p>
                          </div>
                          <div class='align-item-end d-flex flex-row-reverse'>
                            <div class='small mb-2 text-muted d-flex'>
                              <p class='me-1  rounded-3  d-flex justify-content-end'>$time[0]:$time[1]</p>
                              <p class='ms-1 rounded-3' style='width: fit-content;' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#updateMessageModal$comment_id'>編輯</p>
                              <p class='ms-1 rounded-3' style='width: fit-content;' data-mdb-ripple-color='light' data-mdb-toggle='modal' data-mdb-target='#deleteMessageModal$comment_id'>刪除</p>
                            </div>
                          </div>
                        </div>

                        <img src='";echo $_SESSION['icon']; echo"'alt='avatar' class='rounded-circle' style='width: 45px; height: 100%;'>
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
                <img src=<?php echo $_SESSION['icon'];?> alt="avatar 3" style="width: 40px; height: 100%; border-radius: 100%;">
                <input name="content" required type="text" class="form-control form-control-lg"
                  id="exampleFormControlInput1" placeholder="Type message">
                <a class="ms-3" onclick="document.getElementById('add_message').submit();"><i
                    class="fas fa-paper-plane"></i></a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Violate Record -->
      <div class="tab-pane fade h-100" id="pills-violate-record" role="tabpanel" aria-labelledby="tab-violate-record">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">違規紀錄資料</h4>
            <?php
              if($_SESSION['permission'] == 'dormitory_supervisor'){
                echo "<button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal'
                  data-mdb-target='#addViolateRecordModal'><i class='fa fa-add me-1'></i> 新增</button>";
              }
            ?>
          </div>
        </div>


        <!-- Table -->
        <div class="card m-2">
          <section class="border p-4">
            <div id="datatable-custom" data-mdb-hover="true" class="datatable datatable-hover">
              <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
                <table class="table datatable-table">
                  <thead class="datatable-header">
                    <tr>
                      <th scope="col">日期</th>
                      <th scope="col">規範內容</th>
                      <th scope="col">學生帳號</th>
                      <th scope="col">扣點</th>
                      <th scope="col">登記帳號</th>
                      <?php
                        if($_SESSION['permission'] == 'dormitory_supervisor'){
                          echo "<th scope='col' style='width:115px;'>操作</th>";
                        }
                      ?>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      if($_SESSION['permission'] == 'student'){
                        $student_account = $_SESSION['account'];
                        $sql = "SELECT * FROM Violate_Record JOIN Rule ON Violate_Record.rule_id = Rule.rule_id where student_account = '$student_account' ";
                      } else{
                        $sql = "SELECT * FROM Violate_Record JOIN Rule ON Violate_Record.rule_id = Rule.rule_id";
                      }
                    
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $date = $userinfo['date'];
                          $rule_id = $userinfo['rule_id'];
                          $content = $userinfo['content'];
                          $student_account = $userinfo['student_account'];
                          $point = $userinfo['point'];
                          $dormitory_supervisor_account = $userinfo['dormitory_supervisor_account'];
                          $account = $_SESSION['account'];
                          $violate_record_id = $userinfo['violate_record_id'];

                          echo "<tr>" .
                            "<td> " . $date . "</td>".
                            "<td> " . $content . "</td>".
                            "<td> " . $student_account . "</td>".
                            "<td> " . $point . "</td>".
                            "<td> " . $dormitory_supervisor_account . "</td>";
                          if($_SESSION['permission'] == 'dormitory_supervisor'){
                            echo "
                            <td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateViolateRecordModal$violate_record_id'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteViolateRecordModal$violate_record_id'><i class='fa fa-trash'></i></button>
                            </td>";
                          }
                          echo "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateViolateRecordModal$violate_record_id' tabindex='-1' aria-labelledby='updateViolateRecordModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                            <form method='post' action='./service/violate_record_update.php'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='updateViolateRecordModalLabel'>修改違規紀錄</h5>
                                  <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                  <div class='text-center mb-3'>
                                    <div class='mb-4'>
                                      <select class='form-select' id='RuleId' name='rule_id' value='$rule_id'>";
                                        $sql = "SELECT * FROM Rule ORDER BY rule_id";
                                        foreach ($conn->query($sql) as $row) { 
                                          if($row['rule_id'] == $rule_id) echo "<option value=$row[rule_id] selected>$row[content]</option>";
                                          else echo "<option value=$row[rule_id]>$row[content]</option>";
                                        }
                                echo "</select>
                                    </div>
                                    <div class='form-outline mb-4'>
                                      <input value='$student_account' required name='student_account' id='studentaccount' class='form-control' />
                                      <label class='form-label' for='studentaccount'>學生帳號</label>
                                      <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                    </div>
                                    <div class='form-outline mb-4'>
                                      <input value='$point' required name='point' id='point' class='form-control' />
                                      <label class='form-label' for='point'>扣點</label>
                                      <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                    </div>
                                    <input value='$account' hidden name='dormitory_supervisor_account'/>
                                    <input value='$violate_record_id'hidden name='violate_record_id'/>
                                  </div>
                                </div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='submit' class='btn btn-primary'>確認</button>
                                </div>
                            </div>
                            </form>
                            </div>
                          </div>";

                          // Delete Modal
                          echo "
                          <div class='modal fade' id='deleteViolateRecordModal$violate_record_id' tabindex='-1' aria-labelledby='deleteViolateRecordModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteViolateRecordModalLabel'>刪除違規紀錄</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除違規紀錄嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/violate_record_delete.php?violate_record_id=$violate_record_id\"'>確認</button>
                                </div>
                              </div>
                            </div>
                          </div>";
                        }
                      }
                    ?>
                  </tbody>
                </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                  <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                  <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
              </div>
              <div class="datatable-pagination d-flex justify-content-end">
                <div class="datatable-pagination-buttons">
                  <button data-mdb-ripple-color="dark"
                    class="btn btn-link datatable-pagination-button datatable-pagination-left"><i
                      class="fa fa-chevron-left"></i></button>
                  <button data-mdb-ripple-color="dark"
                    class="btn btn-link datatable-pagination-button datatable-pagination-right"><i
                      class="fa fa-chevron-right"></i></button>
                </div>
              </div>
            </div>
          </section>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="addViolateRecordModal" tabindex="-1" aria-labelledby="addViolateRecordModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addViolateRecordModalLabel">新增違規紀錄</h5>

              </div>
              <div class="modal-body">
                <form method="post" action="./service/violate_record_add.php">
                  <div class="modal-body">
                    <div class='text-center mb-3'>
                      <div class='mb-4'>
                        <select class="form-select" name=rule_id aria-label="規範ID" required>
                          <option value="">規範ID</option>
                          <?php
                          $sql = "SELECT * FROM Rule ORDER BY rule_id";
                          foreach ($conn->query($sql) as $row) { 
                            echo "<option value=$row[rule_id]>$row[content]</option>";
                          }?>
                        </select>
                      </div>
                      <div class='form-outline mb-4'>
                        <input required name='student_account' id='studentaccount' class='form-control' />
                        <label class='form-label' type='text' for='studentaccount'>學生帳號</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <div class='form-outline mb-4'>
                        <input required name='point' id='point' class='form-control' />
                        <label class='form-label' for='point'>扣點</label>
                        <div class='form-notch'>
                          <div class='form-notch-leading' style='width: 9px;'></div>
                          <div class='form-notch-middle' style='width: 114.4px;'></div>
                          <div class='form-notch-trailing'></div>
                        </div>
                      </div>
                      <input value='<?php echo $account ?>' hidden name='dormitory_supervisor_account' />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">確認</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--all-->
      <div class="tab-pane fade" id="pills-all" role="tabpanel" aria-labelledby="tab-all">
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">宿舍資料</h4>
          </div>
        </div>

        <!-- Dormitory Table -->
        <?php 
        if($_SESSION['permission'] == 'system_manager'){
          echo "
          <div class='card m-2'>
          <section class='border p-4'>
            <h5 class='m-2'>宿舍大樓</h5>
            <div id='datatable-custom' data-mdb-hover='true' class='datatable datatable-hover'>
              <div class='datatable-inner table-responsive ps' style='overflow: auto; position: relative;'>
                <table class='table datatable-table'>
                  <thead class='datatable-header'>
                    <tr>
                      <th scope='col'>名字</th>
                    </tr>
                  </thead>
                  <tbody class='datatable-body'>";
                      $sql = "SELECT * FROM Dormitory";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $name = $userinfo['name'];
                          $dormitory_id = $userinfo['dormitory_id'];
                          
                          echo "
                              <tr>
                                <td> $name </td>
                              </tr>
                            ";
                          
                        }
                      }
                  echo "</tbody>
                </table>
                <div class='ps__rail-x' style='left: 0px; bottom: 0px;'>
                  <div class='ps__thumb-x' tabindex='0' style='left: 0px; width: 0px;'></div>
                </div>
                <div class='ps__rail-y' style='top: 0px; right: 0px;'>
                  <div class='ps__thumb-y' tabindex='0' style='top: 0px; height: 0px;'></div>
                </div>
              </div>
              <div class='datatable-pagination d-flex justify-content-end'>
                <div class='datatable-pagination-buttons'>
                  <button data-mdb-ripple-color='dark'
                    class='btn btn-link datatable-pagination-button datatable-pagination-left'><i
                      class='fa fa-chevron-left'></i></button>
                  <button data-mdb-ripple-color='dark'
                    class='btn btn-link datatable-pagination-button datatable-pagination-right'><i
                      class='fa fa-chevron-right'></i></button>
                </div>
              </div>
            </div>
          </section>
        </div>
          ";

        }
        ?>
        

        <!-- Room Table -->
        <?php 
          if($_SESSION['permission'] == 'system_manager' || $_SESSION['permission'] == 'dormitory_supervisor'){
            echo "<div class='card m-2'>
              <section class='border p-4'>
                <h5 class='m-2'>宿舍房間</h5>
                <div id='datatable-custom' data-mdb-hover='true' class='datatable datatable-hover'>
                  <div class='datatable-inner table-responsive ps' style='overflow: auto; position: relative;'>
                    <table class='table datatable-table'>
                      <thead class='datatable-header'>
                        <tr>
                          <th scope='col'>房號</th>
                          <th scope='col'>住宿人數</th>
                          <th scope='col'>價錢</th>";
                          if($_SESSION['permission'] == 'system_manager'){
                          echo "<th scope='col'>宿舍大樓</th>";
                          }
                        echo "</tr>
                      </thead>
                      <tbody class='datatable-body'>";
                      if($_SESSION['permission'] == 'system_manager'){
                          $sql = "SELECT * FROM Room JOIN Dormitory ON Dormitory.dormitory_id = Room.dormitory_id";
                      } else{
                        $sql2 = "SELECT dormitory_id FROM Dormitory_Supervisor WHERE account = ?";
                        $stmt = $conn->prepare($sql2);
                        $stmt->bind_param("s", $_SESSION['account']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $dormitory_id = mysqli_fetch_row($result)[0];
                        mysqli_stmt_close($stmt);
                        $sql = "SELECT * FROM Room  WHERE dormitory_id = $dormitory_id";
                      }
                          $result = $conn->query($sql);

                          if (mysqli_num_rows($result) > 0) 
                          {
                            while ($userinfo = mysqli_fetch_assoc($result)) 
                            {
                              $room_number = $userinfo['room_number'];
                              $num_of_people = $userinfo['num_of_people'];
                              $fee = $userinfo['fee'];
                              $dormitory_id = $userinfo['dormitory_id'];
                              if($_SESSION['permission'] == 'system_manager'){
                                $dormitory_name = $userinfo['name'];
                              }
                              echo "<tr>" .
                                "<td> " . $room_number . "</td>".
                                "<td> " . $num_of_people . "</td>".
                                "<td> " . $fee . "</td>";
                              if($_SESSION['permission'] == 'system_manager'){
                                echo "<td> " . $dormitory_name . "</td>";
                                }
                              echo  "</tr>";
                            }
                          }
                      echo "</tbody>
                    </table>
                    <div class='ps__rail-x' style='left: 0px; bottom: 0px;'>
                      <div class='ps__thumb-x' tabindex='0' style='left: 0px; width: 0px;'></div>
                    </div>
                    <div class='ps__rail-y' style='top: 0px; right: 0px;'>
                      <div class='ps__thumb-y' tabindex='0' style='top: 0px; height: 0px;'></div>
                    </div>
                  </div>
                  <div class='datatable-pagination d-flex justify-content-end'>
                    <div class='datatable-pagination-buttons'>
                      <button data-mdb-ripple-color='dark'
                        class='btn btn-link datatable-pagination-button datatable-pagination-left'><i
                          class='fa fa-chevron-left'></i></button>
                      <button data-mdb-ripple-color='dark'
                        class='btn btn-link datatable-pagination-button datatable-pagination-right'><i
                          class='fa fa-chevron-right'></i></button>
                    </div>
                  </div>
                </div>
              </section>
            </div>";
          }
        ?>


        <!-- Equipment Table -->
        <div class="card m-2">
          <section class="border p-4">
            <h5 class='m-2'>宿舍設備</h5>
            <div id="datatable-custom" data-mdb-hover="true" class="datatable datatable-hover">
              <div class="datatable-inner table-responsive ps" style="overflow: auto; position: relative;">
                <table class="table datatable-table">
                  <thead class="datatable-header">
                    <tr>
                      <th scope="col">名稱</th>
                      <th scope="col">購買日期</th>
                      <th scope="col">使用年限</th>
                      <th scope="col">設備狀況</th>
                      <?php 
                      if($_SESSION['permission'] == 'system_manager'){
                        echo "<th scope='col'>宿舍大樓</th>";
                      }?>
                      <th scope="col">宿舍房間</th>
                      <?php
                        if($_SESSION['permission'] == 'system_manager'){
                          echo "<th scope='col'>操作</th>";
                        }
                      ?>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                    if($_SESSION['permission'] == 'system_manager'){
                      $sql = "SELECT *, Dormitory.name as 'dormitory_name' FROM Equipment 
                      JOIN Room ON Equipment.room_number = Room.room_number 
                      JOIN Dormitory ON Dormitory.dormitory_id = Room.dormitory_id 
                      ORDER BY Dormitory.dormitory_id, Room.room_number";
                    }else if($_SESSION['permission'] == 'dormitory_supervisor'){
                      $sql2 = "SELECT dormitory_id FROM Dormitory_Supervisor WHERE account = ?";
                      $stmt = $conn->prepare($sql2);
                      $stmt->bind_param("s", $_SESSION['account']);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $dormitory_id = mysqli_fetch_row($result)[0];
                      mysqli_stmt_close($stmt);
                      
                      $sql = "SELECT * FROM Equipment JOIN Room USING(room_number) WHERE dormitory_id =  $dormitory_id";
                    }else{
                      //會有不同年的
                      $sql = "SELECT * FROM Room JOIN live_in USING(room_number) WHERE student_account =  ? ORDER BY academic_year DESC, semester DESC LIMIT 1";
                      $stmt2 = $conn->prepare($sql);
                      $stmt2->bind_param("s", $_SESSION['account']);
                      $stmt2->execute();
                      $result = $stmt2->get_result();
                      $room = mysqli_fetch_row($result)[0];
                      mysqli_stmt_close($stmt2);

                      $sql = "SELECT * FROM Equipment  WHERE room_number =  $room";
                    }
                    $result = $conn->query($sql);

                    if (mysqli_num_rows($result) > 0) 
                    {
                      while ($userinfo = mysqli_fetch_assoc($result)) 
                      {
                        $name = $userinfo['name'];
                        $purchase_date = $userinfo['purchase_date'];
                        $expired_year = $userinfo['expired_year'];
                        $equipment_id = $userinfo['equipment_id'];
                        $state = $userinfo['state'];
                        $room_number = $userinfo['room_number'];
                        if($_SESSION['permission'] == 'system_manager'){
                          $dormitory_name = $userinfo['dormitory_name'];
                        }
                        $account = $_SESSION['account'];
                        
                        echo "<tr>" .
                          "<td> " . $name . "</td>".
                          "<td> " . $purchase_date . "</td>".
                          "<td> " . $expired_year . "</td>".
                          "<td> " . $state . "</td>";
                        if($_SESSION['permission'] == 'system_manager'){
                          echo "<td> " . $dormitory_name . "</td>";
                        }
                        echo "<td> " . $room_number . "</td>";
                        
                        if($_SESSION['permission'] == 'system_manager'){
                          echo "
                          <td>
                            <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateEquipmentModal$equipment_id'><i class='fa fa-pencil'></i></button>
                          </td>";
                        }
                        
                        echo "</tr>";

                        // Update Modal
                        echo "
                        <div class='modal fade' id='updateEquipmentModal$equipment_id' tabindex='-1' aria-labelledby='updateEquipmentModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                        <form method='post' action='./service/equipment_update.php'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='updateEquipmentModalLabel'>修改宿舍設備</h5>
                              <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                              <div class='text-center mb-3'>
                                <div class='form-outline mb-4'>
                                  <input value='$name' readonly required type='text' name='name' id='EquipmentName' class='form-control' />
                                  <label class='form-label' for='EquipmentName'>名稱</label>
                                  <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                </div>
                                <div class='form-outline mb-4'>
                                  <input value='$expired_year' readonly required type='text' name='expired_year' id='Equipmentexpired_year' class='form-control' />
                                  <label class='form-label' for='Equipmentexpired_year'>使用年限</label>
                                  <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                </div>
                                <div class='form-outline mb-4'>
                                  <input value='$state' required type='text' name='state' id='Equipmentstate' class='form-control' />
                                  <label class='form-label' for='Equipmentstate'>設備狀態</label>
                                  <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                </div>
                                <div class='form-outline mb-4'>
                                  <input value='$room_number' readonly required type='text' name='room_number' id='EquipmentNumber' class='form-control' />
                                  <label class='form-label' for='EquipmentNumber'>房號</label>
                                  <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                </div>
                                <input value='$account' hidden name='account' />
                                <input value='$equipment_id' hidden name='equipment_id' />
                              </div>
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                              <button type='submit' class='btn btn-primary'>確認</button>
                            </div>
                        </div>
                        </form>
                        </div>
                        </div>";
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                  <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                  <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
              </div>
              <div class="datatable-pagination d-flex justify-content-end">
                <div class="datatable-pagination-buttons">
                  <button data-mdb-ripple-color="dark" class="btn btn-link datatable-pagination-button datatable-pagination-left"><i class="fa fa-chevron-left"></i></button>
                  <button data-mdb-ripple-color="dark" class="btn btn-link datatable-pagination-button datatable-pagination-right"><i class="fa fa-chevron-right"></i></button>
                </div>
              </div>
            </div>
          </section>
        </div>
        


      </div>
    </div>
  </main>

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
    } else if (location.hash === "#pills-violate-record") {
      const triggerEl = document.querySelector('a[href="#pills-violate-record"]');
      if (triggerEl) {
        let instance = mdb.Tab.getInstance(triggerEl)
        if (!instance) {
          instance = new mdb.Tab(triggerEl);
        }
        instance.show();
      }
    } else if (location.hash === "#pills-all") {
      const triggerEl = document.querySelector('a[href="#pills-all"]');
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


    .c-stepper__item:before {
      --size: 3rem;
      content: "";
      position: relative;
      z-index: 1;
      flex: 0 0 var(--size);
      height: var(--size);
      border-radius: 50%;
      background-color: lightgrey;
    }

    .c-stepper__item {
      position: relative;
      display: flex;
      gap: 1rem;
      padding-bottom: 1rem;
    }

    .c-stepper__item_a:before {
      --size: 3rem;
      content: "";
      position: relative;
      z-index: 1;
      flex: 0 0 var(--size);
      height: var(--size);
      border-radius: 50%;
      background-color: #3B71CA;
    }

    .c-stepper__item_a {
      position: relative;
      display: flex;
      gap: 1rem;
      padding-bottom: 1rem;
    }

    dl,
    ol,
    ul {
      margin-top: 0;
      margin-bottom: 0rem;
      margin-top: 2rem;
      padding-left: 2rem;
      padding-right: 2rem;
    }

    .c-stepper {
      --size: 3rem;
      --spacing: 0.5rem;
    }

    .c-stepper__item:not(:last-child):after {
      top: calc(var(--size) + var(--spacing));
      transform: translateX(calc(var(--size) / 2));
      bottom: var(--spacing);
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      transform: translateX(1.5rem);
      width: 2px;
      background-color: #e0e0e0;
    }

    .c-stepper__item_a:not(:last-child):after {
      top: calc(var(--size) + var(--spacing));
      transform: translateX(calc(var(--size) / 2));
      bottom: var(--spacing);
      content: "";
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      transform: translateX(1.5rem);
      width: 2px;
      background-color: #e0e0e0;
    }
  </style>
</body>

</html>

