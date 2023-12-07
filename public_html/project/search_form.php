<?php
require_once(__DIR__ . "/../../partials/nav.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Check if the form is submitted
    if (isset($_GET["search"])) {
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

            // Display Spoonacular results in your desired format
            if (isset($spoonacularData['results']) && !empty($spoonacularData['results'])) {
                foreach ($spoonacularData['results'] as $recipe) {
                    // Display recipe information as needed
                    echo "Recipe Name: " . $recipe['title'] . "<br>";
                    echo "Recipe ID: " . $recipe['id'] . "<br>";

                    // Check if "sourceUrl" key exists
                    if (isset($recipe['sourceUrl'])) {
                        echo "<a href='" . $recipe['sourceUrl'] . "' target='_blank'>View Recipe</a><br>"; // Add View Recipe link
                    } else {
                        // Fallback: Provide a link to the Spoonacular website with the recipe ID
                        echo "<a href='https://spoonacular.com/recipes/{$recipe['id']}' target='_blank'>View Recipe</a><br>";
                    }

                    echo "<hr>";
                }
            } else {
                echo "No recipes found.";
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
    <button type="submit">Search</button>
</form>
