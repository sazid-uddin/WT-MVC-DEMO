# MVC Demo (Simple User Management)

This is a complete MVC example using plain PHP and the mysqli extension, following the MVC architecture pattern with proper separation of concerns.

## Project Structure

```
/mvc
├── index.php                 # Front controller and router
├── .htaccess                 # URL rewriting rules
├── setup.sql                 # Database setup script
├── config/
│   └── database.php          # Database connection class
├── models/
│   └── User.php              # User model (data layer)
├── controllers/
│   └── UserController.php    # User controller (business logic)
├── views/
│   ├── layouts/
│   │   ├── header.php        # Common header layout
│   │   └── footer.php        # Common footer layout
│   ├── users/
│   │   ├── index.php         # Users list view
│   │   └── create.php        # Create user form view
│   └── errors/
│       ├── 404.php           # 404 error page
│       └── 500.php           # 500 error page
└── README.md
```

## Features

-   **View Users**: Display all users in a responsive table with Bootstrap styling
-   **Add New User**: Form to create new users with validation
-   **Form Validation**: Server-side validation with error display
-   **Responsive Design**: Mobile-friendly interface using Bootstrap 5
-   **Error Handling**: Custom 404 and 500 error pages
-   **Clean URLs**: SEO-friendly URLs using Apache mod_rewrite
-   **Security**: Input sanitization and prepared statements

## Setup Instructions

1. **Database Setup**:

    - Start XAMPP (Apache + MySQL)
    - Import `setup.sql` into MySQL (creates `mvc_demo` database and `users` table)
    - Or run: `mysql -u root -p < setup.sql`

2. **Web Server Setup**:

    - Place this project in your webroot: `c:\xampp\htdocs\mvc`
    - Ensure Apache mod_rewrite is enabled for clean URLs

3. **Configuration**:

    - Database credentials in `config/database.php` default to:
        - Host: `localhost`
        - Username: `root`
        - Password: `` (empty)
        - Database: `mvc_demo`

4. **Access the Application**:
    - **Home (Users List)**: `http://localhost/mvc/`
    - **Add New User**: `http://localhost/mvc/create`

## Routes

-   `GET /mvc/` → UserController::index() → Display users list
-   `GET /mvc/create` → UserController::create() → Show create user form
-   `POST /mvc/store` → UserController::store() → Process form submission

## Technologies Used

-   **Backend**: PHP 7.4+ with mysqli extension
-   **Database**: MySQL 5.7+
-   **Frontend**: HTML5, CSS3, Bootstrap 5.1.3
-   **Web Server**: Apache with mod_rewrite

## Notes

-   This demo follows MVC architectural principles with clear separation of concerns
-   Uses prepared statements for database security
-   Implements proper error handling and validation
-   Responsive design works on mobile and desktop
-   No external frameworks - pure PHP implementation
-   Session-based success message display

## What `.htaccess` Does

The `.htaccess` file is an Apache web server configuration file that controls how your web server handles requests for your MVC application. Here's what each part does:

### 1. URL Rewriting (MVC Routing)

**Purpose:** Implements "pretty URLs" and enables MVC routing.

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

- `RewriteEngine On`: Enables Apache's URL rewriting module.
- `RewriteCond %{REQUEST_FILENAME} !-f`: Only rewrite if the requested file doesn't exist.
- `RewriteCond %{REQUEST_FILENAME} !-d`: Only rewrite if the requested directory doesn't exist.
- `RewriteRule ^(.*)$ index.php [QSA,L]`: Redirects all requests to `index.php`.
	- `QSA`: Query String Append (preserves GET parameters).
	- `L`: Last rule (stop processing other rules).

**Example:**  
A request to `yoursite.com/users/create` gets internally redirected to `yoursite.com/index.php`, where your MVC router can parse the URL and route it to the appropriate controller.

### 2. Security Protection

**Purpose:** Prevents direct access to sensitive files via web browser.

```apache
# Block access to .sql files
<FilesMatch "\.sql$">
	Order deny,allow
	Deny from all
</FilesMatch>

# Block access to configuration files
<Files "config/database.php">
	Order allow,deny
	Deny from all
</Files>
```

- Blocks access to any `.sql` files (like your `setup.sql`).
- Blocks direct access to configuration files in the `config` directory.
- If someone tries to access `yoursite.com/setup.sql` or `yoursite.com/config/database.php`, they'll get a 403 Forbidden error.

### 3. Optional HTTPS Redirect (Currently Commented Out)

**Purpose:** Would force all HTTP requests to redirect to HTTPS (currently disabled).

```apache
# Uncomment to force HTTPS
# RewriteCond %{HTTPS} off
# RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

### How This Supports Your MVC Structure

This `.htaccess` configuration is essential for your MVC framework because:

- **Clean URLs:** Instead of `yoursite.com/index.php?route=users/create`, users see `yoursite.com/users/create`.
- **Single Entry Point:** All requests go through `index.php`, which acts as your front controller.
- **Security:** Protects your database configuration and SQL files from direct access.
- **Static Files:** CSS, JS, images still work normally because of the "file exists" conditions.

Without this `.htaccess` file, your MVC routing wouldn't work properly and users would need to access everything through `index.php` directly.
