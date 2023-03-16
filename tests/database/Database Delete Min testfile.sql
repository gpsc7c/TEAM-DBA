#Delete row test, note that SAFE MODE MUST BE OFF
DELETE FROM scoreboard_dba.users
    WHERE user_rank = (SELECT min(user_rank));