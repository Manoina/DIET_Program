ALTER TABLE users CHANGE gold est_gold TINYINT;

ALTER TABLE users
ADD COLUMN solde DECIMAL(10,2);

ALTER TABLE users
ADD COLUMN created_at TIMESTAMP;

update users set solde = 30.00 , created_at = '2024-04-29 10:15:11' where id=1;
update users set solde = 60.00 , created_at = '2024-01-01 23:46:10' where id=2;
update users set solde = 60.00 , created_at = '2024-01-01 04:40:32' where id=3;
update users set solde = 70.00 , created_at = '2024-01-01 13:10:34' where id=4;
update users set solde = 100.00 , created_at = '2023-12-31 18:30:55' where id=5;
