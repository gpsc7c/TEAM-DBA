SELECT * FROM scoreboard_dba.users;

DELIMITER $$

CREATE TRIGGER trigger1
BEFORE INSERT
ON users
FOR EACH ROW
BEGIN
  SELECT COUNT(*) INTO @count FROM users;
  IF @count >= 10000 THEN
    DELETE FROM users
    WHERE user_rank = (SELECT min(user_rank) FROM users);
  END IF;
END
$$

DELIMITER ;