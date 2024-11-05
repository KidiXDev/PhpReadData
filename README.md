# PhpReadData

PhpReadData is a simple native CRUD (Create, Read, Update, Delete) application built using PHP and MySQL. This project demonstrates basic operations on a database, including searching, pagination, and data formatting.

## Features

- **Create**: Add new items
- **Read**: View a list of items with pagination and search functionality.
- **Update**: Edit existing items.
- **Delete**: Remove items from the database.

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (e.g., Apache)

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/KidiXDev/PhpReadData.git
   ```

2. Navigate to the project directory:

   ```bash
   cd PhpReadData
   ```

3. Import the database:

   - Create a database named `php_read_data`.
   - Import the `php_read_data.sql` file located in the project directory into your database.

4. Update the database configuration:

   - Open `koneksi.php` and update the `$servername`, `$username`, `$password`, and `$dbname` variables with your database credentials.

5. Start your web server and navigate to the project directory in your browser:
   ```bash
   http://localhost/PhpReadData
   ```

## File Structure

- `index.php`: Main page displaying the list of items with pagination and search functionality.
- `edit.php`: Page for editing existing items.
- `add.php`: Page for adding new items.
- `delete.php`: Script for deleting items.
- `koneksi.php`: Database connection script.
- `scripts/convert.js`: JavaScript file for handling any client-side data conversion.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
