<!-- HEADER -->
<?php
  
    $username = $_SESSION['username'];
    include('ketnoi.php');
    $sql = "SELECT * FROM user WHERE username='$username' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) != 0){
        $user = mysqli_fetch_array($result);
    }
?>
    <nav class="navbar" style="background: linear-gradient(to right, #1d87b9 0%, #61d0e0 100%);">
        

        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href=""><i class="fas fa-store" style="font-size: 30px; "></i></a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="trangchu.php">Home</a></li>
              <li><a href="#">Mua Sắm</a></li>
              <li><a href="contact.php">Liên Hệ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><img src="./images/user/<?php echo $user['avatar'] ?>" alt="" class="avatar img-circle">
                                <?php echo $_SESSION['username']?></a></li>
              <li><a href="logout.php"></span>Đăng xuất</a></li>
            </ul>
        </div>
        <div class="container" style="margin-top: -30px;">
            <div class="row">
                        <div class="row text-center" style="color: white; font-weight: bold; margin-top: -10px;">   
                            <h1 style=" font-weight: bold; font-family: Estonia;">ECOMM - mua sắm ngay!</h1>         
                        </div>
                    </div>
        </div>
    </nav>
    <!-- END HEADER -->