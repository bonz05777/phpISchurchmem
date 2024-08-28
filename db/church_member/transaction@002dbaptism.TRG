TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER baptism_insert_log AFTER INSERT ON `transaction-baptism`\nFOR EACH ROW\nBEGIN\n  INSERT INTO baptism_log (username, baptism_id, operation)\n  VALUES (CURRENT_USER(), NEW.baptismID, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER baptism_update_log AFTER UPDATE ON `transaction-baptism`\nFOR EACH ROW\nBEGIN\n  INSERT INTO baptism_log (username, baptism_id, operation)\n  VALUES (CURRENT_USER(), OLD.baptismID, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER baptism_delete_log AFTER DELETE ON `transaction-baptism`\nFOR EACH ROW\nBEGIN\n  INSERT INTO baptism_log (username, baptism_id, operation)\n  VALUES (CURRENT_USER(), OLD.baptismID, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701233031985050 1701233031999663 1701233032014116
