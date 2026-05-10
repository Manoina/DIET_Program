INSERT INTO credits (valeur, code) VALUES
(10, 'GOLD100VABC123'),
(10, 'VS0932CVVOA492'),
(10, '0439FHWVCVP490'),

(20, 'GOLD250VXYZ789'),
(20, 'V0395F7V29502C'), -- id 5
(20, 'V030204V29502C'),

(50, 'GOLD500VDEF456'),
(50, 'VOPS04KVPOV32F'),
(50, 'PAAM192VWRC09U'),

(100, '1038492VABEC8'), -- id 10
(100, 'LXCM939VOP403'),
(100, 'GOLD1KVGHI012');

INSERT INTO credits_users (id_credit, id_user, date_demande, id_admin, est_accepte, date_reponse) VALUES
(1, 1, '2024-05-01', 1, 1, '2024-05-02'),
(6, 1, '2024-05-01', 1, 1, '2024-05-02'),
(5, 1, '2024-05-09', NULL, NULL, NULL), -- En attente mitovy amle en attente eo ambany fa miandry ny admin hi-confirme ny voalohany

(2, 2, '2024-05-03', 1, 1, '2024-05-04'),
(7, 2, '2024-01-02', 1, 1, '2024-01-03'),
(2, 2, '2024--', NULL, NULL, NULL),


(3, 3, '2024-05-05', 1, 0, '2024-05-06'),
(8, 3, '2024-01-02', 1, 1, '2024-01-03'),
(11, 3, '2024--', NULL, NULL, NULL),

(4, 4, '2024-05-07', 1, 1, '2024-05-08'),
(9, 4, '2024-01-02', 1, 1, '2024-01-03'),
(12, 4, '2024--', NULL, NULL, NULL),

(5, 5, '2024-05-09', NULL, NULL, NULL),  -- En attente
(10, 5, '2024-01-02', 1, 1, '2024-01-03');


---- donnee users
 -- back -- u1 no gold
    -- marie -- u2 gold
    -- jean -- u3 no gold
    -- chen -- u4 gold
    -- rabe -- u5 no gold

INSERT INTO achats_gold (id_user, date_achat, prix) VALUES
(2, '2024-04-18', 9.99), -- u2 gold
(4, '2024-04-22', 9.99); -- u4 gold

INSERT INTO regimes (nom, taux_viande, taux_poisson, taux_volaille, var_poids_jour, prix_jour) VALUES
('Hyperprotéiné', 40.00, 30.00, 30.00, -0.50, 15),
('Méditerranéen', 20.00, 50.00, 30.00, -0.30, 12),
('Végétarien Équilibré', 0.00, 40.00, 0.00, -0.20, 10),
('Prise de Masse', 35.00, 25.00, 40.00, 0.30, 18),
('Paléo', 45.00, 35.00, 20.00, -0.40, 20),
('Low Carb', 50.00, 30.00, 20.00, -0.45, 16);

INSERT INTO sports (nom, var_poids_jour) VALUES
('Course à pied', -0.15),
('Natation', -0.20),
('Musculation', 0.05),
('Yoga', -0.05),
('Cyclisme', -0.18),
('HIIT', -0.25),
('Marche rapide', -0.08),
('Crossfit', -0.22);

INSERT INTO programmes (id_user, type, poids_cible, duree, id_regime, duree_regime) VALUES
(1, 'perte', 55.00, 60, 1, 60),
(2, 'perte', 50.00, 45, 2, 45),
(3, 'gain', 80.00, 90, 4, 90),
(4, 'perte', 48.00, 30, 6, 30),
(5, 'perte', 78.00, 50, 5, 50);

INSERT INTO programmes_sports (id_programme, id_sport, quantite) VALUES
-- Programme 1 (user 1)
(1, 1, 30),  -- Course 30 min
(1, 4, 20),  -- Yoga 20 min
-- Programme 2 (user 2)
(2, 2, 45),  -- Natation 45 min
(2, 7, 30),  -- Marche 30 min
-- Programme 3 (user 3 - gain)
(3, 3, 60),  -- Musculation 60 min
(3, 8, 40),  -- Crossfit 40 min
-- Programme 4 (user 4)
(4, 6, 25),  -- HIIT 25 min
(4, 1, 20),  -- Course 20 min
-- Programme 5 (user 5)
(5, 5, 50),  -- Cyclisme 50 min
(5, 6, 30);  -- HIIT 30 min
