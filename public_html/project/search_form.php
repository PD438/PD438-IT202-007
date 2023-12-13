<?php
require_once(__DIR__ . "/../../partials/nav.php");

// Initialize the variable
$resultCount = 0;
$db = getDB(); 
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
        function insertLikedRecipe($userId, $recipeId)
        {
            $db = getDB();
            
            // Prepare the SQL statement
            $stmt = $db->prepare("INSERT INTO liked_recipes (user_id, RecipeID) VALUES (:user_id, :recipe_id)");
            
            // Bind parameters
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':recipe_id', $recipeId);
            
            // Execute the statement
            $stmt->execute();
        }
        
// // Make Spoonacular API request
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

                $recipeId = $recipe['id'];
                $likedRecipes = isset($_SESSION['liked_recipes']) ? $_SESSION['liked_recipes'] : [];
        
                if (in_array($recipeId, $likedRecipes)) {
                    echo "<p style='color: green;'>You liked this recipe!</p>";
                } else {
                    // Add the "like" button and the hidden field for recipe ID
                    echo "<form method='POST' action='search_form.php'>";
                    echo "<input type='hidden' name='recipe_id' value='" . $recipeId . "'>";
                    echo "<button type='submit' name='like'>Like This Recipe</button>";
                    echo "</form>";
        
                    // Add a check for the form submission and insert the like into the database
                    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['like'])) {
                        // Get the recipe ID from the form submission
                        $likedRecipeId = $_POST['recipe_id'];
        
                        // Insert the like into the liked_recipes table
                        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
                        if ($userId) {
                            insertLikedRecipe($userId, $likedRecipeId);
        
                            // Show the notification when the recipe is liked
                            echo "<script>showNotification('Recipe Liked!');</script>";
                        }
        
                        // Optionally, you can update the session variable to track liked recipes
                        $_SESSION['liked_recipes'][] = $likedRecipeId;
                    }
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
}require_once(__DIR__ . "/../../partials/footer.php");
?>

<!-- Add the HTML form for the search button -->
<form method="GET">
<script>
    function showNotification(message) {
        alert(message);  // You can replace this with a more sophisticated notification library
    }
</script>
    <input type="text" name="search" placeholder="Search for recipes">
    <input type="text" name="cuisine" placeholder="Cuisine">
    <input type="text" name="diet" placeholder="Diet">
    <!-- Add more fields as needed -->
    <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
    <button type="submit">Search</button>
   
</form>

<!-- Display the number of results -->
<div>
    <p>Number of Results: <?php echo $resultCount; ?></p>
</div>
