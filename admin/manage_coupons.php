<?php include_once "../includes/config.php"; 


include_once "includes/redirectIfUnauth.php";


$callingCoupons = mysqli_query($connect, "select * from coupons");
$count = mysqli_num_rows($callingCoupons);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= PROJECT_NAME; ?> | one stop shop for all books</title>
    <link rel="stylesheet" href="../css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <?php include_once "includes/adminHeader.php"; ?>

    <div class="w-full flex-1 flex">
        <div class="w-1/6">
        <?php include_once "includes/links.php"; ?>

        </div>
        <div class="w-5/6">
            <div class="flex p-10 gap-10">
               <div class="w-7/12">
                    <h2 class="my-5 text-2xl font-semibold text-red-500">Manage Coupons (<?= $count;?>)</h2>
                    <table class="w-full">
                        <tr>
                            <th class="p-2 border">Id</th>
                            <th class="p-2 border">Code</th>
                            <th class="p-2 border">Amount</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                        <?php 
                        while($row = mysqli_fetch_array($callingCoupons)):
                        ?>
                        <tr>
                            <td class="border p-2"><?= $row['coupon_id'];?></td>
                            <td class="border p-2"><?= $row['coupon_code'];?></td>
                            <td class="border p-2"><?= $row['coupon_amount'];?></td>
                            <td class="border p-2">
                                <a href="" class="bg-red-500 px-2 text-white py-1 rounded">
                                    Inactive
                                </a>
                            </td>
                        </tr>
                        <?php endwhile;?>
                    </table>
               </div>
               <div class="w-5/12">
               <h2 class="my-5 text-2xl font-semibold text-red-500">Insert Coupon</h2>
                    <div class="bg-slate-200 border p-4">
                        <form action=""  class="flex flex-col gap-3" method="post">
                            <div class="mb-3">
                                <label for="">Coupon Code</label>
                                <input type="text" name="coupon_code" class="border w-full px-3 py-2">
                            </div>
                           
                            <div class="mb-3">
                                <label for="">Coupon amount</label>
                                <input type="text" name="coupon_amount" class="border w-full px-3 py-2">
                            </div>
                           
                            <div class="mb-3">
                                <input type="submit" name="coupon_insert" class="bg-teal-600 hover:bg-teal-500 text-white px-3 py-2 rounded-lg w-full" value="Insert Category">
                            </div>
                        </form>
                        <?php 
                         if(isset($_POST['coupon_insert'])){
                            $coupon_code = $_POST['coupon_code'];
                            $coupon_amount = $_POST['coupon_amount'];

                            $query = mysqli_query($connect, "insert into coupons (coupon_code, coupon_amount) value('$coupon_code', '$coupon_amount')");

                            if($query){
                                redirect_to("manage_coupons.php");
                            }
                         }
                        ?>
                    </div>
               </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>