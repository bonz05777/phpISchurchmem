TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER attendance_insert_log AFTER INSERT ON attendance\nFOR EACH ROW\nBEGIN\n  INSERT INTO attendance_log (username, attendance_id, operation) \n  VALUES (CURRENT_USER(), NEW.id, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `attendance_update_log` AFTER UPDATE ON `attendance` FOR EACH ROW BEGIN\n  INSERT INTO attendance_log (username, attendance_id, operation) \n  VALUES (CURRENT_USER(), OLD.id, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER attendance_delete_log AFTER DELETE ON attendance\nFOR EACH ROW\nBEGIN\n  INSERT INTO attendance_log (username, attendance_id, operation) \n  VALUES (CURRENT_USER(), OLD.id, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701228733756409 1701230420469529 1701228733835188
