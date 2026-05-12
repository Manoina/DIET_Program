CREATE TABLE settings(
    id INT PRIMARY KEY AUTO_INCREMENT,
    prix_gold DECIMAL(10,2),
    reduction_gold DECIMAL(5,2)
);

INSERT INTO settings(prix_gold, reduction_gold)
VALUES (100000, 15);
