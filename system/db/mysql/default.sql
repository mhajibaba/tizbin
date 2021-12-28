INSERT INTO params VALUES(1, "register", 0, "");
INSERT INTO params VALUES(2, "feedback", 0, "");
INSERT INTO groups VALUES(1, "admin");
INSERT INTO groups VALUES(2, "users");

INSERT INTO users VALUES(1, "admin", "4d722dbb9e7ea5e9013d62f93e93b870", "demo1@tizbin.org", 1, "none", "tizbin", "Team", "0", 0, 'FULL', 1, 1, 1, 0);
INSERT INTO users VALUES(2, "tizbin", "4d722dbb9e7ea5e9013d62f93e93b870", "demo2@tizbin.org", 1, "none", "tizbin", "Team", "0", 0, 'NORMAL', 1, 1, 2, 0);
UPDATE users SET quota_used=0;
-- UPDATE params SET nvalue=1 WHERE name="register";

