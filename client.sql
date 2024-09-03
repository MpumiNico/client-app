CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    client_code VARCHAR(255) NOT NULL,
    linked_contacts INT DEFAULT 0
);