use pizzeria

go

IF OBJECT_ID('FK_Product_Type', 'F') IS NOT NULL
    ALTER TABLE Product DROP CONSTRAINT FK_Product_Type;
IF OBJECT_ID('FK_Product_Ingredient_Product', 'F') IS NOT NULL
    ALTER TABLE Product_Ingredient DROP CONSTRAINT FK_Product_Ingredient_Product;
IF OBJECT_ID('FK_Product_Ingredient_Ingredient', 'F') IS NOT NULL
    ALTER TABLE Product_Ingredient DROP CONSTRAINT FK_Product_Ingredient_Ingredient;
IF OBJECT_ID('FK_Pizza_Order_Client', 'F') IS NOT NULL
    ALTER TABLE Pizza_Order DROP CONSTRAINT FK_Pizza_Order_Client;
IF OBJECT_ID('FK_Pizza_Order_Personnel', 'F') IS NOT NULL
    ALTER TABLE Pizza_Order DROP CONSTRAINT FK_Pizza_Order_Personnel;
IF OBJECT_ID('FK_Pizza_Order_Product_Order', 'F') IS NOT NULL
    ALTER TABLE Pizza_Order_Product DROP CONSTRAINT FK_Pizza_Order_Product_Order;
IF OBJECT_ID('FK_Pizza_Order_Product_Product', 'F') IS NOT NULL
    ALTER TABLE Pizza_Order_Product DROP CONSTRAINT FK_Pizza_Order_Product_Product;

-- Drop all tables
IF OBJECT_ID('Pizza_Order_Product', 'U') IS NOT NULL
    DROP TABLE Pizza_Order_Product;
IF OBJECT_ID('Pizza_Order', 'U') IS NOT NULL
    DROP TABLE Pizza_Order;
IF OBJECT_ID('Product_Ingredient', 'U') IS NOT NULL
    DROP TABLE Product_Ingredient;
IF OBJECT_ID('Product', 'U') IS NOT NULL
    DROP TABLE Product;
IF OBJECT_ID('Ingredient', 'U') IS NOT NULL
    DROP TABLE Ingredient;
IF OBJECT_ID('ProductType', 'U') IS NOT NULL
    DROP TABLE ProductType;
IF OBJECT_ID('[User]', 'U') IS NOT NULL
    DROP TABLE [User];


-- Create User table
CREATE TABLE [User] (
  [username] NVARCHAR(200) PRIMARY KEY,
  [password] NVARCHAR(200) NOT NULL,
  [email] NVARCHAR(200) NOT NULL,
  [phone] NVARCHAR(200) NOT NULL,
  [role] NVARCHAR(200) NOT NULL,
  [personnelID] NVARCHAR(10) NULL
);

-- Create ProductType table
CREATE TABLE [ProductType] (
  [name] NVARCHAR(200) PRIMARY KEY
);

-- Create Ingredient table
CREATE TABLE [Ingredient] (
  [name] NVARCHAR(200) PRIMARY KEY
);

-- Create Product table
CREATE TABLE [Product] (
  [name] NVARCHAR(200) PRIMARY KEY,
  [price] DECIMAL(10,2) NOT NULL,
  [type_id] NVARCHAR(200) NOT NULL
);

-- Create Product_Ingredient table
CREATE TABLE [Product_Ingredient] (
  [product_name] NVARCHAR(200),
  [ingredient_name] NVARCHAR(200),
  PRIMARY KEY ([product_name], [ingredient_name])
);

CREATE TABLE [Pizza_Order] (
  [order_id] INT PRIMARY KEY IDENTITY(1, 1),
  [client_username] NVARCHAR(200),
  [client_name] NVARCHAR(200) NOT NULL,
  [personnel_username] NVARCHAR(200) NOT NULL,
  [datetime] DATETIME NOT NULL,
  [status] INT,
  [address] NVARCHAR(200)
);

-- Create Pizza_Order_Product table
CREATE TABLE [Pizza_Order_Product] (
  [order_id] INT,
  [product_name] NVARCHAR(200),
  [quantity] INT NOT NULL,
  PRIMARY KEY ([order_id], [product_name])
);

