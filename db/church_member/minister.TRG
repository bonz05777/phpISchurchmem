TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER minister_log_insert_log AFTER INSERT ON minister\nFOR EACH ROW\nBEGIN\n  INSERT INTO minister_log (username, minister_id, operation) \n  VALUES (CURRENT_USER(), NEW.ministerID, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER minister_log_update_log AFTER UPDATE ON minister\nFOR EACH ROW\nBEGIN\n  INSERT INTO minister_log (username, minister_id, operation) \n  VALUES (CURRENT_USER(), OLD.ministerID, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER minister_log_delete_log AFTER DELETE ON minister\nFOR EACH ROW\nBEGIN\n  INSERT INTO minister_log (username, minister_id, operation) \n  VALUES (CURRENT_USER(), OLD.ministerID, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701231122944373 1701231122960111 1701231122974918
