TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER churchmembership_insert_log AFTER INSERT ON churchmembership\nFOR EACH ROW\nBEGIN\n  INSERT INTO churchmembership_log (username, churchmembership_id, operation) \n  VALUES (CURRENT_USER(), NEW.id, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `churchmembership_update_log` AFTER UPDATE ON `churchmembership` FOR EACH ROW BEGIN\n  INSERT INTO churchmembership_log (username, churchmembership_id, operation) \n  VALUES (CURRENT_USER(), OLD.id, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER churchmembership_delete_log AFTER DELETE ON churchmembership\nFOR EACH ROW\nBEGIN\n  INSERT INTO churchmembership_log (username, churchmembership_id, operation) \n  VALUES (CURRENT_USER(), OLD.id, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701230232409242 1701230425563468 1701230232484597
