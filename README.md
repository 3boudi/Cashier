# Sales Management System(still pdf printing)

## 📌 Overview

This project is a **Sales Management System** built using **PHP, MySQL, HTML, CSS, and JavaScript**. It allows users to:

- Add products to a shopping cart.
- Control product quantity while ensuring it does not exceed stock.
- Complete purchases, which deducts stock from the database.
- View sales history.
- Restore previous sales (individual products or entire purchases).

---

## 📸 Screenshots

*(Add images of pages here)*

---

## 📂 Project Structure

```
📁 project-folder
│── 📄 index.html          # Main page (shopping cart and product list)
│── 📄 historique.php      # Sales history page
│── 📄 buy.php             # Handles purchase transactions
│── 📄 restore.php         # Handles sale restoration
│── 📄 confige.php         # Database connection
│── 📁 assets             # Styles, scripts, images
│── 📁 database           # SQL scripts and backups
```

---

## ⚙️ Features

✅ **Product Management**

- Add products to the cart.
- Adjust quantity manually or via "Add" button.
- Cannot exceed available stock.
- Remove products from the cart.

✅ **Purchase & Stock Control**

- Buy button updates database stock.
- Shopping cart clears after purchase.

✅ **Sales History (Historique Page)**

- Displays all completed purchases.
- Shows product name, quantity, total price, and date.
- Allows restoring products or full sales.

✅ **Restore Functionality**

- Restores sold products back to stock.
- Removes the restored sale from history.

---

## 🛠 Installation Guide

1. **Clone the repository:**

   ```bash
   git clone https://github.com/your-repo/Cashier.git
   ```

2. **Import Database:**

   - Open **phpMyAdmin**.
   - Create a database (e.g., `sales_db`).
   - Run the SQL script in `database/sales.sql`.

3. **Configure Database Connection:**

   - Open `confige.php`.
   - Update database credentials:
     ```php
     $db = new PDO("mysql:host=localhost;dbname=sales_db", "root", "");
     ```

4. **Run the Project:**

   - Start a local server (e.g., XAMPP, WAMP, or LAMP).
   - Open `http://localhost/sales-management/index.html` in your browser.

---

## 🗄️ Database Schema

```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    productname VARCHAR(255) NOT NULL,
    Barcode VARCHAR(255) UNIQUE NOT NULL,
    Quantity INT NOT NULL,
    Price DECIMAL(10,2) NOT NULL
);

CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    sale_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

