<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ReWear – Shop Sustainable Fashion</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --green: #2d6a4f;
    --lime:  #74c69d;
    --cream: #fefae0;
    --dark:  #1b1b1b;
    --red:   #e63946;
    --gold:  #f4a261;
  }

  body { font-family: 'DM Sans', sans-serif; background: #f8f9f5; color: var(--dark); }

  /* ---- NAVBAR ---- */
  nav {
    background: var(--green);
    padding: 0 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 20px rgba(0,0,0,0.15);
  }

  .logo {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: #fff;
    text-decoration: none;
  }

  .nav-links { display: flex; gap: 8px; align-items: center; }

  .nav-btn {
    padding: 8px 18px;
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    text-decoration: none;
    transition: all 0.2s;
  }

  .nav-btn.outline { background: transparent; color: #fff; border: 2px solid rgba(255,255,255,0.4); }
  .nav-btn.outline:hover { border-color: #fff; background: rgba(255,255,255,0.1); }
  .nav-btn.solid { background: var(--lime); color: var(--dark); }
  .nav-btn.solid:hover { background: #52b788; }
  .nav-btn.red { background: var(--red); color: #fff; }

  #username-display { color: rgba(255,255,255,0.8); font-size: 0.9rem; }

  /* ---- HERO BANNER ---- */
  .hero {
    background: linear-gradient(135deg, var(--green) 0%, #1b4332 100%);
    color: #fff;
    text-align: center;
    padding: 60px 20px;
    position: relative;
    overflow: hidden;
  }

  .hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2374c69d' fill-opacity='0.08'%3E%3Ccircle cx='30' cy='30' r='15'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
  }

  .hero-content { position: relative; }

  .hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 4vw, 3rem);
    margin-bottom: 12px;
  }

  .hero p { font-size: 1.05rem; opacity: 0.85; max-width: 600px; margin: 0 auto 24px; }

  .eco-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 50px;
    padding: 8px 20px;
    font-size: 0.9rem;
    backdrop-filter: blur(4px);
  }

  /* ---- PROMO BANNER ---- */
  .promo-strip {
    background: var(--gold);
    color: var(--dark);
    text-align: center;
    padding: 12px;
    font-weight: 600;
    font-size: 0.9rem;
  }

  /* ---- FILTERS ---- */
  .filters {
    max-width: 1200px;
    margin: 28px auto 0;
    padding: 0 24px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
  }

  .filter-btn {
    padding: 8px 18px;
    border: 2px solid #ddd;
    border-radius: 50px;
    background: #fff;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.88rem;
    cursor: pointer;
    transition: all 0.2s;
    font-weight: 500;
  }

  .filter-btn.active, .filter-btn:hover {
    background: var(--green);
    color: #fff;
    border-color: var(--green);
  }

  .search-bar {
    margin-left: auto;
    display: flex;
    gap: 8px;
  }

  .search-bar input {
    padding: 8px 16px;
    border: 2px solid #ddd;
    border-radius: 50px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.9rem;
    width: 220px;
  }

  .search-bar input:focus { outline: none; border-color: var(--lime); }

  .search-bar button {
    padding: 8px 18px;
    background: var(--green);
    color: #fff;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
  }

  /* ---- GRID ---- */
  .container { max-width: 1200px; margin: 0 auto; padding: 24px; }

  .grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 24px;
    margin-top: 24px;
  }

  .card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: pointer;
  }

  .card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.12); }

  .card-img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    background: #e8f5e9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
  }

  .eco-tag {
    background: var(--green);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 4px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }

  .card-body { padding: 16px; }

  .card-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 6px; }

  .card-title { font-weight: 600; font-size: 1rem; line-height: 1.3; }

  .card-meta { font-size: 0.82rem; color: #888; margin-bottom: 10px; }
  .card-meta span { margin-right: 8px; }

  .card-price {
    font-family: 'Playfair Display', serif;
    font-size: 1.3rem;
    color: var(--green);
    font-weight: 700;
  }

  .card-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 12px; }

  .seller-name { font-size: 0.8rem; color: #999; }

  .buy-btn {
    padding: 8px 18px;
    background: var(--green);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
  }

  .buy-btn:hover { background: #1b4332; }

  /* ---- SELL MODAL ---- */
  .modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 200;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
  }

  .modal-overlay.active { display: flex; }

  .modal {
    background: #fff;
    border-radius: 20px;
    padding: 36px;
    width: 100%;
    max-width: 520px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 30px 80px rgba(0,0,0,0.2);
  }

  .modal h2 { font-size: 1.4rem; margin-bottom: 24px; color: var(--dark); }

  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

  .form-group { margin-bottom: 16px; }

  label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  input, select, textarea {
    width: 100%;
    padding: 10px 14px;
    border: 2px solid #e8e8e8;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    transition: border-color 0.2s;
  }

  input:focus, select:focus, textarea:focus { outline: none; border-color: var(--lime); }

  .modal-footer { display: flex; gap: 12px; margin-top: 8px; }

  .btn-cancel {
    flex: 1;
    padding: 12px;
    background: #f0f0f0;
    color: #555;
    border: none;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    cursor: pointer;
  }

  .btn-submit {
    flex: 2;
    padding: 12px;
    background: var(--green);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    cursor: pointer;
    font-size: 0.95rem;
    transition: background 0.2s;
  }

  .btn-submit:hover { background: #1b4332; }

  .msg {
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 0.88rem;
    margin-bottom: 14px;
    display: none;
  }

  .msg.error   { background: #fde8e8; color: var(--red); display: block; }
  .msg.success { background: #d8f3dc; color: var(--green); display: block; }

  .empty-state { text-align: center; padding: 60px 20px; color: #aaa; }
  .empty-state .icon { font-size: 3rem; margin-bottom: 12px; }

  /* Sold badge */
  .sold-badge {
    background: #e63946;
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 4px;
  }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav>
  <a class="logo" href="home.php">♻ ReWear</a>
  <div class="nav-links">
    <span id="username-display">Guest</span>
    <button class="nav-btn solid" onclick="openSellModal()">+ Sell</button>
    <a class="nav-btn outline" href="checkout.php">🛒 Cart</a>
    <button class="nav-btn outline" onclick="logout()">Logout</button>
  </div>
</nav>

<!-- HERO -->
<div class="hero">
  <div class="hero-content">
    <h1>Give Clothes a Second Life 🌿</h1>
    <p>Buy and sell pre-loved fashion. Every purchase reduces textile waste and helps the planet.</p>
    <div class="eco-badge">
      ♻ Join 10,000+ eco-conscious shoppers making fashion circular
    </div>
  </div>
</div>

<!-- PROMO STRIP -->
<div class="promo-strip">
  🌎 Did you know? Buying second-hand saves up to <strong>70% CO₂</strong> compared to buying new. Shop smarter. Shop ReWear!
</div>

<!-- FILTERS -->
<div class="filters">
  <button class="filter-btn active" onclick="filterCat('', this)">All</button>
  <button class="filter-btn" onclick="filterCat('tops', this)">Tops</button>
  <button class="filter-btn" onclick="filterCat('bottoms', this)">Bottoms</button>
  <button class="filter-btn" onclick="filterCat('dresses', this)">Dresses</button>
  <button class="filter-btn" onclick="filterCat('jackets', this)">Jackets</button>
  <button class="filter-btn" onclick="filterCat('shoes', this)">Shoes</button>
  <button class="filter-btn" onclick="filterCat('accessories', this)">Accessories</button>
  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search clothing...">
    <button onclick="doSearch()">Search</button>
  </div>
</div>

<!-- PRODUCTS GRID -->
<div class="container">
  <div class="grid" id="productsGrid">
    <div class="empty-state" style="grid-column: 1/-1">
      <div class="icon">👗</div>
      <p>Loading products...</p>
    </div>
  </div>
</div>

<!-- SELL MODAL -->
<div class="modal-overlay" id="sellModal">
  <div class="modal">
    <h2>📦 List an Item for Sale</h2>
    <div class="msg" id="sellMsg"></div>

    <div class="form-group">
      <label>Item Title</label>
      <input type="text" id="sTitle" placeholder="e.g. Blue Denim Jacket">
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Price (₹)</label>
        <input type="number" id="sPrice" placeholder="299">
      </div>
      <div class="form-group">
        <label>Category</label>
        <select id="sCategory">
          <option value="tops">Tops</option>
          <option value="bottoms">Bottoms</option>
          <option value="dresses">Dresses</option>
          <option value="jackets">Jackets</option>
          <option value="shoes">Shoes</option>
          <option value="accessories">Accessories</option>
        </select>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Size</label>
        <select id="sSize">
          <option>XS</option><option>S</option><option>M</option>
          <option>L</option><option>XL</option><option>XXL</option><option>Free Size</option>
        </select>
      </div>
      <div class="form-group">
        <label>Condition</label>
        <select id="sCondition">
          <option value="Like New">Like New</option>
          <option value="Good">Good</option>
          <option value="Fair">Fair</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea id="sDesc" rows="3" placeholder="Describe the item – material, brand, any defects..."></textarea>
    </div>

    <div class="form-group">
      <label>Product Photo</label>
      <input type="file" id="sImage" accept="image/*">
    </div>

    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeSellModal()">Cancel</button>
      <button class="btn-submit" onclick="submitProduct()">List Item ♻</button>
    </div>
  </div>
</div>

<script>
let currentCategory = '';

// Load username
const savedName = sessionStorage.getItem('userName');
if (savedName) document.getElementById('username-display').textContent = '👤 ' + savedName;

// Load products
async function loadProducts(category = '', search = '') {
  const grid = document.getElementById('productsGrid');
  grid.innerHTML = '<div class="empty-state" style="grid-column:1/-1"><div class="icon">⏳</div><p>Loading...</p></div>';

  let url = `products.php?action=list`;
  if (category) url += `&category=${category}`;
  if (search)   url += `&search=${encodeURIComponent(search)}`;

  const res  = await fetch(url);
  const data = await res.json();

  if (!data.products || data.products.length === 0) {
    grid.innerHTML = '<div class="empty-state" style="grid-column:1/-1"><div class="icon">👗</div><p>No items found. Be the first to list!</p></div>';
    return;
  }

  grid.innerHTML = data.products.map(p => `
    <div class="card" onclick="goCheckout(${p.id})">
      <div class="card-img">
        ${p.image && p.image !== 'default.jpg'
          ? `<img src="uploads/${p.image}" alt="${p.title}" style="width:100%;height:100%;object-fit:cover">`
          : '👗'}
      </div>
      <div class="card-body">
        <div class="card-header">
          <span class="card-title">${p.title}</span>
          <span class="eco-tag">♻ Pre-loved</span>
        </div>
        <div class="card-meta">
          <span>📏 ${p.size || 'N/A'}</span>
          <span>✨ ${p.condition_type || 'Good'}</span>
        </div>
        <div style="font-size:0.82rem;color:#666;margin-bottom:8px">${p.description ? p.description.substring(0,80)+'...' : ''}</div>
        <div class="card-footer">
          <div>
            <div class="card-price">₹${parseFloat(p.price).toFixed(0)}</div>
            <div class="seller-name">by ${p.seller_name}</div>
          </div>
          ${p.status === 'sold'
            ? '<span class="sold-badge">SOLD</span>'
            : '<button class="buy-btn" onclick="event.stopPropagation();goCheckout('+p.id+')">Buy Now</button>'}
        </div>
      </div>
    </div>
  `).join('');
}

function goCheckout(id) {
  sessionStorage.setItem('checkoutProductId', id);
  window.location.href = 'checkout.php';
}

function filterCat(cat, btn) {
  currentCategory = cat;
  document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  loadProducts(cat, document.getElementById('searchInput').value);
}

function doSearch() {
  loadProducts(currentCategory, document.getElementById('searchInput').value);
}

document.getElementById('searchInput').addEventListener('keydown', e => {
  if (e.key === 'Enter') doSearch();
});

// Sell modal
function openSellModal() {
  document.getElementById('sellModal').classList.add('active');
}
function closeSellModal() {
  document.getElementById('sellModal').classList.remove('active');
}

async function submitProduct() {
  const msg = document.getElementById('sellMsg');
  msg.className = 'msg';

  const title    = document.getElementById('sTitle').value.trim();
  const price    = document.getElementById('sPrice').value;
  const desc     = document.getElementById('sDesc').value;
  const category = document.getElementById('sCategory').value;
  const size     = document.getElementById('sSize').value;
  const condition= document.getElementById('sCondition').value;
  const imageFile= document.getElementById('sImage').files[0];

  if (!title || !price) {
    msg.className = 'msg error';
    msg.textContent = 'Title and price are required.';
    return;
  }

  const fd = new FormData();
  fd.append('action', 'add');
  fd.append('title', title);
  fd.append('price', price);
  fd.append('description', desc);
  fd.append('category', category);
  fd.append('size', size);
  fd.append('condition_type', condition);
  if (imageFile) fd.append('image', imageFile);

  const res  = await fetch('products.php', { method: 'POST', body: fd });
  const data = await res.json();

  msg.className = 'msg ' + (data.success ? 'success' : 'error');
  msg.textContent = data.message;

  if (data.success) {
    setTimeout(() => {
      closeSellModal();
      loadProducts();
    }, 1500);
  }
}

async function logout() {
  const fd = new FormData();
  fd.append('action', 'logout');
  await fetch('auth.php', { method: 'POST', body: fd });
  sessionStorage.clear();
  window.location.href = 'login.php';
}

loadProducts();
</script>
</body>
</html>
