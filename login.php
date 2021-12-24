<?php
    session_start();
    header('Content-Type: text/html; charset=UTF-8');

    if(isset($_POST['dangnhap'])){
        include('ketnoi.php');

        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['password']);

        if (!$email || !$password) {
            echo '<script type="text/javascript">alert("Nhập đủ thông tin!")</script>';

        }else {
            $password = md5($password);

            $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) == 0){
                echo '<script type="text/javascript">alert("Tài khoản không tồn tại!")</script>';
             
            }else {
                $row = mysqli_fetch_array($result);
                $_SESSION['username'] = $row['username'];
                header("Location: trangchu.php");
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
        <section class="form login">
            <header>Đăng Nhập</header>
            <form action="login.php" method="post">
                <div class="error-tx">
                    
                </div>
                
                <div class="field input">
                        <label for="">Email</label>
                        <input type="text" name="email" placeholder="email"> 
                </div>
                <div class="field input">
                        <label for="">Mật Khẩu</label>
                        <input type="password" name="password" placeholder="password"> 
                        
                </div>
                
                <div class="field button">
                        <input type="submit" name="dangnhap" value="Đăng Nhập">
                </div>
                
            </form>
            <div class="link">
                Chưa có tài khoản? 
                <a href="register.php">Đăng Ký</a>
            </div>
        </section>
    </div>
    </div>
</body>
</html>