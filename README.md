# PhpReadData

**PhpReadData** is a powerful, straightforward CRUD (Create, Read, Update, Delete) application built with **native PHP** and **MySQL**. This project provides all essential database operations with features like **searching**, **pagination**, **sorting**, and **data filtering** for enhanced usability. With **user authentication** through login and session management, PhpReadData ensures secure access control.

## ✨ Features

- **Create**: Add new records to your database quickly.
- **Read**: View and navigate through entries with integrated pagination, search, and sorting.
- **Update**: Edit existing records easily.
- **Delete**: Remove records from the database with a single click.
- **Search, Sort & Filter**: Quickly find specific records and organize data by fields.
- **User Authentication**: Restricted access via login, using a predefined admin user.
- **Basic Protection**: Basic security measures to prevent SQL injection, XSS, and some common attacks.
- **Session Timeout**: Automatically log out users after a period of inactivity.
- **Session Manager**: View and manage active sessions securely. (work in progress)
- **Export and Import**: Export data in various formats and import records from a CSV file.
- **Pagination**: Navigate through records with ease, displaying a set number of entries per page.
- **User roles**: Define different user roles and permissions. (work in progress)

## 🔑 Login Credentials

To access PhpReadData, log in using these credentials:

- **Username**: `Useradmin`
- **Password**: `adminUser`

_These credentials are predefined in the `users` table. Please remember to change them in production._

## 🛠 Prerequisites

Ensure your environment has the following:

- PHP 7.4 or higher
- MySQL 5.7 or higher
- A web server like Apache or Nginx

## 🚀 Getting Started

To set up PhpReadData locally, follow these steps:

1. **Clone the repository**:

   ```bash
   git clone https://github.com/KidiXDev/PhpReadData.git
   ```

2. **Navigate to the project directory**:

   ```bash
   cd PhpReadData
   ```

3. **Set up the database**:

   ### Option 1: Import the `.sql` file

   - Create a new MySQL database named `php_read_data`.
   - Import the `php_read_data.sql` file in the project directory to initialize the database structure.

   ### Option 2: Run SQL commands manually

   - Connect to MySQL and create the database and tables manually by executing the following commands:

     ```sql
     -- Create the database
     CREATE DATABASE php_read_data;

     -- Switch to the database
     USE php_read_data;

     -- Create `barang` table
     CREATE TABLE `barang` (
       `id` int NOT NULL,
       `nama_barang` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
       `jumlah` int NOT NULL,
       `harga` int NOT NULL
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

     -- Create `users` table
     CREATE TABLE `users` (
       `id` int NOT NULL,
       `username` varchar(25) NOT NULL,
       `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

     -- Create `sessions` table
     CREATE TABLE `sessions` (
      `id` int NOT NULL,
      `user_id` int NOT NULL,
      `session_id` varchar(255) NOT NULL,
      `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      `expires_at` timestamp NULL DEFAULT NULL
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

     -- Insert the default admin user
     INSERT INTO `users` (`id`, `username`, `password`) VALUES
     (1, 'Useradmin', 'ad173b6d7864f0dbcfcef93fb926cf66');

     -- Set primary keys and auto-increment properties
     ALTER TABLE `barang`
       ADD PRIMARY KEY (`id`);
     ALTER TABLE `users`
       ADD PRIMARY KEY (`id`);
      ALTER TABLE `sessions`
        ADD PRIMARY KEY (`id`),
        ADD UNIQUE KEY `session_id` (`session_id`),
        ADD KEY `user_id` (`user_id`);
     ALTER TABLE `barang`
       MODIFY `id` int NOT NULL AUTO_INCREMENT;
     ALTER TABLE `users`
       MODIFY `id` int NOT NULL AUTO_INCREMENT;
       ALTER TABLE `sessions`
     MODIFY `id` int NOT NULL AUTO_INCREMENT;

     -- Set constraints for the `sessions` table
     ALTER TABLE `sessions`
      ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
     COMMIT;
     ```

4. **Configure the database connection**:

   - Open `.env.example` and update the `$servername`, `$username`, `$password`, and `$dbname` variables with your database credentials. then rename it as `.env`.

5. **Launch the web server** and access the project in your browser:

   ```plaintext
   http://localhost/PhpReadData
   ```

   You’re now ready to log in and manage data!

## 📂 File Structure

- **`index.php`**: The main page, routing requests to appropriate modules.
- **`modules/view/dashboard.php`**: Displays the dashboard.
- **`modules/view/add.php`**: Add new records to the database.
- **`modules/view/edit.php`**: Edit existing records.
- **`modules/view/import.php`**: Import records from a csv file.
- **`modules/delete.php`**: Script to delete specific records.
- **`modules/export.php`**: Export records in various formats.
- **`modules/auth/login.php`**: Handles user authentication.
- **`modules/auth/logout.php`**: Ends user sessions securely.
- **`modules/404.php`**: Custom 404 error page.
- **`config/config.php`**: Database connection file.
- **`config/env.php`**: Environment variables loader.
- **`db/php_read_data.sql`**: SQL file to set up the database.
- **`scripts/convert.js`**: Client-side script for data conversion, if needed.

## 🔒 User Authentication

PhpReadData includes basic login functionality to restrict access. Users need to authenticate with the default admin credentials (`Useradmin` / `adminUser`). Sessions manage the login state securely.

## 📝 License

This project is licensed under the MIT License, allowing you to use, modify, and distribute it freely. For more information, see the [LICENSE](LICENSE) file.

## ❤️ Support Me

If you find this project helpful and would like to support my work, consider buying me a coffee:

<a href="https://www.buymeacoffee.com/kidixdev"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" width="200" /></a>

Thank you for your support!
