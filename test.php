<?php
echo "<h2>MVC Demo - Setup Test</h2>";

// Test database connection
echo "<h3>Database Connection Test:</h3>";
try {
    require_once 'config/database.php';
    $db = new Database();
    $connection = $db->getConnection();
    
    if ($connection->ping()) {
        echo "<p style='color: green;'>✓ Database connection successful!</p>";
        
        // Test if mvc_demo database exists
        $result = $connection->query("SHOW DATABASES LIKE 'mvc_demo'");
        if ($result && $result->num_rows > 0) {
            echo "<p style='color: green;'>✓ mvc_demo database exists!</p>";
            
            // Test if users table exists
            $result = $connection->query("SHOW TABLES FROM mvc_demo LIKE 'users'");
            if ($result && $result->num_rows > 0) {
                echo "<p style='color: green;'>✓ users table exists!</p>";
                
                // Count users
                $result = $connection->query("SELECT COUNT(*) as count FROM mvc_demo.users");
                $row = $result->fetch_assoc();
                echo "<p style='color: green;'>✓ Found {$row['count']} users in database!</p>";
            } else {
                echo "<p style='color: red;'>✗ users table not found. Please run setup.sql</p>";
            }
        } else {
            echo "<p style='color: red;'>✗ mvc_demo database not found. Please run setup.sql</p>";
        }
    } else {
        echo "<p style='color: red;'>✗ Database connection failed!</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Test Apache mod_rewrite
echo "<h3>URL Rewriting Test:</h3>";
if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'test.php') !== false) {
    echo "<p style='color: orange;'>! You're accessing test.php directly</p>";
    echo "<p>For clean URLs, try: <a href='/mvc/'>http://localhost/mvc/</a></p>";
} else {
    echo "<p style='color: green;'>✓ Clean URLs are working!</p>";
}

echo "<h3>Next Steps:</h3>";
echo "<ul>";
echo "<li><a href='/mvc/'>View Users List</a> (Main application)</li>";
echo "<li><a href='/mvc/create'>Add New User</a></li>";
echo "<li><a href='/mvc/index.php'>Direct access (bypass .htaccess)</a></li>";
echo "</ul>";

echo "<h3>Troubleshooting:</h3>";
echo "<p>If clean URLs don't work:</p>";
echo "<ol>";
echo "<li>Enable mod_rewrite in Apache</li>";
echo "<li>Change AllowOverride to 'All' in httpd.conf</li>";
echo "<li>Or use direct access: <code>http://localhost/mvc/index.php</code></li>";
echo "</ol>";
?>
