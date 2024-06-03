<div class="flex bg-teal-600 text-white gap-5 px-10 overflow-x-auto">
    <?php
    $callingCategories = mysqli_query($connect, "select * from categories");
    while ($row = mysqli_fetch_assoc($callingCategories)) :
        if (isset($_GET['filter'])) :
            $filter = $_GET['filter'];
            if ($filter == $row['cat_id']) :
    ?>
                <a href="index.php?filter=<?= $row['cat_id']; ?>" class="px-2 py-2 hover:text-white bg-teal-800"><?= $row['cat_title']; ?></a>
            <?php else : ?>
                <a href="index.php?filter=<?= $row['cat_id']; ?>" class="px-2 py-2 hover:text-white"><?= $row['cat_title']; ?></a>

            <?php endif; ?>
        <?php else : ?>
            <a href="index.php?filter=<?= $row['cat_id']; ?>" class="px-2 py-2 hover:text-white"><?= $row['cat_title']; ?></a>

    <?php
        endif;
    endwhile; ?>
</div>