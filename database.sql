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
# Table: Contact
#------------------------------------------------------------

CREATE TABLE Contact(
        id_contact       Int  Auto_increment  NOT NULL ,
        intitule_contact Varchar (50) NOT NULL ,
        nom_contact      Varchar (50) NOT NULL ,
        prenom_contact   Varchar (50) NOT NULL ,
        email_contact    Varchar (50) NOT NULL ,
        tel_contact      Varchar (50) NOT NULL
	,CONSTRAINT Contact_PK PRIMARY KEY (id_contact)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Sigle
#------------------------------------------------------------

CREATE TABLE Sigle(
        id_sigle       Int  Auto_increment  NOT NULL ,
        intitule_sigle Varchar (50) NOT NULL ,
        sigle          Varchar (50) NOT NULL
	,CONSTRAINT Sigle_PK PRIMARY KEY (id_sigle)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Priorisation
#------------------------------------------------------------

CREATE TABLE Priorisation(
        id_priorisation Int  Auto_increment  NOT NULL ,
        priorisation    Varchar (50) NOT NULL
	,CONSTRAINT Priorisation_PK PRIMARY KEY (id_priorisation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Grands_Comptes
#------------------------------------------------------------

CREATE TABLE Grands_Comptes(
        id_Grands_Comptes Int  Auto_increment  NOT NULL ,
        Grands_Comptes    Varchar (50) NOT NULL
	,CONSTRAINT Grands_Comptes_PK PRIMARY KEY (id_Grands_Comptes)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Statut_Pdc
#------------------------------------------------------------

CREATE TABLE Statut_Pdc(
        id_statut_pdc Int  Auto_increment  NOT NULL ,
        statut_pdc    Varchar (50) NOT NULL
	,CONSTRAINT Statut_Pdc_PK PRIMARY KEY (id_statut_pdc)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Budget_FebCOm
#------------------------------------------------------------

CREATE TABLE Budget_FebCOm(
        id_budget_FebCom        Int  Auto_increment  NOT NULL ,
        annee_FebCom            Varchar (50) NOT NULL ,
        enveloppe               Int NOT NULL ,
        1er_versement           Int NOT NULL ,
        2eme_versement          Int NOT NULL ,
        FebCom_consomme         Int NOT NULL ,
        reliquat_1er_versement  Int NOT NULL ,
        reliquat_2eme_versement Int NOT NULL ,
        update_at               Date NOT NULL
	,CONSTRAINT Budget_FebCOm_PK PRIMARY KEY (id_budget_FebCom)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Bases de defense
#------------------------------------------------------------

CREATE TABLE Bases_de_defense(
        id_base_defense  Int  Auto_increment  NOT NULL ,
        base_defense     Varchar (50) NOT NULL ,
        id_rfz           Int NOT NULL ,
        id_budget_FebCom Int NOT NULL
	,CONSTRAINT Bases_de_defense_PK PRIMARY KEY (id_base_defense)

	,CONSTRAINT Bases_de_defense_rfz_FK FOREIGN KEY (id_rfz) REFERENCES rfz(id_rfz)
	,CONSTRAINT Bases_de_defense_Budget_FebCOm0_FK FOREIGN KEY (id_budget_FebCom) REFERENCES Budget_FebCOm(id_budget_FebCom)
	,CONSTRAINT Bases_de_defense_Budget_FebCOm_AK UNIQUE (id_budget_FebCom)
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
# Table: Acces_Wan
#------------------------------------------------------------

CREATE TABLE Acces_Wan(
        id_opera    Int  Auto_increment  NOT NULL ,
        id_access   Varchar (50) NOT NULL ,
        type_opera  Varchar (50) NOT NULL ,
        debit_opera Int NOT NULL ,
        etat_opera  Varchar (50) NOT NULL ,
        commentaire Longtext NOT NULL ,
        update_at   Date NOT NULL ,
        id_quartier Int NOT NULL
	,CONSTRAINT Acces_Wan_PK PRIMARY KEY (id_opera)

	,CONSTRAINT Acces_Wan_quartiers_FK FOREIGN KEY (id_quartier) REFERENCES quartiers(id_quartier)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Travaux_Acces_Wan
#------------------------------------------------------------

CREATE TABLE Travaux_Acces_Wan(
        id_travaux_opera        Int  Auto_increment  NOT NULL ,
        date_travaux_opera      Date NOT NULL ,
        debit_fin_travaux_opera Int NOT NULL ,
        etat_travaux_opera      Varchar (50) NOT NULL ,
        id_opera                Int NOT NULL
	,CONSTRAINT Travaux_Acces_Wan_PK PRIMARY KEY (id_travaux_opera)

	,CONSTRAINT Travaux_Acces_Wan_Acces_Wan_FK FOREIGN KEY (id_opera) REFERENCES Acces_Wan(id_opera)
	,CONSTRAINT Travaux_Acces_Wan_Acces_Wan_AK UNIQUE (id_opera)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Cirisi
#------------------------------------------------------------

CREATE TABLE Cirisi(
        id_cirisi       Int  Auto_increment  NOT NULL ,
        cirisi          Varchar (50) NOT NULL ,
        id_base_defense Int NOT NULL
	,CONSTRAINT Cirisi_PK PRIMARY KEY (id_cirisi)

	,CONSTRAINT Cirisi_Bases_de_defense_FK FOREIGN KEY (id_base_defense) REFERENCES Bases_de_defense(id_base_defense)
	,CONSTRAINT Cirisi_Bases_de_defense_AK UNIQUE (id_base_defense)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ContactBdd
#------------------------------------------------------------

CREATE TABLE ContactBdd(
        id_contact       Int NOT NULL ,
        intitule_contact Varchar (50) NOT NULL ,
        nom_contact      Varchar (50) NOT NULL ,
        prenom_contact   Varchar (50) NOT NULL ,
        email_contact    Varchar (50) NOT NULL ,
        tel_contact      Varchar (50) NOT NULL ,
        id_base_defense  Int NOT NULL
	,CONSTRAINT ContactBdd_PK PRIMARY KEY (id_contact)

	,CONSTRAINT ContactBdd_Contact_FK FOREIGN KEY (id_contact) REFERENCES Contact(id_contact)
	,CONSTRAINT ContactBdd_Bases_de_defense0_FK FOREIGN KEY (id_base_defense) REFERENCES Bases_de_defense(id_base_defense)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ContactCirisi
#------------------------------------------------------------

CREATE TABLE ContactCirisi(
        id_contact       Int NOT NULL ,
        intitule_contact Varchar (50) NOT NULL ,
        nom_contact      Varchar (50) NOT NULL ,
        prenom_contact   Varchar (50) NOT NULL ,
        email_contact    Varchar (50) NOT NULL ,
        tel_contact      Varchar (50) NOT NULL ,
        id_cirisi        Int NOT NULL
	,CONSTRAINT ContactCirisi_PK PRIMARY KEY (id_contact)

	,CONSTRAINT ContactCirisi_Contact_FK FOREIGN KEY (id_contact) REFERENCES Contact(id_contact)
	,CONSTRAINT ContactCirisi_Cirisi0_FK FOREIGN KEY (id_cirisi) REFERENCES Cirisi(id_cirisi)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Nature_Affaire
#------------------------------------------------------------

CREATE TABLE Nature_Affaire(
        id_nature_Affaire Int  Auto_increment  NOT NULL ,
        nature_Affaire    Varchar (50) NOT NULL
	,CONSTRAINT Nature_Affaire_PK PRIMARY KEY (id_nature_Affaire)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Etat_pdc
#------------------------------------------------------------

CREATE TABLE Etat_pdc(
        id_etat_pdc Int  Auto_increment  NOT NULL ,
        etat_pdc    Varchar (50) NOT NULL
	,CONSTRAINT Etat_pdc_PK PRIMARY KEY (id_etat_pdc)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Plan_de_Charge
#------------------------------------------------------------

CREATE TABLE Plan_de_Charge(
        id_pdc            Int  Auto_increment  NOT NULL ,
        intitulePdc       Varchar (50) NOT NULL ,
        num_pdc           Varchar (50) NOT NULL ,
        montant_pdc       Int NOT NULL ,
        updateAt          Date NOT NULL ,
        id_statut_pdc     Int NOT NULL ,
        id_Grands_Comptes Int NOT NULL ,
        id_etat_pdc       Int NOT NULL
	,CONSTRAINT Plan_de_Charge_PK PRIMARY KEY (id_pdc)

	,CONSTRAINT Plan_de_Charge_Statut_Pdc_FK FOREIGN KEY (id_statut_pdc) REFERENCES Statut_Pdc(id_statut_pdc)
	,CONSTRAINT Plan_de_Charge_Grands_Comptes0_FK FOREIGN KEY (id_Grands_Comptes) REFERENCES Grands_Comptes(id_Grands_Comptes)
	,CONSTRAINT Plan_de_Charge_Etat_pdc1_FK FOREIGN KEY (id_etat_pdc) REFERENCES Etat_pdc(id_etat_pdc)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Feb
#------------------------------------------------------------

CREATE TABLE Feb(
        id_feb      Int  Auto_increment  NOT NULL ,
        intituleFeb Varchar (50) NOT NULL ,
        num_feb     Varchar (50) NOT NULL ,
        montant_feb Int NOT NULL ,
        updateAt    Date NOT NULL ,
        id_pdc      Int NOT NULL
	,CONSTRAINT Feb_PK PRIMARY KEY (id_feb)

	,CONSTRAINT Feb_Plan_de_Charge_FK FOREIGN KEY (id_pdc) REFERENCES Plan_de_Charge(id_pdc)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Affaire
#------------------------------------------------------------

CREATE TABLE Affaire(
        id_Affaire        Int  Auto_increment  NOT NULL ,
        nom_Affaire       Varchar (255) NOT NULL ,
        objectif_Affaire  Varchar (50) NOT NULL ,
        montant_Affaire   Int NOT NULL ,
        echeance_Affaire  Date NOT NULL ,
        commentaire       Longtext NOT NULL ,
        update_at         Date NOT NULL ,
        id_priorisation   Int NOT NULL ,
        id_nature_Affaire Int NOT NULL ,
        id_feb            Int
	,CONSTRAINT Affaire_PK PRIMARY KEY (id_Affaire)

	,CONSTRAINT Affaire_Priorisation_FK FOREIGN KEY (id_priorisation) REFERENCES Priorisation(id_priorisation)
	,CONSTRAINT Affaire_Nature_Affaire0_FK FOREIGN KEY (id_nature_Affaire) REFERENCES Nature_Affaire(id_nature_Affaire)
	,CONSTRAINT Affaire_Feb1_FK FOREIGN KEY (id_feb) REFERENCES Feb(id_feb)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: info_Bnr
#------------------------------------------------------------

CREATE TABLE info_Bnr(
        id_info_bnr  Int  Auto_increment  NOT NULL ,
        date_demande Date NOT NULL ,
        montant_info Longtext NOT NULL ,
        impact       Longtext NOT NULL ,
        id_Affaire   Int NOT NULL
	,CONSTRAINT info_Bnr_PK PRIMARY KEY (id_info_bnr)

	,CONSTRAINT info_Bnr_Affaire_FK FOREIGN KEY (id_Affaire) REFERENCES Affaire(id_Affaire)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Support_Internet_Militaire
#------------------------------------------------------------

CREATE TABLE Support_Internet_Militaire(
        id_support_internet_militaire Int  Auto_increment  NOT NULL ,
        support                       Varchar (50) NOT NULL
	,CONSTRAINT Support_Internet_Militaire_PK PRIMARY KEY (id_support_internet_militaire)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: internet_militaire
#------------------------------------------------------------

CREATE TABLE internet_militaire(
        id_internet_militaire         Int  Auto_increment  NOT NULL ,
        master_id                     Varchar (50) NOT NULL ,
        ip_pfs                        Varchar (50) NOT NULL ,
        ip_lan_subnet                 Varchar (50) NOT NULL ,
        date_de_validation            Date NOT NULL ,
        etat_internet_militaire       Varchar (50) NOT NULL ,
        commentaire                   Longtext NOT NULL ,
        update_at                     Date NOT NULL ,
        id_organisme                  Int NOT NULL ,
        id_support_internet_militaire Int NOT NULL
	,CONSTRAINT internet_militaire_PK PRIMARY KEY (id_internet_militaire)

	,CONSTRAINT internet_militaire_Organisme_FK FOREIGN KEY (id_organisme) REFERENCES Organisme(id_organisme)
	,CONSTRAINT internet_militaire_Support_Internet_Militaire0_FK FOREIGN KEY (id_support_internet_militaire) REFERENCES Support_Internet_Militaire(id_support_internet_militaire)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Classement_dl
#------------------------------------------------------------

CREATE TABLE Classement_dl(
        id_classement_dl Int  Auto_increment  NOT NULL ,
        Classement_dl    Varchar (50) NOT NULL
	,CONSTRAINT Classement_dl_PK PRIMARY KEY (id_classement_dl)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Info_modip
#------------------------------------------------------------

CREATE TABLE Info_modip(
        id_info_modip        Int  Auto_increment  NOT NULL ,
        classement_dl        Int NOT NULL ,
        classification_modip Int NOT NULL ,
        reno_avant           Varchar (50) NOT NULL ,
        reno_apres           Varchar (50) NOT NULL ,
        annee_coeur_av_tvx   Int NOT NULL ,
        annee_reno_coeur     Int NOT NULL ,
        annee_modip          Int NOT NULL ,
        semestre_modip       Int NOT NULL ,
        id_Affaire           Int NOT NULL ,
        id_classement_dl     Int NOT NULL
	,CONSTRAINT Info_modip_PK PRIMARY KEY (id_info_modip)

	,CONSTRAINT Info_modip_Affaire_FK FOREIGN KEY (id_Affaire) REFERENCES Affaire(id_Affaire)
	,CONSTRAINT Info_modip_Classement_dl0_FK FOREIGN KEY (id_classement_dl) REFERENCES Classement_dl(id_classement_dl)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: beneficier
#------------------------------------------------------------

CREATE TABLE beneficier(
        id_feb       Int NOT NULL ,
        id_organisme Int NOT NULL
	,CONSTRAINT beneficier_PK PRIMARY KEY (id_feb,id_organisme)

	,CONSTRAINT beneficier_Feb_FK FOREIGN KEY (id_feb) REFERENCES Feb(id_feb)
	,CONSTRAINT beneficier_Organisme0_FK FOREIGN KEY (id_organisme) REFERENCES Organisme(id_organisme)
)ENGINE=InnoDB;

