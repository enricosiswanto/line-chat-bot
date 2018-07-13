<?php
$server = "localhost";
$username = "root";
$password = '';
$database = "christmas_new";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Connection Failed.");
mysql_select_db($database) or die("Cannot Open Database.");
?>
