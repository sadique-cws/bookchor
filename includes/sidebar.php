<div id="sidebar" class="fixed top-0 left-0 z-40 h-screen overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label">
   <h5 id="drawer-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"></svg>
   </h5>


   <div class="flex flex-col gap-y-4">
      <?php 
         $callingCat = mysqli_query($connect, "select * from categories");
         while($cat = mysqli_fetch_array($callingCat)):
      ?>
      <a href="index.php?filter=<?= $cat['cat_id'];?>" class="py-3 px-3 text-xl font-medium hover:bg-green-200"><?= $cat['cat_title'];?></a>
      <?php endwhile;?>
   </div>
</div>