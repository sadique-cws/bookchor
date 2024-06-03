<?php include_once "../includes/config.php";

include_once "includes/redirectIfUnauth.php";


$callingUsers = mysqli_query($connect, "select * from users");
$count = mysqli_num_rows($callingUsers);

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
               <div class="w-full">
                    <div class="flex justify-between items-center">
                    <h2 class="my-5 text-2xl font-semibold text-red-500">Manage Users (<?= $count;?>)</h2>
                   
                    </div>
                    <table class="w-full">
                        <tr>
                            <th class="p-2 border">Id</th>
                            <th class="p-2 border">Fullname</th>
                            <th class="p-2 border">Email</th>
                            <th class="p-2 border">Contact</th>
                            <th class="p-2 border">IsAdmin</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                        <?php 
                        while($row = mysqli_fetch_array($callingUsers)):
                       ?>
                       <tr>
                        <td class="p-2 border"><?= $row['user_id'];?></td>
                        <td class="p-2 border"><?= $row['fullname'];?></td>
                        <td class="p-2 border"><?= $row['email'];?></td>
                        <td class="p-2 border"><?= $row['contact'];?></td>
                        <td class="p-2 border">
                            <?php 
                            if($row['isAdmin'] == 1){
                                echo "Yes";
                            }else{
                                echo "No";
                            }
                            ?>
                        
                        </td>
                        <td class="p-2 border">
                            <a href="" class="bg-red-500 text-white px-3 py-2 rounded shadow-sm hover:bg-red-700">X</a>
                            <?php 
                            if($row['isAdmin'] != 1): ?>   
                            <a href="" class="bg-green-500 text-white px-3 py-2 rounded shadow-sm hover:bg-green-700">Make Admin</a>
                            <?php endif;?>
                            
                        </td>
                       </tr>
                       <?php endwhile; ?>
                    </table>
               </div>
             
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>