<?php
require __DIR__ . "/../libs/db.php";
$db = new Db();
$user = $_COOKIE['user_id'];
$item = $_POST['id'];

// CHecking if the user already has this item in his cart
if($db->checkRow(array('item' => $item, 'user' => $user), 'carts')) {
  // If he does, just update the row with an increased quantity
  $row = $db->getRow(array('item' => $item, 'user' => $user), 'carts');
  $db->updateValue(array('quantity' => $row['quantity'] + 1), array('id' => $row['id']), 'carts');
}

// Else, we create the entry in his cart
else {
  $db->insert(array('quantity' => 1, 'item' => $item, 'user' => $user), 'carts');
}

echo "Successfully added to cart.";
?>
