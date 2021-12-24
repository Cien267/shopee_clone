<?php
   session_start();
   header('Content-Type: text/html; charset=UTF-8');

   include_once "head.php"; 
   include_once "header.php"; 

   $sort = isset($_GET['sort']) ? $_GET['sort'] : "";
   

      include('ketnoi.php');

      switch ($sort) {
         case 'cost':
            $sql = "SELECT * FROM orders ORDER BY cost DESC";
            $result = mysqli_query($conn, $sql);
            $orders = [];

             if($result){
                 while($row = mysqli_fetch_assoc($result)){
                     $orders[] = $row;
                 }
             }
            break;
         case 'time':
            $sql = "SELECT * FROM orders ORDER BY order_date DESC";
            $result = mysqli_query($conn, $sql); 
            $orders = [];

             if($result){
                 while($row = mysqli_fetch_assoc($result)){
                     $orders[] = $row;
                 }
             }        
            break;
         default :
            $sql = "SELECT * FROM orders ";
            $result = mysqli_query($conn, $sql); 
            $orders = [];

             if($result){
                 while($row = mysqli_fetch_assoc($result)){
                     $orders[] = $row;
                 }
             }        
            break;
      }


   
   
    
?>

<script>
   $(function () {
      $('select[name="sort"]').change(function () {
        var sort = $(this).val();
        window.location.href = "statistic.php" + "?sort=" + sort;
      })
   })
</script>
<body>
   <div class="container-fluid text-center">
        <div class="row content">
            <?php
               include_once "sidebar.php"; 
            ?>
            <div class="col-sm-9">
               <div class="form-group">
                 <label for="statistic"><h2>Sắp xếp theo:</h2></label>
                 <select class="form-control" id="statistic" name="sort">
                  <option value=""></option>
                   <option value="cost">Giá trị đơn hàng</option>
                   <option value="time">Thời gian đặt hàng</option>
                 </select>
               </div>
               <div>
               <?php
                         foreach($orders as $order){ ?>
                        <div class="row order">
                            
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
                                          <span style="color: #0b6b7a">Thời gian đặt hàng: </span>
                                            <?php echo $order['order_date'] ?>
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
   </div>
</body>
</html>