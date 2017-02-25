<?php
require __DIR__ . "/../libs/db.php";
$db = new Db();
$item = $_POST['id'];
$user = $_POST['user'];

// Deleting the row with this item from the user's cart.
$db->deleteRow(array('item' => $item, 'user' => $user), 'carts');

echo "Successfully removed from cart.";
?>
