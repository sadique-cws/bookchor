<?php 
if(isset($_SESSION['user'])){
    $user  = getUserInfo();
}

 ?>
<div class="flex flex-1 bg-green-600 items-center justify-between px-10 py-4">

    <div class="flex gap-3 items-center">
    <button class="text-white bg-transparent hover:bg-slate-200 hover:text-slate-700" type="button" data-drawer-target="sidebar" data-drawer-show="sidebar" aria-controls="sidebar">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>

    </button>
    <h1 class="text-3xl text-white font-semibold"><?= PROJECT_NAME; ?></h1>
    </div>

    <form action="index.php" class="flex w-[700px]">
        <input type="search" name="search" placeholder="Search Book by title, author, isbn..." class="border px-3 py-2 w-full">
        <input type="submit" name="find" value="Go" class="bg-red-500 text-white px-3 py-2">
    </form>

    <div class="flex gap-4">
        <a href="index.php" class="text-white flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>

            Home
        </a>
        <a href="cart.php" class="text-white flex items-center gap-3">
            

            Cart
        </a>
        <?php 
            if (isset($_SESSION['user'])):
        ?>

        
<img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer" src="https://www.tenforums.com/geek/gars/images/2/types/thumb_15951118880user.png" alt="User dropdown">

<!-- Dropdown menu -->
<div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
      <div><?= $user['fullname'];?></div>
      <div class="font-medium truncate"><?= $user['email'];?></div>
    </div>
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
      </li>
    </ul>
    <div class="py-1">
      <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
    </div>
</div>



       <?php else: ?>


        <a href="register.php" class="text-white">

            SignUp
        </a>
        <a href="login.php" class="text-white">Login</a>

        <?php endif;?>
    </div>
</div>