<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

function insert_recipes_into_db($db, $recipes, $mappings)
{
    // Adjust the SQL query based on your Spoonacular recipes table
    $query = "INSERT INTO `spoonacular_recipes` ";

    // ... rest of the function remains the same
}

function process_single_recipe($recipe, $columns, $mappings)
{
    // ... rest of the function remains the same
}

function process_recipes()
{
    // Adjust the Spoonacular API request based on your requirements
    $result = get(
        "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch",
        "YOUR_SPOONACULAR_API_KEY",
        ["query" => "pasta", "cuisine" => "italian", "limit" => 10],
        true,
        "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com"
    );

    $status = se($result, "status", 400, false);
    if ($status != 200) {
        // Handle API error
        return;
    }

    // Extract data from the Spoonacular API response
    $data_string = html_entity_decode(se($result, "response", "{}", false));
    $wrapper = "{\"data\":$data_string}";
    $data = json_decode($wrapper, true);
    if (!isset($data["data"])) {
        // Handle invalid API response
        return;
    }

    // Get columns from your Spoonacular recipes table
    $db = getDB();
    $stmt = $db->prepare("SHOW COLUMNS FROM spoonacular_recipes");
    $stmt->execute();
    $columnsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare columns and mappings
    $columns = array_column($columnsData, 'Field');
    $mappings = [];
    foreach ($columnsData as $column) {
        $mappings[$column['Field']] = $column['Type'];
    }

    // Process each recipe
    $recipes = [];
    foreach ($data["data"] as $recipe) {
        $record = process_single_recipe($recipe, $columns, $mappings);
        array_push($recipes, $record);
    }

    // Insert recipes into the database
    insert_recipes_into_db($db, $recipes, $mappings);
}

$action = se($_POST, "action", "", false);
if ($action) {
    switch ($action) {
        case "recipes":
            process_recipes();
            break;
    }
}
?>

<div class="container-fluid">
    <h1>Spoonacular Recipe Data Management</h1>
    <div class="row">
        <div class="col">
            <!-- Recipe refresh button -->
            <form method="POST">
                <input type="hidden" name="action" value="recipes" />
                <input type="submit" class="btn btn-primary" value="Refresh Recipes" />
            </form>
        </div>
    </div>
</div>
