<?php
require_once(__DIR__ . "/../../partials/nav.php");

// Initialize the variable
$resultCount = 0;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the form is submitted
    if (!empty($_GET["search"])) {  // Check if the search parameter is not empty
        // Get the form inputs
        $search = $_GET;

        // Build Spoonacular API URL
        $spoonacularUrl = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch?";
        // Append form inputs to the URL
        $spoonacularUrl .= http_build_query($search);

        function make_request($url)
        {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
                    "X-RapidAPI-Key: ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
                return false;
            } else {
                return $response;
            }
        }

        // Make Spoonacular API request
        $spoonacularResponse = make_request($spoonacularUrl);

        // Process Spoonacular API response
        if ($spoonacularResponse) {
            $spoonacularData = json_decode($spoonacularResponse, true);

            // Check for JSON decoding errors
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo "Error decoding Spoonacular data. JSON Error: " . json_last_error_msg();
                // Handle the error as needed
            } else {
                // Count the number of results
                $resultCount = isset($spoonacularData['results']) ? count($spoonacularData['results']) : 0;

                // Display Spoonacular results in your desired format
                if ($resultCount > 0) {
                    foreach ($spoonacularData['results'] as $recipe) {
                        // Display recipe information as needed
                        echo "Recipe Name: " . $recipe['title'] . "<br>";
                        echo "Recipe ID: " . $recipe['id'] . "<br>";
                        if (isset($recipe['sourceUrl'])) {
                            echo "<a href='" . $recipe['sourceUrl'] . "' target='_blank'>View Recipe</a>";
                        } else {
                            echo "<a href='https://spoonacular.com/recipes/{$recipe['id']}' target='_blank'>View Recipe</a>";
                        }

                        // Check if the recipe is liked
                        $recipeId = $recipe['id'];
                        $likedRecipes = isset($_SESSION['liked_recipes']) ? $_SESSION['liked_recipes'] : [];

                        if (in_array($recipeId, $likedRecipes)) {
                            echo "<p style='color: green;'>You liked this recipe!</p>";
                        } else {
                            // Add the "like" button and the hidden field for recipe ID
                            echo "<form method='POST' action='liked_recipes.php'>";
                            echo "<input type='hidden' name='recipe_id' value='" . $recipeId . "'>";
                            echo "<button type='submit' name='like'>Like This Recipe</button>";
                            echo "</form>";
                        }

                        echo "<hr>";
                    }
                } else {
                    echo "No recipes found.";
                }
            }
        } else {
            echo "Error retrieving Spoonacular data. Response: " . $spoonacularResponse;
        }
    }
}

require_once(__DIR__ . "/../../partials/footer.php");
?>

<!-- Add the HTML form for the search button -->
<form method="GET">
    <input type="text" name="search" placeholder="Search for recipes">
    <!-- Add additional form fields for criteria -->
    <input type="text" name="cuisine" placeholder="Cuisine">
    <input type="text" name="diet" placeholder="Diet">
    <!-- Add more fields as needed -->
    <button type="submit">Search</button>
</form>

<!-- Display the number of results -->
<div>
    <p>Number of Results: <?php echo $resultCount; ?></p>
</div>
