TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER status_insert_log AFTER INSERT ON status\nFOR EACH ROW\nBEGIN\n  INSERT INTO status_log (username, status_id, operation) \n  VALUES (CURRENT_USER(), NEW.statusID, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER status_update_log AFTER UPDATE ON status\nFOR EACH ROW\nBEGIN\n  INSERT INTO status_log (username, status_id, operation) \n  VALUES (CURRENT_USER(), OLD.statusID, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER status_delete_log AFTER DELETE ON status\nFOR EACH ROW\nBEGIN\n  INSERT INTO status_log (username, status_id, operation) \n  VALUES (CURRENT_USER(), OLD.statusID, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701232156174936 1701232156188196 1701232156198294
