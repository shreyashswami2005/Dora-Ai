-- Pharma Shop Database Setup
-- Run: mysql -u root -p < database.sql (create DB first if needed)

CREATE DATABASE IF NOT EXISTS `pharma_shop new`;
USE `pharma_shop new`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Test user (admin: password=admin123)
INSERT INTO `users` (`username`, `email`, `password_hash`, `role`) VALUES 
('admin', 'admin@pharmashop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

