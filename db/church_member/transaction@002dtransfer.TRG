TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER transfer_insert_log AFTER INSERT ON `transaction-transfer`\nFOR EACH ROW\nBEGIN\n  INSERT INTO transfer_log (username, transfer_id, operation)\n  VALUES (CURRENT_USER(), NEW.transferID, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER transfer_update_log AFTER UPDATE ON `transaction-transfer`\nFOR EACH ROW\nBEGIN\n  INSERT INTO transfer_log (username, transfer_id, operation)\n  VALUES (CURRENT_USER(), OLD.transferID, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER transfer_delete_log AFTER DELETE ON `transaction-transfer`\nFOR EACH ROW\nBEGIN\n  INSERT INTO transfer_log (username, transfer_id, operation)\n  VALUES (CURRENT_USER(), OLD.transferID, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701232911047096 1701232911061969 1701232911079070
