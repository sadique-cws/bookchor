<?php include_once "includes/config.php";

// fetching book information according to the bid of get variable 

// redirect if view this page with id
if (!isset($_GET['bid'])) {
    redirect_to("index.php");
}


$bid = $_GET['bid'];
$query = mysqli_query($connect, "select * from books JOIN categories ON books.category_id = categories.cat_id where id='$bid'");

if (mysqli_num_rows($query) == 0) {
    redirect_to("index.php");
}

$singleBook = mysqli_fetch_array($query);

// print_r($row['cover_image']);

?>
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

    <div class="flex flex-1 flex-col px-[10%]">
        <div class="flex flex-1  mt-5 gap-10">
            <div class="w-3/12">
                <img src="./images/products/<?= $singleBook['cover_image']; ?>" class="w-full" />
            </div>
            <div class="w-9/12 ">
                <div class="flex flex-col gap-2 h-full justify-between">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-2xl font-semibold"><?= $singleBook['title']; ?></h2>
                        <p class="text-xs">Category: <?= $singleBook['cat_title']; ?></p>
                        <p class="text-xs">Author: <?= $singleBook['author']; ?></p>
                        <p class="text-xs">ISBN: <?= $singleBook['isbn']; ?></p>
                        <p class="text-xs">No of Pages: <?= $singleBook['nop']; ?> pages</p>
                    </div>

                    <div class="flex flex-col gap-5">
                        <p class="">
                            <span class="text-green-700 text-4xl font-bold">₹<?= $singleBook['price']; ?></span>
                            <del class="text-slate-500 font-xs">MRP: ₹<?= $singleBook['mrp']; ?> </del>
                        </p>
                        <div class="flex gap-2">
                            <a href="view.php?add_to_cart=<?= $singleBook['id'];?>&bid=<?= $singleBook['id'];?>" class="text-white bg-orange-600 text-xl hover:bg-orange-800 px-4 py-2 rounded">Add to Cart</a>
                            <a href="" class="text-white bg-teal-600 text-xl hover:bg-teal-800 px-4 py-2 rounded">Buy Now</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="flex">
            <div class="border flex-1 mt-4">
                <div class="border text-slate-500 px-3 py-3">
                    Description
                </div>
                <div class="p-4">
                    <?= $singleBook['description']; ?>
                </div>
            </div>
        </div>
        <div class="flex flex-1 mt-4">
            <h2 class="text-teal-800 text-2xl pl-3 font-semibold border-l-2 border-teal-700">Related Books</h2>
        </div>
        <div class="w-full p-5">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-3">
                <?php
                    $cat_id = $singleBook['cat_id'];
                    $callingBooks = mysqli_query($connect, "SELECT * FROM books JOIN categories ON books.category_id = categories.cat_id WHERE category_id = '$cat_id' and books.id != '$bid'");
                    while ($row = mysqli_fetch_array($callingBooks)) :
                ?>

                    <a href="view.php?bid=<?= $row['id']; ?>">
                        <div class="border shadow-sm">
                            <img src="<?= "images/products/" . $row['cover_image']; ?>" style="object-fit:cover; width:100%; height400px" alt="book cover image">
                            <div class="p-4">
                                <h2 class="line-clamp-1"><?= $row['title']; ?></h2>
                                <p class="text-xs text-slate-400"><?= $row['cat_title']; ?></p>
                                <h2 class="text-2xl font-semibold text-slate-700">₹<?= $row['price']; ?> <del class="text-red-600 text-xs">MRP: ₹<?= $row['mrp']; ?></del></h2>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

</body>

</html>

<!-- add to cart work -->
<?php 
if(isset($_GET['add_to_cart'])){
    $book_id = $_GET['add_to_cart'];

    addToCart($book_id);
    redirect_to("cart.php");
}