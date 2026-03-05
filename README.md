# Navex Store

A web-based laptop and spare part store built with native PHP.

## Features
### User
- Browse laptop product catalog
- Send messages to admin (contact form)

### Admin
- Login & logout
- Manage products (CRUD)
- Edit slider & company profile
- Manage customer messages via email

## Tech Stack
- **Backend:** PHP Native
- **Frontend:** Bootstrap 5 + jQuery
- **Database:** MySQL
- **Email:** PHPMailer (SMTP Gmail)

## Installation
1. Clone this repository
2. Import `navex_store.sql` to MySQL
3. Create `class/dbh.php` file:
```php
<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Leave empty for localhost or fill with your DB password
$dbname = 'navex_store';
$connection = new mysqli($host, $user, $pass, $dbname);
```
4. Fill in your email & app password in PHPMailer config
5. Run in browser

## License
© 2025-2026 Diana Tri Asih
