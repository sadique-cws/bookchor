<?php include_once "../includes/config.php";

include_once "includes/redirectIfUnauth.php";


$callingBooks = mysqli_query($connect, "select * from books");
$count = mysqli_num_rows($callingBooks);

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
                    <h2 class="my-5 text-2xl font-semibold text-red-500">Manage Books (<?= $count;?>)</h2>
                    <a href="insert-book.php" class="bg-teal-500 text-white px-3 py-2 rounded hover:bg-teal-700">Insert Book</a>
                    </div>
                    <table class="w-full">
                        <tr>
                            <th class="p-2 border">Id</th>
                            <th class="p-2 border">Title</th>
                            <th class="p-2 border">Author</th>
                            <th class="p-2 border">Price</th>
                            <th class="p-2 border">Actions</th>
                        </tr>
                        <?php 
                        while($row = mysqli_fetch_array($callingBooks)):
                       ?>
                       <tr>
                        <td class="p-2 border"><?= $row['id'];?></td>
                        <td class="p-2 border"><?= $row['title'];?></td>
                        <td class="p-2 border"><?= $row['author'];?></td>
                        <td class="p-2 border">₹<?= $row['price'];?> <del class="text-xs text-slate-500">₹<?= $row['mrp'];?></del></td>
                        <td class="p-2 border">
                            <a href="" class="bg-red-500 text-white px-3 py-2 rounded shadow-sm hover:bg-red-700">X</a>
                            <a href="" class="bg-sky-500 text-white px-3 py-2 rounded shadow-sm hover:bg-sky-700">view</a>
                            <a href="" class="bg-green-500 text-white px-3 py-2 rounded shadow-sm hover:bg-green-700">Edit</a>
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