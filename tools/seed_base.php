<?php
// Run once: C:\xampp\php\php.exe tools\seed_base.php
require __DIR__ . '/../config.php';
foreach (['Coffee', 'Non-Coffee', 'Food'] as $c) {
 $pdo->prepare("INSERT IGNORE INTO categories (name) VALUES (?)")->execute([$c]);
}
$users = [
 ['Kopipiro Owner', 'owner@kopipiro.test', 'owner123', 'owner'],
 ['Cashier Ani', 'cashier1@kopipiro.test', 'cashier123', 'cashier'],
 ['Cashier Budi', 'cashier2@kopipiro.test', 'cashier123', 'cashier'],
 ['Demo Customer', 'customer@kopipiro.test', 'customer123', 'customer'],
];
$ins = $pdo->prepare(
 "INSERT IGNORE INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)");
foreach ($users as [$name, $email, $pass, $role]) {
 $ins->execute([$name, $email, password_hash($pass, PASSWORD_DEFAULT), $role]);
}
// Non-coffee products, added by hand (the public coffee API has none).
$find = $pdo->prepare("SELECT id FROM categories WHERE name = ?");
$cat = function ($name) use ($find) {
 $find->execute([$name]);
 return $find->fetchColumn();
};
$items = [
 ['Non-Coffee', 'Chocolate Milk', 'Cold chocolate with fresh milk', 22000],
 ['Non-Coffee', 'Matcha Latte', 'Japanese green tea with steamed milk', 26000],
 ['Non-Coffee', 'Lemon Tea', 'Black tea with fresh lemon', 15000],
 ['Food', 'Butter Toast', 'Thick toast with butter and sugar', 18000],
 ['Food', 'Chocolate Toast', 'Thick toast with chocolate and cheese', 20000],
];
$ins = $pdo->prepare(
 "INSERT INTO products (category_id, name, description, price) VALUES (?, ?, ?, ?)");
foreach ($items as [$c, $name, $desc, $price]) {
 $ins->execute([$cat($c), $name, $desc, $price]);
}
echo "Base data ready.\n";