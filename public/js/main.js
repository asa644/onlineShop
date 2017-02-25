$(function() {
  // If the add to cart button is clicked, an ajax call is made to ajax/addTocart.php with the item id
  $(".add-to-cart").click(function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');

    $.post("ajax/addToCart.php", {id: id}).done(function(data) {
      alert(data);
    });
  });

  // If the remove from cart button is clicked, the item is removed by making an ajax call to ajax/removeFromCart.php
  $(".remove-from-cart").click(function(e) {
    // Prevent default tells the browser to not treat the button clicked as a link and to not do anything
    e.preventDefault();
    var id = $(this).attr('data-id');
    var user = $(this).attr('data-user');
    
    var parent = $(this).parents('.product-square');
    $.post("ajax/removeFromCart.php", {user: user, id: id}).done(function(data) {
      parent.remove();
      alert(data);
    });
  });
});
