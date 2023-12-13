<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
</head>
<body>

    <?php
    require(__DIR__ . "/../../partials/nav.php");
    require(__DIR__ . "C:/../../public_html/project/recipes.php");

    function getRecipesFromSpoonacular($apiKey) {
        $curl = curl_init();
        $db = getDB();
        curl_setopt_array($curl, [
            // ... (your existing cURL options remain unchanged)
        ]);
        $result = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err) {
            $decoded_response = json_decode($result, true);
            return $decoded_response;
        } else {
            return [];
        }
    }

    $spoonacularResponse = getRecipesFromSpoonacular("ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d");
    ?>

    <h1>Want More??</h1>

    <!-- Display the link to Spoonacular main site -->
    <a href="https://spoonacular.com/" target="_blank">Visit Spoonacular</a>

    <!-- Display a button to view a specific recipe -->
    <?php
    if (!empty($spoonacularResponse) && isset($spoonacularResponse['results'][0])) {
        $recipeTitle = $spoonacularResponse['results'][0]['title'];
        $recipeUrl = $spoonacularResponse['results'][0]['sourceUrl'];
        echo '<button><a href="' . $recipeUrl . '" target="_blank">View Recipe: ' . $recipeTitle . '</a></button>';
    } else {
        echo '<p>No recipes found.</p>';
    }
    ?>

    <?php
    require_once(__DIR__ . "/../../partials/footer.php");
    ?>

</body>
</html>
