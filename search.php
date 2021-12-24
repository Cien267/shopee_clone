<?php
	session_start();
	include_once "head.php"; 
   include_once "header.php"; 

	if(isset($_POST['search-btn'])){
		include('ketnoi.php');
		$keyword = isset($_POST['search']) ? $_POST['search'] : '';
		$error = '';

		$sql = "SELECT * FROM orders WHERE shop_name LIKE '%$keyword%' OR status LIKE '%$keyword%' OR product_name LIKE '%$keyword%' ";

        $result = mysqli_query($conn, $sql);
        $orders = [];
        if($result){

        	while($row = mysqli_fetch_assoc($result)){
	            $orders[] = $row;
	        }
        	
        }else {
        	$error = "Không tìm thấy đơn hàng";
        }
	}else {
		echo 'nothin';
	}
?>

<body>
   <div class="container-fluid text-center">
        <div class="row content">
            <?php
               include_once "sidebar.php"; 
            ?>
            <div class="col-sm-9">
            	<h2>Kết quả tìm kiếm:</h2>
                        <?php
                         foreach($orders as $order){ ?>
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
                                <a class="show-order-info" style="display: block;"  data-id="<?php echo $order['id']; ?>" >
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
                                                <button class="btn btn-addition" onclick="window.location = 'order-delete.php?id=<?php echo $order['id'];?>'">Hủy Đơn</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    
            </div>
        </div>
   </div>
</body>
</html>