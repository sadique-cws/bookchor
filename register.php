<?php include_once "includes/config.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= PROJECT_NAME; ?> | one stop shop for all books</title>
    <link rel="stylesheet" href="css/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root, head, body{
            height: 100%;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>
<body>
    <?php include_once "includes/header.php";?>

    <div class="flex h-full flex-1 items-center">
        <div class="w-3/12 mx-auto">
            <div class="border bg-white shadow-sm flex-1 p-5">
                <form action="" method="post">
                <div class="mb-3">
                        <h2 class="text-xl font-medium">Create an Account Here</h2>
                    </div>

                    <div class="mb-3">
                    <label for="Fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input id="Fullname" name="fullname" type="text" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <input id="email" name="email" type="email" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>

                    
                    <div class="mb-3">
                        <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                        <input id="contact" name="contact" type="text" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="block text-sm font-medium text-gray-700">Create Password</label>
                        <input id="password" name="password" type="password" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="signup" class="bg-teal-600 w-full p-3 text-white hover:bg-teal-800">
                    </div>

                    <div class="text-xs">
                        <a href="login.php" class="text-teal-600 hover:text-teal-800">Already have an account? Login</a>
                    </div>
                </form>

                <?php 
                    if(isset($_POST['signup'])){
                        $fullname = $_POST['fullname'];
                        $email = $_POST['email'];
                        $contact = $_POST['contact'];
                        $password = $_POST['password'];

                        // encyption 
                        $password = md5($password);

                        $sql = "INSERT INTO users(`fullname`, `email`, `contact`, `password`) VALUES ('$fullname','$email','$contact','$password')";
                        $result = mysqli_query($connect,$sql);
                        if($result){
                            echo "<script>alert('Registration Successful')</script>";
                            redirect_to('login.php');
                        }else{
                            echo "<script>alert('Registration Failed')</script>";
                        }
                    }

                ?>
            </div>
        </div>
    </div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>