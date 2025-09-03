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
