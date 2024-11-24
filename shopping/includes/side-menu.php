<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head" style="font-size: 1.5rem; color: White; display: flex; align-items: center; margin: 20px 0;">
        <i class="icon fa fa-align-justify fa-fw" style="margin-right: 10px;"></i> Categories
    </div>
    <nav class="yamm megamenu-horizontal" role="navigation">

        <ul class="nav">
            <li class="dropdown menu-item">
                <?php $sql = mysqli_query($con, "select id,categoryName  from category");
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <a href="category.php?cid=<?php echo $row['id']; ?>" class="dropdown-toggle"><i class="icon fa fa-desktop fa-fw"></i>
                        <?php echo $row['categoryName']; ?></a>
                <?php } ?>

            </li>
        </ul>
    </nav>
</div>