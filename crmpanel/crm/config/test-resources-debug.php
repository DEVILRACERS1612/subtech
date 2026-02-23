<?php
/**
 * Subtech Resources Page - Debug Test File
 * Upload this file to your local root directory and access it
 * URL: http://localhost/subtech/test-resources-debug.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Subtech Resources - Debug Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #e93132; border-bottom: 3px solid #e93132; padding-bottom: 10px; }
        h2 { color: #333; margin-top: 30px; border-left: 4px solid #e93132; padding-left: 10px; }
        .success { color: #28a745; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        .warning { color: #ffc107; font-weight: bold; }
        .info { background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 10px 0; border-left: 4px solid #2196F3; }
        .check-item { padding: 8px; margin: 5px 0; background: #f8f9fa; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        table td, table th { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        table th { background: #e93132; color: white; }
        .code { background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 5px; overflow-x: auto; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Subtech Resources Page - Debug Report</h1>
        <p><strong>Test Date:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        
        <?php
        $all_passed = true;
        
        // TEST 1: Config File
        echo "<h2>1. Configuration File Check</h2>";
        if(file_exists("./config/config.inc.php")){
            echo "<div class='check-item'><span class='success'>✓</span> Config file exists at ./config/config.inc.php</div>";
            include_once "./config/config.inc.php";
            echo "<div class='check-item'><span class='success'>✓</span> Config file loaded successfully</div>";
        } else {
            echo "<div class='check-item'><span class='error'>✗</span> Config file NOT found at ./config/config.inc.php</div>";
            echo "<div class='info'>❗ <strong>SOLUTION:</strong> Check your file path. Config file should be at: ./config/config.inc.php</div>";
            $all_passed = false;
        }
        
        // TEST 2: Database Connection
        echo "<h2>2. Database Connection</h2>";
        if(isset($db) && $db){
            echo "<div class='check-item'><span class='success'>✓</span> Database connected successfully</div>";
            echo "<table>";
            echo "<tr><th>Parameter</th><th>Value</th></tr>";
            echo "<tr><td>Host</td><td>" . (defined('DB_HOST') ? DB_HOST : 'Not defined') . "</td></tr>";
            echo "<tr><td>Database</td><td>" . (defined('DB_NAME') ? DB_NAME : 'Not defined') . "</td></tr>";
            echo "<tr><td>User</td><td>" . (defined('DB_USER') ? DB_USER : 'Not defined') . "</td></tr>";
            echo "</table>";
        } else {
            echo "<div class='check-item'><span class='error'>✗</span> Database connection FAILED</div>";
            if(mysqli_connect_error()){
                echo "<div class='check-item'><span class='error'>Error:</span> " . mysqli_connect_error() . "</div>";
            }
            echo "<div class='info'>❗ <strong>SOLUTION:</strong> Check your database credentials in config.inc.php:<br>";
            echo "<div class='code'>define('DB_HOST', 'localhost');<br>";
            echo "define('DB_USER', 'root');<br>";
            echo "define('DB_PASS', '');<br>";
            echo "define('DB_NAME', 'subtech_db');</div></div>";
            $all_passed = false;
        }
        
        if(isset($db) && $db){
            // TEST 3: Resources Table
            echo "<h2>3. Resources Table Check</h2>";
            $check = $db->query("SHOW TABLES LIKE 'mi_resources'");
            if($check && $check->num_rows > 0){
                echo "<div class='check-item'><span class='success'>✓</span> Resources table (mi_resources) exists</div>";
                
                // Check table structure
                $structure = $db->query("DESCRIBE mi_resources");
                if($structure){
                    echo "<div class='check-item'><span class='success'>✓</span> Table structure accessible</div>";
                    echo "<details><summary>Click to view table structure</summary>";
                    echo "<table><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
                    while($col = $structure->fetch_assoc()){
                        echo "<tr><td>{$col['Field']}</td><td>{$col['Type']}</td><td>{$col['Null']}</td><td>{$col['Key']}</td></tr>";
                    }
                    echo "</table></details>";
                }
                
                // Count records
                $count = $db->query("SELECT COUNT(*) as total FROM mi_resources");
                if($count){
                    $row = $count->fetch_assoc();
                    echo "<div class='check-item'><span class='success'>✓</span> Total resources in table: <strong>" . $row['total'] . "</strong></div>";
                    
                    if($row['total'] == 0){
                        echo "<div class='info'>⚠ <strong>WARNING:</strong> Table exists but has no data. You need to import data from live site.</div>";
                        $all_passed = false;
                    }
                }
            } else {
                echo "<div class='check-item'><span class='error'>✗</span> Resources table does NOT exist</div>";
                echo "<div class='info'>❗ <strong>SOLUTION:</strong> Export mi_resources table from live site and import to local database</div>";
                $all_passed = false;
            }
            
            // TEST 4: Resource Categories
            echo "<h2>4. Resource Categories Check</h2>";
            $cat_tables = ['mi_resource_cat', 'mi_rcat', 'mi_resource_categories'];
            $cat_table_found = false;
            
            foreach($cat_tables as $table){
                $check = $db->query("SHOW TABLES LIKE '$table'");
                if($check && $check->num_rows > 0){
                    echo "<div class='check-item'><span class='success'>✓</span> Categories table ($table) exists</div>";
                    $cat_table_found = true;
                    
                    $result = $db->query("SELECT * FROM $table LIMIT 10");
                    if($result && $result->num_rows > 0){
                        echo "<div class='check-item'><span class='success'>✓</span> Found {$result->num_rows} categories</div>";
                        echo "<ul>";
                        while($cat = $result->fetch_assoc()){
                            $cat_name = isset($cat['cat_name']) ? $cat['cat_name'] : (isset($cat['name']) ? $cat['name'] : 'Unknown');
                            echo "<li>" . htmlspecialchars($cat_name) . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<div class='info'>⚠ Categories table exists but is empty</div>";
                    }
                    break;
                }
            }
            
            if(!$cat_table_found){
                echo "<div class='check-item'><span class='warning'>⚠</span> No category table found (might not be required)</div>";
            }
            
            // TEST 5: Sample Resources Query
            echo "<h2>5. Sample Resources Query</h2>";
            $qr = $db->query("SELECT * FROM mi_resources LIMIT 5");
            if($qr && $qr->num_rows > 0){
                echo "<div class='check-item'><span class='success'>✓</span> Successfully queried resources table</div>";
                echo "<div class='check-item'>Found " . $qr->num_rows . " sample resources:</div>";
                echo "<table><tr><th>ID</th><th>Title</th><th>Type</th><th>Status</th></tr>";
                while($res = $qr->fetch_assoc()){
                    $title = isset($res['title']) ? $res['title'] : (isset($res['name']) ? $res['name'] : 'N/A');
                    $type = isset($res['type']) ? $res['type'] : (isset($res['category']) ? $res['category'] : 'N/A');
                    $status = isset($res['status']) ? $res['status'] : (isset($res['mi_status']) ? $res['mi_status'] : 'N/A');
                    $id = isset($res['id']) ? $res['id'] : 'N/A';
                    echo "<tr><td>$id</td><td>" . htmlspecialchars($title) . "</td><td>$type</td><td>$status</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<div class='check-item'><span class='error'>✗</span> Query failed or no resources found</div>";
                if($db->error){
                    echo "<div class='check-item'><span class='error'>Error:</span> " . $db->error . "</div>";
                }
                $all_passed = false;
            }
        }
        
        // TEST 6: Configuration Values
        echo "<h2>6. Configuration Values</h2>";
        echo "<table>";
        echo "<tr><th>Setting</th><th>Value</th></tr>";
        echo "<tr><td>BASE_PATH</td><td>" . (defined('BASE_PATH') ? BASE_PATH : 'Not defined') . "</td></tr>";
        echo "<tr><td>Current URL</td><td>" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "</td></tr>";
        echo "<tr><td>Document Root</td><td>" . $_SERVER['DOCUMENT_ROOT'] . "</td></tr>";
        echo "<tr><td>PHP Version</td><td>" . phpversion() . "</td></tr>";
        echo "</table>";
        
        if(defined('BASE_PATH')){
            $current_url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . "/";
            if(strpos($current_url, str_replace(['http://', 'https://'], '', BASE_PATH)) === false){
                echo "<div class='info'>⚠ <strong>WARNING:</strong> BASE_PATH might not match your current URL<br>";
                echo "BASE_PATH: " . BASE_PATH . "<br>";
                echo "Current URL: " . $current_url . "</div>";
            }
        }
        
        // TEST 7: File System
        echo "<h2>7. File System Check</h2>";
        $paths_to_check = [
            './config/header.php',
            './config/footer.php',
            './config/head.php',
            './uploads/',
            './uploads/resources/',
            './images/'
        ];
        
        foreach($paths_to_check as $path){
            if(file_exists($path)){
                echo "<div class='check-item'><span class='success'>✓</span> $path exists</div>";
            } else {
                echo "<div class='check-item'><span class='error'>✗</span> $path NOT found</div>";
            }
        }
        
        // TEST 8: PHP Extensions
        echo "<h2>8. PHP Extensions</h2>";
        $extensions = ['mysqli', 'pdo', 'pdo_mysql', 'curl', 'gd', 'mbstring'];
        foreach($extensions as $ext){
            if(extension_loaded($ext)){
                echo "<div class='check-item'><span class='success'>✓</span> $ext loaded</div>";
            } else {
                echo "<div class='check-item'><span class='warning'>⚠</span> $ext not loaded (might not be required)</div>";
            }
        }
        
        // FINAL SUMMARY
        echo "<h2>📊 Summary</h2>";
        if($all_passed){
            echo "<div class='info' style='background: #d4edda; border-left-color: #28a745;'>";
            echo "<h3 style='color: #155724; margin-top: 0;'>✅ All Critical Tests Passed!</h3>";
            echo "<p>Your local environment seems properly configured. If the resources page still doesn't work, check:</p>";
            echo "<ol>";
            echo "<li>Browser console (F12) for JavaScript errors</li>";
            echo "<li>Browser network tab (F12 > Network) for failed requests</li>";
            echo "<li>Apache/PHP error logs</li>";
            echo "<li>Make sure resources.php file exists and is accessible</li>";
            echo "</ol>";
            echo "</div>";
        } else {
            echo "<div class='info' style='background: #f8d7da; border-left-color: #dc3545;'>";
            echo "<h3 style='color: #721c24; margin-top: 0;'>❌ Issues Found</h3>";
            echo "<p>Please fix the errors marked with ✗ above. Common solutions:</p>";
            echo "<ol>";
            echo "<li><strong>Database not connected:</strong> Check credentials in config.inc.php</li>";
            echo "<li><strong>Table not found:</strong> Export from live site and import to local</li>";
            echo "<li><strong>No data:</strong> Make sure to export DATA, not just structure</li>";
            echo "</ol>";
            echo "</div>";
        }
        
        echo "<h2>🔗 Next Steps</h2>";
        echo "<div class='info'>";
        echo "<ol>";
        echo "<li>Fix any ✗ errors shown above</li>";
        echo "<li>Try accessing your resources page: <a href='" . (defined('BASE_PATH') ? BASE_PATH . "resources/" : "resources/") . "'>Resources Page</a></li>";
        echo "<li>If still not working, check browser console (F12) for JavaScript errors</li>";
        echo "<li>Enable error display in your resources.php file (see documentation)</li>";
        echo "</ol>";
        echo "</div>";
        ?>
        
        <h2>📝 Quick Fixes</h2>
        <div class="info">
            <h3>If Database Not Connected:</h3>
            <div class="code">
// config/config.inc.php<br>
define('DB_HOST', 'localhost');<br>
define('DB_USER', 'root');<br>
define('DB_PASS', '');  // Usually empty on XAMPP<br>
define('DB_NAME', 'subtech_db');  // Your actual DB name
            </div>
            
            <h3>If Tables Missing:</h3>
            <p>1. Go to live site phpMyAdmin<br>
            2. Export mi_resources table (with data)<br>
            3. Import to local phpMyAdmin<br>
            4. Refresh this test page</p>
            
            <h3>If BASE_PATH Wrong:</h3>
            <div class="code">
// config/config.inc.php<br>
define('BASE_PATH', 'http://localhost/subtech/');  // Match your local URL
            </div>
        </div>
    </div>
</body>
</html>