CREATE TABLE `acces_wan` (
 `id_opera` int(11) NOT NULL AUTO_INCREMENT,
 `id_quartier` int(11) DEFAULT NULL,
 `id_access` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `type_opera` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `debit_opera` int(11) NOT NULL,
 `etat_opera` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `commentaire` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
 `update_at` date NOT NULL,
 PRIMARY KEY (`id_opera`),
 KEY `Acces_Wan_quartiers_FK` (`id_quartier`),
 CONSTRAINT `FK_BB5C0307AE337AB8` FOREIGN KEY (`id_quartier`) REFERENCES `quartiers` (`id_quartier`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `affaire` (
 `id_priorisation` int(11) DEFAULT NULL,
 `id_feb` int(11) DEFAULT NULL,
 `id_Affaire` int(11) NOT NULL AUTO_INCREMENT,
 `nom_Affaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `objectif_Affaire` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `montant_Affaire` decimal(10,2) NOT NULL,
 `echeance_Affaire` date NOT NULL,
 `commentaire` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
 `update_at` date NOT NULL,
 `id_nature_Affaire` int(11) DEFAULT NULL,
 PRIMARY KEY (`id_Affaire`),
 KEY `Affaire_Nature_Affaire1_FK` (`id_nature_Affaire`),
 KEY `Affaire_Feb2_FK` (`id_feb`),
 KEY `Affaire_Priorisation_FK` (`id_priorisation`),
 CONSTRAINT `FK_9C3F18EF46B3FA0E` FOREIGN KEY (`id_priorisation`) REFERENCES `priorisation` (`id_priorisation`),
 CONSTRAINT `FK_9C3F18EF7667D7A0` FOREIGN KEY (`id_nature_Affaire`) REFERENCES `nature_affaire` (`id_nature_Affaire`),
 CONSTRAINT `FK_9C3F18EF9689194C` FOREIGN KEY (`id_feb`) REFERENCES `feb` (`id_feb`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `bases_de_defense` (
 `id_base_defense` int(11) NOT NULL AUTO_INCREMENT,
 `id_rfz` int(11) DEFAULT NULL,
 `base_defense` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `id_budget_FebCom` int(11) DEFAULT NULL,
 PRIMARY KEY (`id_base_defense`),
 UNIQUE KEY `Bases_de_defense_Budget_FebCOm_AK` (`id_budget_FebCom`),
 KEY `Bases_de_defense_rfz_FK` (`id_rfz`),
 CONSTRAINT `FK_90E8530FB5E7D975` FOREIGN KEY (`id_rfz`) REFERENCES `rfz` (`id_rfz`),
 CONSTRAINT `FK_90E8530FE11941AA` FOREIGN KEY (`id_budget_FebCom`) REFERENCES `budget_febcom` (`id_budget_FebCom`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `beneficier` (
 `id_feb` int(11) NOT NULL,
 `id_organisme` int(11) NOT NULL,
 PRIMARY KEY (`id_feb`,`id_organisme`),
 KEY `IDX_BE1877D09689194C` (`id_feb`),
 KEY `IDX_BE1877D05D3AF914` (`id_organisme`),
 CONSTRAINT `FK_BE1877D05D3AF914` FOREIGN KEY (`id_organisme`) REFERENCES `organisme` (`id_organisme`),
 CONSTRAINT `FK_BE1877D09689194C` FOREIGN KEY (`id_feb`) REFERENCES `feb` (`id_feb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `budget_febcom` (
 `id_budget_FebCom` int(11) NOT NULL AUTO_INCREMENT,
 `annee_FebCom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `enveloppe` int(11) NOT NULL,
 `1er_versement` int(11) NOT NULL,
 `2eme_versement` int(11) NOT NULL,
 `FebCom_consomme` int(11) NOT NULL,
 `reliquat_1er_versement` int(11) NOT NULL,
 `reliquat_2eme_versement` int(11) NOT NULL,
 `update_at` date NOT NULL,
 PRIMARY KEY (`id_budget_FebCom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `cirisi` (
 `id_cirisi` int(11) NOT NULL AUTO_INCREMENT,
 `id_base_defense` int(11) DEFAULT NULL,
 `cirisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_cirisi`),
 UNIQUE KEY `Cirisi_Bases_de_defense_AK` (`id_base_defense`),
 CONSTRAINT `FK_1DCCA21ACC623963` FOREIGN KEY (`id_base_defense`) REFERENCES `bases_de_defense` (`id_base_defense`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `classement_dl` (
 `id_Classement_Dl` int(11) NOT NULL AUTO_INCREMENT,
 `Classment_Dl` int(11) NOT NULL,
 PRIMARY KEY (`id_Classement_Dl`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `contact` (
 `id_contact` int(11) NOT NULL AUTO_INCREMENT,
 `intitule_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `nom_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `prenom_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `email_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `tel_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_contact`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `contactbdd` (
 `id_contact` int(11) NOT NULL,
 `id_base_defense` int(11) DEFAULT NULL,
 `intitule_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `nom_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `prenom_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `email_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `tel_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_contact`),
 KEY `ContactBdd_Bases_de_defense0_FK` (`id_base_defense`),
 CONSTRAINT `FK_7EBC2DC492FF4F48` FOREIGN KEY (`id_contact`) REFERENCES `contact` (`id_contact`),
 CONSTRAINT `FK_7EBC2DC4CC623963` FOREIGN KEY (`id_base_defense`) REFERENCES `bases_de_defense` (`id_base_defense`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `contactcirisi` (
 `id_contact` int(11) NOT NULL,
 `id_cirisi` int(11) DEFAULT NULL,
 `intitule_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `nom_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `prenom_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `email_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `tel_contact` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_contact`),
 KEY `ContactCirisi_Cirisi0_FK` (`id_cirisi`),
 CONSTRAINT `FK_BADE5E893BFB17F7` FOREIGN KEY (`id_cirisi`) REFERENCES `cirisi` (`id_cirisi`),
 CONSTRAINT `FK_BADE5E8992FF4F48` FOREIGN KEY (`id_contact`) REFERENCES `contact` (`id_contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `doctrine_migration_versions` (
 `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
 `executed_at` datetime DEFAULT NULL,
 `execution_time` int(11) DEFAULT NULL,
 PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
CREATE TABLE `etat_pdc` (
 `id_etat_pdc` int(11) NOT NULL AUTO_INCREMENT,
 `etat_pdc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_etat_pdc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `feb` (
 `id_feb` int(11) NOT NULL AUTO_INCREMENT,
 `id_pdc` int(11) DEFAULT NULL,
 `intitule_feb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `num_feb` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `montant_feb` decimal(10,2) NOT NULL,
 `updateAt` date NOT NULL,
 PRIMARY KEY (`id_feb`),
 KEY `Feb_Plan_de_Charge_FK` (`id_pdc`),
 CONSTRAINT `FK_82DF116E03EC759` FOREIGN KEY (`id_pdc`) REFERENCES `plan_de_charge` (`id_pdc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `grands_comptes` (
 `id_Grands_Comptes` int(11) NOT NULL AUTO_INCREMENT,
 `Grands_Comptes` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_Grands_Comptes`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `info_bnr` (
 `id_info_bnr` int(11) NOT NULL AUTO_INCREMENT,
 `date_demande` date NOT NULL,
 `montant_info` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
 `impact` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
 `id_Affaire` int(11) DEFAULT NULL,
 PRIMARY KEY (`id_info_bnr`),
 KEY `info_Bnr_Affaire_FK` (`id_Affaire`),
 CONSTRAINT `FK_298809198D1F8803` FOREIGN KEY (`id_Affaire`) REFERENCES `affaire` (`id_Affaire`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `info_modip` (
 `id_info_modip` int(11) NOT NULL AUTO_INCREMENT,
 `classification_modip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `reno_avant` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `reno_apres` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `annee_coeur_av_tvx` int(11) NOT NULL,
 `annee_reno_coeur` int(11) NOT NULL,
 `annee_modip` int(11) NOT NULL,
 `semestre_modip` int(11) NOT NULL,
 `id_Classement_Dl` int(11) DEFAULT NULL,
 `id_Affaire` int(11) DEFAULT NULL,
 PRIMARY KEY (`id_info_modip`),
 KEY `IDX_6578A46F86B4EE73` (`id_Classement_Dl`),
 KEY `Info_modip_Affaire_FK` (`id_Affaire`),
 CONSTRAINT `FK_6578A46F86B4EE73` FOREIGN KEY (`id_Classement_Dl`) REFERENCES `classement_dl` (`id_Classement_Dl`),
 CONSTRAINT `FK_6578A46F8D1F8803` FOREIGN KEY (`id_Affaire`) REFERENCES `affaire` (`id_Affaire`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `internet_militaire` (
 `id_internet_militaire` int(11) NOT NULL AUTO_INCREMENT,
 `id_organisme` int(11) DEFAULT NULL,
 `master_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `ip_pfs` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `ip_lan_subnet` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `date_de_validation` date NOT NULL,
 `etat_internet_militaire` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `commentaire` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `update_at` date NOT NULL,
 `id_support_internet_militaire` int(11) DEFAULT NULL,
 `debit_internet_militaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_internet_militaire`),
 KEY `internet_militaire_Support_FK` (`id_support_internet_militaire`),
 KEY `IDX_9087FF315D3AF914` (`id_organisme`),
 CONSTRAINT `FK_9087FF315179C953` FOREIGN KEY (`id_support_internet_militaire`) REFERENCES `support_internet_militaire` (`id_support_internet_militaire`),
 CONSTRAINT `FK_9087FF315D3AF914` FOREIGN KEY (`id_organisme`) REFERENCES `organisme` (`id_organisme`)
CREATE TABLE `nature_affaire` (
 `id_nature_Affaire` int(11) NOT NULL AUTO_INCREMENT,
 `nature_Affaire` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_nature_Affaire`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `organisme` (
 `id_organisme` int(11) NOT NULL AUTO_INCREMENT,
 `id_quartier` int(11) DEFAULT NULL,
 `organisme` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_organisme`),
 KEY `Organisme_quartiers_FK` (`id_quartier`),
 CONSTRAINT `FK_DD0F4533AE337AB8` FOREIGN KEY (`id_quartier`) REFERENCES `quartiers` (`id_quartier`)
) ENGINE=InnoDB AUTO_INCREMENT=444 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `plan_de_charge` (
 `id_pdc` int(11) NOT NULL AUTO_INCREMENT,
 `id_statut_pdc` int(11) DEFAULT NULL,
 `id_etat_pdc` int(11) DEFAULT NULL,
 `intitule_pdc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `num_pdc` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `montant_pdc` decimal(10,2) NOT NULL,
 `updateAt` date NOT NULL,
 `id_Grands_Comptes` int(11) DEFAULT NULL,
 PRIMARY KEY (`id_pdc`),
 KEY `IDX_FE670B05689A1A0E` (`id_etat_pdc`),
 KEY `Plan_de_Charge_Grands_Comptes0_FK` (`id_Grands_Comptes`),
 KEY `Plan_de_Charge_Statut_Pdc_FK` (`id_statut_pdc`),
 CONSTRAINT `FK_FE670B053AD2C9F5` FOREIGN KEY (`id_Grands_Comptes`) REFERENCES `grands_comptes` (`id_Grands_Comptes`),
 CONSTRAINT `FK_FE670B05689A1A0E` FOREIGN KEY (`id_etat_pdc`) REFERENCES `etat_pdc` (`id_etat_pdc`),
 CONSTRAINT `FK_FE670B05B75F2366` FOREIGN KEY (`id_statut_pdc`) REFERENCES `statut_pdc` (`id_statut_pdc`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `priorisation` (
 `id_priorisation` int(11) NOT NULL AUTO_INCREMENT,
 `priorisation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_priorisation`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `quartiers` (
 `id_quartier` int(11) NOT NULL AUTO_INCREMENT,
 `id_base_defense` int(11) DEFAULT NULL,
 `quartier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `trigramme` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `adresse_quartier` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_quartier`),
 KEY `quartiers_Bases_de_defense_FK` (`id_base_defense`),
 CONSTRAINT `FK_5E2F7BE8CC623963` FOREIGN KEY (`id_base_defense`) REFERENCES `bases_de_defense` (`id_base_defense`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `rfz` (
 `id_rfz` int(11) NOT NULL AUTO_INCREMENT,
 `rfz` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_rfz`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `sigle` (
 `id_sigle` int(11) NOT NULL AUTO_INCREMENT,
 `intitule_sigle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `sigle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_sigle`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `statut_pdc` (
 `id_statut_pdc` int(11) NOT NULL AUTO_INCREMENT,
 `statut_pdc` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_statut_pdc`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `support_internet_militaire` (
 `id_support_internet_militaire` int(11) NOT NULL AUTO_INCREMENT,
 `support` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_support_internet_militaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `travaux_acces_wan` (
 `id_travaux_opera` int(11) NOT NULL AUTO_INCREMENT,
 `id_opera` int(11) DEFAULT NULL,
 `date_travaux_opera` date NOT NULL,
 `debit_fin_travaux_opera` int(11) NOT NULL,
 `etat_travaux_opera` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 PRIMARY KEY (`id_travaux_opera`),
 UNIQUE KEY `Travaux_Acces_Wan_Acces_Wan_AK` (`id_opera`),
 CONSTRAINT `FK_51DA6466315AB55C` FOREIGN KEY (`id_opera`) REFERENCES `acces_wan` (`id_opera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
CREATE TABLE `users` (
 `id_user` int(11) NOT NULL AUTO_INCREMENT,
 `user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
 `pwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
 PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci