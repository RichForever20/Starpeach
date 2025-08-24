CREATE DATABASE IF NOT EXISTS studiova_payments CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE studiova_payments;
CREATE TABLE IF NOT EXISTS payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(200),
  user_email VARCHAR(200),
  user_phone VARCHAR(100),
  plan VARCHAR(50),
  amount DECIMAL(10,2),
  gateway VARCHAR(50),
  transaction_ref VARCHAR(200),
  status VARCHAR(50),
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE INDEX idx_email ON payments (user_email);
CREATE INDEX idx_plan ON payments (plan);
CREATE INDEX idx_status ON payments (status);
