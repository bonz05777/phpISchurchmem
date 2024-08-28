TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER excuse_insert_log AFTER INSERT ON `transaction-excuse`\nFOR EACH ROW\nBEGIN\n  INSERT INTO excuse_log (username, excuse_id, operation)\n  VALUES (CURRENT_USER(), NEW.excuseID, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER excuse_update_log AFTER UPDATE ON `transaction-excuse`\nFOR EACH ROW\nBEGIN\n  INSERT INTO excuse_log (username, excuse_id, operation)\n  VALUES (CURRENT_USER(), OLD.excuseID, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER excuse_delete_log AFTER DELETE ON `transaction-excuse`\nFOR EACH ROW\nBEGIN\n  INSERT INTO excuse_log (username, excuse_id, operation)\n  VALUES (CURRENT_USER(), OLD.excuseID, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701233160515177 1701233160528124 1701233160541085
