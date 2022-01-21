#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Users
#------------------------------------------------------------

CREATE TABLE Users(
                      id_user   Int  Auto_increment  NOT NULL ,
                      user      Varchar (5) NOT NULL ,
                      pwd       Varchar (50) NOT NULL ,
                      role_user Varchar (50) NOT NULL
    ,CONSTRAINT Users_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: rfz
#------------------------------------------------------------

CREATE TABLE rfz(
                    id_rfz Int  Auto_increment  NOT NULL ,
                    rfz    Varchar (50) NOT NULL
    ,CONSTRAINT rfz_PK PRIMARY KEY (id_rfz)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Bases de defense
#------------------------------------------------------------

CREATE TABLE Bases_de_defense(
                                 id_base_defense Int  Auto_increment  NOT NULL ,
                                 base_defense    Varchar (50) NOT NULL ,
                                 id_rfz          Int NOT NULL
    ,CONSTRAINT Bases_de_defense_PK PRIMARY KEY (id_base_defense)

    ,CONSTRAINT Bases_de_defense_rfz_FK FOREIGN KEY (id_rfz) REFERENCES rfz(id_rfz)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: quartiers
#------------------------------------------------------------

CREATE TABLE quartiers(
                          id_quartier      Int  Auto_increment  NOT NULL ,
                          quartier         Varchar (50) NOT NULL ,
                          trigramme        Varchar (50) NOT NULL ,
                          adresse_quartier Varchar (50) NOT NULL ,
                          id_base_defense  Int NOT NULL
    ,CONSTRAINT quartiers_PK PRIMARY KEY (id_quartier)

    ,CONSTRAINT quartiers_Bases_de_defense_FK FOREIGN KEY (id_base_defense) REFERENCES Bases_de_defense(id_base_defense)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Organisme
#------------------------------------------------------------

CREATE TABLE Organisme(
                          id_organisme Int  Auto_increment  NOT NULL ,
                          organisme    Varchar (50) NOT NULL ,
                          id_quartier  Int NOT NULL
    ,CONSTRAINT Organisme_PK PRIMARY KEY (id_organisme)

    ,CONSTRAINT Organisme_quartiers_FK FOREIGN KEY (id_quartier) REFERENCES quartiers(id_quartier)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Contact
#------------------------------------------------------------

CREATE TABLE Contact(
                        id_contact       Int  Auto_increment  NOT NULL ,
                        intitule_contact Varchar (50) NOT NULL ,
                        nom_contact      Varchar (50) NOT NULL ,
                        prenom_contact   Varchar (50) NOT NULL ,
                        email_contact    Varchar (50) NOT NULL ,
                        tel_contact      Varchar (50) NOT NULL ,
                        id_base_defense  Int
    ,CONSTRAINT Contact_PK PRIMARY KEY (id_contact)

    ,CONSTRAINT Contact_Bases_de_defense_FK FOREIGN KEY (id_base_defense) REFERENCES Bases_de_defense(id_base_defense)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Sigle
#------------------------------------------------------------

CREATE TABLE Sigle(
                      id_sigle Int  Auto_increment  NOT NULL ,
                      sigle    Varchar (50) NOT NULL
    ,CONSTRAINT Sigle_PK PRIMARY KEY (id_sigle)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: internet_militaire
#------------------------------------------------------------

CREATE TABLE internet_militaire(
                                   id_internet_militaire   Int  Auto_increment  NOT NULL ,
                                   master_id               Varchar (50) NOT NULL ,
                                   type_internet_militaire Varchar (50) NOT NULL ,
                                   ip_pfs                  Varchar (50) NOT NULL ,
                                   ip_lan_subnet           Varchar (50) NOT NULL ,
                                   date_de_validation      Date NOT NULL ,
                                   etat_internet_militaire Varchar (50) NOT NULL ,
                                   id_organisme            Int NOT NULL
    ,CONSTRAINT internet_militaire_PK PRIMARY KEY (id_internet_militaire)

    ,CONSTRAINT internet_militaire_Organisme_FK FOREIGN KEY (id_organisme) REFERENCES Organisme(id_organisme)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Opera
#------------------------------------------------------------

CREATE TABLE Opera(
                      id_opera    Int  Auto_increment  NOT NULL ,
                      id_access   Varchar (50) NOT NULL ,
                      type_opera  Varchar (50) NOT NULL ,
                      debit_opera Int NOT NULL ,
                      etat_opera  Varchar (50) NOT NULL ,
                      id_quartier Int NOT NULL
    ,CONSTRAINT Opera_PK PRIMARY KEY (id_opera)

    ,CONSTRAINT Opera_quartiers_FK FOREIGN KEY (id_quartier) REFERENCES quartiers(id_quartier)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Travaux_Opera
#------------------------------------------------------------

CREATE TABLE Travaux_Opera(
                              id_travaux_opera        Int  Auto_increment  NOT NULL ,
                              date_travaux_opera      Date NOT NULL ,
                              debit_fin_travaux_opera Int NOT NULL ,
                              etat_travaux_opera      Varchar (50) NOT NULL ,
                              id_opera                Int NOT NULL
    ,CONSTRAINT Travaux_Opera_PK PRIMARY KEY (id_travaux_opera)

    ,CONSTRAINT Travaux_Opera_Opera_FK FOREIGN KEY (id_opera) REFERENCES Opera(id_opera)
    ,CONSTRAINT Travaux_Opera_Opera_AK UNIQUE (id_opera)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Modip
#------------------------------------------------------------

CREATE TABLE Modip(
                      id_modip                Int  Auto_increment  NOT NULL ,
                      num_declic              Varchar (50) NOT NULL ,
                      classement_dl           Int NOT NULL ,
                      prio_declic             Varchar (50) NOT NULL ,
                      client_modip            Varchar (50) NOT NULL ,
                      classification_op_modip Varchar (50) NOT NULL ,
                      cout_modip              Int NOT NULL ,
                      description_modip       Varchar (50) NOT NULL ,
                      categorie_modip         Varchar (50) NOT NULL ,
                      type_modip              Varchar (50) NOT NULL ,
                      reno_avant              Varchar (50) NOT NULL ,
                      reno_apres              Varchar (50) NOT NULL ,
                      annee_coeur_av_tvx      Int NOT NULL ,
                      annee_reno_coeur        Int NOT NULL ,
                      annee_modip             Int NOT NULL ,
                      semestre_modip          Varchar (50) NOT NULL ,
                      etat_modip              Varchar (50) NOT NULL ,
                      id_quartier             Int NOT NULL
    ,CONSTRAINT Modip_PK PRIMARY KEY (id_modip)

    ,CONSTRAINT Modip_quartiers_FK FOREIGN KEY (id_quartier) REFERENCES quartiers(id_quartier)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Bnr
#------------------------------------------------------------

CREATE TABLE Bnr(
                    id_bnr          Int  Auto_increment  NOT NULL ,
                    prio_bnr        Varchar (50) NOT NULL ,
                    obj_bnr         Varchar (50) NOT NULL ,
                    montant_feb     Varchar (50) NOT NULL ,
                    echeance_bnr    Date NOT NULL ,
                    commentaire_bnr Varchar (50) NOT NULL ,
                    etat_bnr        Varchar (50) NOT NULL ,
                    id_organisme    Int NOT NULL
    ,CONSTRAINT Bnr_PK PRIMARY KEY (id_bnr)

    ,CONSTRAINT Bnr_Organisme_FK FOREIGN KEY (id_organisme) REFERENCES Organisme(id_organisme)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Cirisi
#------------------------------------------------------------

CREATE TABLE Cirisi(
                       id_cirisi       Int  Auto_increment  NOT NULL ,
                       cirirsi         Varchar (50) NOT NULL ,
                       id_base_defense Int NOT NULL
    ,CONSTRAINT Cirisi_PK PRIMARY KEY (id_cirisi)

    ,CONSTRAINT Cirisi_Bases_de_defense_FK FOREIGN KEY (id_base_defense) REFERENCES Bases_de_defense(id_base_defense)
    ,CONSTRAINT Cirisi_Bases_de_defense_AK UNIQUE (id_base_defense)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Contact_CIRISI
#------------------------------------------------------------

CREATE TABLE Contact_CIRISI(
                               id_contact_cirisi       Int  Auto_increment  NOT NULL ,
                               intitule_contact_cirisi Varchar (50) NOT NULL ,
                               nom_contact_cirisi      Varchar (50) NOT NULL ,
                               prenom_contact_cirisi   Varchar (50) NOT NULL ,
                               email_contact_cirisi    Varchar (50) NOT NULL ,
                               tel_contact_cirisi      Varchar (50) NOT NULL ,
                               id_cirisi               Int NOT NULL
    ,CONSTRAINT Contact_CIRISI_PK PRIMARY KEY (id_contact_cirisi)

    ,CONSTRAINT Contact_CIRISI_Cirisi_FK FOREIGN KEY (id_cirisi) REFERENCES Cirisi(id_cirisi)
)ENGINE=InnoDB;

