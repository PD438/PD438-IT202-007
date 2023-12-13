<?php

require_once(__DIR__ . "/../../partials/nav.php");
require_once(__DIR__ . "/../../lib/functions.php"); // Include your API functions file

// Function to fetch recipes from Spoonacular
function fetchRecipesFromSpoonacular($spoonacularApiKey)
{
    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch?query=pasta&cuisine=italian&excludeCuisine=greek&diet=vegetarian&intolerances=gluten&equipment=pan&includeIngredients=tomato%2Ccheese&excludeIngredients=eggs&type=main%20course&instructionsRequired=true&fillIngredients=false&addRecipeInformation=false&titleMatch=Crock%20Pot&maxReadyTime=20&ignorePantry=true&sort=calories&sortDirection=asc&minCarbs=10&maxCarbs=100&minProtein=10&maxProtein=100&minCalories=50&maxCalories=800&minFat=10&maxFat=100&minAlcohol=0&maxAlcohol=100&minCaffeine=0&maxCaffeine=100&minCopper=0&maxCopper=100&minCalcium=0&maxCalcium=100&minCholine=0&maxCholine=100&minCholesterol=0&maxCholesterol=100&minFluoride=0&maxFluoride=100&minSaturatedFat=0&maxSaturatedFat=100&minVitaminA=0&maxVitaminA=100&minVitaminC=0&maxVitaminC=100&minVitaminD=0&maxVitaminD=100&minVitaminE=0&maxVitaminE=100&minVitaminK=0&maxVitaminK=100&minVitaminB1=0&maxVitaminB1=100&minVitaminB2=0&maxVitaminB2=100&minVitaminB5=0&maxVitaminB5=100&minVitaminB3=0&maxVitaminB3=100&minVitaminB6=0&maxVitaminB6=100&minVitaminB12=0&maxVitaminB12=100&minFiber=0&maxFiber=100&minFolate=0&maxFolate=100&minFolicAcid=0&maxFolicAcid=100&minIodine=0&maxIodine=100&minIron=0&maxIron=100&minMagnesium=0&maxMagnesium=100&minManganese=0&maxManganese=100&minPhosphorus=0&maxPhosphorus=100&minPotassium=0&maxPotassium=100&minSelenium=0&maxSelenium=100&minSodium=0&maxSodium=100&minSugar=0&maxSugar=100&minZinc=0&maxZinc=100&offset=0&number=10&limitLicense=false&ranking=2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
            "X-RapidAPI-Key: ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d", // Use the provided API key
        ],
    ]);

    // Execute cURL request
    $result = curl_exec($curl);
    $err = curl_error($curl);

    // Close cURL session
    curl_close($curl);

    // Process the API response
    if (!$err) {
        $decoded_response = json_decode($result, true);
        return $decoded_response;
    } else {
        return [];
    }
}

// Call the function to fetch recipes
$recipes = fetchRecipesFromSpoonacular("ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d");

?>

<div class="container-fluid">
    <h1>Recipes with Pasta - Demo</h1>
    <p>Remember, we typically won't be frequently calling live data from our API; this is merely a quick sample. We'll want to cache data in our DB to save on API quota.</p>
    <?php if (!empty($recipes['results'])): ?>
        <div class="row">
            <?php foreach ($recipes['results'] as $recipe) : ?>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $recipe["image"] ?? ''; ?>" class="card-img-top" alt="Recipe Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $recipe["title"] ?? ''; ?></h5>
                            <?php if (isset($recipe["summary"]) && !empty($recipe["summary"])) : ?>
                                <p class="card-text"><?php echo $recipe["summary"]; ?></p>
                            <?php else : ?>
                                <p class="card-text">Summary not available.</p>
                            <?php endif; ?>
                            <?php if (isset($recipe["sourceUrl"]) && !empty($recipe["sourceUrl"])) : ?>
                                <a href="<?php echo $recipe["sourceUrl"]; ?>" class="btn btn-primary">View</a>
                            <?php else : ?>
                                <p>Recipe source URL not available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No recipes found.</p>
    <?php endif; ?>
</div>
<?php require_once(__DIR__ . "/../../partials/footer.php"); ?>
