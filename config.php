<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=yourdatabasename;charset=utf8", "user", "pass");
} catch ( PDOException $e ){
     print $e->getMessage();
}

?>