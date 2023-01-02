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
  <h1>Back Stage</h1>
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
            <input required name="account" type="text" id="loginAccount" class="form-control" />
            <label class="form-label" for="loginAccount">Account</label>
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

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school_dormitory_db";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";




    $sql = "SELECT * FROM User WHERE account ='root'";

    $result = $conn->query($sql);

    if ($result->num_rows <= 0)
    {
        echo "NO root account , Auto create...";
        $sql = "INSERT INTO User (name, password, email, phone, account, type) VALUES (?, ?, ?, ?, ?, ?)";

        $root = "root";
        $password = password_hash("root" ,PASSWORD_DEFAULT);  
        $email = "X";
        $phone = 0;
        $type = "system_manager";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssiss' ,$root , $password , $email , $phone , $root , $type);
        $stmt->execute();

        $sql = "INSERT INTO System_Manager (account) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s' ,$root);
        $stmt->execute();
    }

?>