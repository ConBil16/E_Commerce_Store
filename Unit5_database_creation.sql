use cbilgrave;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS product;

CREATE TABLE customer(
    id int AUTO_INCREMENT NOT NULL,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255),
    password varchar(255),
    role int,
    PRIMARY KEY (id)
);

CREATE TABLE product(
    id int AUTO_INCREMENT NOT NULL,
    product_name varchar(255),
    image_name varchar(255),
    price decimal(6,2),
    in_stock int,
    inactive TINYINT,
    PRIMARY KEY (id)
);

CREATE TABLE orders (
    ID int AUTO_INCREMENT,
    product_id int,
    FOREIGN KEY (product_id) REFERENCES product(id),
    customer_id int,
    FOREIGN KEY (customer_id) REFERENCES customer(id),
    quantity int,
    price decimal(6,2),
    tax decimal(6,2),
    donation decimal (4,2),
    PRIMARY KEY (ID),
    timestamp bigint UNIQUE
);

INSERT INTO customer (first_name, last_name, password, email, role)
VALUES ('Frodo', 'Baggins', 'fb', 'fb@mines.edu', '1'), ('Harry', 'Potter', 'hp', 'hp@mines.edu', '2');

INSERT INTO product (product_name, image_name, price, in_stock, inactive)
VALUES('Coffee', 'Coffee.jpg', '6.99', '0', '0'), ('Car', 'Car.jpg', '.99', '30', '0'), ('Gloves', 'Gloves.jpg', '6000.78', '2', '0');







