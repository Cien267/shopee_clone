<!-- SIDEBAR -->
<?php

    $username = $_SESSION['username'];
    include('ketnoi.php');
    $sql = "SELECT * FROM user WHERE username='$username' ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) != 0){
        $user = mysqli_fetch_array($result);
    }
?>
            <div class="col-sm-3 sidenav" style="width: 20%; padding-top: 35px;">
                <div class="row" style="border-bottom: solid 1px #eddddd; height: 65px;">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"><img src="./images/user/<?php echo $user['avatar'] ?>" alt="" class="avatar-big img-circle"></div>
                    <div class="col-sm-6" style="font-size: 14px; padding-top: 5px;">
                        <div class="row ">
                            <strong><?php echo $_SESSION['username'] ?></strong>
                        </div>
                        <div class="row" style="color: #929292; padding-left: 25px;">
                            <a href="profile.php"><i class="fas fa-pen"></i>Sửa hồ sơ</a>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-2" style="color: #60CFE0;">
                        <div class="row" style="margin-top: 25px;">
                            <i class="fas fa-plus-square left-option" ></i> 
                        </div>
                        
                        <div class="row" style="margin-top: 10px;">
                            <img src="https://cf.shopee.vn/file/f0049e9df4e536bc3e7f140d071e9078" class="left-option">
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <img src="https://cf.shopee.vn/file/f0049e9df4e536bc3e7f140d071e9078" class="left-option">
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <img src="https://cf.shopee.vn/file/84feaa363ce325071c0a66d3c9a88748" class="left-option">
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="row text-left" style="margin-top: 25px;">
                            <span class=""><a href="order-add.php">Thêm đơn hàng</a></span>
                            
                        </div>
                        <div class="row text-left" style="margin-top: 11px;">
                            <span class=""><a href="trangchu.php">Danh sách đơn hàng</a></span>
                        </div>
                        <div class="row text-left" style="margin-top: 11px;">
                            <span class=""><a href="statistic.php">Thống kê đơn hàng</a></span>
                        </div>
                        <div class="row text-left" style="margin-top: 11px;">
                            <span class=""><a href="voucher.php">Kho Voucher</a></span>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- SIDEBAR -->