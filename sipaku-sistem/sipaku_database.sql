-- Database: sipaku

CREATE DATABASE IF NOT EXISTS sipaku;
USE sipaku;

-- Table structure for table `users`
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(20) NOT NULL,
  no_hp VARCHAR(20) NOT NULL,
  email VARCHAR(100) NOT NULL,
  jenis_kendaraan ENUM('Motor', 'Mobil') NOT NULL,
  sim_path VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `parking_status`
CREATE TABLE IF NOT EXISTS parking_status (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  license_plate VARCHAR(20) NOT NULL,
  status ENUM('masuk', 'keluar') NOT NULL,
  entry_time DATETIME DEFAULT NULL,
  exit_time DATETIME DEFAULT NULL,
  fee INT DEFAULT 0,
  duration VARCHAR(50) DEFAULT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `transactions`
CREATE TABLE IF NOT EXISTS transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  license_plate VARCHAR(20) NOT NULL,
  amount INT NOT NULL,
  transaction_date DATE NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `parking_slots`
CREATE TABLE IF NOT EXISTS parking_slots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slot_number INT NOT NULL,
  status ENUM('kosong', 'terisi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `violators`
CREATE TABLE IF NOT EXISTS violators (
  id INT AUTO_INCREMENT PRIMARY KEY,
  license_plate VARCHAR(20) NOT NULL,
  violation_time DATE NOT NULL,
  action_taken VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `e_wallet`
CREATE TABLE IF NOT EXISTS e_wallet (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  balance INT NOT NULL DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
