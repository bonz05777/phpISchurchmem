TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER memberpersonaldetails_log_insert_log AFTER INSERT ON memberpersonaldetails\nFOR EACH ROW\nBEGIN\n  INSERT INTO memberpersonaldetails_log (username, member_id, operation) \n  VALUES (CURRENT_USER(), NEW.id, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER memberpersonaldetails_log_update_log AFTER UPDATE ON memberpersonaldetails\nFOR EACH ROW\nBEGIN\n  INSERT INTO memberpersonaldetails_log (username, member_id, operation) \n  VALUES (CURRENT_USER(), OLD.id, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER memberpersonaldetails_log_delete_log AFTER DELETE ON memberpersonaldetails\nFOR EACH ROW\nBEGIN\n  INSERT INTO memberpersonaldetails_log (username, member_id, operation) \n  VALUES (CURRENT_USER(), OLD.id, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701230894310784 1701230894326709 1701230894342192
