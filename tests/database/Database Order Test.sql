SELECT users.user_name, users.user_score, count(t2.user_name) score_rank
FROM users
LEFT JOIN users t2 ON t2.user_score >= users.user_score
WHERE users.user_name='test2'
GROUP BY user_score;