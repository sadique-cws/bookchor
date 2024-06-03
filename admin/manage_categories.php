<?php include_once "../includes/config.php"; 


include_once "includes/redirectIfUnauth.php";


$callingCat = mysqli_query($connect, "select * from categories");
$count = mysqli_num_rows($callingCat);
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
                    <h2 class="my-5 text-2xl font-semibold text-red-500">Manage Categories (<?= $count;?>)</h2>
                    <table class="w-full">
                        <tr>
                            <th class="p-2 border">Id</th>
                            <th class="p-2 border">Title</th>
                            <th class="p-2 border">Description</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                        <?php 
                        while($row = mysqli_fetch_array($callingCat)):
                        ?>
                        <tr>
                            <td class="border p-2"><?= $row['cat_id'];?></td>
                            <td class="border p-2"><?= $row['cat_title'];?></td>
                            <td class="border p-2"><?= $row['cat_desc'];?></td>
                            <td class="border p-2">
                                <a href="" class="bg-red-500 px-2 text-white py-1 rounded">X</a>
                            </td>
                        </tr>
                        <?php endwhile;?>
                    </table>
               </div>
               <div class="w-5/12">
               <h2 class="my-5 text-2xl font-semibold text-red-500">Insert Category</h2>
                    <div class="bg-slate-200 border p-4">
                        <form action=""  class="flex flex-col gap-3" method="post">
                            <div class="mb-3">
                                <label for="">Category Title</label>
                                <input type="text" name="cat_title" class="border w-full px-3 py-2">
                            </div>
                            <div class="mb-3">
                                <label for="">Category Description</label>
                                <textarea rows="5" type="text" name="cat_desc" class="border w-full px-3 py-2"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="cat_insert" class="bg-teal-600 hover:bg-teal-500 text-white px-3 py-2 rounded-lg w-full" value="Insert Category">
                            </div>
                        </form>
                        <?php 
                         if(isset($_POST['cat_insert'])){
                            $cat_title = addslashes($_POST['cat_title']);
                            $cat_desc = addslashes($_POST['cat_desc']);


                            $query = mysqli_query($connect, "insert into categories (cat_title, cat_desc) value('$cat_title', '$cat_desc')");

                            if($query){
                                redirect_to("manage_categories.php");
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