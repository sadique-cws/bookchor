<?php include_once "includes/config.php";

if (!isset($_SESSION['user'])) {
    redirect_to("login.php");
}

$user_id = getUserInfo()['user_id'];


// checking address id exist in order table or not if not exist then redirect in cart page
$order = mysqli_query($connect, "SELECT * from orders where user_id = '$user_id' and ordered=false");
$orderData = mysqli_fetch_array($order);

if ($orderData['address_id'] == NULL) {
    redirect_to("cart.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout <?= PROJECT_NAME; ?> | one stop shop for all books</title>
    <link rel="stylesheet" href="css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <?php include_once "includes/header.php"; ?>
    <?php include_once "includes/subheader.php"; ?>
    <?php include_once "includes/sidebar.php"; ?>

    <div class="flex flex-1 px-[10%] py-10 flex-col justify-center">
        <div class="flex flex-col gap-2 text-center mb-4">
            <h2 class="text-2xl font-bold">Make Payment for Order</h2>
            <h6>Choose payment Option and complete your order</h6>
        </div>
        <div class="flex justify-center">
            <div class="w-1/3">
                <div class="flex flex-col gap-2">
                    <form action="" method="post">
                        <label for="mode" class="cursor-pointer">
                            <input type="radio" id="mode" name="mode" value="cod" class="peer sr-only">
                            <div class="peer-checked:border-sky-700 peer-checked:bg-sky-100 border-2 px-3 py-2">
                                <h2 class="text-2xl font-semibold">Cash on Delivery (COD)</h2>
                            </div>
                        </label>
                        <div class="my-3">
                            <input type="submit" value="Make Order" name="make_payment" class="cursor-pointer bg-teal-700 text-white px-3 py-2 rounded w-full">
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>

<?php
if (isset($_POST['make_payment'])) {

    $mode = $_POST['mode'];

    if (!isset($mode)) {
        echo "<script>alert('Please select payment mode');</script>";
        redirect_to("makepayment.php");
    }

    $order_id = $orderData['order_id'];


    // checking address id exist in order table or not if not exist then redirect in cart page
    $order = mysqli_query($connect, "SELECT * FROM orders LEFT JOIN coupons on orders.coupon_id = coupons.coupon_id where ordered=false AND user_id='$user_id'");
    $orderData = mysqli_fetch_array($order);


    if ($orderData['address_id'] == NULL) {
        redirect_to("cart.php");
    }

    $order_id = $orderData['order_id'];

    $callingOrderItems = mysqli_query($connect, "select * from order_items JOIN books ON order_items.book_id = books.id where order_id='$order_id' and ordered=false and user_id='$user_id'");

    // calculation variables 
    $total_mrp_amount = 0;
    $total_amount = 0;
    $total_discount = 0;
    $total_tax = 0;
    $total_payment_amount = 0;
    $total_coupon_amount = 0;

    while ($item = mysqli_fetch_array($callingOrderItems)) :

        $total_mrp_amount += $item['mrp'] * $item['qty'];
        $total_amount += $item['price'] * $item['qty'];
        $total_discount = $total_mrp_amount - $total_amount;
        $total_tax = $total_amount * 0.18;
        $total_payment_amount = $total_amount + $total_tax;

        if ($orderData['coupon_id'] != NULL) {
            $total_payment_amount -= $orderData['coupon_amount'];
        }

    endwhile;

    // user_id, order_id, payment_amount, mode, txn, status
    $query = mysqli_query($connect, "insert into payments (order_id, amount, mode) values('$order_id','$total_payment_amount','$mode')");


    if($query){

        $Updatequery = mysqli_query($connect, "update orders set ordered=true where order_id='$order_id' and user_id='$user_id'");

        if($Updatequery){
            redirect_to("order-success.php");
        }
    }
}
