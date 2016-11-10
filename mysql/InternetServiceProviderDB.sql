USE InternetServiceProvider;
CREATE TABLE Customers(
	CustomerID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    CustomerName VARCHAR(100) NOT NULL,
    Location VARCHAR(255),
    Telephone VARCHAR(11),
    IpAddress INT UNSIGNED NOT NULL,
    Fee TINYINT UNSIGNED NOT NULL,
    PaymentDate DATE,
    AccessEnd DATE NOT NULL,
    Notes VARCHAR(255),
    DateAdded DATE,
    PRIMARY KEY (CustomerID),
    CONSTRAINT uc_IpAddress UNIQUE (IpAddress)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TRIGGER tr_InternetAccessInsert BEFORE INSERT ON customers FOR EACH ROW
SET NEW.DateAdded = CURRENT_DATE(), NEW.PaymentDate = CURRENT_DATE();

DELIMITER ;;

CREATE TRIGGER tr_InternetAccessUpdate BEFORE UPDATE ON customers FOR EACH ROW
IF (NEW.AccessEnd <=> OLD.AccessEnd) THEN
	SET NEW.PaymentDate = CURDATE();
END IF;;

DELIMITER ;


INSERT INTO customers (CustomerName, Location, Telephone, IpAddress, Fee, AccessEnd, Notes)
VALUES ('Деян Горанов', 'Своге, блок 11', '0893462324',
INET_ATON('78.128.90.98'), 20, '2015-12-30', 'Много як!');