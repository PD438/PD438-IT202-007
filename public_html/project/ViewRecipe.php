<?php
require(__DIR__ . "/../../partials/nav.php");

// Include the function to make the API request
require(__DIR__ . "C:/../../public_html/project/recipes.php");

// Make a request to Spoonacular API
$getRecipesFromSpoonacular("ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d"); // You need to implement this function

?>
<div class="container-fluid">
    <h4>Delicious Recipes</h4>
    <div class="container mx-auto">
        <div>
            <?php include(__DIR__ . "/../../partials/search_form.php"); ?>
        </div>
        <div class="row justify-content-center">
            <!-- Display Spoonacular API results -->
            <?php foreach ($spoonacularResponse as $recipe) : ?>
                <div class="col">
                    <!-- Display recipe information -->
                    <h5><?= $recipe['title']; ?></h5>
                    <p><?= $recipe['summary']; ?></p>
                </div>
            <?php endforeach; ?>

            <?php if (empty($spoonacularResponse)) : ?>
                <div class="col-12">
                    No recipes available
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
require_once(__DIR__ . "/../../partials/footer.php");
?>