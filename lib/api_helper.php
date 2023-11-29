require_once(__DIR__ . "/load_api_keys.php");
$api_key = "ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d";
$query_params = [
    'query' => 'pasta',
    'cuisine' => 'italian',
    'excludeCuisine' => 'greek',
    // ... (other parameters)
];

try {
    $response = get(
        "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch",
        "ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d", 
        $query_params
    );

     $response = _sendRequest(
     "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/complexSearch",
    //     "ce921b5120mshc87fd7963cf9bfdp1757a4jsn546e724a2a9d", 
         $query_params
    // );

    // Access the response status and body
    $status = $response['status'];
    $body = $response['response'];

    // Process the API response as needed
    if ($status === 200) {
        // Successfully received data, handle $body as needed
        echo $body;
    } else {
        // Handle error (e.g., display error message)
        echo "Error: $status - $body";
    }
} catch (Exception $e) {
    // Handle exceptions (e.g., display error message)
    echo "Exception: " . $e->getMessage();
}
