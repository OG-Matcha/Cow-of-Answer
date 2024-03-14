CREATE DATABASE IF NOT EXISTS laravel;
CREATE USER IF NOT EXISTS 'laraveluser'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON laravel.* TO 'laraveluser'@'%';