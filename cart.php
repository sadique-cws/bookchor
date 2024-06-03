<?php include_once "includes/config.php";

if(!isset($_SESSION['user'])){
    redirect_to("login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart <?= PROJECT_NAME; ?> | one stop shop for all books</title>
    <link rel="stylesheet" href="css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <?php include_once "includes/header.php"; ?>
    <?php include_once "includes/subheader.php"; ?>
    <?php include_once "includes/sidebar.php"; ?>


    <div class="flex flex-1">
        <div class="w-8/12 p-3 flex flex-col gap-5">
            <?php
            $user_id = getUserInfo()['user_id'];
            $callingCart = "SELECT * FROM orders LEFT JOIN coupons on orders.coupon_id = coupons.coupon_id where ordered=false AND user_id='$user_id'";
            $runCallingCart  = mysqli_query($connect, $callingCart);
            $countCart = mysqli_num_rows($runCallingCart);
            $cart = mysqli_fetch_array($runCallingCart);


            if ($countCart == 0) {
                echo "<h1>Your cart is empty</h1>";
            } else {
                $order_id = $cart['order_id'];
                $callingOrderItems = mysqli_query($connect, "select * from order_items JOIN books ON order_items.book_id = books.id where order_id='$order_id' and ordered=false and user_id='$user_id'");

                // calculation variables 
                $total_mrp_amount = 0;
                $total_amount = 0;
                $total_discount = 0;
                $total_tax = 0;
                $total_payment_amount = 0;
                $total_coupon_amount = 0;

                while ($item = mysqli_fetch_array($callingOrderItems)) :


            ?>
                    <div class="flex p-4 gap-5 border border-slate-300">
                        <div class="w-1/12">
                            <img src="<?= "images/products/" . $item['cover_image']; ?>" alt="">
                        </div>
                        <div class="w-11/12">
                            <h3 class="text-xl font-semibold mb-4"><?= $item['title']; ?></h3>
                            <div class="flex items-center">
                                <a href="?minus=<?= $item['id']; ?>" class="text-white bg-red-500 px-3 py-2 rounded text-xl">-</a>
                                <span class="px-3 py-2 text-2xl font-semibold"><?= $item['qty']; ?></span>
                                <a href="?add=<?= $item['id']; ?>" class="text-white bg-green-500 px-3 py-2 rounded text-xl">+</a>
                            </div>
                            <div class="flex gap-2 flex-col">
                                <div class="flex gap-2">
                                    <span class="">₹<?= $item['price']; ?> X <?= $item['qty']; ?> = ₹<?= $item['price'] * $item['qty']; ?></span>
                                </div>
                                <span class="">MRP: <del>₹<?= $item['mrp']; ?></del></span>

                            </div>
                        </div>
                    </div>
            <?php
                    // calculate logic 
                    $total_mrp_amount += $item['mrp'] * $item['qty'];
                    $total_amount += $item['price'] * $item['qty'];
                    $total_discount = $total_mrp_amount - $total_amount;
                    $total_tax = $total_amount * 0.18;
                    $total_payment_amount = $total_amount + $total_tax;

                    if ($cart['coupon_id'] != NULL) {
                        $total_payment_amount -= $cart['coupon_amount'];
                    }



                endwhile;
            } ?>
        </div>
        <?php 
        if($countCart != 0): ?>
        <div class="w-4/12 p-3">
            <h2 class="text-xl font-bold">Price Break</h2>
            <table class="w-full mt-2">
                <tr>
                    <th class="px-5 py-2 border">Total Amount</th>
                    <td class="px-5 py-2 border">₹<?= $total_mrp_amount; ?>/-</td>
                </tr>
                <tr class="bg-green-600 text-white">
                    <th class="px-5 py-2 border">Total Discount</th>
                    <td class="px-5 py-2 border">₹<?= $total_discount; ?>/-</td>
                </tr>
                <tr>
                    <th class="px-5 py-2 border">Total GST (18%)</th>
                    <td class="px-5 py-2 border">₹<?= round($total_tax); ?>/-</td>
                </tr>

                <?php
                if ($cart['coupon_id'] != NULL) : ?>
                    <tr class="bg-yellow-100">
                        <th class="px-5 py-2 border flex flex-col">
                            <span>Coupon Discount</span>
                            <span class="text-xs text-teal-700">Your Code: <?= $cart['coupon_code']; ?>
                                <a href="cart.php?remove_coupon=1" class="text-red-600 text-lg underline">X</a>
                            </span>

                        </th>
                        <td class="px-5 py-2 border"><?= $cart['coupon_amount']; ?>/-</td>
                    </tr>
                <?php endif; ?>

                <tr>
                    <th class="px-5 py-2 border">Total Payable</th>
                    <td class="px-5 py-2 border">₹<?= round($total_payment_amount); ?>/-</td>
                </tr>
            </table>


            <?php
            if ($cart['coupon_id'] == null) : ?>


                <div class="bg-slate-100 border border-slate-300 mt-4">
                    <h2 class="text-xl font-semibold text-center my-3">Apply Coupons</h2>
                    <div class="p-3">
                        <form action="cart.php" method="POST">
                            <div class="flex gap-3 justify-center">
                                <input type="text" name="coupon_code" class="flex-1 border px-3 py-2 rounded" placeholder="Enter Coupon Code">
                                <button type="submit" name="apply_coupon" class="bg-teal-500 text-white px-2 py-2 rounded">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>


            <?php endif; ?>

            <div class="flex flex-1 gap-5 mt-6 text-center">
                <a href="index.php" class="bg-slate-600 text-white px-3 py-2 text-2xl flex-1 rounded-lg">More Shopping</a>
                <a href="checkout.php" class="bg-teal-600 text-white px-3 py-2 text-2xl flex-1 rounded-lg">Checkout</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>

<?php
if (isset($_GET['add'])) {
    $book_id = $_GET['add'];

    addToCart($book_id);
    redirect_to("cart.php");
}

// remove qty function 
if (isset($_GET['minus'])) {
    $book_id = $_GET['minus'];
    removeFromCartqty($book_id);
    redirect_to("cart.php");
}

// coupon_apply 
if (isset($_POST['apply_coupon'])) {
    $code = $_POST['coupon_code'];

    // checking coupon code 
    $checkCode = mysqli_query($connect, "SELECT * FROM coupons WHERE coupon_code='$code' and coupon_status=1");
    $couponData = mysqli_fetch_array($checkCode);
    $couponCount = mysqli_num_rows($checkCode);

    if ($couponCount > 0) {
        // order table update 
        $coupon_id = $couponData['coupon_id'];
        if ($total_payment_amount > $couponData['coupon_amount']) {
            $updateOrder = mysqli_query($connect, "UPDATE orders SET coupon_id='$coupon_id' where user_id='$user_id' and order_id='$order_id' and ordered=false");
            redirect_to("cart.php");
        }
        else{
            message("total amount must be greater than coupon amount");
        }
    } else {
        message("invalid coupon code");
    }
}


// remove coupon  code from order 
if (isset($_GET['remove_coupon'])) {
    $updateOrder = mysqli_query($connect, "UPDATE orders SET coupon_id=NULL where user_id='$user_id' and order_id='$order_id' and ordered=false");
    redirect_to("cart.php");
}
