<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ReWear – Sign Up</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --green:  #2d6a4f;
    --lime:   #74c69d;
    --cream:  #fefae0;
    --dark:   #1b1b1b;
    --red:    #e63946;
  }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: radial-gradient(circle at 20% 80%, #d8f3dc 0%, transparent 50%),
                      radial-gradient(circle at 80% 20%, #b7e4c7 0%, transparent 50%);
  }

  .card {
    background: #fff;
    border-radius: 20px;
    padding: 48px 40px;
    width: 100%;
    max-width: 440px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.10);
  }

  .logo {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    color: var(--green);
    text-align: center;
    margin-bottom: 4px;
  }

  .tagline {
    text-align: center;
    font-size: 0.85rem;
    color: #888;
    margin-bottom: 32px;
  }

  h2 {
    font-size: 1.3rem;
    color: var(--dark);
    margin-bottom: 24px;
    font-weight: 600;
  }

  .form-group {
    margin-bottom: 18px;
  }

  label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  input, select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e8e8e8;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    transition: border-color 0.2s;
    background: #fafafa;
  }

  input:focus, select:focus {
    outline: none;
    border-color: var(--lime);
    background: #fff;
  }

  .btn {
    width: 100%;
    padding: 14px;
    background: var(--green);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    margin-top: 8px;
    transition: background 0.2s, transform 0.1s;
  }

  .btn:hover { background: #1b4332; transform: translateY(-1px); }
  .btn:active { transform: translateY(0); }

  .msg {
    padding: 12px;
    border-radius: 8px;
    font-size: 0.9rem;
    margin-bottom: 16px;
    display: none;
  }

  .msg.error   { background: #fde8e8; color: var(--red); display: block; }
  .msg.success { background: #d8f3dc; color: var(--green); display: block; }

  .login-link {
    text-align: center;
    margin-top: 20px;
    font-size: 0.9rem;
    color: #666;
  }

  .login-link a { color: var(--green); font-weight: 600; text-decoration: none; }
</style>
</head>
<body>

<div class="card">
  <div class="logo">♻ ReWear</div>
  <div class="tagline">Sustainable fashion starts here</div>
  <h2>Create Account</h2>

  <div class="msg" id="msg"></div>

  <div class="form-group">
    <label>Full Name</label>
    <input type="text" id="name" placeholder="Your name">
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="email" id="email" placeholder="you@example.com">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" id="password" placeholder="Min 6 characters">
  </div>
  <div class="form-group">
    <label>I want to</label>
    <select id="role">
      <option value="buyer">Buy clothes</option>
      <option value="seller">Sell clothes</option>
    </select>
  </div>

  <button class="btn" onclick="register()">Create Account</button>

  <div class="login-link">Already have an account? <a href="login.php">Sign In</a></div>
</div>

<script>
async function register() {
  const name     = document.getElementById('name').value.trim();
  const email    = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  const role     = document.getElementById('role').value;
  const msg      = document.getElementById('msg');

  msg.className = 'msg';

  if (!name || !email || !password) {
    msg.className = 'msg error';
    msg.textContent = 'Please fill in all fields.';
    return;
  }

  const fd = new FormData();
  fd.append('action', 'register');
  fd.append('name', name);
  fd.append('email', email);
  fd.append('password', password);
  fd.append('role', role);

  const res  = await fetch('auth.php', { method: 'POST', body: fd });
  const data = await res.json();

  msg.className = 'msg ' + (data.success ? 'success' : 'error');
  msg.textContent = data.message;

  if (data.success) {
    setTimeout(() => window.location.href = 'login.php', 1500);
  }
}
</script>
</body>
</html>
