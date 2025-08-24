/* Simple client-side cart system for Studiova */
(function () {
  const STORAGE_KEYS = {
    CART: 'studiova_cart',
    COUNT: 'studiova_cart_count'
  };

  // Product catalog (now 20 products)
  window.STUDIOVA_PRODUCTS = [
    {id:'product1', name:'Modern Wooden Chair', price:129.99, image:'assets/images/products/product1.jpg', category:'Chairs', description:'A sleek wooden chair with a natural finish and comfortable design.'},
    {id:'product2', name:'Stylish Table Lamp', price:59.99, image:'assets/images/products/product2.jpg', category:'Lighting', description:'Minimalist lamp with warm ambient light, perfect for desks.'},
    {id:'product3', name:'Cozy 3-Seater Sofa', price:799.99, image:'assets/images/products/product3.jpg', category:'Sofas', description:'Comfort meets style in this upholstered 3-seater sofa.'},
    {id:'product4', name:'Oak Dining Table', price:349.99, image:'assets/images/products/product4.jpg', category:'Tables', description:'Solid oak dining table for gatherings and daily meals.'},
    {id:'product5', name:'Minimal Bookshelf', price:149.99, image:'assets/images/products/product5.jpg', category:'Shelves', description:'Open frame shelf for books and decor in any room.'},
    {id:'product6', name:'Ergo Office Desk', price:229.99, image:'assets/images/products/product6.jpg', category:'Desks', description:'Ergonomic desk with cable management and sturdy build.'},
    {id:'product7', name:'Solid Wood Bed Frame', price:699.99, image:'assets/images/products/product7.jpg', category:'Beds', description:'Durable wooden bed frame with clean lines.'},
    {id:'product8', name:'Round Coffee Table', price:179.99, image:'assets/images/products/product8.jpg', category:'Tables', description:'Round coffee table with beveled edge and stable base.'},
    {id:'product9', name:'Tall Floor Lamp', price:89.99, image:'assets/images/products/product9.jpg', category:'Lighting', description:'Tall floor lamp with soft diffused light for living rooms.'},
    {id:'product10', name:'Linen Armchair', price:249.99, image:'assets/images/products/product10.jpg', category:'Chairs', description:'Cozy armchair with linen fabric and wooden legs.'},
    {id:'product11', name:'Compact Nightstand', price:99.99, image:'assets/images/products/product11.jpg', category:'Storage', description:'Nightstand with drawer and shelf for compact storage.'},
    {id:'product12', name:'Floating Wall Shelf', price:74.99, image:'assets/images/products/product12.jpg', category:'Shelves', description:'Floating wall shelf to display decor or store essentials.'},
    
    // Added products
    {id:'product13', name:'Glass Coffee Table', price:199.99, image:'assets/images/products/product1.jpg', category:'Tables', description:'Modern glass coffee table with sleek legs.'},
    {id:'product14', name:'Leather Recliner Chair', price:459.99, image:'assets/images/products/product2.jpg', category:'Chairs', description:'Luxury recliner chair with premium leather finish.'},
    {id:'product15', name:'Wall Mounted TV Unit', price:299.99, image:'assets/images/products/product3.jpg', category:'Storage', description:'TV unit with shelves and cabinets for modern living rooms.'},
    {id:'product16', name:'Classic Wooden Wardrobe', price:649.99, image:'assets/images/products/product4.jpg', category:'Storage', description:'Spacious wardrobe with multiple compartments.'},
    {id:'product17', name:'Modern Study Table', price:199.99, image:'assets/images/products/product5.jpg', category:'Desks', description:'Study table with storage and durable build.'},
    {id:'product18', name:'Upholstered Bed', price:899.99, image:'assets/images/products/product6.jpg', category:'Beds', description:'Queen size upholstered bed with tufted headboard.'},
    {id:'product19', name:'Designer Floor Rug', price:129.99, image:'assets/images/products/product7.jpg', category:'Decor', description:'Soft designer rug perfect for living rooms and bedrooms.'},
    {id:'product20', name:'Wooden Dining Chairs (Set of 4)', price:399.99, image:'assets/images/products/product8.jpg', category:'Chairs', description:'Set of 4 sturdy wooden dining chairs.'}
    
  ];

  function getCart() {
    try { return JSON.parse(localStorage.getItem(STORAGE_KEYS.CART)) || []; }
    catch(e){ return []; }
  }
  function saveCart(cart) {
    localStorage.setItem(STORAGE_KEYS.CART, JSON.stringify(cart));
    updateCartBadge();
  }
  function addToCart(id, qty=1) {
    const cart = getCart();
    const item = cart.find(x => x.id === id);
    if (item) item.qty += qty;
    else cart.push({id, qty});
    saveCart(cart);
    alert('Added to cart!');
  }
  function removeFromCart(id) {
    const cart = getCart().filter(x => x.id !== id);
    saveCart(cart);
  }
  function setQty(id, qty) {
    const cart = getCart();
    const item = cart.find(x => x.id === id);
    if (item) {
      item.qty = Math.max(1, qty|0);
      saveCart(cart);
    }
  }
  function clearCart() {
    localStorage.removeItem(STORAGE_KEYS.CART);
    updateCartBadge();
  }
  function getProductById(id) {
    return window.STUDIOVA_PRODUCTS.find(p => p.id === id);
  }
  function cartCount() {
    return getCart().reduce((a,c)=>a+c.qty,0);
  }
  function updateCartBadge() {
    const count = cartCount();
    document.querySelectorAll('[data-cart-count]').forEach(el => el.textContent = count);
  }

  // Expose to global scope
  window.StudiovaCart = { getCart, saveCart, addToCart, removeFromCart, setQty, clearCart, getProductById, updateCartBadge, cartCount };

  // Initialize badge on load
  document.addEventListener('DOMContentLoaded', updateCartBadge);
})();
