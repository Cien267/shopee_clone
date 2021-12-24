<?php
   session_start();
   header('Content-Type: text/html; charset=UTF-8');

   include_once "head.php"; 
   include_once "header.php";
   include('ketnoi.php'); 

   require "./libs/orders.php";

   if(isset($_POST['add'])){

        $shop_name   = isset($_POST['shop_name']) ? $_POST['shop_name'] : "";
        $product_name   = isset($_POST['product_name']) ? $_POST['product_name'] : "";
        $product_quantity      = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : "";
        $cost   = isset($_POST['cost']) ? $_POST['cost'] : "";
        $status   = isset($_POST['status']) ? $_POST['status'] : "";
        $voucher_code = isset($_POST['voucher_code']) ? $_POST['voucher_code'] : "";

        if($voucher_code) {
            include('ketnoi.php');
            $sql = "SELECT * FROM voucher WHERE voucher_code = '$voucher_code'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $discount = mysqli_fetch_assoc($result)['discount'];
            }
            $cost = $cost*(100-$discount)/100;
        }
        

        $target_dir = "images/product/";
        
        $img_name = $_FILES['product_image']['name'];
        
        
        $time = time();
        $new_img_name = $time. "_".$img_name;
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_dir.$new_img_name);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order_date = date('d/m/Y H:i:s');

        $result = add_order($shop_name, $product_name, $new_img_name, $product_quantity, $cost, $status, $order_date);
         if($result){
             echo ("<SCRIPT LANGUAGE='JavaScript'>
             window.alert('Thêm thành công!')
             window.location.href='order-add.php';
             </SCRIPT>");

         }else {
             echo '<script type="text/javascript">alert("Có lỗi xảy ra!")</script>';
         }
     
        
    } 
?>

<body>
   <div class="container-fluid text-center">
        <div class="row content">
            <?php
               include_once "sidebar.php"; 
            ?>
            <div class="col-sm-9">
               <form class="form-horizontal" style="padding-top: 40px"
               action="order-add.php" method="post" enctype="multipart/form-data">
                  <fieldset>

                  <!-- Form Name -->
                  <legend>THÊM ĐƠN HÀNG</legend>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="shop_name">Tên cửa hàng</label>  
                    <div class="col-md-4">
                    <input id="shop_name" name="shop_name" placeholder="tên cửa hàng" class="form-control input-md" required="" type="text">
                      
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="product_name">Tên sản phẩm</label>  
                    <div class="col-md-4">
                    <input id="product_name" name="product_name" placeholder="tên sản phẩm" class="form-control input-md" required="" type="text">
                      
                    </div>
                  </div>

                  <!-- File --> 
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="product_image">Ảnh sản phẩm</label>
                    <div class="col-md-4">
                      <input id="product_image" name="product_image" class="input-file" type="file" accept="image/png, image/gif, image/jpeg">
                    </div>
                  </div>

                  <!-- Num input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="product_quantity">Số lượng sản phẩm</label>  
                    <div class="col-md-4">
                    <input id="product_quantity" name="product_quantity" placeholder="số lượng sản phẩm" class="form-control input-md" required="" type="number">  
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="cost">Tổng số tiền</label>  
                    <div class="col-md-4">
                    <input id="cost" name="cost" placeholder="tổng số tiền" class="form-control input-md" required="" type="text">
                      
                    </div>
                  </div>

                  <!-- Select  -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="status">Trạng thái đơn hàng</label>
                    <div class="col-md-4">
                      <select id="status" name="status" class="form-control">
                        <option value=""></option>
                        <option value="đã hủy">Đã hủy</option>
                        <option value="đã giao">Đã giao</option>
                        <option value="đang giao">Đang giao</option>
                        <option value="chờ lấy hàng">Chờ lấy hàng</option>
                        <option value="chờ xác nhận">Chờ xác nhận</option>
                      </select>
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="voucher_code">Mã giảm giá</label>  
                    <div class="col-md-4">
                    <input id="voucher_code" name="voucher_code" placeholder="mã giảm giá" class="form-control input-md"  type="text">
                      
                    </div>
                  </div>

                  
                  <div class="form-group" style="padding-top:50px">
                     <input class="btn btn-default" type="submit" name="add" value="Thêm" style="background: linear-gradient(to right, #1d87b9 0%, #61d0e0 100%); ">
                  </div>
                  
                  

                  </fieldset>
               </form>
            </div>
        </div>
   </div>
</body>
</html>