<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ReWear – Admin Panel</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
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

  body { font-family: 'DM Sans', sans-serif; background: #f0f2f0; color: var(--dark); display: flex; min-height: 100vh; }

  /* SIDEBAR */
  .sidebar {
    width: 230px;
    background: var(--dark);
    min-height: 100vh;
    padding: 28px 0;
    flex-shrink: 0;
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
  }

  .sidebar-logo {
    font-family: 'Playfair Display', serif;
    font-size: 1.4rem;
    color: var(--lime);
    padding: 0 24px 24px;
    border-bottom: 1px solid #333;
    margin-bottom: 16px;
  }

  .sidebar-menu { list-style: none; }

  .sidebar-menu li a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 13px 24px;
    color: #aaa;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.92rem;
    transition: all 0.2s;
    cursor: pointer;
  }

  .sidebar-menu li a:hover,
  .sidebar-menu li a.active {
    background: #2a2a2a;
    color: var(--lime);
    border-right: 3px solid var(--lime);
  }

  .sidebar-menu li a span.icon { font-size: 1.1rem; }

  /* MAIN */
  .main { flex: 1; padding: 32px; overflow: auto; }

  .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
  }

  .page-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--dark);
  }

  .logout-btn {
    padding: 8px 18px;
    background: var(--red);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-weight: 600;
    cursor: pointer;
  }

  /* STATS */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 32px;
  }

  .stat-card {
    background: #fff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
  }

  .stat-label { font-size: 0.82rem; color: #888; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }

  .stat-value {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    color: var(--green);
  }

  /* TABLE */
  .table-card {
    background: #fff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    margin-bottom: 28px;
  }

  .table-card h2 { font-size: 1.1rem; margin-bottom: 18px; color: var(--dark); }

  table { width: 100%; border-collapse: collapse; }

  th, td {
    padding: 12px 14px;
    text-align: left;
    font-size: 0.88rem;
    border-bottom: 1px solid #f0f0f0;
  }

  th {
    background: #f8f9f5;
    font-weight: 700;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #888;
  }

  tr:last-child td { border-bottom: none; }
  tr:hover td { background: #f8f9f5; }

  .badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
  }

  .badge.active  { background: #d8f3dc; color: var(--green); }
  .badge.sold    { background: #fde8e8; color: var(--red); }
  .badge.pending { background: #fff3cd; color: #856404; }
  .badge.buyer   { background: #e3f2fd; color: #1565c0; }
  .badge.seller  { background: #f3e5f5; color: #6a1b9a; }
  .badge.admin   { background: #fde8e8; color: var(--red); }

  .section { display: none; }
  .section.active { display: block; }

  .delete-btn {
    padding: 5px 12px;
    background: var(--red);
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.8rem;
    font-family: 'DM Sans', sans-serif;
  }
</style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-logo">♻ Admin</div>
  <ul class="sidebar-menu">
    <li><a onclick="showSection('dashboard')" class="active"><span class="icon">📊</span> Dashboard</a></li>
    <li><a onclick="showSection('products')"><span class="icon">👗</span> Products</a></li>
    <li><a onclick="showSection('users')"><span class="icon">👥</span> Users</a></li>
    <li><a onclick="showSection('orders')"><span class="icon">📦</span> Orders</a></li>
    <li><a href="../home.php"><span class="icon">🏠</span> View Site</a></li>
  </ul>
</aside>

<!-- MAIN -->
<main class="main">
  <div class="page-header">
    <h1 id="pageTitle">Dashboard</h1>
    <button class="logout-btn" onclick="logout()">Logout</button>
  </div>

  <!-- DASHBOARD -->
  <div class="section active" id="dashboard">
    <div class="stats-grid" id="statsGrid">
      <div class="stat-card"><div class="stat-label">Total Users</div><div class="stat-value" id="statUsers">–</div></div>
      <div class="stat-card"><div class="stat-label">Products Listed</div><div class="stat-value" id="statProducts">–</div></div>
      <div class="stat-card"><div class="stat-label">Orders Placed</div><div class="stat-value" id="statOrders">–</div></div>
      <div class="stat-card"><div class="stat-label">Items Sold</div><div class="stat-value" id="statSold">–</div></div>
    </div>
    <div class="table-card">
      <h2>♻ Circular Fashion Impact</h2>
      <p style="font-size:0.9rem;color:#555;line-height:1.7">
        Every item sold on ReWear saves approx. <strong>3 kg CO₂</strong> and <strong>2,700 L water</strong>.
        With <span id="impactCount">0</span> items sold, the community has collectively saved 
        <strong id="co2Saved">0 kg</strong> of CO₂ and <strong id="waterSaved">0 L</strong> of water. 🌍
      </p>
    </div>
  </div>

  <!-- PRODUCTS -->
  <div class="section" id="products">
    <div class="table-card">
      <h2>All Products</h2>
      <table>
        <thead><tr><th>#</th><th>Title</th><th>Price</th><th>Category</th><th>Size</th><th>Status</th><th>Seller</th><th>Date</th><th>Action</th></tr></thead>
        <tbody id="productsTable"><tr><td colspan="9" style="text-align:center;color:#aaa">Loading...</td></tr></tbody>
      </table>
    </div>
  </div>

  <!-- USERS -->
  <div class="section" id="users">
    <div class="table-card">
      <h2>All Users</h2>
      <table>
        <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Joined</th></tr></thead>
        <tbody id="usersTable"><tr><td colspan="5" style="text-align:center;color:#aaa">Loading...</td></tr></tbody>
      </table>
    </div>
  </div>

  <!-- ORDERS -->
  <div class="section" id="orders">
    <div class="table-card">
      <h2>All Orders</h2>
      <table>
        <thead><tr><th>#</th><th>Product</th><th>Buyer</th><th>Total</th><th>Status</th><th>Date</th></tr></thead>
        <tbody id="ordersTable"><tr><td colspan="6" style="text-align:center;color:#aaa">Loading...</td></tr></tbody>
      </table>
    </div>
  </div>

</main>

<script>
function showSection(name) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.getElementById(name).classList.add('active');
  document.querySelectorAll('.sidebar-menu li a').forEach(a => a.classList.remove('active'));
  event.target.classList.add('active');
  document.getElementById('pageTitle').textContent = name.charAt(0).toUpperCase() + name.slice(1);

  if (name === 'products') loadAdminProducts();
  if (name === 'users')    loadAdminUsers();
  if (name === 'orders')   loadAdminOrders();
}

async function loadDashboard() {
  const res  = await fetch('../admin_api.php?action=stats');
  const data = await res.json();
  if (!data.success) return;
  const s = data.stats;
  document.getElementById('statUsers').textContent    = s.users;
  document.getElementById('statProducts').textContent = s.products;
  document.getElementById('statOrders').textContent   = s.orders;
  document.getElementById('statSold').textContent     = s.sold;
  document.getElementById('impactCount').textContent  = s.sold;
  document.getElementById('co2Saved').textContent     = (s.sold * 3) + ' kg';
  document.getElementById('waterSaved').textContent   = (s.sold * 2700).toLocaleString() + ' L';
}

async function loadAdminProducts() {
  const res  = await fetch('../admin_api.php?action=products');
  const data = await res.json();
  const tbody = document.getElementById('productsTable');
  if (!data.products || !data.products.length) {
    tbody.innerHTML = '<tr><td colspan="9" style="text-align:center;color:#aaa">No products</td></tr>';
    return;
  }
  tbody.innerHTML = data.products.map(p => `
    <tr>
      <td>${p.id}</td>
      <td>${p.title}</td>
      <td>₹${parseFloat(p.price).toFixed(0)}</td>
      <td>${p.category}</td>
      <td>${p.size}</td>
      <td><span class="badge ${p.status}">${p.status}</span></td>
      <td>${p.seller_name}</td>
      <td>${p.created_at.substring(0,10)}</td>
      <td><button class="delete-btn" onclick="deleteProduct(${p.id})">Delete</button></td>
    </tr>
  `).join('');
}

async function loadAdminUsers() {
  const res  = await fetch('../admin_api.php?action=users');
  const data = await res.json();
  const tbody = document.getElementById('usersTable');
  if (!data.users || !data.users.length) {
    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;color:#aaa">No users</td></tr>';
    return;
  }
  tbody.innerHTML = data.users.map(u => `
    <tr>
      <td>${u.id}</td>
      <td>${u.name}</td>
      <td>${u.email}</td>
      <td><span class="badge ${u.role}">${u.role}</span></td>
      <td>${u.created_at.substring(0,10)}</td>
    </tr>
  `).join('');
}

async function loadAdminOrders() {
  const res  = await fetch('../admin_api.php?action=orders');
  const data = await res.json();
  const tbody = document.getElementById('ordersTable');
  if (!data.orders || !data.orders.length) {
    tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#aaa">No orders</td></tr>';
    return;
  }
  tbody.innerHTML = data.orders.map(o => `
    <tr>
      <td>${o.id}</td>
      <td>${o.product_title}</td>
      <td>${o.buyer_name}</td>
      <td>₹${parseFloat(o.total_price).toFixed(0)}</td>
      <td><span class="badge ${o.status}">${o.status}</span></td>
      <td>${o.created_at.substring(0,10)}</td>
    </tr>
  `).join('');
}

async function deleteProduct(id) {
  if (!confirm('Delete this product?')) return;
  const fd = new FormData();
  fd.append('action', 'delete_product');
  fd.append('id', id);
  const res  = await fetch('../admin_api.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.success) loadAdminProducts();
  else alert('Failed to delete');
}

async function logout() {
  const fd = new FormData();
  fd.append('action', 'logout');
  await fetch('../auth.php', { method: 'POST', body: fd });
  window.location.href = '../login.php';
}

loadDashboard();
</script>
</body>
</html>
