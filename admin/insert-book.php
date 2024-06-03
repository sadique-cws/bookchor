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
            <div class="flex p-10 gap-10">
                <div class="w-full">
                    <div class="flex justify-between items-center">
                        <h2 class="my-5 text-2xl font-semibold text-red-500">Insert Book</h2>
                        <a href="manage_books.php" class="bg-black text-white px-3 py-2 rounded hover:bg-teal-700">Go Back</a>
                    </div>



                    <div class="border p-4">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="flex gap-3">
                                <div class="flex-1">
                                    <div class="mb-3 flex flex-col gap-2">
                                        <label for="name">Title</label>
                                        <input type="text" id="name" class="border px-3 py-2 rounded" name="title">
                                    </div>
                                    <div class="mb-3 flex flex-col gap-2">
                                        <label for="author">author</label>
                                        <input type="text" id="author" class="border px-3 py-2 rounded" name="author">
                                    </div>
                                    <div class="mb-3 flex flex-col gap-2">
                                        <label for="author">description</label>
                                        <textarea rows="4" type="text" id="author" class="border px-3 py-2 rounded" name="description"></textarea>
                                    </div>
                                    <div class="mb-3 flex flex-col gap-2">
                                        <label for="category">category</label>
                                        <select id="category" class="border px-3 py-2 rounded" name="category">
                                            <option value="" selected disabled>Select Category</option>
                                            <?php 
                                                $callingcat = mysqli_query($connect, "select * from categories");
                                                while($cat = mysqli_fetch_array($callingcat)):
                                            ?>
                                                <option value="<?= $cat['cat_id'];?>"><?= $cat['cat_title'];?></option>

                                                <?php endwhile;?>
                                        </select>
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <div class="mb-3 flex flex-col gap-2">
                                        <label for="nop">No of Page</label>
                                        <input type="text" id="nop" class="border px-3 py-2 rounded" name="nop">
                                    </div>
                                    <div class="mb-3 flex flex-col gap-2">
                                        <label for="mrp">MRP</label>
                                        <input type="text" id="mrp" class="border px-3 py-2 rounded" name="mrp">
                                    </div>
                                    <div class="mb-3 flex flex-col gap-2">
                                        <label for="price">Selling Price</label>
                                        <input type="text" id="price" class="border px-3 py-2 rounded" name="price">
                                    </div>
                                    <div class="mb-3 flex flex-col gap-2">
                                        <label for="cover_image">Cover Image</label>
                                        <input type="file" id="cover_image" class="border px-3 py-2 rounded" name="cover_image">
                                    </div>
                                    <div class="mb-3 flex flex-col gap-2">
                                        <label for="isbn">ISBN</label>
                                        <input type="text" id="isbn" class="border px-3 py-2 rounded" name="isbn">
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <input type="submit" value="Insert Book" class="bg-teal-600 hover:bg-teal-900 text-white px-3 py-3 w-full rounded" name="insert">
                            </div>
                        </form>

                        <?php 
                            if(isset($_POST['insert']))
                            {
                                $title = addslashes($_POST['title']);
                                $author = addslashes($_POST['author']);
                                $description = addslashes($_POST['description']);
                                
                                $category = $_POST['category'];
                                $nop = $_POST['nop'];
                                $mrp = $_POST['mrp'];
                                $price = $_POST['price'];
                                $cover_image = $_FILES['cover_image']['name'];
                                $tmp_cover_image = $_FILES['cover_image']['tmp_name'];
                                $isbn = $_POST['isbn'];

                                $query = mysqli_query($connect, "insert into books (title,author, description, category_id, nop, mrp, price, cover_image, isbn) values ('$title','$author','$description','$category','$nop','$mrp','$price','$cover_image', '$isbn')");

                                if($query){
                                    move_uploaded_file($tmp_cover_image, "../images/products/$cover_image");
                                    redirect_to("manage_books.php");
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