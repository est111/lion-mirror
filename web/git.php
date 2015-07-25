<?php $output = shell_exec('cd /var/www/ && git pull 2>&1'); 

echo "<pre>";
print_r($output);
echo "</pre>";