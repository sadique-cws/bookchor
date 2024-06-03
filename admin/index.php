<?php include_once "../includes/config.php";

include_once "includes/redirectIfUnauth.php";

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
            <div class="grid grid-cols-4 p-10 gap-10">
                <div class="bg-red-500 text-white flex-1 flex flex-col gap-3 p-5 rounded shadow-lg border border-red-700">
                    <h1 class="text-3xl font-semibold"><?= countTable('books');?></h1>
                    <h6 class="text-sm">Total Books</h6>
                </div>
                <div class="bg-green-500 text-white flex-1 flex flex-col gap-3 p-5 rounded shadow-lg border border-green-700">
                    <h1 class="text-3xl font-semibold"><?= countTable('categories');?></h1>
                    <h6 class="text-sm">Total Categories</h6>
                </div>
                <div class="bg-purple-500 text-white flex-1 flex flex-col gap-3 p-5 rounded shadow-lg border border-purple-700">
                    <h1 class="text-3xl font-semibold"><?= countTable('users');?></h1>
                    <h6 class="text-sm">Total Users</h6>
                </div>
                <div class="bg-orange-500 text-white flex-1 flex flex-col gap-3 p-5 rounded shadow-lg border border-orange-700">
                    <h1 class="text-3xl font-semibold">10+</h1>
                    <h6 class="text-sm">Total Orders</h6>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>