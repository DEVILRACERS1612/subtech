<?php
/**
 * File Checker - Check which CSS/JS files are missing
 * Upload to: http://localhost/subtech/check-files.php
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Subtech - File Check</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; }
        h1 { color: #e93132; }
        .found { color: #28a745; font-weight: bold; }
        .missing { color: #dc3545; font-weight: bold; }
        .file-item { padding: 10px; margin: 5px 0; background: #f8f9fa; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Checking Missing Files</h1>
        
        <?php
        // Common CSS/JS file locations
        $files_to_check = [
            // CSS files
            'css/bootstrap.min.css',
            'css/bootstrap-select.min.css',
            'assets/css/bootstrap.min.css',
            'assets/css/bootstrap-select.min.css',
            'public/css/bootstrap.min.css',
            'public/css/bootstrap-select.min.css',
            
            // JS files
            'js/bootstrap.min.js',
            'js/bootstrap-select.min.js',
            'js/jquery.min.js',
            'js/main.js',
            'js/custom.js',
            'assets/js/bootstrap.min.js',
            'assets/js/bootstrap-select.min.js',
            'assets/js/jquery.min.js',
            
            // Common includes
            'config/head.php',
            'config/footer.php',
            'config/foot.php',
            'config/header.php',
        ];
        
        echo "<h2>File Check Results:</h2>";
        
        $missing_files = [];
        $found_files = [];
        
        foreach($files_to_check as $file){
            if(file_exists($file)){
                $found_files[] = $file;
                echo "<div class='file-item'><span class='found'>✓ FOUND:</span> $file</div>";
            } else {
                $missing_files[] = $file;
                echo "<div class='file-item'><span class='missing'>✗ MISSING:</span> $file</div>";
            }
        }
        
        echo "<h2>Summary:</h2>";
        echo "<p><strong>Found:</strong> " . count($found_files) . " files</p>";
        echo "<p><strong>Missing:</strong> " . count($missing_files) . " files</p>";
        
        if(count($missing_files) > 0){
            echo "<h2>⚠️ Critical Missing Files:</h2>";
            $critical = array_filter($missing_files, function($file){
                return strpos($file, 'bootstrap') !== false || strpos($file, 'jquery') !== false;
            });
            
            if(count($critical) > 0){
                echo "<div style='background: #f8d7da; padding: 15px; border-radius: 5px; border-left: 4px solid #dc3545;'>";
                echo "<h3>Bootstrap/jQuery files are missing!</h3>";
                echo "<p><strong>Solution:</strong></p>";
                echo "<ol>";
                echo "<li>Copy these files from your live site</li>";
                echo "<li>OR download from CDN and place in correct folders</li>";
                echo "<li>Check your config/head.php and config/foot.php for correct paths</li>";
                echo "</ol>";
                echo "</div>";
            }
        }
        
        // Check config files
        echo "<h2>📝 Config File Contents:</h2>";
        
        if(file_exists('config/head.php')){
            echo "<h3>config/head.php:</h3>";
            echo "<pre style='background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 5px; overflow-x: auto;'>";
            echo htmlspecialchars(file_get_contents('config/head.php'));
            echo "</pre>";
        }
        
        if(file_exists('config/foot.php')){
            echo "<h3>config/foot.php:</h3>";
            echo "<pre style='background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 5px; overflow-x: auto;'>";
            echo htmlspecialchars(file_get_contents('config/foot.php'));
            echo "</pre>";
        }
        
        ?>
        
        <h2>🔧 Solutions:</h2>
        <div style="background: #e7f3ff; padding: 15px; border-radius: 5px; border-left: 4px solid #2196F3;">
            <h3>Option 1: Copy from Live Site</h3>
            <ol>
                <li>Download all CSS/JS files from live site</li>
                <li>Upload to exact same paths on local</li>
                <li>Refresh page</li>
            </ol>
            
            <h3>Option 2: Use CDN (Quick Fix)</h3>
            <p>Add to config/head.php:</p>
            <pre style='background: #2d2d2d; color: #f8f8f2; padding: 10px; border-radius: 5px;'>
&lt;!-- Bootstrap CSS --&gt;
&lt;link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"&gt;
&lt;link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css" rel="stylesheet"&gt;
            </pre>
            
            <p>Add to config/foot.php (BEFORE closing body tag):</p>
            <pre style='background: #2d2d2d; color: #f8f8f2; padding: 10px; border-radius: 5px;'>
&lt;!-- jQuery --&gt;
&lt;script src="https://code.jquery.com/jquery-3.6.0.min.js"&gt;&lt;/script&gt;
&lt;!-- Bootstrap JS --&gt;
&lt;script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"&gt;&lt;/script&gt;
&lt;script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"&gt;&lt;/script&gt;
            </pre>
        </div>
    </div>
</body>
</html>