<?php
//create session
session_start();
if ($_SERVER['REQUEST_METHOD']=='POST') {  
//connection with db
$conn = false;
$file='../connection.php';
if(file_exists($file)) {include($file);}
if ($conn) {  
//check the fields
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$res = $conn->prepare('SELECT * FROM workers WHERE email = ? 
AND password = ?');
$res->execute(array($email, $password));
$row=$res->fetch();
if (!$row) {
// incorrect login
$content='<script>alert("Invalid login")</script>';
}
else {
//create session based on variables from user
$adminid = $row['id'];
$_SESSION['adminid']=$adminid;
$email = $row['email'];
$_SESSION['email']=$email;
//redirect to the admin menu
header("location:adminmenu.php");
}
}
else {  
$content = '<script>alert("Can not connect to DataBase.")</script>';
}
}
else { 
$content='';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="iso-8859-1" />
    <title>Login
    </title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>

<body>
    <div id="login-con">
        <div class="login-box">
            <h1>TravelersAdmin
            </h1>
            <h2>Login
            </h2>
            <?php echo $content; ?>
            <div>
                <!--- Login form--->
                <form method="post">
                    <p>
                        <label>User
                        </label>
                        <input type="text" name="email" size="20" class="log-input" style=" background-color: black;" />
                    </p>
                    <p>
                        <label>Password
                        </label>
                        <input type="password" name="password" size="20" class="log-input" style=" background-color: black;" />
                    </p>
                    <div class="log-foot">
                        <div class="log-btn">
                            <span>
                            </span>
                            <span>
                            </span>
                            <span>
                            </span>
                            <span>
                            </span>
                            <input type="submit" value="Log in" id="log" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
