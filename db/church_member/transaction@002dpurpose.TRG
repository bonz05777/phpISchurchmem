TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER purpose_insert_log AFTER INSERT ON `transaction-purpose`\nFOR EACH ROW\nBEGIN\n  INSERT INTO purpose_log (username, purpose_id, operation)\n  VALUES (CURRENT_USER(), NEW.purposeID, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER purpose_update_log AFTER UPDATE ON `transaction-purpose`\nFOR EACH ROW\nBEGIN\n  INSERT INTO purpose_log (username, purpose_id, operation)\n  VALUES (CURRENT_USER(), OLD.purposeID, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER purpose_delete_log AFTER DELETE ON `transaction-purpose`\nFOR EACH ROW\nBEGIN\n  INSERT INTO purpose_log (username, purpose_id, operation)\n  VALUES (CURRENT_USER(), OLD.purposeID, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701233412455696 1701233412469630 1701233412481549
