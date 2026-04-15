<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ReWear – Login</title>
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
    max-width: 420px;
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

  h2 { font-size: 1.3rem; color: var(--dark); margin-bottom: 24px; font-weight: 600; }

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

  input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e8e8e8;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    transition: border-color 0.2s;
    background: #fafafa;
  }

  input:focus { outline: none; border-color: var(--lime); background: #fff; }

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

  .msg {
    padding: 12px;
    border-radius: 8px;
    font-size: 0.9rem;
    margin-bottom: 16px;
    display: none;
  }

  .msg.error   { background: #fde8e8; color: var(--red); display: block; }
  .msg.success { background: #d8f3dc; color: var(--green); display: block; }

  .signup-link { text-align: center; margin-top: 20px; font-size: 0.9rem; color: #666; }
  .signup-link a { color: var(--green); font-weight: 600; text-decoration: none; }

  .hint {
    background: #f0faf4;
    border: 1px solid #b7e4c7;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 0.82rem;
    color: #555;
    margin-bottom: 20px;
  }
</style>
</head>
<body>

<div class="card">
  <div class="logo">♻ ReWear</div>
  <div class="tagline">Fashion that gives back</div>
  <h2>Sign In</h2>

  <div class="hint">
    🔑 Demo Admin: <strong>admin@rewear.com</strong> / <strong>password</strong>
  </div>

  <div class="msg" id="msg"></div>

  <div class="form-group">
    <label>Email</label>
    <input type="email" id="email" placeholder="you@example.com">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" id="password" placeholder="Your password">
  </div>

  <button class="btn" onclick="login()">Sign In</button>

  <div class="signup-link">New here? <a href="signup.php">Create account</a></div>
</div>

<script>
async function login() {
  const email    = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  const msg      = document.getElementById('msg');

  msg.className = 'msg';

  if (!email || !password) {
    msg.className = 'msg error';
    msg.textContent = 'Please enter email and password.';
    return;
  }

  const fd = new FormData();
  fd.append('action', 'login');
  fd.append('email', email);
  fd.append('password', password);

  const res  = await fetch('auth.php', { method: 'POST', body: fd });
  const data = await res.json();

  msg.className = 'msg ' + (data.success ? 'success' : 'error');
  msg.textContent = data.success ? `Welcome back, ${data.name}! Redirecting...` : data.message;

  if (data.success) {
    setTimeout(() => window.location.href = data.redirect, 1200);
  }
}

document.addEventListener('keydown', e => {
  if (e.key === 'Enter') login();
});
</script>
</body>
</html>
