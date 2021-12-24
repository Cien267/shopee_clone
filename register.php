<?php
    session_start();
    header('Content-Type: text/html; charset=UTF-8');

    if(isset($_POST['dangky'])){
        include('ketnoi.php');

        $username   = addslashes($_POST['username']);
        $password   = addslashes($_POST['password']);
        $email      = addslashes($_POST['email']);
         
        $password = md5($password);

        $sql1 = "SELECT * FROM user WHERE username='$username' OR email='$email'";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1) > 0){
            echo '<script type="text/javascript">alert("Tài khoản đã tồn tại!")</script>';    
        }else {
            $sql2 = " INSERT INTO user (username,email,password) VALUES ('$username','$email','$password')";
            $result2 = mysqli_query($conn, $sql2);
            if($result2){
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Đăng ký thành công!')
                window.location.href='login.php';
                </SCRIPT>");

            }else {
                echo '<script type="text/javascript">alert("Có lỗi xảy ra!")</script>';
            }
        }
        
    }
    
?>

<?php
   include_once "head.php"; 
?>
<body>
    <div class="bodyy">
        <div class="wrapper">
        <section class="form signup">
            <header>Đăng Ký</header>
            <form action="register.php" method="post">
                <div class="error-txt"></div>
              
                    <div class="field input">
                        <label for="">Username</label>
                        <input type="text" name="username" placeholder="username" required> 
                    </div>
               
                <div class="field input">
                        <label for="">Email</label>
                        <input type="text" name="email" placeholder="email" required> 
                </div>
                <div class="field input">
                        <label for="">Mật Khẩu</label>
                        <input type="password" name="password" placeholder="password" required> 
                       
                </div>
                <div class="field button">
                        <input type="submit" name="dangky" value="Đăng Ký">
                </div>
                
            </form>
            <div class="link">
                Đã có tài khoản? 
                <a href="login.php">Đăng Nhập</a>
            </div>
        </section>
    </div>
    </div>
</body>
</html>