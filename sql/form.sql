CREATE DATABASE booking_system;

USE booking_system;

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    edd DATE NOT NULL,
    age INT,
    phone VARCHAR(15) NOT NULL,
    location VARCHAR(255) NOT NULL,
    hospital VARCHAR(50) NOT NULL,
    delivery_type VARCHAR(50) NOT NULL,
    duration INT NOT NULL,
    package VARCHAR(50) NOT NULL
);
