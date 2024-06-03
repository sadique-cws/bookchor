<?php include_once "includes/config.php";

if (!isset($_SESSION['user'])) {
    redirect_to("login.php");
}

$user_id = getUserInfo()['user_id'];


// checking address id exist in order table or not if not exist then redirect in cart page
$order = mysqli_query($connect, "SELECT * FROM orders LEFT JOIN coupons on orders.coupon_id = coupons.coupon_id where  user_id='$user_id'");
$orderData = mysqli_fetch_array($order);


if ($orderData['address_id'] == NULL) {
    // redirect_to("cart.php");
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
    <link rel="stylesheet" href="css/animation.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <?php include_once "includes/header.php"; ?>
    <?php include_once "includes/subheader.php"; ?>
    <?php include_once "includes/sidebar.php"; ?>

    <div class="flex flex-1 px-[10%] py-10 flex-col justify-center">
        <div class="flex flex-col gap-2 text-center mb-4">
            <h2 class="text-6xl font-bold text-green-800">Order Placed Successfully</h2>
            <h6>too see your orders please click on My Order button</h6>

            <a href="" class="bg-red-700 text-white px-3 py-2 rounded self-center w-[200px] mt-5">My Orders</a>
        </div>
        <div class="flex justify-center">
            <div class="w-1/3">
                <div class="flex flex-col gap-2">
                    <div class="firework"></div>
                    <div class="firework"></div>
                    <div class="firework"></div>
                    <div class="firework"></div>
                    <div class="firework"></div>
                    <div class="firework"></div>
                    <div class="firework"></div>
                </div>
            </div>
        </div>

</body>

</html>