-- -- Add foreign key constraints
ALTER TABLE [Product] ADD constraint a FOREIGN KEY ([type_id]) REFERENCES [ProductType] ([name]);
ALTER TABLE [Product_Ingredient] ADD constraint b FOREIGN KEY ([product_name]) REFERENCES [Product] ([name]);
ALTER TABLE [Product_Ingredient] ADD constraint c FOREIGN KEY ([ingredient_name]) REFERENCES [Ingredient] ([name]);
ALTER TABLE [Pizza_Order] ADD constraint d FOREIGN KEY ([client_username]) REFERENCES [User] ([username]);
ALTER TABLE [Pizza_Order] ADD constraint e FOREIGN KEY ([personnel_username]) REFERENCES [User] ([username]);
ALTER TABLE [Pizza_Order_Product] ADD constraint f FOREIGN KEY ([order_id]) REFERENCES [Pizza_Order] ([order_id]);
ALTER TABLE [Pizza_Order_Product] ADD constraint g FOREIGN KEY ([product_name]) REFERENCES [Product] ([name]);

-- -- Insert statements for 20 users with realistic names
INSERT INTO [User] (username, [password], email, phone, [role], [personnelID])
VALUES
	('mvermeer', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Client', '0'),
	('jstone', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Client', '0'),
	('htimmer', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Client', '0'),
	('sleap', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Client', '0'),
	('addafee', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Client', '0'),
	('adaderget', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Client', '0'),
	('vsdvfhtr', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Client', '0'),
	('pietdikhoofd', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Personnel', '1'),
	('bcvxvzvzv', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Personnel', '1'),
	('tyyretroe', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Personnel', '1'),
	('opqopqp', 'wachtwoord', 'niet.interessant@gmail.com', '06-1000000', 'Personnel', '1');


-- Insert statements for product types
INSERT INTO ProductType ([name]) VALUES
('Pizza'),
('Maaltijd'),
('Specerij'),
('Voorgerecht'),
('Drank');

-- Insert statements for ingredients
INSERT INTO Ingredient ([name]) VALUES
('Tomaat'),
('Kaas'),
('Pepperoni'),
('Champignon'),
('Ui'),
('Sla'),
('Spek'),
('Saus');

-- Insert statements for products
INSERT INTO Product ([name], price, type_id) VALUES
('Margherita Pizza', 9.99, 'Pizza'),
('Pepperoni Pizza', 11.99, 'Pizza'),
('Vegetarische Pizza', 10.99, 'Pizza'),
('Hawaiian Pizza', 12.99, 'Pizza'),
('Combinatiemaaltijd', 15.99, 'Maaltijd'),
('Knoflookbrood', 4.99, 'Voorgerecht'),
('Coca Cola', 2.49, 'Drank'),
('Sprite', 2.49, 'Drank');

-- Insert statements for product-ingredient relationships
INSERT INTO Product_Ingredient (product_name, ingredient_name) VALUES
('Margherita Pizza', 'Tomaat'), -- Margherita Pizza met Tomaat
('Margherita Pizza', 'Kaas'), -- Margherita Pizza met Kaas
('Pepperoni Pizza', 'Tomaat'), -- Pepperoni Pizza met Tomaat
('Pepperoni Pizza', 'Kaas'), -- Pepperoni Pizza met Kaas
('Pepperoni Pizza', 'Pepperoni'), -- Pepperoni Pizza met Pepperoni
('Vegetarische Pizza', 'Tomaat'), -- Vegetarische Pizza met Tomaat
('Vegetarische Pizza', 'Kaas'), -- Vegetarische Pizza met Kaas
('Vegetarische Pizza', 'Champignon'), -- Vegetarische Pizza met Champignon
('Vegetarische Pizza', 'Ui'), -- Vegetarische Pizza met Ui
('Hawaiian Pizza', 'Tomaat'), -- Hawaiian Pizza met Tomaat
('Hawaiian Pizza', 'Kaas'), -- Hawaiian Pizza met Kaas
('Hawaiian Pizza', 'Pepperoni'), -- Hawaiian Pizza met Pepperoni
('Hawaiian Pizza', 'Ui'), -- Hawaiian Pizza met Ui
('Hawaiian Pizza', 'Sla'), -- Hawaiian Pizza met Sla
('Hawaiian Pizza', 'Spek'), -- Hawaiian Pizza met Spek
('Hawaiian Pizza', 'Saus'), -- Hawaiian Pizza met Saus
('Combinatiemaaltijd', 'Tomaat'), -- Combinatiemaaltijd met Tomaat
('Combinatiemaaltijd', 'Kaas'), -- Combinatiemaaltijd met Kaas
('Combinatiemaaltijd', 'Pepperoni'), -- Combinatiemaaltijd met Pepperoni
('Combinatiemaaltijd', 'Champignon'), -- Combinatiemaaltijd met Champignon
('Combinatiemaaltijd', 'Ui'), -- Combinatiemaaltijd met Ui
('Combinatiemaaltijd', 'Sla'), -- Combinatiemaaltijd met Sla
('Combinatiemaaltijd', 'Spek'), -- Combinatiemaaltijd met Spek
('Combinatiemaaltijd', 'Saus'); -- Combinatiemaaltijd met Saus

-- Insert statements for pizza orders
INSERT INTO [Pizza_Order] (client_username, client_name, personnel_username, datetime, status, address) 
VALUES
('mvermeer', 'Maria Vermeer', 'pietdikhoofd', '2024-06-12 18:45:00', 1, 'Bakkerstraat 1, 6811EG, Arnhem'),
('jstone', 'John Stone', 'tyyretroe', '2024-06-12 19:00:00', 2, 'Jansplein 2, 6811GD, Arnhem'),
('htimmer', 'Hanna Timmer', 'opqopqp', '2024-06-12 19:15:00', 1, 'Willemsplein 3, 6811KD, Arnhem'),
('sleap', 'Simon Leap', 'bcvxvzvzv', '2024-06-12 19:30:00', 2, 'Kerkstraat 4, 6811DW, Arnhem'),
('addafee', 'Anne Dafee', 'pietdikhoofd', '2024-06-12 19:45:00', 3, 'Rijnkade 5, 6811HA, Arnhem'),
(NULL, 'Pieter Post', 'tyyretroe', '2024-06-12 20:00:00', 1, 'Grote Markt 6, 6511KB, Nijmegen'),
(NULL, 'Anna Smits', 'opqopqp', '2024-06-12 20:15:00', 2, 'Sint Annastraat 7, 6524EZ, Nijmegen'),
(NULL, 'Bert van Dijk', 'bcvxvzvzv', '2024-06-12 20:30:00', 3, 'Oranjesingel 8, 6511NV, Nijmegen'),
(NULL, 'Sara de Vries', 'tyyretroe', '2024-06-12 20:45:00', 1, 'Van Welderenstraat 9, 6511MS, Nijmegen'),
(NULL, 'Jan Jansen', 'opqopqp', '2024-06-12 21:00:00', 2, 'Molenstraat 10, 6511HJ, Nijmegen');


-- Insert statements for Pizza_Order_Product (dummy data for orders)
INSERT INTO Pizza_Order_Product (order_id, product_name, quantity) VALUES
(1, 'Margherita Pizza', 2),
(1, 'Coca Cola', 3),
(2, 'Pepperoni Pizza', 1),
(2, 'Sprite', 2),
(3, 'Vegetarische Pizza', 1),
(3, 'Hawaiian Pizza', 1),
(4, 'Combinatiemaaltijd', 2),
(4, 'Knoflookbrood', 1),
(5, 'Pepperoni Pizza', 1),
(6, 'Margherita Pizza', 3),
(6, 'Hawaiian Pizza', 2),
(7, 'Combinatiemaaltijd', 2),
(8, 'Knoflookbrood', 2),
(8, 'Sprite', 1),
(9, 'Pepperoni Pizza', 1),
(10, 'Hawaiian Pizza', 2),
(10, 'Coca Cola', 2);


-- pak de oudste en de nieuwste datum
declare @date_start datetime;
declare @date_end datetime;

select @date_start = MIN(datetime) from Pizza_Order;
select @date_end   = max(datetime) from Pizza_Order;

-- Bereken aan de hand van het verschil de middelste datum tussen start en eind
declare @diff int;
set @diff = DATEDIFF(minute, @date_start, @date_end);

declare @middle_date datetime;
set @middle_date = DATEADD(minute, @diff/2, @date_start);

-- Bereken verschil middelste datum met nu (huidig tijdstip)
set @diff = DATEDIFF(minute, @middle_date, GETDATE());

-- update vlucht vertrektijden en passagier inchecktijd
update Pizza_Order set [datetime] = DATEADD(minute, @diff, datetime);

go