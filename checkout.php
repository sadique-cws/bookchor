<?php include_once "includes/config.php";

if(!isset($_SESSION['user'])){
    redirect_to("login.php");
}

$user_id = getUserInfo()['user_id'];

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

    <div class="flex flex-1 px-[10%] py-10 flex-col">
        <div class="flex flex-col gap-2">
            <h2 class="text-2xl font-bold">Checkout Order</h2>
            <h6>Fill or choose address information</h6>
        </div>
<!--	pincode	type -->
        <div class="flex gap-10">
            <div class="w-8/12">
                <div class="bg-white border border-slate-700 rounded-lg mt-4 p-4">
                    <form action="" method="post">
                        <div class="flex gap-3">
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">FullName for Shipping</label>
                                <input type="text" name="fullname" class="border px-3 py-2 rounded">
                            </div>
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">Contact no Shipping</label>
                                <input type="text" name="contact_no" class="border px-3 py-2 rounded">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">Alternative Contact</label>
                                <input type="text" name="alt_contact_no" class="border px-3 py-2 rounded">
                            </div>
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">Street</label>
                                <input type="text" name="street" class="border px-3 py-2 rounded">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">Area/Locality/Village</label>
                                <input type="text" name="area" class="border px-3 py-2 rounded">
                            </div>
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">Landmark</label>
                                <input type="text" name="landmark" class="border px-3 py-2 rounded">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">City</label>
                                <input type="text" name="city" class="border px-3 py-2 rounded">
                            </div>
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">State</label>
                                <input type="text" name="state" class="border px-3 py-2 rounded">
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">pincode</label>
                                <input type="number" name="pincode" class="border px-3 py-2 rounded">
                            </div>
                            <div class="flex-1 mb-3 flex flex-col">
                                <label for="">Address Type</label>
                                <select  name="type" class="border px-3 py-2 rounded">
                                    <option value="" selected disabled>Select Type</option>
                                    <option>Office</option>
                                    <option>Home</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="flex-1">
                                <input type="submit" name="save_address" value="Save Address" class="bg-teal-700 hover:bg-teal-900 text-white px-3 py-2 w-full">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w-4/12">
                <div class="flex">
                    <h2 class="mb-3 text-xl font-semibold ">Saved Addresses</h2>
                </div>
                <div class="h-[600px] overflow-y-auto">
                <form action="" method="post">
                <?php 
                    $callingOrder = mysqli_query($connect, "select * from orders where user_id = '$user_id' and ordered=false");
                    $orderData = mysqli_fetch_array($callingOrder);
                    $callingAddress = mysqli_query($connect, "select * from Addresses");
                    while($add = mysqli_fetch_array($callingAddress)):
                       
                ?>
                <label class="cursor-pointer">
                    <input type="radio" name="address_id" value="<?= $add['address_id'];?>" class="peer sr-only">
                <div class="border-2 mb-3 hover:shadow-2xl p-5 rounded-lg flex flex-col  peer-checked:border-blue-700" >
                    <h2 class="text-xl font-semibold capitalize"><?= $add['fullname'];?></h2>
                    <p>Contact: <?= $add['contact_no'];?>, <?= $add['alt_contact_no'];?></p>
                    <p><?= $add['street'];?>, <?= $add['area'];?>, <?= $add['city'];?>, <?= $add['state'];?> (<?= $add['pincode'];?>) </p>
                    <p>Landmark: <?= $add['landmark'];?></p>
                </div>
                </label>
                <?php endwhile;?> 
                
                <div class="mb-2">
                    <input type="submit" name="add_address" value="Proceed to Pay" class="bg-orange-600 text-white px-3 py-2 w-full hover:bg-orange-800 cursor-pointer">
                </div>
                </form>
                </div> 
            </div>
        </div>
    </div>


</body>
</html>
<?php 
if(isset($_POST['save_address'])){
    $fullname = $_POST['fullname'];
    $contact_no = $_POST['contact_no'];
    $alt_contact_no = $_POST['alt_contact_no'];
    $street = $_POST['street'];
    $area = $_POST['area'];
    $landmark = $_POST['landmark'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $type = $_POST['type'];
    
    $query = mysqli_query($connect, "insert into addresses (user_id, fullname, contact_no, alt_contact_no, street, city, state, area, pincode, type,landmark) values ('$user_id','$fullname','$contact_no','$alt_contact_no','$street','$city','$state','$area','$pincode','$type','$landmark')");


    if($query){
        redirect_to("checkout.php");
    }
    else{
        message("something went wrong");
    }
}


// update order table with address information

if(isset($_POST['add_address'])){
    if(isset($_POST['address_id'])){
        $address_id = $_POST['address_id'];
        $query = mysqli_query($connect, "update orders set address_id = '$address_id' where user_id = '$user_id' and ordered = false");
        if($query){
            redirect_to("makepayment.php");
        }
        else{
            message("something went wrong");
        }
    }
    else{
        message("please select saved address");
    }
}
?>
