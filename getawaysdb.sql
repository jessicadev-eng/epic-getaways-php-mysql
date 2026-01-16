create database if not exists getawaysdb;
use getawaysdb;

create table if not exists customer(
    cust_id int AUTO_INCREMENT NOT NULL,
    first_name varchar(20) not null,
    last_name varchar(30) not null,
    email VARCHAR(50) NOT NULL UNIQUE,
    phone_number VARCHAR(15) NOT NULL,
    address VARCHAR(100) NOT NULL,
    password varchar(60) not null,
    primary key (cust_id)
);

create table if not exists package(
    package_id int AUTO_INCREMENT NOT NULL,
    package_name varchar(20) not null,
    package_desc TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_name VARCHAR(50) NOT NULL,
    primary key(package_id)
);

CREATE TABLE IF NOT EXISTS customer_order (
    order_id VARCHAR(50) NOT NULL,
    customer_email VARCHAR(50) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) NOT NULL,
    PRIMARY KEY (order_id)
    -- FOREIGN KEY (customer_email) REFERENCES customer(email)
       -- ON DELETE NO ACTION
       -- ON UPDATE NO ACTION
);


CREATE TABLE IF NOT EXISTS order_details (
    order_details_id INT AUTO_INCREMENT NOT NULL,
    order_id VARCHAR(50) NOT NULL,
    package_id INT NOT NULL,
    qty INT NOT NULL,
    PRIMARY KEY (order_details_id)
    -- FOREIGN KEY (order_id) REFERENCES customer_order(order_id)
        -- ON DELETE NO ACTION
        -- ON UPDATE NO ACTION,
    -- FOREIGN KEY (package_id) REFERENCES package(package_id)
        -- ON DELETE NO ACTION
        -- ON UPDATE NO ACTION
);



INSERT INTO customer (first_name, last_name, email, phone_number, address, password) 
VALUES 
('John', 'Doe', 'john@example.com', '1234567890', '123 Main St, Sydney', 'password123'),
('Jane', 'Smith', 'jane@example.com', '0987654321', '456 Market St, Melbourne', 'mypassword'),
('Alice', 'Johnson', 'alice@example.com', '1122334455', '789 High St, Brisbane', 'alicepass'),
('Bob', 'Brown', 'bob@example.com', '2233445566', '101 Central Rd, Perth', 'bobpass'),
('Emily', 'Davis', 'emily@example.com', '3344556677', '202 Beach Rd, Gold Coast', 'emilypass');


INSERT INTO package (package_name, package_desc, price, image_name)
VALUES 
('Sydney Explorer', '5-day tour exploring the iconic sights of Sydney.', 1200.00, 'sydney.png'),
('Gold Coast Adventure', '7-day package including theme parks and beaches.', 1500.00, 'goldcoast.png'),
('Melbourne Experience', '4-day cultural and food tour of Melbourne.', 1100.00, 'melbourne.png'),
('Cairns Reef Adventure', '6-day Great Barrier Reef diving experience.', 1750.00, 'cairns.png'),
('Tasmania Escape', '8-day wilderness tour in Tasmania.', 1950.00, 'tasmania.png'),
('Perth Adventure', '5-day Perth adventure including beaches and wine tasting.', 1300.00, 'perth.png'),
('Brisbane Discovery', '4-day Brisbane discovery including river cruise and museums.', 1150.00, 'brisbane.png'),
('Adelaide Wine Tour', '6-day Barossa Valley wine tour.', 1600.00, 'adelaide.png'),
('Darwin Outback Experience', '7-day Darwin adventure including Kakadu National Park.', 1800.00, 'darwin.png'),
('Uluru Red Centre', '3-day Uluru outback camping experience.', 900.00, 'uluru.png'),
('Hobart Discovery', '5-day Hobart discovery including Salamanca Market and museums.', 1300.00, 'hobart.png'),
('Byron Bay Retreat', '6-day Byron Bay surfing and relaxation retreat.', 1450.00, 'byronbay.png'),
('Whitsundays Cruise', '5-day Whitsundays island hopping cruise.', 1750.00, 'whitsundays.png'),
('Broome & Kimberley', '7-day Broome and Kimberley outback and coastal exploration.', 2100.00, 'broome.png'),
('Great Barrier Reef', '7-day adventure to the Great Barrier Reef and surrounding outback.', 3100.00, 'greatbarrier.png');


INSERT INTO customer_order (order_id, customer_email, total_price, status) 
VALUES 
('ORD00120240513', 'alice@example.com', 1200.00, 'Confirmed'),
('ORD00220240513', 'bob@example.com', 1500.00, 'Pending'),
('ORD00320240513', 'john@example.com', 1100.00, 'Completed'),
('ORD00420240513', 'jane@example.com', 1750.00, 'Cancelled'),
('ORD00520240513', 'emily@example.com', 1950.00, 'Confirmed');

INSERT INTO order_details (order_id, package_id, qty) 
VALUES 
('ORD00120240513', 1, 2),
('ORD00220240513', 2, 3),
('ORD00320240513', 3, 1),
('ORD00420240513', 4, 2),
('ORD00520240513', 5, 4);


