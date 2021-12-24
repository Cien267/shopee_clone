<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/0fcd29bac2.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Estonia&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script>
        $(function () {
            // STATE TRANSITION
            $(".state-option").click(function (e) {
                $(this).parent().find('.state-option').css({
                    'border-bottom': 'none'
                });
                $(this).css({
                    'border-bottom': '2px solid #60CFE0',

                });

            });
            $(".state-option>a").click(function (e) {
                $(this).parent().parent().find('.state-option>a').css({
                    'color': 'black',
                });
                $(this).css({
                    'color': '#60CFE0',

                });

            });

            $(".show-order-info").click(function(e){
                e.preventDefault();

                var id = $(this).data('id');

                $.ajax({
                    type: 'POST',
                    url: 'show-order-info.php',
                    data: {
                        id: id,
                    },
                    success:function(res){
                        var data = JSON.parse(res);
                        console.log(data);
                        $('.status-info').text('');
                        $('.status-info').append(document.createTextNode(data.status));

                        $('.date-info').text('');
                        $('.date-info').append(document.createTextNode(data.order_date));

                        $('.shop-name-info').text('');
                        $('.shop-name-info').append(document.createTextNode(data.shop_name));

                        $('.product-name-info').text('');
                        $('.product-name-info').append(document.createTextNode(data.product_name));

                        $('.product-quantity-info').text('');
                        $('.product-quantity-info').append(document.createTextNode(data.product_quantity));

                        $('.cost-info').text('');
                        $('.cost-info').append(document.createTextNode(data.cost));

                        $('.product-image-info').attr("src", "");
                        $('.product-image-info').attr("src", "./images/product/" + data.product_image);

                        $('#order-info').modal('toggle');
                    },
                    error: function(e){
                        notify('Có lỗi xảy ra', 'danger');
                    }
                });

            });

            
            
        });

        
    </script>

</head>