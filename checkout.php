<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ReWear – Checkout</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --green: #2d6a4f;
    --lime:  #74c69d;
    --cream: #fefae0;
    --dark:  #1b1b1b;
    --red:   #e63946;
  }

  body { font-family: 'DM Sans', sans-serif; background: #f8f9f5; color: var(--dark); }

  nav {
    background: var(--green);
    padding: 0 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.15);
  }

  .logo { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: #fff; text-decoration: none; }

  .back-btn {
    padding: 8px 18px;
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255,255,255,0.4);
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    font-size: 0.9rem;
  }

  .back-btn:hover { border-color: #fff; }

  .container {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
  }

  @media (max-width: 680px) { .container { grid-template-columns: 1fr; } }

  .panel {
    background: #fff;
    border-radius: 20px;
    padding: 32px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
  }

  h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    margin-bottom: 24px;
    color: var(--dark);
  }

  /* Product panel */
  .product-img {
    width: 100%;
    height: 200px;
    border-radius: 12px;
    object-fit: cover;
    background: #e8f5e9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    margin-bottom: 16px;
    overflow: hidden;
  }

  .product-title { font-size: 1.15rem; font-weight: 600; margin-bottom: 8px; }

  .product-meta { font-size: 0.85rem; color: #888; margin-bottom: 12px; }
  .product-meta span { display: inline-block; margin-right: 12px; }

  .product-price {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--green);
  }

  .eco-promo {
    background: linear-gradient(135deg, #d8f3dc, #b7e4c7);
    border-radius: 12px;
    padding: 14px 16px;
    margin-top: 16px;
    font-size: 0.85rem;
    color: #1b4332;
    font-weight: 500;
    line-height: 1.5;
  }

  .eco-promo strong { display: block; margin-bottom: 4px; font-size: 0.9rem; }

  /* Checkout form */
  .form-group { margin-bottom: 18px; }

  label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  input, textarea {
    width: 100%;
    padding: 11px 14px;
    border: 2px solid #e8e8e8;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    transition: border-color 0.2s;
  }

  input:focus, textarea:focus { outline: none; border-color: var(--lime); }

  .divider { border: none; border-top: 2px solid #f0f0f0; margin: 20px 0; }

  .total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    font-size: 0.9rem;
    color: #666;
  }

  .total-row.final {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--dark);
    margin-top: 12px;
  }

  .place-order-btn {
    width: 100%;
    padding: 14px;
    background: var(--green);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    margin-top: 16px;
    transition: background 0.2s, transform 0.1s;
  }

  .place-order-btn:hover { background: #1b4332; transform: translateY(-1px); }

  .msg {
    padding: 12px;
    border-radius: 8px;
    font-size: 0.9rem;
    margin-bottom: 14px;
    display: none;
  }

  .msg.error   { background: #fde8e8; color: var(--red); display: block; }
  .msg.success { background: #d8f3dc; color: var(--green); display: block; }

  .no-product {
    grid-column: 1/-1;
    text-align: center;
    padding: 60px;
    color: #aaa;
  }
</style>
</head>
<body>

<nav>
  <a class="logo" href="home.php">♻ ReWear</a>
  <a class="back-btn" href="home.php">← Back to Shop</a>
</nav>

<div class="container" id="checkoutContent">
  <div class="no-product">Loading...</div>
</div>

<script>
const productId = sessionStorage.getItem('checkoutProductId');

async function loadCheckout() {
  const content = document.getElementById('checkoutContent');

  if (!productId) {
    content.innerHTML = '<div class="no-product"><h2>No item selected</h2><p>Please choose an item from the shop.</p><br><a href="home.php" style="color:#2d6a4f;font-weight:600">← Go to Shop</a></div>';
    return;
  }

  const res  = await fetch(`products.php?action=get&id=${productId}`);
  const data = await res.json();

  if (!data.success) {
    content.innerHTML = '<div class="no-product"><h2>Item not found</h2><a href="home.php" style="color:#2d6a4f;font-weight:600">← Go to Shop</a></div>';
    return;
  }

  const p = data.product;
  const price = parseFloat(p.price);
  const shipping = 49;
  const total = price + shipping;

  content.innerHTML = `
    <div class="panel">
      <h2>Order Summary</h2>
      <div class="product-img">
        ${p.image && p.image !== 'default.jpg'
          ? `<img src="uploads/${p.image}" alt="${p.title}" style="width:100%;height:100%;object-fit:cover">`
          : '👗'}
      </div>
      <div class="product-title">${p.title}</div>
      <div class="product-meta">
        <span>📏 ${p.size || 'N/A'}</span>
        <span>✨ ${p.condition_type || 'Good'}</span>
        <span>👤 ${p.seller_name}</span>
      </div>
      <div class="product-price">₹${price.toFixed(0)}</div>

      <div class="eco-promo">
        <strong>🌿 You're making a difference!</strong>
        Buying pre-loved clothing saves approximately <strong>3 kg of CO₂</strong> and <strong>2,700 litres of water</strong> compared to buying new. Thank you for choosing circular fashion! ♻
      </div>
    </div>

    <div class="panel">
      <h2>Delivery Details</h2>
      <div class="msg" id="checkoutMsg"></div>

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" id="buyerName" placeholder="Your name">
      </div>
      <div class="form-group">
        <label>Phone Number</label>
        <input type="tel" id="phone" placeholder="10-digit mobile number">
      </div>
      <div class="form-group">
        <label>Delivery Address</label>
        <textarea id="address" rows="3" placeholder="Flat/House No, Street, Area, City, Pincode"></textarea>
      </div>

      <hr class="divider">

      <div class="total-row"><span>Item Price</span><span>₹${price.toFixed(0)}</span></div>
      <div class="total-row"><span>Delivery Charge</span><span>₹${shipping}</span></div>
      <div class="total-row final"><span>Total</span><span>₹${total.toFixed(0)}</span></div>

      <button class="place-order-btn" onclick="placeOrder()">
        🛍 Place Order – ₹${total.toFixed(0)}
      </button>
    </div>
  `;
}

async function placeOrder() {
  const name    = document.getElementById('buyerName').value.trim();
  const phone   = document.getElementById('phone').value.trim();
  const address = document.getElementById('address').value.trim();
  const msg     = document.getElementById('checkoutMsg');

  msg.className = 'msg';

  if (!name || !address || !phone) {
    msg.className = 'msg error';
    msg.textContent = 'Please fill in all delivery details.';
    return;
  }

  const fullAddress = `${name}, ${phone}\n${address}`;

  const fd = new FormData();
  fd.append('action', 'place');
  fd.append('product_id', productId);
  fd.append('address', fullAddress);

  const res  = await fetch('orders.php', { method: 'POST', body: fd });
  const data = await res.json();

  msg.className = 'msg ' + (data.success ? 'success' : 'error');
  msg.textContent = data.message;

  if (data.success) {
    sessionStorage.removeItem('checkoutProductId');
    setTimeout(() => window.location.href = 'home.php', 2000);
  }
}

loadCheckout();
</script>
</body>
</html>
