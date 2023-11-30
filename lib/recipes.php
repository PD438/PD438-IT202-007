<?php
require_once(__DIR__ . "/../../partials/nav.php");
require_once(__DIR__ . "/../../config/db.php"); // Include your API functions file

// Spoonacular API key
$spoonacularApiKey = "ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d";
function get($url, $apiKey, $params = [], $isRapidAPI = true, $rapidAPIHost = "")
{
    // Construct the URL with parameters
    $url .= '?' . http_build_query($params);

    // Set headers based on whether it's a RapidAPI request or not
    $headers = [
        "x-api-key: " . ($isRapidAPI ? "" : $apiKey),
        "X-RapidAPI-Host: " . ($isRapidAPI ? $rapidAPIHost : "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com"),
        "X-RapidAPI-Key: " . ($isRapidAPI ? $apiKey : "ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d"),
    ];

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
    ]);

    // Execute cURL session
    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        throw new Exception(curl_error($curl));
    }

    // Get HTTP status code
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Close cURL session
    curl_close($curl);

    // Return the response status and body
    return ["status" => $status, "response" => $response];
}
// Fetch recipes from Spoonacular
$result = get(
    "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch",
    $spoonacularApiKey,
    [
        "query" => "pasta",
        "cuisine" => "italian",
        "excludeCuisine" => "greek",
        "diet" => "vegetarian",
        // Add other parameters as needed
    ],
    true, // Set to true for RapidAPI
    "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com"
);

// Process the API response
if (se($result, "status", 400, false) == 200 && isset($result["response"])) {
    $result = json_decode($result["response"], true);
} else {
    $result = [];
}
?>

<div class="container-fluid">
    <h1>Recipes with Pasta - Demo</h1>
    <p>Remember, we typically won't be frequently calling live data from our API, this is merely a quick sample. We'll want to cache data in our DB to save on API quota.</p>
    <div class="row">
        <?php foreach ($result as $recipe) : ?>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="<?php se($recipe["image"]); ?>" class="card-img-top" alt="Recipe Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php se($recipe["title"]); ?></h5>
                        <p class="card-text"><?php se($recipe["summary"]); ?></p>
                        <a href="<?php se($recipe["sourceUrl"]); ?>" class="btn btn-primary">View Recipe</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../../partials/footer.php");
?>
