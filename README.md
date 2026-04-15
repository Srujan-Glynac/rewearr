# ReWear – Circular Fashion Platform

A second-hand clothing buy/sell platform built with PHP, MySQL, and vanilla HTML/CSS/JS.

## Project Structure

- `index.php` — redirect to login
- `signup.php` — registration page
- `login.php` — login page
- `home.php` — product listing + sell modal
- `checkout.php` — checkout and order placement
- `config.php` — database connection
- `auth.php` — login/register/logout API
- `products.php` — products list/add API
- `orders.php` — order placement API
- `admin_api.php` — admin data API
- `database.sql` — database setup script
- `uploads/` — product images (auto-created)
- `admin/index.php` — admin dashboard

## Setup on XAMPP

1. Copy the entire repository folder to:
   `C:\xampp\htdocs\rewearr`
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Create a new MySQL database for the app.
4. Import `database.sql` into the new database.
5. Update `config.php` with your database credentials.
6. Open `http://localhost/rewearr/` in your browser.

## Notes

- The `uploads/` directory is used for product images and should be writable by the web server.
- Do not commit development files, logs, or local environment files.
