TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER address_insert_log AFTER INSERT ON address\nFOR EACH ROW\nBEGIN\n  INSERT INTO address_log (username, address_id, operation) \n  VALUES (CURRENT_USER(), NEW.addressID, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `address_update_log` AFTER UPDATE ON `address` FOR EACH ROW BEGIN\n  INSERT INTO address_log (username, address_id, operation) \n  VALUES (CURRENT_USER(), OLD.addressID, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER address_delete_log AFTER DELETE ON address\nFOR EACH ROW\nBEGIN\n  INSERT INTO address_log (username, address_id, operation) \n  VALUES (CURRENT_USER(), OLD.addressID, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701227580202835 1701230407207642 1701227580297595
