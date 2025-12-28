


CREATE DATABASE IF NOT EXISTS bankapp
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE bankapp;

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comptes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    type ENUM('courant','epargne') NOT NULL,
    solde DECIMAL(10,2) NOT NULL DEFAULT 0,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_compte_client
        FOREIGN KEY (client_id)
        REFERENCES clients(id)
        ON DELETE RESTRICT
);


CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    compte_id INT NOT NULL,
    type ENUM('depot','retrait') NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_transaction_compte
        FOREIGN KEY (compte_id)
        REFERENCES comptes(id)
        ON DELETE CASCADE
);
