-- donnee admin
insert into admins (nom, email, password)
values ('admin', 'admin@root.com', '$2y$10$DO0AueYnJMZmxciA6No/CO2U21.eqAMYfbyD98fQr.KPZqTMIfG5C'); -- admin

-- donnee users
insert into users (nom, password, email, genre, taille, poids, gold)
values ('young back', '$2y$10$FjU2rUmV1vv0QhbihYD4x.QV31u0gqarQywCgVIErjvac7A4kx4yC', 'young@gmail.com', 'M', 160, 60.00, 0); -- back

INSERT INTO users (nom, password, email, genre, taille, poids, gold)
VALUES
('marie dubois', '$2y$10$Bd1BtQcXuRrQuQprw7b1reRgSid/rz8aBvMyGKJ7SQzWIYgudpBa.', 'marie@gmail.com', 'F', 165, 55.50, 1),    -- marie
('jean martin', '$2y$10$1bmhPt4aLmsycONnmFzWZ.iWbT4D4uvZ4hh9s3kReZlCsJRap3YS2', 'jean@gmail.com', 'M', 178, 75.20, 0),  -- jean
('sophie chen', '$2y$10$W6zTJs1MGlZsa.HtMRwfOu9VTEEvxaIV5SLWvaLzgkiYS6tzHXBtm', 'sophie@gmail.com', 'F', 158, 52.00, 1),    -- chen
('pierre rabe', '$2y$10$kq/YOcIh.rI5odrQnItoIuK.g9tmiOJRgdPyPPCYwLC0.R2oQ1xbq', 'pierre@gmail.com', 'M', 182, 85.30, 0);    -- rabe
