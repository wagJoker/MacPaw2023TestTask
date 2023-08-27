CREATE DATABASE fundraising;

USE fundraising;

CREATE TABLE collections (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    target_amount DECIMAL(10, 2) NOT NULL,
    link VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contributors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    collection_id INT NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (collection_id) REFERENCES collections(id)
);