<?php

$DBHOST = 'localhost';
$DBUSER = 'root';
$DBPASSWORD = '';
$DBNAME = 'projectdesa_db';

// Membuat koneksi
$db_connect = new mysqli($DBHOST, $DBUSER, $DBPASSWORD, $DBNAME);

// Memeriksa koneksi
if ($db_connect->connect_error) {
    die("Failed to connect to MySQL: " . $db_connect->connect_error);
}

// Set karakter set koneksi (opsional)
$db_connect->set_charset("utf8");

// Sisanya dari kode Anda
