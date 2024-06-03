<?php include_once "includes/config.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= PROJECT_NAME; ?> | one stop shop for all books</title>
    <link rel="stylesheet" href="css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <?php include_once "includes/header.php"; ?>
    <?php include_once "includes/subheader.php"; ?>
    <?php include_once "includes/sidebar.php"; ?>

    <div class="w-full flex-1 flex">
        <div class="w-full p-5">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-3">
                <?php
                if(isset($_GET['filter'])){
                    $cat_id = $_GET['filter'];
                    $callingBooks = mysqli_query($connect, "SELECT * FROM books JOIN categories ON books.category_id = categories.cat_id where category_id = '$cat_id'");
                }
                elseif(isset($_GET['find'])){
                    $search = $_GET['search'];

                    if(preg_match("/[0-9]{5,}/",$search)){
                        $callingBooks = mysqli_query($connect, "SELECT * FROM books where isbn='$search'");
                        $singleBookData = mysqli_fetch_array($callingBooks);
                        $bid = $singleBookData['id'];
                        redirect_to("view.php?bid=$bid");
                    }


                    if(strlen($search) <= 3){
                            message("please use atleat more then 3 characters");
                            redirect_to("index.php");
                    }
                    else{
                        $callingBooks = mysqli_query($connect, "SELECT * FROM books JOIN categories ON books.category_id = categories.cat_id where title LIKE '%$search%'");
                    }   
                }
                else{
                    $callingBooks = mysqli_query($connect, "SELECT * FROM books JOIN categories ON books.category_id = categories.cat_id");
                }

                $count = mysqli_num_rows($callingBooks);
                if($count < 1){
                    echo "<h2 class='text-center text-2xl'>No books found</h2>";
                }
                while ($row = mysqli_fetch_array($callingBooks)) :
                ?>

                   <a href="view.php?bid=<?= $row['id'];?>">
                    <div class="border shadow-sm">
                            <img src="<?= "images/products/" . $row['cover_image'];?>" style="object-fit:cover; width:100%; height400px" alt="book cover image">
                            <div class="p-4">
                                <h2 class="line-clamp-1"><?= $row['title'];?></h2>
                                <p class="text-xs text-slate-400"><?= $row['cat_title'];?></p>
                                <h2 class="text-2xl font-semibold text-slate-700">₹<?= $row['price'];?> <del class="text-red-600 text-xs">MRP: ₹<?= $row['mrp'];?></del></h2>
                            </div>
                        </div>
                   </a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>