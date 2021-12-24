<?php
	$id = $_POST['id'];
	
	if($id){
		require "./libs/orders.php";
		$order = get_order($id);
		if($order){
			echo json_encode($order);
		}else {
			echo "Không tìm thấy đơn hàng";
		}
	}else {
		echo "có lỗi xảy ra";
	}
	
?>