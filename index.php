<?php require 'common/header.php'; ?>

<div class='recent-products'>
  <h1>Recent Products</h1>

  <div class='recent-products-listing'>
    <?php
    // Fetches all the products from the database
    // Loops over them, but when 4 products are shown, the loop stops
    $products = $db->fetchAllRows('items', 'id', 'desc');
    foreach($products as $k => $product) {
      if($k >= 4) break; ?>
      <div class='product-square'>
        <img src='uploads/<?php echo $product['image']; ?>' />

        <h2><?php echo $product['name']; ?></h2>
        <h3>USD <?php echo $product['price']; ?></h3>
        <a href='#' class='add-to-cart' <?php echo "data-id='{$product['id']}'"; ?>>Add to Cart</a>
      </div>
    <?php } ?>
  </div>
</div>

<?php require 'common/footer.php'; ?>
