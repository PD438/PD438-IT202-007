<?php
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: " . get_url("home.php")));
}

function insert_recipes_into_db($db, $recipes, $mappings)
{
    // Assuming $mappings contains the mapping between Spoonacular API keys and your table column names

    // Columns in your recipes table
    $columns = implode('title,', array_keys($mappings));

    // Prepare the placeholders for values in the SQL query
    $placeholders = implode(', ', array_fill(0, count($mappings), '?'));

    // Build the SQL query
    $query = "INSERT INTO recipes ($columns) VALUES ($placeholders)";

    // Prepare the statement
    $stmt = $db->prepare($query);

    foreach ($recipes as $recipe) {
        // Bind parameters based on the mappings
        foreach ($mappings as $api_key => $column_name) {
            $stmt->bindValue($api_key, $recipe[$api_key]);
        }

        // Execute the query for each recipe
        $stmt->execute();
    // Adjust the SQL query based on your Spoonacular recipes table
    $query = "INSERT INTO `spoonacular_recipes` ";

    }
}
function get($url, $api_key, $params = [], $headers = [], $api_host = "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com") {
    $ch = curl_init();

    // Build the full URL with parameters if provided
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    // Ensure $headers is an array before merging
    $combinedHeaders = is_array($headers) ? array_merge(["Authorization: $api_key"], $headers) : ["Authorization: $api_key"];

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set the combined headers in the request
    if (!empty($combinedHeaders)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $combinedHeaders);
    }

    // Set the API host if provided
    if (!empty($api_host)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Host: $api_host"]);
    }

    // Execute the cURL session
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        // Handle errors as needed
        echo 'Curl error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Return the response
    return $response;
}

$columns = ['title', 'vegetarian', 'glutenFree', 'pricePerServing', 'unknownColumn'];

// Mappings of columns to actions
$mappings = [
    'title' => 'custom_action_title',
    'vegetarian' => 'custom_action_vegetarian',
    'glutenFree' => 'custom_action_gluten_free',
    'pricePerServing' => 'custom_action_price',
    // ... other mappings ...
];

// Function to perform custom action on the title
function custom_action_title($value)
{
    return strtoupper($value);
}

// Function to perform custom action on the vegetarian property
function custom_action_vegetarian($value)
{
    return $value ? 'Yes' : 'No';
}

// Function to perform custom action on the glutenFree property
function custom_action_gluten_free($value)
{
    return $value ? 'Yes' : 'No';
}

// Function to perform custom action on the pricePerServing property
function custom_action_price($value)
{
    return '$' . number_format($value, 2);
}
    function process_single_recipe($recipe, $columns, $mappings)
{
    foreach ($columns as $column) {
        // Check if the column exists in the recipe
        if (array_key_exists($column, $recipe)) {
            // Check if there is a mapping for the current column
            if (isset($mappings[$column])) {
                // Retrieve the action specified in the mapping
                $action = $mappings[$column];

                // Customize the action based on your requirements
                switch ($action) {
                    case 'custom_action_title':
                        $recipe[$column] = custom_action_title($recipe[$column]);
                        break;
                    case 'custom_action_vegetarian':
                        $recipe[$column] = custom_action_vegetarian($recipe[$column]);
                        break;
                    case 'custom_action_gluten_free':
                        $recipe[$column] = custom_action_gluten_free($recipe[$column]);
                        break;
                    case 'custom_action_price':
                        $recipe[$column] = custom_action_price($recipe[$column]);
                        break;
                    // Add more cases as needed for different actions
                    default:
                        // Handle unknown action or implement a default behavior
                        //Example: log_unknown_action($action);
                        break;
                }
            } else {
                // Handle the case where there is no mapping for the current column
                 //Example: log_unmapped_column($column);
            }
        } else {
            // Handle the case where the column does not exist in the recipe
            //Example: log_missing_column($column);
        }
    }
    // Additional processing or return the modified recipe
    return $recipe;
}// ... rest of the function remains the same


function process_recipes()
{
    // Adjust the Spoonacular API request based on your requirements
    $result = get(
        "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch",
        "ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d",
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
