<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css"
    rel="stylesheet"
    />
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
    ></script>
    <title>Document</title>
</head>
<body>
  <section class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div style="width: 26rem;" class="bg-white border rounded-5 p-4">
    <!--navs -->
    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
      <li class="nav-item" role="presentation">
        <a
          class="nav-link active"
          id="tab-login"
          data-mdb-toggle="pill"
          href="#pills-login"
          role="tab"
          aria-controls="pills-login"
          aria-selected="true"
          >Login</a>
      </li>
      <li class="nav-item" role="presentation">
        <a
          class="nav-link"
          id="tab-register"
          data-mdb-toggle="pill"
          href="#pills-register"
          role="tab"
          aria-controls="pills-register"
          aria-selected="false"
          >Register</a>
      </li>
    </ul>
    <!-- content -->

  

    <div class="tab-content">
      <!-- login -->
      <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <form action="./service/login.php" method="post">
          <div class="form-outline mb-4">
            <input required name="account" type="text" id="loginName" class="form-control" />
            <label class="form-label" for="loginName">Account</label>
            <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
          </div>
    
          <div class="form-outline mb-4">
            <input required name="password" type="password" id="loginPassword" class="form-control" />
            <label class="form-label" for="loginPassword">Password</label>
            <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
          </div>

          <button type="submit" value="Login" class="btn btn-primary btn-block mb-4">Sign in</button>
        </form>
      </div>

      <!-- register -->
      <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
      <form method="post" action="./service/register.php">
        <div class="text-center mb-3">

        <div class="form-outline mb-4">
          <input required type="text" name="account" id="registerAccount" class="form-control" />
          <label class="form-label" for="registerAccount">Account</label>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
        </div>
        <div class="form-outline mb-4">
          <input required type="password" name="password" id="registerPassword" class="form-control" />
          <label class="form-label" for="registerPassword">Password</label>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
        </div>
        <div class="form-outline mb-4">
          <input required type="text" name="name" id="registerName" class="form-control" />
          <label class="form-label" for="registerName">Name</label>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
        </div>
        <div class="form-outline mb-4">
          <input required type="email" name="email" id="registerEmail" class="form-control" />
          <label class="form-label" for="registerEmail">Email</label>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
        </div>
        <div class="form-outline mb-4">
          <input required type="tel" name="phone" id="registerPhone" class="form-control" />
          <label class="form-label" for="registerPhone">Phone</label>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
        </div>

        <div class="form-outline mb-4">
          <input required type="number" name="academic_year" id="registerAcademicYear" class="form-control" />
          <label class="form-label" for="registerAcademicYear">Academic Year</label>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
        </div>
        <div class="form-outline mb-4">
          <input required type="number" name="major_year" id="registerMajorYear" class="form-control" />
          <label class="form-label" for="registerMajorYear">Major Year</label>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
        </div>
        <div class="form-outline mb-4">
          <input required type="text" name="student_id" id="registerStudentNo" class="form-control" />
          <label class="form-label" for="registerStudentNo">Student No</label>
          <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 114.4px;"></div><div class="form-notch-trailing"></div></div>
        </div>

        <div class="form-check form-check-inline mb-4">
          <input name="gender" value="male" class="form-check-input" type="radio" id="male"/>
          <label class="form-check-label" for="male">男</label>
        </div>
        <div class="form-check form-check-inline mb-4">
          <input name="gender" value="female" class="form-check-input" type="radio" id="female"/>
          <label class="form-check-label" for="female">女</label>
        </div>

        <button type="submit" value="Login" class="btn btn-primary btn-block mb-3">Sign up</button>
      </form>
    </div>
  </div>
  <!-- Pills content -->
</div>
    </section>
</body>
</html>

<?php

session_start();

if (isset($_SESSION["permission"]) && $_SESSION["permission"] == "Error"){
	echo "Account or Password Wrong";
}

?>