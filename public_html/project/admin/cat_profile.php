<?php
// Include navigation and check for Admin role
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

// Initialize variables
$id = (int)se($_GET, "id", 0, false);
$recipe = [];

// Handle Spoonacular API request
if ($id > 0) {
    $curl = curl_init();

    // Replace YOUR_API_KEY with your actual API key
    $api_key = "";
    $recipe_id = $id;

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/$recipe_id/information",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: spoonacular-recipe-food-nutrition-v1.p.rapidapi.com",
            "X-RapidAPI-Key: $api_key"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $recipe = json_decode($response, true);
    }
}

$data = $_GET;
unset($data["id"]);
$back = "admin/list_cats.php?" . http_build_query($data);
?>

<div class="container-fluid">
    <h1>Recipe Details</h1>
    <a class="btn btn-secondary" href="<?php get_url($back, true); ?>">Back</a>
    <?php if (!empty($recipe)) : ?>
        <h2><?php echo $recipe['title']; ?></h2>
        <p><?php echo $recipe['instructions']; ?></p>
        <!-- Display other recipe details as needed -->
    <?php else : ?>
        <p>No recipe details found.</p>
    <?php endif; ?>
</div>

<?php
// Include footer
require_once(__DIR__ . "/../../../partials/footer.php");
?>