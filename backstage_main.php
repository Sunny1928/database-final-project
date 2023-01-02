<?php
	session_start();
	if (!isset($_SESSION["permission"]) || $_SESSION['permission']!="system_manager" || $_SESSION["account"] != "root"){
					
		Header("Location: ./login.php" , 301);
		die();
	}		
?>

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
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-student" data-mdb-toggle="pill"
            href="#pills-student" role="tab" aria-controls="pills-student" aria-selected="false">
            <i class="fas fa-envelope pe-3"></i>學生
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-system-manager"
            data-mdb-toggle="pill" href="#pills-system-manager" role="tab" aria-controls="pills-system-manager"
            aria-selected="false">
            <i class="fas fa-paper-plane pe-3"></i>系統管理員
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-dormitory-supervisor"
            data-mdb-toggle="pill" href="#pills-dormitory-supervisor" role="tab"
            aria-controls="pills-dormitory-supervisor" aria-selected="false">
            <i class="fas fa-paper-plane pe-3"></i>舍監
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-dormitory" data-mdb-toggle="pill"
            href="#pills-dormitory" role="tab" aria-controls="pills-dormitory" aria-selected="false">
            <i class="fas fa-paper-plane pe-3"></i>宿舍
          </a>
          <a class="list-group-item list-group-item-action py-2 ripple pb-2" id="tab-rule" data-mdb-toggle="pill"
            href="#pills-rule" role="tab" aria-controls="pills-rule" aria-selected="false">
            <i class="fas fa-paper-plane pe-3"></i>規範
          </a>
          <a href="#" class="list-group-item list-group-item-action py-2 ripple pb-2 pt-2">
            <i class="fas fa-user-astronaut pe-3"></i>Log out
          </a>
        </div>
    </nav>
    <!-- Sidebar -->
  </header>
  <main>
    <div class="tab-content h-100">
      <!--dashboard-->
      <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel" aria-labelledby="tab-dashboard">

      </div>

      <!--student-->
      <div class="tab-pane fade" id="pills-student" role="tabpanel" aria-labelledby="tab-student">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">學生資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal' data-mdb-target='#addStudentModal'><i
                class='fa fa-add me-1'></i> 新增</button>
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
                      <th scope="col">帳號</th>
                      <th scope="col">姓名</th>
                      <th scope="col">學號</th>
                      <th scope="col">學年</th>
                      <th scope="col">系級</th>
                      <th scope="col">性別</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                  require_once('./service/connect_db.php');
                  $conn = connect_db();
                      
                  $sql = "SELECT * FROM Student JOIN User ON Student.account = User.account";
                  $result = $conn->query($sql);
            
                  if (mysqli_num_rows($result) > 0) 
                  {
                    while ($userinfo = mysqli_fetch_assoc($result)) 
                    {
                      $student_id = $userinfo['student_id'];
                                                                      
                      echo "<tr data-mdb-index='0'>" .
                        "<td> ". $userinfo['account'] ."</td> ".
                        "<td> " . $userinfo['name'] . "</td>".
                        "<td> " . $student_id . "</td>".
                        "<td> " . $userinfo['academic_year'] . "</td>".
                        "<td> " . $userinfo['major_year'] . "</td>".
                        "<td> " . $userinfo['gender'] . "</td>".
                        "<td>
                          <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateStudentModal$student_id'><i class='fa fa-pencil'></i></button>
                          <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteStudentModal$student_id'><i class='fa fa-trash'></i></button>
                        </td>".
                        "</tr>";

                      // Update Modal
                      echo "
                        <div class='modal fade' id='updateStudentModal$student_id' tabindex='-1' aria-labelledby='updateStudentModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateStudentModalLabel'>修改學生</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>...</div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                <button type='button' class='btn btn-primary'>確認</button>
                              </div>
                            </div>
                          </div>
                        </div>";

                      // Delete Modal
                      echo "
                      <div class='modal fade' id='deleteStudentModal$student_id' tabindex='-1' aria-labelledby='deleteStudentModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='deleteStudentModalLabel'>刪除學生</h5>
                              <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>您確認要刪除學生嗎？</div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                              <button type='button' class='btn btn-primary'>確認</button>
                            </div>
                          </div>
                        </div>
                      </div>";
                    }
                  }?>
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
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <form method="post" action="./service/register.php">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title" id="addStudentModalLabel">新增學生</h5>
                </div>

                <div class="modal-body">
                  <div class="text-center mb-3">
                    <div class="form-outline mb-4">
                      <input required type="text" name="account" id="registerAccount" class="form-control" />
                      <label class="form-label" for="registerAccount">帳號</label>
                      <div class="form-notch">
                        <div class="form-notch-leading" style="width: 9px;"></div>
                        <div class="form-notch-middle" style="width: 114.4px;"></div>
                        <div class="form-notch-trailing"></div>
                      </div>
                    </div>
                    <div class="form-outline mb-4">
                      <input required type="text" name="name" id="registerName" class="form-control" />
                      <label class="form-label" for="registerName">姓名</label>
                      <div class="form-notch">
                        <div class="form-notch-leading" style="width: 9px;"></div>
                        <div class="form-notch-middle" style="width: 114.4px;"></div>
                        <div class="form-notch-trailing"></div>
                      </div>
                    </div>
                    <div class="form-outline mb-4">
                      <input required type="number" name="academic_year" id="registerAcademicYear"
                        class="form-control" />
                      <label class="form-label" for="registerAcademicYear">學年</label>
                      <div class="form-notch">
                        <div class="form-notch-leading" style="width: 9px;"></div>
                        <div class="form-notch-middle" style="width: 114.4px;"></div>
                        <div class="form-notch-trailing"></div>
                      </div>
                    </div>
                    <div class="form-outline mb-4">
                      <input required type="number" name="major_year" id="registerMajorYear" class="form-control" />
                      <label class="form-label" for="registerMajorYear">系級</label>
                      <div class="form-notch">
                        <div class="form-notch-leading" style="width: 9px;"></div>
                        <div class="form-notch-middle" style="width: 114.4px;"></div>
                        <div class="form-notch-trailing"></div>
                      </div>
                    </div>
                    <div class="form-outline mb-4">
                      <input required type="text" name="student_id" id="registerStudentNo" class="form-control" />
                      <label class="form-label" for="registerStudentNo">學號</label>
                      <div class="form-notch">
                        <div class="form-notch-leading" style="width: 9px;"></div>
                        <div class="form-notch-middle" style="width: 114.4px;"></div>
                        <div class="form-notch-trailing"></div>
                      </div>
                    </div>

                    <div class="form-check form-check-inline mb-4">
                      <input name="gender" value="male" class="form-check-input" type="radio" id="male" />
                      <label class="form-check-label" for="male">男</label>
                    </div>
                    <div class="form-check form-check-inline mb-4">
                      <input name="gender" value="female" class="form-check-input" type="radio" id="female" />
                      <label class="form-check-label" for="female">女</label>
                    </div>

                    <button type="submit" value="Login" class="btn btn-primary btn-block mb-3">Sign up</button>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">取消</button>
                  <button type="button" class="btn btn-primary">確認</button>
                </div>

              </div>
          </div>
          </form>
        </div>
      </div>



      <!-- System Manager -->
      <div class="tab-pane fade h-100" id="pills-system-manager" role="tabpanel" aria-labelledby="tab-system-manager">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">系統管理員資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal'
              data-mdb-target='#addSystemManagerModal'><i class='fa fa-add me-1'></i> 新增</button>
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
                      <th scope="col">帳號</th>
                      <th scope="col">名字</th>
                      <th scope="col">Email</th>
                      <th scope="col">電話</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM System_Manager JOIN User ON User.account = System_Manager.account";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $account = $userinfo['account'];
                          $name = $userinfo['name'];
                          $email = $userinfo['email'];
                          $phone = $userinfo['phone'];
                          
                          echo "<tr>" .
                            "<td> ". $account ."</td> ".
                            "<td> " . $name . "</td>".
                            "<td> " . $email . "</td>".
                            "<td> " . $phone . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateSystemManagerModal$account'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteSystemManagerModal$account'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateSystemManagerModal$account' tabindex='-1' aria-labelledby='updateSystemManagerModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                            <form method='post' action='./service/system_manager_update.php'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateSystemManagerModalLabel'>修改系統管理員</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$account' readonly type='text' name='account' id='systemManagerAccount' class='form-control' />
                                    <label class='form-label' for='systemManagerAccount'>帳號</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$name' required type='text' name='name' id='systemManagerName' class='form-control' />
                                    <label class='form-label' for='systemManagerName'>姓名</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$email' required type='text' name='email' id='systemManagerEmail' class='form-control' />
                                    <label class='form-label' for='systemManagerEmail'>Email</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$phone' required type='tel' name='phone' id='systemManagerPhone' class='form-control' />
                                    <label class='form-label' for='systemManagerPhone'>電話</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
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

                          // Delete System Manager Modal
                          echo "
                          <div class='modal fade' id='deleteSystemManagerModal$account' tabindex='-1' aria-labelledby='deleteSystemManagerModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteSystemManagerModalLabel'>刪除系統管理員</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除系統管理員嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/system_manager_delete.php?account=$account\"'>確認</button>
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
        <div class="modal fade" id="addSystemManagerModal" tabindex="-1" aria-labelledby="addSystemManagerModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addSystemManagerModalLabel">新增系統管理員</h5>

              </div>
              <div class="modal-body">
                <form method="post" action="./service/system_manager_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class="form-outline mb-4">
                        <input required type="text" name="account" id="systemManagerAccount" class="form-control" />
                        <label class="form-label" for="systemManagerAccount">帳號</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="password" id="systemManagerPassword" class="form-control" />
                        <label class="form-label" for="systemManagerPassword">密碼</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="name" id="systemManagerName" class="form-control" />
                        <label class="form-label" for="systemManagerName">姓名</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="email" id="systemManagerEmail" class="form-control" />
                        <label class="form-label" for="systemManagerEmail">Email</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="tel" name="phone" id="systemManagerPhone" class="form-control" />
                        <label class="form-label" for="systemManagerPhone">電話</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
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


      <!-- Domitory Supervisor -->
      <div class="tab-pane fade h-100" id="pills-dormitory-supervisor" role="tabpanel"
        aria-labelledby="tab-dormitory-supervisor">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">舍監資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal'
              data-mdb-target='#addDomitorySupervisorModal'><i class='fa fa-add me-1'></i> 新增</button>
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
                      <th scope="col">帳號</th>
                      <th scope="col">名字</th>
                      <th scope="col">Email</th>
                      <th scope="col">電話</th>
                      <th scope="col">宿舍ID</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM Dormitory_Supervisor JOIN User ON User.account = Dormitory_Supervisor.account";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $account = $userinfo['account'];
                          $name = $userinfo['name'];
                          $email = $userinfo['email'];
                          $phone = $userinfo['phone'];
                          $dormitory_id = $userinfo['dormitory_id'];
                          
                          echo "<tr>" .
                            "<td> ". $account ."</td> ".
                            "<td> " . $name . "</td>".
                            "<td> " . $email . "</td>".
                            "<td> " . $phone . "</td>".
                            "<td> " . $dormitory_id . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateDomitorySupervisorModal$account'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteDomitorySupervisorModal$account'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateDomitorySupervisorModal$account' tabindex='-1' aria-labelledby='updateDomitorySupervisorModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered'>
                          <form method='post' action='./service/dormitory_supervisor_update.php'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateDomitorySupervisorModalLabel'>修改舍監</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$account' readonly type='text' name='account' id='DomitorySupervisorAccount' class='form-control' />
                                    <label class='form-label' for='DomitorySupervisorAccount'>帳號</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$name' required type='text' name='name' id='DomitorySupervisorName' class='form-control' />
                                    <label class='form-label' for='DomitorySupervisorName'>姓名</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$email' required type='text' name='email' id='DomitorySupervisorEmail' class='form-control' />
                                    <label class='form-label' for='DomitorySupervisorEmail'>Email</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$phone' required type='tel' name='phone' id='DomitorySupervisorPhone' class='form-control' />
                                    <label class='form-label' for='DomitorySupervisorPhone'>電話</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$dormitory_id' required type='tel' name='dormitory_id' id='DomitorySupervisorDormitoryId' class='form-control' />
                                    <label class='form-label' for='DomitorySupervisorDormitoryId'>宿舍ID</label>
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

                          // Delete System Manager Modal
                          echo "
                          <div class='modal fade' id='deleteDomitorySupervisorModal$account' tabindex='-1' aria-labelledby='deleteDomitorySupervisorModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteDomitorySupervisorModalLabel'>刪除舍監</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除舍監嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/dormitory_supervisor_delete.php?account=$account\"'>確認</button>
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
        <div class="modal fade" id="addDomitorySupervisorModal" tabindex="-1"
          aria-labelledby="addDomitorySupervisorModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addDomitorySupervisorModalLabel">新增舍監</h5>

              </div>
              <div class="modal-body">
                <form method="post" action="./service/dormitory_supervisor_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class="form-outline mb-4">
                        <input required type="text" name="account" id="DomitorySupervisorAccount"
                          class="form-control" />
                        <label class="form-label" for="DomitorySupervisorAccount">帳號</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="password" id="DomitorySupervisorPassword"
                          class="form-control" />
                        <label class="form-label" for="DomitorySupervisorPassword">密碼</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="name" id="DomitorySupervisorName" class="form-control" />
                        <label class="form-label" for="DomitorySupervisorName">姓名</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="text" name="email" id="DomitorySupervisorEmail" class="form-control" />
                        <label class="form-label" for="DomitorySupervisorEmail">Email</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="tel" name="phone" id="DomitorySupervisorPhone" class="form-control" />
                        <label class="form-label" for="DomitorySupervisorPhone">電話</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
                      <div class="form-outline mb-4">
                        <input required type="tel" name="dormitory_id" id="DomitorySupervisorDormitoryId"
                          class="form-control" />
                        <label class="form-label" for="DomitorySupervisorDormitoryId">宿舍ID</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
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


      <!-- Domitory -->
      <div class="tab-pane fade h-100" id="pills-dormitory" role="tabpanel" aria-labelledby="tab-dormitory">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">宿舍資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal'
              data-mdb-target='#addDomitoryModal'><i class='fa fa-add me-1'></i> 新增</button>
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
                      <th scope="col">名字</th>
                      <th scope="col">宿舍ID</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM Dormitory";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $name = $userinfo['name'];
                          $dormitory_id = $userinfo['dormitory_id'];
                          
                          echo "<tr>" .
                            "<td> " . $name . "</td>".
                            "<td> " . $dormitory_id . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateDomitoryModal$dormitory_id'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteDomitoryModal$dormitory_id'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateDomitoryModal$dormitory_id' tabindex='-1' aria-labelledby='updateDomitoryModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered'>
                          <form method='post' action='./service/dormitory_update.php'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateDomitoryModalLabel'>修改宿舍</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$name' required type='text' name='name' id='DomitoryName' class='form-control' />
                                    <label class='form-label' for='DomitoryName'>姓名</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$dormitory_id' readonly name='dormitory_id' id='DomitoryId' class='form-control' />
                                    <label class='form-label' for='DomitoryId'>姓名</label>
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

                          // Delete System Manager Modal
                          echo "
                          <div class='modal fade' id='deleteDomitoryModal$dormitory_id' tabindex='-1' aria-labelledby='deleteDomitoryModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteDomitoryModalLabel'>刪除宿舍</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除宿舍嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/dormitory_delete.php?dormitory_id=$dormitory_id\"'>確認</button>
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
        <div class="modal fade" id="addDomitoryModal" tabindex="-1"
          aria-labelledby="addDomitoryModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addRuleModalLabel">新增宿舍</h5>

              </div>
              <div class="modal-body">
                <form method="post" action="./service/dormitory_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class="form-outline mb-4">
                        <input required type="text" name="name" id="dormitoryName" class="form-control" />
                        <label class="form-label" for="dormitoryName">名稱</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
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

      <!-- Rule -->
      <div class="tab-pane fade h-100" id="pills-rule" role="tabpanel" aria-labelledby="tab-rule">

        <!--Title-->
        <div class="card m-2 px-4 py-3">
          <div class="d-flex justify-content-between">
            <h4 class="mb-0">規範資料</h4>
            <button class='btn ms-2 btn-primary btn-sm' data-mdb-toggle='modal'
              data-mdb-target='#addRuleModal'><i class='fa fa-add me-1'></i> 新增</button>
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
                      <th scope="col">內容</th>
                      <th scope="col">規範ID</th>
                      <th scope="col">操作</th>
                    </tr>
                  </thead>
                  <tbody class="datatable-body">
                    <?php
                      $sql = "SELECT * FROM rule";
                      $result = $conn->query($sql);

                      if (mysqli_num_rows($result) > 0) 
                      {
                        while ($userinfo = mysqli_fetch_assoc($result)) 
                        {
                          $content = $userinfo['content'];
                          $rule_id = $userinfo['rule_id'];
                          
                          echo "<tr>" .
                            "<td> " . $content . "</td>".
                            "<td> " . $rule_id . "</td>".
                            "<td>
                              <button class='call-btn btn btn-outline-primary btn-floating btn-sm ripple-surface' data-mdb-toggle='modal' data-mdb-target='#updateRuleModal$rule_id'><i class='fa fa-pencil'></i></button>
                              <button class='message-btn btn ms-2 btn-primary btn-floating btn-sm' data-mdb-toggle='modal' data-mdb-target='#deleteRuleModal$rule_id'><i class='fa fa-trash'></i></button>
                            </td>".
                            "</tr>";

                          // Update Modal
                          echo "
                          <div class='modal fade' id='updateRuleModal$rule_id' tabindex='-1' aria-labelledby='updateRuleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered'>
                          <form method='post' action='./service/rule_update.php'>
                          <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='updateRuleModalLabel'>修改規範</h5>
                                <button type='button' class='btn-close' data-mdb-dismiss='modal' aria-label='Close'></button>
                              </div>
                              <div class='modal-body'>
                                <div class='text-center mb-3'>
                                  <div class='form-outline mb-4'>
                                    <input value='$content' required type='text' name='content' id='RuleContent' class='form-control' />
                                    <label class='form-label' for='RuleContent'>內容</label>
                                    <div class='form-notch'><div class='form-notch-leading' style='width: 9px;'></div><div class='form-notch-middle' style='width: 114.4px;'></div><div class='form-notch-trailing'></div></div>
                                  </div>
                                  <div class='form-outline mb-4'>
                                    <input value='$rule_id' readonly name='rule_id' id='RuleId' class='form-control' />
                                    <label class='form-label' for='RuleId'>內容</label>
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

                          // Delete System Manager Modal
                          echo "
                          <div class='modal fade' id='deleteRuleModal$rule_id' tabindex='-1' aria-labelledby='deleteRuleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='deleteRuleModalLabel'>刪除規範</h5>
                                </div>
                                <div class='modal-body'>您確認要刪除規範嗎？</div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-mdb-dismiss='modal'>取消</button>
                                  <button type='button' class='btn btn-primary' onclick='location.href=\"./service/rule_delete.php?rule_id=$rule_id\"'>確認</button>
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
        <div class="modal fade" id="addRuleModal" tabindex="-1"
          aria-labelledby="addRuleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addRuleModalLabel">新增規範</h5>

              </div>
              <div class="modal-body">
                <form method="post" action="./service/rule_add.php">
                  <div class="modal-body">
                    <div class="text-center mb-3">
                      <div class="form-outline mb-4">
                        <input required type="text" name="content" id="ruleContent" class="form-control" />
                        <label class="form-label" for="ruleContent">內容</label>
                        <div class="form-notch">
                          <div class="form-notch-leading" style="width: 9px;"></div>
                          <div class="form-notch-middle" style="width: 114.4px;"></div>
                          <div class="form-notch-trailing"></div>
                        </div>
                      </div>
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

    </div>

  </main>
</body>

</html>


<script>
  document.querySelectorAll('.form-outline').forEach((formOutline) => {
    new mdb.Input(formOutline).init();
  });

  if (location.hash === "#pills-student") {
    const triggerEl = document.querySelector('a[href="#pills-student"]');
    if (triggerEl) {
      let instance = mdb.Tab.getInstance(triggerEl)
      if (!instance) {
        instance = new mdb.Tab(triggerEl);
      }
      instance.show();
    }
  } else if (location.hash === "#pills-system-manager") {
    const triggerEl = document.querySelector('a[href="#pills-system-manager"]');
    if (triggerEl) {
      let instance = mdb.Tab.getInstance(triggerEl)
      if (!instance) {
        instance = new mdb.Tab(triggerEl);
      }
      instance.show();
    }
  } else if (location.hash === "#pills-dormitory-supervisor") {
    const triggerEl = document.querySelector('a[href="#pills-dormitory-supervisor"]');
    if (triggerEl) {
      let instance = mdb.Tab.getInstance(triggerEl)
      if (!instance) {
        instance = new mdb.Tab(triggerEl);
      }
      instance.show();
    }
  } else if (location.hash === "#pills-dormitory") {
    const triggerEl = document.querySelector('a[href="#pills-dormitory"]');
    if (triggerEl) {
      let instance = mdb.Tab.getInstance(triggerEl)
      if (!instance) {
        instance = new mdb.Tab(triggerEl);
      }
      instance.show();
    }
  } else if (location.hash === "#pills-rule") {
    const triggerEl = document.querySelector('a[href="#pills-rule"]');
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
  html,
  body,
  .intro {
    height: 100%;
  }

  table td,
  table th {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
  }

  .card {
    border-radius: .5rem;
  }

  .mask-custom {
    background: rgba(24, 24, 16, .2);
    border-radius: 2em;
    backdrop-filter: blur(25px);
    border: 2px solid rgba(255, 255, 255, 0.05);
    background-clip: padding-box;
    box-shadow: 10px 10px 10px rgba(46, 54, 68, 0.03);
  }

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
<script>

</script>