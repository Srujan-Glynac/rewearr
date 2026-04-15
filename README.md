# ♻ ReWear – Circular Fashion Platform

A second-hand clothing buy/sell platform built with PHP, MySQL, and vanilla HTML/CSS/JS.

---

## 📁 Project Structure

```
rewear/
├── index.php          → Redirects to login
├── signup.php         → Registration page
├── login.php          → Login page
├── home.php           → Product listing + sell modal
├── checkout.php       → Checkout & order placement
├── config.php         → DB connection
├── auth.php           → Login/register/logout API
├── products.php       → Products list/add API
├── orders.php         → Order placement API
├── admin_api.php      → Admin data API
├── database.sql       → DB setup script
├── uploads/           → Product images (auto-created)
└── admin/
    └── index.php      → Admin dashboard
```

---

## 🚀 Setup on XAMPP

### Step 1 – Place files
Copy the entire `rewear/` folder to:
```
C:\xampp\htdocs\rewear\
```

### Step 2 – Start XAMPP
- Start **Apache** and **MySQL** from XAMPP Control Panel

### Step 3 – Create the Database
1. Open browser → go to `http://localhost/phpmyadmin`
2. Click **Import** tab
3. Choose file → select `rewear/database.sql`
4. Click **Go**

OR paste the SQL manually in the SQL tab.

### Step 4 – Run the App
Open browser and go to:
```
http://localhost/rewear/
```

---

## 🔑 Default Login

| Role  | Email              | Password  |
|-------|--------------------|-----------|
| Admin | admin@rewear.com   | password  |

---

## 📄 Pages

| Page           | URL                              |
|----------------|----------------------------------|
| Sign Up        | /rewear/signup.php               |
| Login          | /rewear/login.php                |
| Home / Shop    | /rewear/home.php                 |
| Checkout       | /rewear/checkout.php             |
| Admin Panel    | /rewear/admin/index.php          |

---

## ✨ Features

- **Sign Up / Login** – Register as buyer or seller
- **Home Page** – Browse all second-hand listings with category filters & search
- **Sell Feature** – Sellers can upload photo, set price, category, size, condition
- **Eco Promo Messages** – Every product shows circular fashion impact message
- **Checkout** – Enter delivery details and place order
- **Admin Panel** – Dashboard with stats, manage products/users/orders

---

## 🛠 Tech Stack

- **Frontend**: HTML5, CSS3, Vanilla JavaScript
- **Backend**: PHP 7+
- **Database**: MySQL (via XAMPP)
- **Image Upload**: PHP file upload → `/uploads/` folder
