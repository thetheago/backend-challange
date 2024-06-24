
CREATE DATABASE IF NOT EXISTS payment_test;

USE payment_test;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    shopkeeper BOOLEAN NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    UNIQUE KEY unique_email_cpf (email, cpf)
);

TRUNCATE TABLE users;

INSERT INTO users (name, email, cpf, shopkeeper, amount) VALUES
('Freddie Mercury', 'freddie.mercury@queen.com', '123.456.789-10', true, 300.00),
('Elvis Presley', 'elvis.presley@king.com', '111.222.333-44', false, 500.50),
('Kurt Cobain', 'kurt.cobain@nirvana.com', '222.333.444-55', false, 150.00),
('Tyler Joseph', 'tyler.joseph@twentyonepilots.com', '987.654.312-01', false, 620.20),
('Josh Dun', 'josh.dun@twentyonepilots.com', '111.222.333-44', false, 132.06),
('Paul McCartney', 'paul.mccartney@beatles.com', '333.444.555-66', true, 750.75),
('John Lennon', 'john.lennon@beatles.com', '444.555.666-77', false, 640.40),
('Mick Jagger', 'mick.jagger@rollingstones.com', '555.666.777-88', true, 830.30),
('David Bowie', 'david.bowie@ziggy.com', '666.777.888-99', false, 920.90),
('Jimi Hendrix', 'jimi.hendrix@purplehaze.com', '777.888.999-00', false, 410.10),
('Beyoncé Knowles', 'beyonce@destinyschild.com', '888.999.000-11', true, 1000.00),
('Axl Rose', 'axl.rose@gnr.com', '999.000.111-22', false, 300.30),
('Slash Hudson', 'slash.hudson@gnr.com', '000.111.222-33', false, 310.40),
('Eddie Vedder', 'eddie.vedder@pearljam.com', '111.222.333-55', false, 500.50),
('Chris Cornell', 'chris.cornell@soundgarden.com', '111.222.333-44', false, 132.06);
