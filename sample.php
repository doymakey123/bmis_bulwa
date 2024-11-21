
<?php


$admin_password = 'admin123';
$user_password = 'user123';

$hashedpassword_admin = password_hash($admin_password, PASSWORD_DEFAULT);
$hashedpassword_user = password_hash($user_password, PASSWORD_DEFAULT);


echo 'admin passowrd: '. $hashedpassword_admin;
echo 'user passowrd: '. $hashedpassword_user;