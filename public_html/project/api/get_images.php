<?php
require_once(__DIR__."/../../../lib/functions.php");
$breed_id = se($_GET, "recipes_images_id", -1, false);
$result = get_recipes_by_ingredients($ingredients, true);
echo json_encode($result);
?>
