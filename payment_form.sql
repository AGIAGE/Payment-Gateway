CREATE DATABASE payment_form;

USE payment_form;

CREATE TABLE submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    payment_amount DECIMAL(10, 2) NOT NULL,
    payment_status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    proof_of_payment VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
