USE InternetServiceProvider;
DELIMITER ;;

CREATE TRIGGER timeLeftUpdate BEFORE UPDATE ON customers FOR EACH ROW
IF NOT (NEW.CustomerName <=> OLD.CustomerName AND NEW.Location <=> OLD.Location
AND NEW.IpAddress <=> OLD.IpAddress AND NEW.DateAdded <=> OLD.DateAdded
AND NEW.EndOfInternetAccess <=> OLD.EndOfInternetAccess) THEN
	SET NEW.DateUpdated = CURRENT_DATE(),
	NEW.EndOfInternetAccess = DATE_ADD(CURRENT_DATE(), INTERVAL TimeLeft DAY);
END IF;;

DELIMITER ;