<?php
session_start();
$pdo = new PDO(
    "mysql:host=localhost;dbname=kopipiro;charset=utf8mb4",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_FOUND_ROWS => true,
    ]
);
const DISCOUNT_RATE = 0.10; // 10% for logged-in customers
const MIDTRANS_SERVER_KEY = 'SB-Mid-server-pwVt_5GepZFD_cw9uoh4ebLG';