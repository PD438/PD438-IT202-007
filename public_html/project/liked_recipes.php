<?php
require_once(__DIR__ . "/../../partials/nav.php");

try {
    $db = getDB();

    // Get user ID dynamically (adjust this based on your authentication system)
    $user_id = get_user_id();

    // Retrieve liked recipes for the user from the liked_recipes table
    $stmt = $db->prepare("
        SELECT r.*
        FROM liked_recipes l
        JOIN recipes r ON l.RecipeID = r.RecipeID
        WHERE l.user_id = :user_id
    ");
    $stmt->execute([':user_id' => $user_id]);

    // Fetch the liked recipes as an associative array
    $liked_recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the liked recipes
    echo "<h3>Liked Recipes</h3>";

    if (!empty($liked_recipes)) {
        foreach ($liked_recipes as $recipe) {
            echo "<p>Recipe ID: " . $recipe['RecipeID'] . "</p>";
            echo "<p>Recipe Name: " . $recipe['recipe_name'] . "</p>";

            // Include the "Unlike" button and the hidden field for recipe ID
            echo "<form method='POST' action='liked_recipes.php'>";
            echo "<input type='hidden' name='recipe_id' value='" . $recipe['RecipeID'] . "'>";
            echo "<button type='submit' name='unlike'>Unlike This Recipe</button>";
            echo "</form>";

            echo "<hr>";
        }
    } else {
        echo "Dude go like some recipes.";
    }

    // Form processing for unliking recipes
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['unlike'])) {
        // Form submitted for unliking a recipe
        $recipe_id_to_unlike = $_POST['recipe_id'];

      // Include the "Unlike" button and the hidden field for recipe ID
      echo "<form method='POST' action='liked_recipes.php'>";
      echo "<input type='hidden' name='recipe_id' value='" . $recipe['RecipeID'] . "'>";
      echo "<button type='submit' name='unlike'>Unlike This Recipe</button>";
      echo "</form>";

      echo "<hr>";
        header("Location: liked_recipes.php");
        exit;
    }
} catch (PDOException $e) {
    // Handle or log the exception
    echo 'Error: ' . $e->getMessage();
}

require_once(__DIR__ . "/../../partials/footer.php");
?>
