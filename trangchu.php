<?php 
    session_start();
    header('Content-Type: text/html; charset=UTF-8');
    require "./libs/orders.php";
    $orders = get_all_orders(); 
?>

<?php
   include "head.php"; 
?>

<body>

    <?php if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        include('ketnoi.php');
        $sql = "SELECT * FROM user WHERE username='$username' ";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) != 0){
            $user = mysqli_fetch_array($result);
        }
     ?>
    <?php
       include_once "header.php"; 
    ?>
    

    <div class="container-fluid text-center">
        <div class="row content">
            <?php
               include_once "sidebar.php"; 
            ?>
            <div class="col-sm-9">
                <!-- ORDER STATES -->
                <div class="row state nav nav-tabs" style="font-size: 16px;">
                    <div class="col-sm-2 state-option active"
                        style="height: 100%; padding-top: 15px; border-bottom: 2px solid #60CFE0;"> <a
                            style="color: #60CFE0;" data-toggle="tab" href="#all">Tất cả</a></div>
                    <div class="col-sm-2 state-option" style="height: 100%; padding-top: 15px;"> <a style="color: black"
                            data-toggle="tab" href="#confirming">Chờ xác
                            nhận</a></div>
                    <div class="col-sm-2 state-option" style="height: 100%; padding-top: 15px;"> <a style="color: black"
                            data-toggle="tab" href="#taking">Chờ lấy
                            hàng</a></div>
                    <div class="col-sm-2 state-option" style="height: 100%; padding-top: 15px;"> <a style="color: black"
                            data-toggle="tab" href="#delivering">Đang
                            giao</a></div>
                    <div class="col-sm-2 state-option" style="height: 100%; padding-top: 15px;"> <a style="color: black"
                            data-toggle="tab" href="#delivered">Đã giao</a>
                    </div>
                    <div class="col-sm-2 state-option" style="height: 100%; padding-top: 15px;"> <a style="color: black"
                            data-toggle="tab" href="#canceled">Đã hủy</a>
                    </div>
                </div>
                <!-- END ORDER STATES -->

                <!-- SEARCH -->
                <div class="row search-order">
                    <form action="search.php" method="post">
                        <div class="input-group" style="border: transparent; height: 45px; ">
                            <span class="input-group-btn">
                                
                                <input type="submit" style="border: transparent; height: 100%; background-color: #EAEAEA;"
                                    class="btn btn-default" value="Tìm" name="search-btn">
                            </span>
                            <input style="border: transparent; height: 100%; background-color: #EAEAEA;" type="text"
                                class="form-control" placeholder="Tìm kiếm theo Tên Shop, Trạng thái đơn hàng hoặc Tên Sản Phẩm" name="search">
                        </div>
                    </form>
                </div>
                <!-- END SEARCH -->

                <!-- MAIN CONTENT -->
                
                <div class="tab-content">
                    <!-- all -->

                    <div id="all" class="tab-pane fade in active">
                        <?php foreach($orders as $key => $order){ ?>
                        <div class="row order">
                            <div class="row" style=" height: 62px; padding-top: 20px; ">

                                <div class="col-sm-3">
                                    <strong><?php echo $order['shop_name'] ?></strong>
                                </div>
                                <div class="col-sm-4" style="margin-left: -140px;">
                                    <button class="btn-visit-shop">
                                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0"
                                            class="shopee-svg-icon icon-btn-shop">
                                            <path
                                                d="m15 4.8c-.1-1-.8-2-1.6-2.9-.4-.3-.7-.5-1-.8-.1-.1-.7-.5-.7-.5h-8.5s-1.4 1.4-1.6 1.6c-.4.4-.8 1-1.1 1.4-.1.4-.4.8-.4 1.1-.3 1.4 0 2.3.6 3.3l.3.3v3.5c0 1.5 1.1 2.6 2.6 2.6h8c1.5 0 2.5-1.1 2.5-2.6v-3.7c.1-.1.1-.3.3-.3.4-.8.7-1.7.6-3zm-3 7c0 .4-.1.5-.4.5h-8c-.3 0-.5-.1-.5-.5v-3.1c.3 0 .5-.1.8-.4.1 0 .3-.1.3-.1.4.4 1 .7 1.5.7.7 0 1.2-.1 1.6-.5.5.3 1.1.4 1.6.4.7 0 1.2-.3 1.8-.7.1.1.3.3.5.4.3.1.5.3.8.3zm.5-5.2c0 .1-.4.7-.3.5l-.1.1c-.1 0-.3 0-.4-.1s-.3-.3-.5-.5l-.5-1.1-.5 1.1c-.4.4-.8.7-1.4.7-.5 0-.7 0-1-.5l-.6-1.1-.5 1.1c-.3.5-.6.6-1.1.6-.3 0-.6-.2-.9-.8l-.5-1-.7 1c-.1.3-.3.4-.4.6-.1 0-.3.1-.3.1s-.4-.4-.4-.5c-.4-.5-.5-.9-.4-1.5 0-.1.1-.4.3-.5.3-.5.4-.8.8-1.2.7-.8.8-1 1-1h7s .3.1.8.7c.5.5 1.1 1.2 1.1 1.8-.1.7-.2 1.2-.5 1.5z">
                                            </path>
                                        </svg>
                                        <span style="font-weight: bold; margin-bottom: 5px;">Xem Shop</span>
                                    </button>
                                </div>
                                <div class="col-sm-5">
                                    <div style="margin-right: -355px;">
                                        <span style="color: #60CFE0; font-weight: 500;"><?php echo(mb_convert_case($order['status'], MB_CASE_UPPER, 'UTF-8')); ?></span>
                                    </div>
                                </div>
                                <hr style="margin-top: 45px; width: 920px;">
                            </div>
                            <div class="row" style=" height: 120px;">
                                <a class="show-order-info" style="display: block;"  data-id="<?php echo $order['id']; ?>" data-key="<?php echo $key ?>">
                                    <div style="height: 100%; margin-top: 15px;">
                                        <div class="col-sm-2" style="height: 100%;">
                                            <img src="./images/product/<?php echo $order['product_image'];?>" class="product-image"></img>
                                        </div>
                                        <div class="col-sm-8" style="height: 100%;">
                                            <div class="row text-left">
                                                <span style="font-size: 16px; font-weight: 400;"><?php echo $order['product_name'] ?></span>
                                            </div>
                                           
                                            <div class="row text-left" style="padding-top: 5px;">
                                                <span>x<?php echo $order['product_quantity'] ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-center" style="height: 100%;">
                                            
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px; width: 920px;">
                                </a>

                            </div>
                            <div class="row">
                                <div class="row text-right" style="padding-right: 70px; padding-top: 40px;">
                                    <svg width="16" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.94 1.664s.492 5.81-1.35 9.548c0 0-.786 1.42-1.948 2.322 0 0-1.644 1.256-4.642 2.561V0s2.892 1.813 7.94 1.664zm-15.88 0C5.107 1.813 8 0 8 0v16.095c-2.998-1.305-4.642-2.56-4.642-2.56-1.162-.903-1.947-2.323-1.947-2.323C-.432 7.474.059 1.664.059 1.664z"
                                            fill="url(#paint0_linear)"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.073 6.905s-1.09-.414-.735-1.293c0 0 .255-.633 1.06-.348l4.84 2.55c.374-2.013.286-4.009.286-4.009-3.514.093-5.527-1.21-5.527-1.21s-2.01 1.306-5.521 1.213c0 0-.06 1.352.127 2.955l5.023 2.59s1.09.42.693 1.213c0 0-.285.572-1.09.28L2.928 8.593c.126.502.285.99.488 1.43 0 0 .456.922 1.233 1.56 0 0 1.264 1.126 3.348 1.941 2.087-.813 3.352-1.963 3.352-1.963.785-.66 1.235-1.556 1.235-1.556a6.99 6.99 0 00.252-.632L8.073 6.905z"
                                            fill="#FEFEFE"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="8" y1="0" x2="8" y2="16.095"
                                                gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#F53D2D"></stop>
                                                <stop offset="1" stop-color="#F63"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <span>Tổng số tiền:</span>
                                    <strong style="color: #60CFE0; font-size: 20px;">đ <?php echo $order['cost'] ?></strong>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8" style="padding-right: 50px;">
                                        <div style="margin-top: 10px;">
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition"
                                                    style="background-color: #60CFE0; color: #fff;">Đánh Giá</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition">Liên Hệ Người Bán</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-edit.php?id=<?php echo $order['id'];?>'">Chỉnh Sửa</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-delete.php?id=<?php echo $order['id'];?>'">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- end all -->


                    <!-- confirming -->
                    
                    <div id="confirming" class="tab-pane fade">
                        <?php 
                        $d = 0;
                        foreach($orders as $order){ 
                         if($order["status"] == "chờ xác nhận"){ $d++; ?>
                        <div class="row order">
                            <div class="row" style=" height: 62px; padding-top: 20px; ">

                                <div class="col-sm-3">
                                    <strong><?php echo $order['shop_name'] ?></strong>
                                </div>
                                <div class="col-sm-4" style="margin-left: -140px;">
                                    <button class="btn-visit-shop">
                                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0"
                                            class="shopee-svg-icon icon-btn-shop">
                                            <path
                                                d="m15 4.8c-.1-1-.8-2-1.6-2.9-.4-.3-.7-.5-1-.8-.1-.1-.7-.5-.7-.5h-8.5s-1.4 1.4-1.6 1.6c-.4.4-.8 1-1.1 1.4-.1.4-.4.8-.4 1.1-.3 1.4 0 2.3.6 3.3l.3.3v3.5c0 1.5 1.1 2.6 2.6 2.6h8c1.5 0 2.5-1.1 2.5-2.6v-3.7c.1-.1.1-.3.3-.3.4-.8.7-1.7.6-3zm-3 7c0 .4-.1.5-.4.5h-8c-.3 0-.5-.1-.5-.5v-3.1c.3 0 .5-.1.8-.4.1 0 .3-.1.3-.1.4.4 1 .7 1.5.7.7 0 1.2-.1 1.6-.5.5.3 1.1.4 1.6.4.7 0 1.2-.3 1.8-.7.1.1.3.3.5.4.3.1.5.3.8.3zm.5-5.2c0 .1-.4.7-.3.5l-.1.1c-.1 0-.3 0-.4-.1s-.3-.3-.5-.5l-.5-1.1-.5 1.1c-.4.4-.8.7-1.4.7-.5 0-.7 0-1-.5l-.6-1.1-.5 1.1c-.3.5-.6.6-1.1.6-.3 0-.6-.2-.9-.8l-.5-1-.7 1c-.1.3-.3.4-.4.6-.1 0-.3.1-.3.1s-.4-.4-.4-.5c-.4-.5-.5-.9-.4-1.5 0-.1.1-.4.3-.5.3-.5.4-.8.8-1.2.7-.8.8-1 1-1h7s .3.1.8.7c.5.5 1.1 1.2 1.1 1.8-.1.7-.2 1.2-.5 1.5z">
                                            </path>
                                        </svg>
                                        <span style="font-weight: bold; margin-bottom: 5px;">Xem Shop</span>
                                    </button>
                                </div>
                                <div class="col-sm-5">
                                    <div style="margin-right: -355px;">
                                        <span style="color: #60CFE0; font-weight: 500;"><?php echo(mb_convert_case($order['status'], MB_CASE_UPPER, 'UTF-8')); ?></span>
                                    </div>
                                </div>
                                <hr style="margin-top: 45px; width: 920px;">
                            </div>
                            <div class="row" style=" height: 120px;">
                                <a class="show-order-info" style="display: block;"  data-id="<?php echo $order['id']; ?>" data-key="<?php echo $key ?>">
                                    <div style="height: 100%; margin-top: 15px;">
                                        <div class="col-sm-2" style="height: 100%;">
                                            <img src="./images/product/<?php echo $order['product_image'];?>" class="product-image"></img>
                                        </div>
                                        <div class="col-sm-8" style="height: 100%;">
                                            <div class="row text-left">
                                                <span style="font-size: 16px; font-weight: 400;"><?php echo $order['product_name'] ?></span>
                                            </div>
                                           
                                            <div class="row text-left" style="padding-top: 5px;">
                                                <span>x<?php echo $order['product_quantity'] ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-center" style="height: 100%;">
                                            
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px; width: 920px;">
                                </a>

                            </div>
                            <div class="row">
                                <div class="row text-right" style="padding-right: 70px; padding-top: 40px;">
                                    <svg width="16" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.94 1.664s.492 5.81-1.35 9.548c0 0-.786 1.42-1.948 2.322 0 0-1.644 1.256-4.642 2.561V0s2.892 1.813 7.94 1.664zm-15.88 0C5.107 1.813 8 0 8 0v16.095c-2.998-1.305-4.642-2.56-4.642-2.56-1.162-.903-1.947-2.323-1.947-2.323C-.432 7.474.059 1.664.059 1.664z"
                                            fill="url(#paint0_linear)"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.073 6.905s-1.09-.414-.735-1.293c0 0 .255-.633 1.06-.348l4.84 2.55c.374-2.013.286-4.009.286-4.009-3.514.093-5.527-1.21-5.527-1.21s-2.01 1.306-5.521 1.213c0 0-.06 1.352.127 2.955l5.023 2.59s1.09.42.693 1.213c0 0-.285.572-1.09.28L2.928 8.593c.126.502.285.99.488 1.43 0 0 .456.922 1.233 1.56 0 0 1.264 1.126 3.348 1.941 2.087-.813 3.352-1.963 3.352-1.963.785-.66 1.235-1.556 1.235-1.556a6.99 6.99 0 00.252-.632L8.073 6.905z"
                                            fill="#FEFEFE"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="8" y1="0" x2="8" y2="16.095"
                                                gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#F53D2D"></stop>
                                                <stop offset="1" stop-color="#F63"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <span>Tổng số tiền:</span>
                                    <strong style="color: #60CFE0; font-size: 20px;">đ <?php echo $order['cost'] ?></strong>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8" style="padding-right: 50px;">
                                        <div style="margin-top: 10px;">
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition"
                                                    style="background-color: #60CFE0; color: #fff;">Đánh Giá</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition">Liên Hệ Người Bán</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-edit.php?id=<?php echo $order['id'];?>'">Chỉnh Sửa</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-delete.php?id=<?php echo $order['id'];?>'">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} if($d == 0) { ?>
                            <div class="row order ">

                                <div class="no-order"></div>
                                <div><strong>Chưa có đơn hàng</strong></div>

                            </div>
                        <?php }?>
                    </div>
                    
                    <!-- end confirming -->

                    <!-- taking -->
                    <div id="taking" class="tab-pane fade">
                        <?php 
                        $d = 0;
                        foreach($orders as $order){ 
                         if($order["status"] == "chờ lấy hàng"){ $d++; ?>
                        <div class="row order">
                            <div class="row" style=" height: 62px; padding-top: 20px; ">

                                <div class="col-sm-3">
                                    <strong><?php echo $order['shop_name'] ?></strong>
                                </div>
                                <div class="col-sm-4" style="margin-left: -140px;">
                                    <button class="btn-visit-shop">
                                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0"
                                            class="shopee-svg-icon icon-btn-shop">
                                            <path
                                                d="m15 4.8c-.1-1-.8-2-1.6-2.9-.4-.3-.7-.5-1-.8-.1-.1-.7-.5-.7-.5h-8.5s-1.4 1.4-1.6 1.6c-.4.4-.8 1-1.1 1.4-.1.4-.4.8-.4 1.1-.3 1.4 0 2.3.6 3.3l.3.3v3.5c0 1.5 1.1 2.6 2.6 2.6h8c1.5 0 2.5-1.1 2.5-2.6v-3.7c.1-.1.1-.3.3-.3.4-.8.7-1.7.6-3zm-3 7c0 .4-.1.5-.4.5h-8c-.3 0-.5-.1-.5-.5v-3.1c.3 0 .5-.1.8-.4.1 0 .3-.1.3-.1.4.4 1 .7 1.5.7.7 0 1.2-.1 1.6-.5.5.3 1.1.4 1.6.4.7 0 1.2-.3 1.8-.7.1.1.3.3.5.4.3.1.5.3.8.3zm.5-5.2c0 .1-.4.7-.3.5l-.1.1c-.1 0-.3 0-.4-.1s-.3-.3-.5-.5l-.5-1.1-.5 1.1c-.4.4-.8.7-1.4.7-.5 0-.7 0-1-.5l-.6-1.1-.5 1.1c-.3.5-.6.6-1.1.6-.3 0-.6-.2-.9-.8l-.5-1-.7 1c-.1.3-.3.4-.4.6-.1 0-.3.1-.3.1s-.4-.4-.4-.5c-.4-.5-.5-.9-.4-1.5 0-.1.1-.4.3-.5.3-.5.4-.8.8-1.2.7-.8.8-1 1-1h7s .3.1.8.7c.5.5 1.1 1.2 1.1 1.8-.1.7-.2 1.2-.5 1.5z">
                                            </path>
                                        </svg>
                                        <span style="font-weight: bold; margin-bottom: 5px;">Xem Shop</span>
                                    </button>
                                </div>
                                <div class="col-sm-5">
                                    <div style="margin-right: -355px;">
                                        <span style="color: #60CFE0; font-weight: 500;"><?php echo(mb_convert_case($order['status'], MB_CASE_UPPER, 'UTF-8')); ?></span>
                                    </div>
                                </div>
                                <hr style="margin-top: 45px; width: 920px;">
                            </div>
                            <div class="row" style=" height: 120px;">
                                <a class="show-order-info" style="display: block;"  data-id="<?php echo $order['id']; ?>" data-key="<?php echo $key ?>">
                                    <div style="height: 100%; margin-top: 15px;">
                                        <div class="col-sm-2" style="height: 100%;">
                                            <img src="./images/product/<?php echo $order['product_image'];?>" class="product-image"></img>
                                        </div>
                                        <div class="col-sm-8" style="height: 100%;">
                                            <div class="row text-left">
                                                <span style="font-size: 16px; font-weight: 400;"><?php echo $order['product_name'] ?></span>
                                            </div>
                                           
                                            <div class="row text-left" style="padding-top: 5px;">
                                                <span>x<?php echo $order['product_quantity'] ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-center" style="height: 100%;">
                                            
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px; width: 920px;">
                                </a>

                            </div>
                            <div class="row">
                                <div class="row text-right" style="padding-right: 70px; padding-top: 40px;">
                                    <svg width="16" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.94 1.664s.492 5.81-1.35 9.548c0 0-.786 1.42-1.948 2.322 0 0-1.644 1.256-4.642 2.561V0s2.892 1.813 7.94 1.664zm-15.88 0C5.107 1.813 8 0 8 0v16.095c-2.998-1.305-4.642-2.56-4.642-2.56-1.162-.903-1.947-2.323-1.947-2.323C-.432 7.474.059 1.664.059 1.664z"
                                            fill="url(#paint0_linear)"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.073 6.905s-1.09-.414-.735-1.293c0 0 .255-.633 1.06-.348l4.84 2.55c.374-2.013.286-4.009.286-4.009-3.514.093-5.527-1.21-5.527-1.21s-2.01 1.306-5.521 1.213c0 0-.06 1.352.127 2.955l5.023 2.59s1.09.42.693 1.213c0 0-.285.572-1.09.28L2.928 8.593c.126.502.285.99.488 1.43 0 0 .456.922 1.233 1.56 0 0 1.264 1.126 3.348 1.941 2.087-.813 3.352-1.963 3.352-1.963.785-.66 1.235-1.556 1.235-1.556a6.99 6.99 0 00.252-.632L8.073 6.905z"
                                            fill="#FEFEFE"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="8" y1="0" x2="8" y2="16.095"
                                                gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#F53D2D"></stop>
                                                <stop offset="1" stop-color="#F63"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <span>Tổng số tiền:</span>
                                    <strong style="color: #60CFE0; font-size: 20px;">đ <?php echo $order['cost'] ?></strong>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8" style="padding-right: 50px;">
                                        <div style="margin-top: 10px;">
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition"
                                                    style="background-color: #60CFE0; color: #fff;">Đánh Giá</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition">Liên Hệ Người Bán</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-edit.php?id=<?php echo $order['id'];?>'">Chỉnh Sửa</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-delete.php?id=<?php echo $order['id'];?>'">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} if($d == 0) { ?>
                            <div class="row order ">

                                <div class="no-order"></div>
                                <div><strong>Chưa có đơn hàng</strong></div>

                            </div>
                        <?php }?>
                    </div>
                    <!-- end taking -->
                    <!-- delivering -->
                    <div id="delivering" class="tab-pane fade">
                        <?php 
                        $d = 0;
                        foreach($orders as $order){ 
                         if($order["status"] == "đang giao"){ $d++; ?>
                        <div class="row order">
                            <div class="row" style=" height: 62px; padding-top: 20px; ">

                                <div class="col-sm-3">
                                    <strong><?php echo $order['shop_name'] ?></strong>
                                </div>
                                <div class="col-sm-4" style="margin-left: -140px;">
                                    <button class="btn-visit-shop">
                                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0"
                                            class="shopee-svg-icon icon-btn-shop">
                                            <path
                                                d="m15 4.8c-.1-1-.8-2-1.6-2.9-.4-.3-.7-.5-1-.8-.1-.1-.7-.5-.7-.5h-8.5s-1.4 1.4-1.6 1.6c-.4.4-.8 1-1.1 1.4-.1.4-.4.8-.4 1.1-.3 1.4 0 2.3.6 3.3l.3.3v3.5c0 1.5 1.1 2.6 2.6 2.6h8c1.5 0 2.5-1.1 2.5-2.6v-3.7c.1-.1.1-.3.3-.3.4-.8.7-1.7.6-3zm-3 7c0 .4-.1.5-.4.5h-8c-.3 0-.5-.1-.5-.5v-3.1c.3 0 .5-.1.8-.4.1 0 .3-.1.3-.1.4.4 1 .7 1.5.7.7 0 1.2-.1 1.6-.5.5.3 1.1.4 1.6.4.7 0 1.2-.3 1.8-.7.1.1.3.3.5.4.3.1.5.3.8.3zm.5-5.2c0 .1-.4.7-.3.5l-.1.1c-.1 0-.3 0-.4-.1s-.3-.3-.5-.5l-.5-1.1-.5 1.1c-.4.4-.8.7-1.4.7-.5 0-.7 0-1-.5l-.6-1.1-.5 1.1c-.3.5-.6.6-1.1.6-.3 0-.6-.2-.9-.8l-.5-1-.7 1c-.1.3-.3.4-.4.6-.1 0-.3.1-.3.1s-.4-.4-.4-.5c-.4-.5-.5-.9-.4-1.5 0-.1.1-.4.3-.5.3-.5.4-.8.8-1.2.7-.8.8-1 1-1h7s .3.1.8.7c.5.5 1.1 1.2 1.1 1.8-.1.7-.2 1.2-.5 1.5z">
                                            </path>
                                        </svg>
                                        <span style="font-weight: bold; margin-bottom: 5px;">Xem Shop</span>
                                    </button>
                                </div>
                                <div class="col-sm-5">
                                    <div style="margin-right: -355px;">
                                        <span style="color: #60CFE0; font-weight: 500;"><?php echo(mb_convert_case($order['status'], MB_CASE_UPPER, 'UTF-8')); ?></span>
                                    </div>
                                </div>
                                <hr style="margin-top: 45px; width: 920px;">
                            </div>
                            <div class="row" style=" height: 120px;">
                                <a class="show-order-info" style="display: block;"  data-id="<?php echo $order['id']; ?>" data-key="<?php echo $key ?>">
                                    <div style="height: 100%; margin-top: 15px;">
                                        <div class="col-sm-2" style="height: 100%;">
                                            <img src="./images/product/<?php echo $order['product_image'];?>" class="product-image"></img>
                                        </div>
                                        <div class="col-sm-8" style="height: 100%;">
                                            <div class="row text-left">
                                                <span style="font-size: 16px; font-weight: 400;"><?php echo $order['product_name'] ?></span>
                                            </div>
                                           
                                            <div class="row text-left" style="padding-top: 5px;">
                                                <span>x<?php echo $order['product_quantity'] ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-center" style="height: 100%;">
                                            
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px; width: 920px;">
                                </a>

                            </div>
                            <div class="row">
                                <div class="row text-right" style="padding-right: 70px; padding-top: 40px;">
                                    <svg width="16" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.94 1.664s.492 5.81-1.35 9.548c0 0-.786 1.42-1.948 2.322 0 0-1.644 1.256-4.642 2.561V0s2.892 1.813 7.94 1.664zm-15.88 0C5.107 1.813 8 0 8 0v16.095c-2.998-1.305-4.642-2.56-4.642-2.56-1.162-.903-1.947-2.323-1.947-2.323C-.432 7.474.059 1.664.059 1.664z"
                                            fill="url(#paint0_linear)"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.073 6.905s-1.09-.414-.735-1.293c0 0 .255-.633 1.06-.348l4.84 2.55c.374-2.013.286-4.009.286-4.009-3.514.093-5.527-1.21-5.527-1.21s-2.01 1.306-5.521 1.213c0 0-.06 1.352.127 2.955l5.023 2.59s1.09.42.693 1.213c0 0-.285.572-1.09.28L2.928 8.593c.126.502.285.99.488 1.43 0 0 .456.922 1.233 1.56 0 0 1.264 1.126 3.348 1.941 2.087-.813 3.352-1.963 3.352-1.963.785-.66 1.235-1.556 1.235-1.556a6.99 6.99 0 00.252-.632L8.073 6.905z"
                                            fill="#FEFEFE"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="8" y1="0" x2="8" y2="16.095"
                                                gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#F53D2D"></stop>
                                                <stop offset="1" stop-color="#F63"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <span>Tổng số tiền:</span>
                                    <strong style="color: #60CFE0; font-size: 20px;">đ <?php echo $order['cost'] ?></strong>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8" style="padding-right: 50px;">
                                        <div style="margin-top: 10px;">
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition"
                                                    style="background-color: #60CFE0; color: #fff;">Đánh Giá</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition">Liên Hệ Người Bán</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-edit.php?id=<?php echo $order['id'];?>'">Chỉnh Sửa</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-delete.php?id=<?php echo $order['id'];?>'">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} if($d == 0) { ?>
                            <div class="row order ">

                                <div class="no-order"></div>
                                <div><strong>Chưa có đơn hàng</strong></div>

                            </div>
                        <?php }?>
                    </div>
                    <!-- end delivering -->
                    <!-- delivered -->
                    <div id="delivered" class="tab-pane fade">
                        <?php 
                        $d = 0;
                        foreach($orders as $order){ 
                         if($order["status"] == "đã giao"){ $d++;?>
                        <div class="row order">
                            <div class="row" style=" height: 62px; padding-top: 20px; ">

                                <div class="col-sm-3">
                                    <strong><?php echo $order['shop_name'] ?></strong>
                                </div>
                                <div class="col-sm-4" style="margin-left: -140px;">
                                    <button class="btn-visit-shop">
                                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0"
                                            class="shopee-svg-icon icon-btn-shop">
                                            <path
                                                d="m15 4.8c-.1-1-.8-2-1.6-2.9-.4-.3-.7-.5-1-.8-.1-.1-.7-.5-.7-.5h-8.5s-1.4 1.4-1.6 1.6c-.4.4-.8 1-1.1 1.4-.1.4-.4.8-.4 1.1-.3 1.4 0 2.3.6 3.3l.3.3v3.5c0 1.5 1.1 2.6 2.6 2.6h8c1.5 0 2.5-1.1 2.5-2.6v-3.7c.1-.1.1-.3.3-.3.4-.8.7-1.7.6-3zm-3 7c0 .4-.1.5-.4.5h-8c-.3 0-.5-.1-.5-.5v-3.1c.3 0 .5-.1.8-.4.1 0 .3-.1.3-.1.4.4 1 .7 1.5.7.7 0 1.2-.1 1.6-.5.5.3 1.1.4 1.6.4.7 0 1.2-.3 1.8-.7.1.1.3.3.5.4.3.1.5.3.8.3zm.5-5.2c0 .1-.4.7-.3.5l-.1.1c-.1 0-.3 0-.4-.1s-.3-.3-.5-.5l-.5-1.1-.5 1.1c-.4.4-.8.7-1.4.7-.5 0-.7 0-1-.5l-.6-1.1-.5 1.1c-.3.5-.6.6-1.1.6-.3 0-.6-.2-.9-.8l-.5-1-.7 1c-.1.3-.3.4-.4.6-.1 0-.3.1-.3.1s-.4-.4-.4-.5c-.4-.5-.5-.9-.4-1.5 0-.1.1-.4.3-.5.3-.5.4-.8.8-1.2.7-.8.8-1 1-1h7s .3.1.8.7c.5.5 1.1 1.2 1.1 1.8-.1.7-.2 1.2-.5 1.5z">
                                            </path>
                                        </svg>
                                        <span style="font-weight: bold; margin-bottom: 5px;">Xem Shop</span>
                                    </button>
                                </div>
                                <div class="col-sm-5">
                                    <div style="margin-right: -355px;">
                                        <span style="color: #60CFE0; font-weight: 500;"><?php echo(mb_convert_case($order['status'], MB_CASE_UPPER, 'UTF-8')); ?></span>
                                    </div>
                                </div>
                                <hr style="margin-top: 45px; width: 920px;">
                            </div>
                            <div class="row" style=" height: 120px;">
                                <a class="show-order-info" style="display: block;"  data-id="<?php echo $order['id']; ?>" data-key="<?php echo $key ?>">
                                    <div style="height: 100%; margin-top: 15px;">
                                        <div class="col-sm-2" style="height: 100%;">
                                            <img src="./images/product/<?php echo $order['product_image'];?>" class="product-image"></img>
                                        </div>
                                        <div class="col-sm-8" style="height: 100%;">
                                            <div class="row text-left">
                                                <span style="font-size: 16px; font-weight: 400;"><?php echo $order['product_name'] ?></span>
                                            </div>
                                           
                                            <div class="row text-left" style="padding-top: 5px;">
                                                <span>x<?php echo $order['product_quantity'] ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-center" style="height: 100%;">
                                            
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px; width: 920px;">
                                </a>

                            </div>
                            <div class="row">
                                <div class="row text-right" style="padding-right: 70px; padding-top: 40px;">
                                    <svg width="16" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.94 1.664s.492 5.81-1.35 9.548c0 0-.786 1.42-1.948 2.322 0 0-1.644 1.256-4.642 2.561V0s2.892 1.813 7.94 1.664zm-15.88 0C5.107 1.813 8 0 8 0v16.095c-2.998-1.305-4.642-2.56-4.642-2.56-1.162-.903-1.947-2.323-1.947-2.323C-.432 7.474.059 1.664.059 1.664z"
                                            fill="url(#paint0_linear)"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.073 6.905s-1.09-.414-.735-1.293c0 0 .255-.633 1.06-.348l4.84 2.55c.374-2.013.286-4.009.286-4.009-3.514.093-5.527-1.21-5.527-1.21s-2.01 1.306-5.521 1.213c0 0-.06 1.352.127 2.955l5.023 2.59s1.09.42.693 1.213c0 0-.285.572-1.09.28L2.928 8.593c.126.502.285.99.488 1.43 0 0 .456.922 1.233 1.56 0 0 1.264 1.126 3.348 1.941 2.087-.813 3.352-1.963 3.352-1.963.785-.66 1.235-1.556 1.235-1.556a6.99 6.99 0 00.252-.632L8.073 6.905z"
                                            fill="#FEFEFE"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="8" y1="0" x2="8" y2="16.095"
                                                gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#F53D2D"></stop>
                                                <stop offset="1" stop-color="#F63"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <span>Tổng số tiền:</span>
                                    <strong style="color: #60CFE0; font-size: 20px;">đ <?php echo $order['cost'] ?></strong>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8" style="padding-right: 50px;">
                                        <div style="margin-top: 10px;">
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition"
                                                    style="background-color: #60CFE0; color: #fff;">Đánh Giá</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition">Liên Hệ Người Bán</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-edit.php?id=<?php echo $order['id'];?>'">Chỉnh Sửa</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-delete.php?id=<?php echo $order['id'];?>'">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} if($d == 0) { ?>
                            <div class="row order ">

                                <div class="no-order"></div>
                                <div><strong>Chưa có đơn hàng</strong></div>

                            </div>
                        <?php }?>
                        
                    </div>
                    <!-- end delivered -->
                    <!-- canceled -->
                    <div id="canceled" class="tab-pane fade">
                        <?php 
                       $d = 0;
                        foreach($orders as $order){ 
                         if($order["status"] == "đã hủy"){ $d++;?>
                        <div class="row order">
                            <div class="row" style=" height: 62px; padding-top: 20px; ">

                                <div class="col-sm-3">
                                    <strong><?php echo $order['shop_name'] ?></strong>
                                </div>
                                <div class="col-sm-4" style="margin-left: -140px;">
                                    <button class="btn-visit-shop">
                                        <svg enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0"
                                            class="shopee-svg-icon icon-btn-shop">
                                            <path
                                                d="m15 4.8c-.1-1-.8-2-1.6-2.9-.4-.3-.7-.5-1-.8-.1-.1-.7-.5-.7-.5h-8.5s-1.4 1.4-1.6 1.6c-.4.4-.8 1-1.1 1.4-.1.4-.4.8-.4 1.1-.3 1.4 0 2.3.6 3.3l.3.3v3.5c0 1.5 1.1 2.6 2.6 2.6h8c1.5 0 2.5-1.1 2.5-2.6v-3.7c.1-.1.1-.3.3-.3.4-.8.7-1.7.6-3zm-3 7c0 .4-.1.5-.4.5h-8c-.3 0-.5-.1-.5-.5v-3.1c.3 0 .5-.1.8-.4.1 0 .3-.1.3-.1.4.4 1 .7 1.5.7.7 0 1.2-.1 1.6-.5.5.3 1.1.4 1.6.4.7 0 1.2-.3 1.8-.7.1.1.3.3.5.4.3.1.5.3.8.3zm.5-5.2c0 .1-.4.7-.3.5l-.1.1c-.1 0-.3 0-.4-.1s-.3-.3-.5-.5l-.5-1.1-.5 1.1c-.4.4-.8.7-1.4.7-.5 0-.7 0-1-.5l-.6-1.1-.5 1.1c-.3.5-.6.6-1.1.6-.3 0-.6-.2-.9-.8l-.5-1-.7 1c-.1.3-.3.4-.4.6-.1 0-.3.1-.3.1s-.4-.4-.4-.5c-.4-.5-.5-.9-.4-1.5 0-.1.1-.4.3-.5.3-.5.4-.8.8-1.2.7-.8.8-1 1-1h7s .3.1.8.7c.5.5 1.1 1.2 1.1 1.8-.1.7-.2 1.2-.5 1.5z">
                                            </path>
                                        </svg>
                                        <span style="font-weight: bold; margin-bottom: 5px;">Xem Shop</span>
                                    </button>
                                </div>
                                <div class="col-sm-5">
                                    <div style="margin-right: -355px;">
                                        <span style="color: #60CFE0; font-weight: 500;"><?php echo(mb_convert_case($order['status'], MB_CASE_UPPER, 'UTF-8')); ?></span>
                                    </div>
                                </div>
                                <hr style="margin-top: 45px; width: 920px;">
                            </div>
                            <div class="row" style=" height: 120px;">
                                <a class="show-order-info" style="display: block;"  data-id="<?php echo $order['id']; ?>" data-key="<?php echo $key ?>">
                                    <div style="height: 100%; margin-top: 15px;">
                                        <div class="col-sm-2" style="height: 100%;">
                                            <img src="./images/product/<?php echo $order['product_image'];?>" class="product-image"></img>
                                        </div>
                                        <div class="col-sm-8" style="height: 100%;">
                                            <div class="row text-left">
                                                <span style="font-size: 16px; font-weight: 400;"><?php echo $order['product_name'] ?></span>
                                            </div>
                                           
                                            <div class="row text-left" style="padding-top: 5px;">
                                                <span>x<?php echo $order['product_quantity'] ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-center" style="height: 100%;">
                                            
                                        </div>
                                    </div>
                                    <hr style="margin-top: 0px; width: 920px;">
                                </a>

                            </div>
                            <div class="row">
                                <div class="row text-right" style="padding-right: 70px; padding-top: 40px;">
                                    <svg width="16" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.94 1.664s.492 5.81-1.35 9.548c0 0-.786 1.42-1.948 2.322 0 0-1.644 1.256-4.642 2.561V0s2.892 1.813 7.94 1.664zm-15.88 0C5.107 1.813 8 0 8 0v16.095c-2.998-1.305-4.642-2.56-4.642-2.56-1.162-.903-1.947-2.323-1.947-2.323C-.432 7.474.059 1.664.059 1.664z"
                                            fill="url(#paint0_linear)"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.073 6.905s-1.09-.414-.735-1.293c0 0 .255-.633 1.06-.348l4.84 2.55c.374-2.013.286-4.009.286-4.009-3.514.093-5.527-1.21-5.527-1.21s-2.01 1.306-5.521 1.213c0 0-.06 1.352.127 2.955l5.023 2.59s1.09.42.693 1.213c0 0-.285.572-1.09.28L2.928 8.593c.126.502.285.99.488 1.43 0 0 .456.922 1.233 1.56 0 0 1.264 1.126 3.348 1.941 2.087-.813 3.352-1.963 3.352-1.963.785-.66 1.235-1.556 1.235-1.556a6.99 6.99 0 00.252-.632L8.073 6.905z"
                                            fill="#FEFEFE"></path>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="8" y1="0" x2="8" y2="16.095"
                                                gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#F53D2D"></stop>
                                                <stop offset="1" stop-color="#F63"></stop>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    <span>Tổng số tiền:</span>
                                    <strong style="color: #60CFE0; font-size: 20px;">đ <?php echo $order['cost'] ?></strong>
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8" style="padding-right: 50px;">
                                        <div style="margin-top: 10px;">
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition"
                                                    style="background-color: #60CFE0; color: #fff;">Đánh Giá</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition">Liên Hệ Người Bán</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-edit.php?id=<?php echo $order['id'];?>'">Chỉnh Sửa</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-addition" onclick="window.location = 'order-delete.php?id=<?php echo $order['id'];?>'">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} if($d == 0) { ?>
                            <div class="row order ">

                                <div class="no-order"></div>
                                <div><strong>Chưa có đơn hàng</strong></div>

                            </div>
                        <?php }?>
                            
                    </div>
                    <!-- end canceled -->
                </div>
                
                <!-- END MAIN CONTENT -->

            </div>

        </div>
    </div>

                                    <!-- ==========MODAL========== -->

    <!-- THÔNG TIN ĐƠN HÀNG -->
    <!-- Modal -->
    <div id="order-info" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thông tin đơn hàng</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="height: 50px;">
                        <div class="col-sm-10 text-right ">
                            <span>Trạng thái đơn hàng:</span>
                            <span style="color: #60CFE0; text-transform:uppercase;" class="status-info"> </span>
                        </div>
                    </div>

                    
                    <div class="custom-line"></div>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3 text-left">
                            <div class="row">
                                <strong style="font-size: 20px;">Địa Chỉ Nhận Hàng</strong>
                            </div>
                            <div class="row" style="padding-top: 10px;">
                                <strong class="customer-name-info"><?php echo $user['username']; ?></strong>
                            </div>
                            <div class="row" style="color: #BBBBBB; padding-top: 5px;">
                                <?php echo $user['phone_number']; ?>
                            </div>
                            <div class="row" style="color: #BBBBBB; padding-top: 5px;">
                                <?php echo $user['address']; ?>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="col-sm-8 text-right">
                                <div class="row date-info" style="padding-top: 5px">

                                </div>
                            </div>
                            <div class="col-sm-4 text-left" style="color: #BBBBBB ;">
                                <div class="row" style="padding-top: 5px">
                                    : Đặt hàng thành công
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- ========= -->
                    <div class="row" style=" height: 62px; padding-top: 20px; margin-top: 50px;">

                        <div class="col-sm-3">
                            
                            <strong class="shop-name-info"></strong>
                        </div>
                        <div class="col-sm-4" style="margin-left: -140px;">

                        </div>
                        <div class="col-sm-5">
                            <div style="margin-right: -355px;">
                                <span style="color: #60CFE0; text-transform:uppercase;" class="status-info"> </span>
                            </div>
                        </div>
                        <hr style="margin-top: 45px; width: 920px;">
                    </div>

                    <div class="row" style=" height: 120px; ">
                        <a class="show-order-info" style="display: block;"  data-id="<?php echo $order['id']; ?>" data-key="<?php echo $key ?>">
                            <div style="height: 100%; margin-top: 15px;">
                                <div class="col-sm-2" style="height: 100%;">
                                    <img src="" class="product-image product-image-info"></img>
                                </div>
                                <div class="col-sm-8" style="height: 100%;">
                                    <div class="row text-left">
                                        <span style="font-size: 16px; font-weight: 400;" class="product-name-info"></span>
                                    </div>
                                    <div class="row text-left" style="padding-top: 5px;">
                                        
                                    </div>
                                    <div class="row text-left" style="padding-top: 5px;">
                                        <span class="product-quantity-info"></span>
                                    </div>
                                </div>
                                <div class="col-sm-2 text-center" style="height: 100%;">
                                    <span style="margin-top: 45px; display: inline-block;" class="cost-info"></span>
                                </div>
                            </div>
                            <hr style="margin-top: 0px; width: 920px;">
                        </a>
                    </div>
                    <!-- ================================ -->
                    <div class="row" style="padding-bottom: 30px;">
                        <div class="col-sm-7 text-right" style="color: #BBBBBB; ">
                           
                            <div class="row" style="padding-top: 10px;">Phí vận chuyển</div>
                            
                        
                            <div class="row" style="padding-top: 10px;">Tổng số tiền</div>
                            <div class="row" style="padding-top: 10px;">Phương thức thanh toán</div>
                        </div>
                        <div class="col-sm-4 text-right">
                            
                            <div class="row" style="padding-top: 10px;">đ15.000</div>
                            
                            <div class="row cost-info" style="padding-top: 10px;"></div>
                            <div class="row" style="padding-top: 10px;">Tài khoản ngân hàng 
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
        <!-- end modal content -->
    </div>
    </div>
    <!-- end modal -->
    <!-- KẾT THÚC THÔNG TIN ĐƠN HÀNG -->


                          <!-- ==========END MODAL========== -->


    <!-- FOOTER -->
    <footer class="container-fluid text-center ">
        <div class="row" style=" height: 350px;">
            <div class="col-sm-1"></div>
            <div class="col-sm-2 text-left">
                <div class="row"><strong>CHĂM SÓC KHÁCH HÀNG</strong></div>
                <div class="row" style="padding-top: 15px; font-size:12px;">Trung Tâm Trợ giúp</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Shopee Blog</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Shopee Mall</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Hướng Dẫn Mua Hàng</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Hướng Dẫn Bán Hàng</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Thanh Toán</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Shopee Xu</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Vận Chuyển</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Trả Hàng & Hoàn Tiền</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Chăm Sóc Khách Hàng</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Chính Sách Bảo Hành</div>
            </div>
            <div class="col-sm-2 text-left">
                <div class="row"><strong>VỀ SHOPEE</strong></div>
                <div class="row" style="padding-top: 15px; font-size:12px;">Giới Thiệu Về Shopee Việt Nam</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Tuyển Dụng</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Điều Khoản Shopee</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Chính Sách Bảo Mật</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Chính Hãng</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Kênh Người Bán</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Flash Sales</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Chương Trình Tiếp Thị Liên Kết Shopee</div>
                <div class="row" style="padding-top: 7px; font-size:12px;">Liên Hệ Với Truyền Thông</div>

            </div>
            <div class="col-sm-2 text-left">
                <div class="row"><strong>THANH TOÁN</strong></div>
                <div class="row" style="height: 78px;"></div>
                <div class="row"><strong>ĐƠN VỊ VẬN CHUYỂN</strong></div>
            </div>
            <div class="col-sm-2 text-left">
                <div class="row"><strong>THEO DÕI CHÚNG TÔI TRÊN</strong></div>
                <div class="row" style="padding-top: 15px; font-size:12px;"><i class="fab fa-facebook"></i> Facebook
                </div>
                <div class="row" style="padding-top: 7px; font-size:12px;"><i class="fab fa-instagram"></i> Instagram
                </div>
                <div class="row" style="padding-top: 7px; font-size:12px;"><i class="fab fa-linkedin"></i> Linkedin
                </div>
            </div>
            <div class="col-sm-2 text-left">
                <div class="row"><strong>TẢI ỨNG DỤNG SHOPEE NGAY THÔI</strong></div>
                <div class="row" style="padding-top: 15px;">
                    <div class="col-sm-6">
                        <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/d91264e165ed6facc6178994d5afae79.png"
                            alt="download_qr_code" class="_1GU-58" style="width:90px; height: 90px;">
                    </div>
                    <div class="col-sm-6">
                        <div class="tnOn1x"><img class="_2OIm6O"
                                src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/39f189e19764dab688d3850742f13718.png"
                                alt="App Store" style="width: 90px; height: auto;"><img class="_2OIm6O"
                                src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/f4f5426ce757aea491dce94201560583.png"
                                alt="Play Store" style="width: 90px; height: auto;"><img class="_2OIm6O"
                                src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/1ae215920a31f2fc75b00d4ee9ae8551.png"
                                alt="App Gallery" style="width: 90px; height: auto;"></div>
                    </div>
                </div>

            </div>
            <div class="col-sm-1"></div>

        </div>
    </footer>
    <!-- END FOOTER -->

<?php }else {?>
    <div>
        <h1>Bạn chưa đăng nhập!</h1>
        <h2>Click vào <a href="login.php">đây</a> để đăng nhập</h2>
    </div>
    <?php } ?>
</body>

</html>