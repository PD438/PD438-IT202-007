<?php
require(__DIR__ . "/../../../partials/nav.php");
$TABLE_NAME = "recipes";

// Check if the user has the "Admin" role
if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    redirect("home.php");
}

// Check if the item ID is set in the URL
if (isset($_GET["id"])) {
    $item_id = $_GET["id"];
    function get_item_details($table, $id) {
        global $conn;  // Assuming $conn is your database connection object
    
        $sql = "SELECT * FROM $table WHERE id = $id";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Fetch the item details from the database
    $item = get_item_details($TABLE_NAME, $item_id);

    if (!$item) {
        flash("Item not found", "danger");
        redirect("home.php");
    }
} else {
    flash("Item ID not provided", "danger");
    redirect("home.php");
}

// Update item details when the form is submitted
if (isset($_POST["submit"])) {
    $result = update_data($TABLE_NAME, $_POST, $item_id);
    
    if ($result) {
        flash("Item updated successfully", "success");
    } else {
        flash("Error updating item", "danger");
    }
}

// Get the table definition
$columns = get_columns($TABLE_NAME);
$ignore = ["Item ID","id", "modified", "created"];
?>

<div class="container-fluid">
    <h1>Edit Item</h1>
    <form method="POST">
        <?php foreach ($columns as $index => $column) : ?>
            <?php if (!in_array($column["Field"], $ignore)) : ?>
                <div class="mb-4">
                    <label class="form-label" for="<?php se($column, "Field"); ?>"><?php se($column, "Field"); ?></label>
                    <input class="form-control" id="<?php se($column, "Field"); ?>" type="<?php echo input_map(se($column, "Type", "", false)); ?>" name="<?php se($column, "Field"); ?>" value="<?php echo $item[$column["Field"]]; ?>" />
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <input class="btn btn-primary" type="submit" value="Update" name="submit" />
    </form>
</div>

<?php
require_once(__DIR__ . "/../../../partials/footer.php");
?>