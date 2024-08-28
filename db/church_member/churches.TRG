TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER churches_insert_log AFTER INSERT ON churches\nFOR EACH ROW\nBEGIN\n  INSERT INTO churches_log (username, churches_id, operation) \n  VALUES (CURRENT_USER(), NEW.churchID, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER churches_update_log AFTER UPDATE ON churches\nFOR EACH ROW\nBEGIN\n  INSERT INTO churches_log (username, churches_id, operation) \n  VALUES (CURRENT_USER(), OLD.churchID, "UPDATE - OLD"),\n         (CURRENT_USER(), NEW.churchID, "UPDATE - NEW");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER churches_delete_log AFTER DELETE ON churches\nFOR EACH ROW\nBEGIN\n  INSERT INTO churches_log (username, churches_id, operation) \n  VALUES (CURRENT_USER(), OLD.churchID, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701229911199639 1701229911238921 1701229911278657
