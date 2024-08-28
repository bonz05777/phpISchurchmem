TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER office_insert_log AFTER INSERT ON office\nFOR EACH ROW\nBEGIN\n  INSERT INTO office_log (username, office_id, operation) \n  VALUES (CURRENT_USER(), NEW.officeID, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER office_update_log AFTER UPDATE ON office\nFOR EACH ROW\nBEGIN\n  INSERT INTO office_log (username, office_id, operation) \n  VALUES (CURRENT_USER(), OLD.officeID, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER office_delete_log AFTER DELETE ON office\nFOR EACH ROW\nBEGIN\n  INSERT INTO office_log (username, office_id, operation) \n  VALUES (CURRENT_USER(), OLD.officeID, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701231553848082 1701231553860507 1701231553875142
