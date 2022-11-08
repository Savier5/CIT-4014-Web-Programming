<!-- Savier Osman
10/31/2022
Refactored program to move nav tag to category_nav view. -->

<nav>
    <ul>
        <!-- display links for all categories -->
        <?php foreach($categories as $category) : ?>
            <li>
                <a href="?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>