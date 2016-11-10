USE InternetServiceProvider;

INSERT INTO customers (CustomerName, Location, Telephone, IpAddress, Fee, AccessEnd) 
VALUES
 ("Георги Горанов", "София, Обеля 21", "0893453451", INET_ATON('10.10.9.44'), 10, '2015-12-11')
("Liubomir Georgiev", "Iskrec", "", INET_ATON('10.10.9.45'), 10, '2015-12-11')
("Test", "", "", INET_ATON('10.10.9.46'), 10, '2015-12-11')
("Problem", "", "0983453451", INET_ATON('10.10.9.47'), 10, '2015-12-11')
("Г", "София, Обеля 21", "0981231231",INET_ATON('10.10.9.48'), 10, '2015-12-11');

