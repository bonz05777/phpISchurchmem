TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER officer_insert_log AFTER INSERT ON officer\nFOR EACH ROW\nBEGIN\n  INSERT INTO officer_log (username, officeID, year, operation)\n  VALUES (CURRENT_USER(), NEW.officeID, NEW.year, "INSERT");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER officer_update_log AFTER UPDATE ON officer\nFOR EACH ROW\nBEGIN\n  INSERT INTO officer_log (username, officeID, year, operation)\n  VALUES (CURRENT_USER(), OLD.officeID, OLD.year, "UPDATE");\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER officer_delete_log AFTER DELETE ON officer\nFOR EACH ROW\nBEGIN\n  INSERT INTO officer_log (username, officeID, year, operation)\n  VALUES (CURRENT_USER(), OLD.officeID, OLD.year, "DELETE");\nEND'
sql_modes=1098907648 1098907648 1098907648
definers='root@localhost' 'root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1701231927773480 1701231927789341 1701231927802197
