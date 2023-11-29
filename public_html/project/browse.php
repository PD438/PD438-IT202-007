<?php
require(__DIR__ . "/../../partials/nav.php");
require(__DIR__ . "/../../config/db.php"); // Include your database configuration file

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform a simple query to fetch data from the "Recipe" table
$query = "SELECT * FROM Recipe";
$result = $conn->query($query);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch the data and store it in an array
$recipes = [];
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
}

// Close the database connection
$conn->close();
?>

<div class="container-fluid">
    <div class="container mx-auto">
        <div>
            <?php include(__DIR__ . "/../../partials/search_form.php"); ?>
        </div>
        <div class="row justify-content-center">
            <?php foreach ($recipes as $recipe) : ?>
                <div class="col">
                    <!-- Modify the rendering based on your actual database columns -->
                    <h5><?php echo $recipe['Title']; ?></h5>
                    <p>Ingredients: <?php echo $recipe['Ingredients']; ?></p>
                    <p>Instructions: <?php echo $recipe['Instructions']; ?></p>
                </div>
            <?php endforeach; ?>
            <?php if (empty($recipes)) : ?>
                <div class="col-12">
                    No recipes available
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../../partials/footer.php");
?>