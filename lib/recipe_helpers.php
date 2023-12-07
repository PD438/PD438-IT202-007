<?php

function get_recipes_by_ingredients($ingredients)
{
    $data = [
        "ingredients" => implode(",", $ingredients),
        "number" => 25, // Adjust the number based on your requirements
        "ranking" => 1, // Adjust the ranking parameter as needed
        "ignorePantry" => true
    ];

    // Replace with your actual RapidAPI key
    $results = get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients", "ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d", $data, false);

    if (isset($results) && isset($results["status"]) && $results["status"] == 200) {
        return json_decode($results["response"], true);
    }

    return [];
}

function _store_recipes($recipes)
{   $db = getDB();
    $query = "INSERT INTO recipes (spoonacular_id, title, image, instructions) VALUES ";
    $values = [];
    $placeholders = [];

    foreach ($recipes as $recipe) {
        $placeholders[] = "(:spoonacular_id, :title, :image, :instructions)";
        $values[] = [
            ":spoonacular_id" => $recipe["id"],
            ":title" => $recipe["title"],
            ":image" => $recipe["image"],
            ":instructions" => $recipe["instructions"]
            // Add other fields as needed
        ];
    }

    $query .= implode(',', $placeholders);
    $query .= " ON DUPLICATE KEY UPDATE modified = CURRENT_TIMESTAMP()";

    $stmt = $db->prepare($query);

    foreach ($values as $index => $val) {
        foreach ($val as $key => $v) {
            $stmt->bindValue($key, $v);
        }
    }

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error inserting recipe data: " . var_export($e, true));
    }
    // Modify this function to store recipes in your database
    // Adapt the data structure based on the Spoonacular API response
    // Implement your database insert logic here
}

// Other functions remain the same...

// Example usage:
$ingredients = ["ingredient1", "ingredient2", "ingredient3"];
$recipes = get_recipes_by_ingredients($ingredients);
print_r($recipes);

// Store recipes in the database
_store_recipes($recipes);
