TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER users_insert_log AFTER INSERT ON users\nFOR EACH ROW\nBEGIN\n  INSERT INTO users_log (username, users_id, operation) \n  VALUES (CURRENT_USER(), NEW.id, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER users_update_log AFTER UPDATE ON users\nFOR EACH ROW\nBEGIN\n  INSERT INTO users_log (username, users_id, operation) \n  VALUES (CURRENT_USER(), OLD.id, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER users_delete_log AFTER DELETE ON users\nFOR EACH ROW\nBEGIN\n  INSERT INTO users_log (username, users_id, operation) \n  VALUES (CURRENT_USER(), OLD.id, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701238919968213 1701238919981337 1701238919993872
