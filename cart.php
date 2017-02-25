<?php require 'common/header.php'; ?>

<div class='recent-products'>
  <h1>Your Cart</h1>

  <div class='recent-products-listing'>
    <?php
    // Fetching the cart for the specific user from the database
    $cart = $db->getRow(array('user' => $_COOKIE['user_id']), 'carts', false);

    // Creating an empty array to store the products
    $products = array();

    // Looping through the cart products, and adding each product to the products array
    foreach($cart as $k => $item) {
      $products[$k] = $db->getRow(array('id' => $item['item']), 'items');
      $products[$k]['quantity'] = $item['quantity'];
    }

    foreach($products as $product) { ?>
      <div class='product-square'>
        <img src='uploads/<?php echo $product['image']; ?>' />

        <h2><?php echo $product['name']; ?></h2>
        <h3>(x<?php echo $product['quantity']; ?>) USD <?php echo $product['price'] * $product['quantity']; ?></h3>
        <a href='#' class='remove-from-cart' <?php echo "data-user='{$_COOKIE['user_id']}' data-id='{$product['id']}'"; ?>>Remove from Cart</a>
      </div>
    <?php } ?>
  </div>
</div>
<?php require 'common/footer.php'; ?>
