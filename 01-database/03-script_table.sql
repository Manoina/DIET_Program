create table credits_users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_credit INT,
    id_user INT,
    date_demande DATE,
    id_admin INT,
    est_accepte TINYINT,
    date_reponse DATE,

    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_admin) REFERENCES admin(id) ON DELETE CASCADE ON UPDATE CASCADE
);


create table achats_gold(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    date_achat DATE,

    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

create table regimes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30),
    taux_viande DECIMAL(5,2),
    taux_poisson DECIMAL(5,2),
    taux_volaille DECIMAL(5,2),
    var_poids_jour DECIMAL(5,2),
    prix_jour INT
);

create table sports(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30),
    var_poids_jour DECIMAL(5,2)
);

create table programmes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    type VARCHAR(30),
    poids_cible DECIMAL(5,2),
    duree INT,
    id_regime INT,
    duree_regime INT,

    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_regime) REFERENCES regimes(id) ON DELETE CASCADE ON UPDATE CASCADE

);

create table programmes_sports(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_programme INT,
    id_sport INT,
    quantite INT,

    FOREIGN KEY (id_programme) REFERENCES programmes(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_sport) REFERENCES sports(id) ON DELETE CASCADE ON UPDATE CASCADE
);
