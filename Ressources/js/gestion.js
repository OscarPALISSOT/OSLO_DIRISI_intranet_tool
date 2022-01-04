
$(document).ready(function () {


    // process the form

    var formdata = {
        'bureau': window.location.pathname,
        'role': frole,
        'methode': 'POST'

    };

var filetitle = "Fichier export";

    // process the form
    console.log(formdata);
    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: 'Modèle/gestion.php', // the url where we want to POST
        data: formdata, // our data object
        dataType: 'json', // what type of data do we expect back from the server
        encode: true
    })
        // using the done promise callback
        .done(function (data) {


            // log data to the console so we can see
            console.log(data);

            switch (formdata['bureau']) {
                case '/BPT':
				filetitle = "MODIP PLANIF DL METZ";
                $('#tableBRCfinis').bootstrapTable({

                    data: data['resultat'],
                    pagination: true,
                    search: true,
                    pageList: [10, 25, 50, 100, 200, "All"],
                    showColumns: true,
                    showToggle: true,
                    showExport: true,
                    showColumnsToggleAll: true,
                    uniqueId: 'ID',




                    columns: [
                        {
                            field: 'selections',
                            checkbox: true,
                            clickToSelect: true,

                        },


                        {
                            showColumns: false,
                            //checkbox: true,
                            field: 'ID',
                            sortable: true,
                            title: 'ID'
                        }
                        , {
                            field: 'Nature',
                            sortable: true,
                            title: 'Nature'
                        }, {
                            field: 'Zone',
                            sortable: true,
                            title: 'Zone'
                        }, {
                            field: 'N_ASAP',
                            sortable: true,
                            title: 'N° ASAP'

                        }, {
                            field: 'N_SERVICE_du_PDC',
                            sortable: true,
                            title: 'N° SERVICE du PDC'
                        }, {
                            field: 'N_RANG',
                            sortable: true,
                            title: 'N° RANG'
                        }, {
                            field: 'Priorisation',
                            sortable: true,
                            title: 'Priorisation'
                        }, {
                            field: 'Bénéficiaire',
                            sortable: true,
                            title: 'Bénéficiaire'
                        }, {
                            field: 'BDD_Impliquée',
                            sortable: true,
                            title: 'BDD Impliquée'
                        }, {
                            field: 'Description_Service',
                            sortable: true,
                            title: 'Description Service'
                        }, {
                            field: 'Objectifs_et_description_fonctionnelle',
                            sortable: true,
                            title: 'Objectifs et description fonctionnelle'
                        },{
                            field: 'Montant_FEB',
                            sortable: true,
                            title: 'Montant FEB'
                        },{
                            field: 'Date_retour_DTS',
                            sortable: true,
                            title: 'Date retour DTS'
                        },{
                            field: 'Point_de_situation',
                            sortable: true,
                            title: 'Point de situation'
                        },{
                            field: '(J/H)_Chef_de_projet',
                            sortable: true,
                            title: 'Chef de projet'
                        },{
                            field: '(J/H)_Technicien',
                            sortable: true,
                            title: 'Technicien'
                        },{
                            field: 'Trigramme',
                            sortable: true,
                            title: 'Trigramme'
                        },{
                            field: 'Nom',
                            sortable: true,
                            title: 'Organisme'
                        },{
                            field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                $.ajax({
                                    data: row,
                                    type: 'GET',
                                    url: 'Vue/Formulaires/ModifierBnrFinis.php',

                                })

                                    .done(function (data) {
                                        // console.log(data);
                                        $("#modalBRCfini").append(data)

                                    })

                                return [

                                    '<button title="Modifier un élément BNR" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit-bnrfinis' + row[0] + '" type="button">',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                ].join('')
                            }

                        }]

                })
                $('#tableBRCprevus').bootstrapTable({

                    data: data['resultat2'],
                    pagination: true,
                    search: true,
                    pageList: [10, 25, 50, 100, 200, "All"],
                    showColumns: true,
                    showToggle: true,
                    showExport: true,
                    showColumnsToggleAll: true,
                    uniqueId: 'ID',



                    columns: [
                        {
                            field: 'selections',
                            checkbox: true,
                            clickToSelect: true,

                        },


                        {
                            showColumns: false,
                            //checkbox: true,
                            field: 'ID',
                            sortable: true,
                            title: 'ID',
                            
                        }
                        ,  /*{
                           field: 'Nature',
                            sortable: true,
                            title: 'Nature'
                        }, {
                            field: 'Zone',
                            sortable: true,
                            title: 'Zone'
                        }, {
                            field: 'N_ASAP',
                            sortable: true,
                            title: 'N° ASAP'

                        }, {
                            field: 'N_SERVICE_du_PDC',
                            sortable: true,
                            title: 'N° SERVICE du PDC'
                        }, {
                            field: 'N_RANG',
                            sortable: true,
                            title: 'N° RANG'
                        },*/ {
                            field: 'Priorisation',
                            sortable: true,
                            title: 'Priorisation'
                        }, {
                            field: 'Bénéficiaire',
                            sortable: true,
                            title: 'Bénéficiaire'
                        }, {
                            field: 'BDD_Impliquée',
                            sortable: true,
                            title: 'BDD Impliquée'
                        }, /*{
                            field: 'Description_Service',
                            sortable: true,
                            title: 'Description Service'
                        }, */{
                            field: 'Objectifs_et_description_fonctionnelle',
                            sortable: true,
                            title: 'Objectifs et description fonctionnelle'
                        },{
                            field: 'Montant_FEB',
                            sortable: true,
                            title: 'Montant FEB'
                        },{
                            field: 'Echeance_souhaitée',
                            sortable: true,
                            title: 'Echeance souhaitée'
                        },{
                            field: 'Date_de_la_demande',
                            sortable: true,
                            title: 'Date de la demande'
                        },{
                            field: 'Point_de_situation',
                            sortable: true,
                            title: 'Point de situation'
                        }, /*{
                            field: '(J/H)_Chef_de_projet',
                            sortable: true,
                            title: 'Chef de projet'
                        },{
                            field: '(J/H)_Technicien',
                            sortable: true,
                            title: 'Technicien'
                        }, */{
                            field: 'Trigramme',
                            sortable: true,
                            title: 'Trigramme'
                        },{
                            field: 'Nom',
                            sortable: true,
                            title: 'Organisme'
                        },
                        {
                            field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                $.ajax({
                                    data: row,
                                    type: 'GET',
                                    url: 'Vue/Formulaires/ModifierBnr.php',

                                })

                                    .done(function (data) {
                                        // console.log(data);
                                        $("#modalBRC").append(data)

                                    })


                                return [

                                    '<button title="Modifier un élément BNR" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit-bnr' + row[0] + '" type="button">',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                ].join('')
                            }

                        }]

                })


                
                $('#tableMODIPprevu').bootstrapTable({
                    data: data['resultat3'],
                    pagination: true,
                    pageList: [10, 25, 50, 100, 200, "All"],
                    search: true,
                    showColumns: true,
                    showExport: true,
                    showColumnsToggleAll: true,
                    uniqueId: 'ID',



                    columns: [{
                        field: 'selections',
                        checkbox: true,
                        clickToSelect: true,

                    }, {
                        field: 'Id_modip',
                        title: 'ID',
                        sortable: true,
                        searchable: false
                    }, {
                        field: 'Numero_DECLIC',
                        sortable: true,
                        title: 'Numéro DECLIC'

                    },  {
                        field: 'Classement_DL',
                        sortable: true,
                        title: 'Classement_DL'

                    },  {
                        field: 'Priorite_DECLIC',
                        sortable: true,
                        title: 'Priorite DECLIC'

                    }, {
                        field: 'Site',
                        sortable: true,
                        title: 'Site'

                    }, {
                        field: 'Trigramme',
                        sortable: true,
                        title: 'Trigramme'

                    }, {
                        field: 'Classification Site',
                        sortable: true,
                        title: 'Priorite DECLIC'

                    }, {
                        field: 'clients',
                        sortable: true,
                        title: 'Clients'

                    }, {
                        field: 'Classification_Operation',
                        sortable: true,
                        title: 'Classification Operation'

                    }, {
                        field: 'Cout',
                        sortable: true,
                        title: 'Cout'

                    }, {
                        field: 'Description',
                        sortable: true,
                        title: 'Description'

                    }, {
                        field: 'Categorie',
                        sortable: true,
                        title: 'Categorie'

                    }, {
                        field: 'Type',
                        sortable: true,
                        title: 'Type'

                    }, {
                        field: 'reno_avant',
                        sortable: true,
                        title: 'reno avant'

                    }, {
                        field: 'reno_apres',
                        sortable: true,
                        title: 'reno apres'
                    }, {
                        field: 'Annee_Coeur_av_tvx',
                        sortable: true,
                        title: 'Annee Coeur av tvx'

                    }, {
                        field: 'Annee_reno_coeur',
                        sortable: true,
                        title: 'Annee reno coeur'
                    }, {
                        field: 'Annee',
                        sortable: true,
                        title: 'Année'
                    }, {
                        field: 'Semestre',
                        sortable: true,
                        title: 'Semestre'
                    }, {
                        field: 'operation',
                        formatter: function operateFormatter(value, row, index) {
                            $.ajax({
                                data: row,
                                type: 'GET',
                                url: 'Vue/Formulaires/ModifierModip.php',

                            })

                                .done(function (data) {
                                    // console.log(data);
                                    $("#modalBRC2").append(data)

                                })

                            return [

                                '<button title="Modifier un élément MODIP" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit_modip' + row[0] + '" type = "button" >',
                                '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                '</button>'
                            ].join('')
                        
                        }
                    }]
                })

                $('#tableMODIPfini').bootstrapTable({
                    data: data['resultat4'],
                    pagination: true,
                    pageList: [10, 25, 50, 100, 200, "All"],
                    search: true,
                    showColumns: true,
                    showExport: true,
                    showColumnsToggleAll: true,
                    uniqueId: 'ID',



                    columns: [{
                        field: 'selections',
                        checkbox: true,
                        clickToSelect: true,

                    }, {
                        field: 'ID',
                        title: 'ID',
                        sortable: true,
                        searchable: false
                    }, {
                        field: 'Numero_DECLIC',
                        sortable: true,
                        title: 'Numéro DECLIC'

                    },  {
                        field: 'Classement_DL',
                        sortable: true,
                        title: 'Classement_DL'

                    },  {
                        field: 'Priorite_DECLIC',
                        sortable: true,
                        title: 'Priorite DECLIC'

                    }, {
                        field: 'Site',
                        sortable: true,
                        title: 'Site'

                    }, {
                        field: 'Trigramme',
                        sortable: true,
                        title: 'Trigramme'

                    }, {
                        field: 'Classification Site',
                        sortable: true,
                        title: 'Priorite DECLIC'

                    }, {
                        field: 'clients',
                        sortable: true,
                        title: 'Clients'

                    }, {
                        field: 'Classification_Operation',
                        sortable: true,
                        title: 'Classification Operation'

                    }, {
                        field: 'Cout',
                        sortable: true,
                        title: 'Cout'

                    }, {
                        field: 'Description',
                        sortable: true,
                        title: 'Description'

                    }, {
                        field: 'Categorie',
                        sortable: true,
                        title: 'Categorie'

                    }, {
                        field: 'Type',
                        sortable: true,
                        title: 'Type'

                    }, {
                        field: 'reno_avant',
                        sortable: true,
                        title: 'reno avant'

                    }, {
                        field: 'reno_apres',
                        sortable: true,
                        title: 'reno apres'
                    }, {
                        field: 'Annee_Coeur_av_tvx',
                        sortable: true,
                        title: 'Annee Coeur av tvx'

                    }, {
                        field: 'Annee_reno_coeur',
                        sortable: true,
                        title: 'Annee reno coeur'
                    }, {
                        field: 'Annee',
                        sortable: true,
                        title: 'Année'
                    }, {
                        field: 'Semestre',
                        sortable: true,
                        title: 'Semestre'
                    }, {
                        field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                $.ajax({
                                    data: row,
                                    type: 'GET',
                                    url: 'Vue/Formulaires/ModifierModipFini.php',

                                })

                                    .done(function (data) {
                                        // console.log(data);
                                        $("#modalBRCfini2").append(data)

                                    })

                                return [
                                    '<button title="Modifier un élément MODIP" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit_modipfini' + row[0] + '" type = "button" >',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                ].join('')
                            }
                        }]

                    })
                    break;

                case '/BRC':

					filetitle = "Suivi PDCA et BNR";
                    $('#tableBRCfinis').bootstrapTable({

                        data: data['resultat'],
                        pagination: true,
                        search: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        showColumns: true,
                        showToggle: true,
                        showExport: true,
                        showColumnsToggleAll: true,
                        uniqueId: 'ID',




                        columns: [
                            {
                                field: 'selections',
                                checkbox: true,
                                clickToSelect: true,

                            },


                            {
                                showColumns: false,
                                //checkbox: true,
                                field: 'ID',
                                sortable: true,
                                title: 'ID'
                            }
                            , {
                                field: 'Nature',
                                sortable: true,
                                title: 'Nature'
                            }, {
                                field: 'Zone',
                                sortable: true,
                                title: 'Zone'
                            }, {
                                field: 'N_ASAP',
                                sortable: true,
                                title: 'N° ASAP'

                            }, {
                                field: 'N_SERVICE_du_PDC',
                                sortable: true,
                                title: 'N° SERVICE du PDC'
                            }, {
                                field: 'N_RANG',
                                sortable: true,
                                title: 'N° RANG'
                            }, {
                                field: 'Priorisation',
                                sortable: true,
                                title: 'Priorisation'
                            }, {
                                field: 'Bénéficiaire',
                                sortable: true,
                                title: 'Bénéficiaire'
                            }, {
                                field: 'BDD_Impliquée',
                                sortable: true,
                                title: 'BDD Impliquée'
                            }, {
                                field: 'Description_Service',
                                sortable: true,
                                title: 'Description Service'
                            }, {
                                field: 'Objectifs_et_description_fonctionnelle',
                                sortable: true,
                                title: 'Objectifs et description fonctionnelle'
                            },{
                                field: 'Montant_FEB',
                                sortable: true,
                                title: 'Montant FEB'
                            },{
                                field: 'Date_retour_DTS',
                                sortable: true,
                                title: 'Date retour DTS'
                            },{
                                field: 'Point_de_situation',
                                sortable: true,
                                title: 'Point de situation'
                            },{
                                field: 'Chef_de_projet',
                                sortable: true,
                                title: 'Chef de projet'
                            },{
                                field: 'Technicien',
                                sortable: true,
                                title: 'Technicien'
                            },{
                                field: 'Trigramme',
                                sortable: true,
                                title: 'Trigramme'
                            },{
                                field: 'Nom',
                                sortable: true,
                                title: 'Organisme'
                            },{
                                field: 'operation',
                                formatter: function operateFormatter(value, row, index) {
                                    $.ajax({
                                        data: row,
                                        type: 'GET',
                                        url: 'Vue/Formulaires/ModifierBnrFinis.php',

                                    })

                                        .done(function (data) {
                                            // console.log(data);
                                            $("#modalBRCFINI").append(data)

                                        })


                                    return [

                                        '<button title="Modifier un élément BNR" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit-bnrfinis' + row[0] + '" type="button">',
                                        '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                        '</button>'
                                    ].join('')
                                }

                            }]

                    })
                    $('#tableBRCprevus').bootstrapTable({

                        data: data['resultat2'],
                        pagination: true,
                        search: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        showColumns: true,
                        showToggle: true,
                        showExport: true,
                        showColumnsToggleAll: true,
                        uniqueId: 'ID',



                        columns: [
                            {
                                field: 'selections',
                                checkbox: true,
                                clickToSelect: true,

                            },


                            {
                                showColumns: false,
                                //checkbox: true,
                                field: 'ID',
                                sortable: true,
                                title: 'ID',
                                
                            }
                            ,  /*{
                               field: 'Nature',
                                sortable: true,
                                title: 'Nature'
                            }, {
                                field: 'Zone',
                                sortable: true,
                                title: 'Zone'
                            }, {
                                field: 'N_ASAP',
                                sortable: true,
                                title: 'N° ASAP'

                            }, {
                                field: 'N_SERVICE_du_PDC',
                                sortable: true,
                                title: 'N° SERVICE du PDC'
                            }, {
                                field: 'N_RANG',
                                sortable: true,
                                title: 'N° RANG'
                            },*/ {
                                field: 'Priorisation',
                                sortable: true,
                                title: 'Priorisation'
                            }, {
                                field: 'Bénéficiaire',
                                sortable: true,
                                title: 'Bénéficiaire'
                            }, {
                                field: 'BDD_Impliquée',
                                sortable: true,
                                title: 'BDD Impliquée'
                            }, /*{
                                field: 'Description_Service',
                                sortable: true,
                                title: 'Description Service'
                            }, */{
                                field: 'Objectifs_et_description_fonctionnelle',
                                sortable: true,
                                title: 'Objectifs et description fonctionnelle'
                            },{
                                field: 'Montant_FEB',
                                sortable: true,
                                title: 'Montant FEB'
                            },{
                                field: 'Echeance_souhaitée',
                                sortable: true,
                                title: 'Echeance souhaitée'
                            },{
                                field: 'Date_de_la_demande',
                                sortable: true,
                                title: 'Date de la demande'
                            },{
                                field: 'Point_de_situation',
                                sortable: true,
                                title: 'Point de situation'
                            }, /*{
                                field: '(J/H)_Chef_de_projet',
                                sortable: true,
                                title: 'Chef de projet'
                            },{
                                field: '(J/H)_Technicien',
                                sortable: true,
                                title: 'Technicien'
                            }, */{
                                field: 'Trigramme',
                                sortable: true,
                                title: 'Trigramme'
                            },{
                                field: 'Nom',
                                sortable: true,
                                title: 'Organisme'
                            },
                            {
                                field: 'operation',
                                formatter: function operateFormatter(value, row, index) {
                                    $.ajax({
                                        data: row,
                                        type: 'GET',
                                        url: 'Vue/Formulaires/ModifierBnr.php',

                                    })

                                        .done(function (data) {
                                            // console.log(data);
                                            $("#modalBRC").append(data)

                                        })


                                    return [

                                        '<button title="Modifier un élément BNR" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit-bnr' + row[0] + '" type="button">',
                                        '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                        '</button>'
                                    ].join('')
                                }

                            }]

                    })


                    
                    $('#tableMODIPprevu').bootstrapTable({
                        data: data['resultat3'],
                        pagination: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        search: true,
                        showColumns: true,
                        showExport: true,
                        showColumnsToggleAll: true,
                        uniqueId: 'ID',
    
    
    
                        columns: [{
                            field: 'selections',
                            checkbox: true,
                            clickToSelect: true,
    
                        }, {
                            field: 'ID',
                            title: 'ID',
                            sortable: true,
                            searchable: false
                        }, {
                            field: 'Numero_DECLIC',
                            sortable: true,
                            title: 'Numéro DECLIC'
    
                        },  {
                            field: 'Classement_DL',
                            sortable: true,
                            title: 'Classement_DL'
    
                        },  {
                            field: 'Priorite_DECLIC',
                            sortable: true,
                            title: 'Priorite DECLIC'
    
                        }, {
                            field: 'Site',
                            sortable: true,
                            title: 'Site'
    
                        }, {
                            field: 'Trigramme',
                            sortable: true,
                            title: 'Trigramme'
    
                        }, {
                            field: 'Classification Site',
                            sortable: true,
                            title: 'Priorite DECLIC'
    
                        }, {
                            field: 'clients',
                            sortable: true,
                            title: 'Clients'
    
                        }, {
                            field: 'Classification_Operation',
                            sortable: true,
                            title: 'Classification Operation'
    
                        }, {
                            field: 'Cout',
                            sortable: true,
                            title: 'Cout'
    
                        }, {
                            field: 'Description',
                            sortable: true,
                            title: 'Description'
    
                        }, {
                            field: 'Categorie',
                            sortable: true,
                            title: 'Categorie'
    
                        }, {
                            field: 'Type',
                            sortable: true,
                            title: 'Type'
    
                        }, {
                            field: 'reno_avant',
                            sortable: true,
                            title: 'reno avant'
    
                        }, {
                            field: 'reno_apres',
                            sortable: true,
                            title: 'reno apres'
                        }, {
                            field: 'Annee_Coeur_av_tvx',
                            sortable: true,
                            title: 'Annee Coeur av tvx'
    
                        }, {
                            field: 'Annee_reno_coeur',
                            sortable: true,
                            title: 'Annee reno coeur'
                        }, {
                            field: 'Annee',
                            sortable: true,
                            title: 'Année'
                        }, {
                            field: 'Semestre',
                            sortable: true,
                            title: 'Semestre'
                        }, {
                            field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                $.ajax({
                                    data: row,
                                    type: 'GET',
                                    url: 'Vue/Formulaires/ModifierModip.php',
    
                                })
    
                                    .done(function (data) {
                                        // console.log(data);
                                        $("#modalBRC2").append(data)
    
                                    })
    
                                return [
    
                                    '<button title="Modifier un élément MODIP" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit_modip' + row[0] + '" type = "button" >',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                ].join('')
                            
                            }
                        }]
                    })

                    $('#tableMODIPfini').bootstrapTable({
                        data: data['resultat4'],
                        pagination: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        search: true,
                        showColumns: true,
                        showExport: true,
                        showColumnsToggleAll: true,
                        uniqueId: 'Id_modip',



                        columns: [{
                            field: 'selections',
                            checkbox: true,
                            clickToSelect: true,

                        }, {
                            field: 'ID',
                            title: 'ID',
                            sortable: true,
                            searchable: false
                        }, {
                            field: 'Numero_DECLIC',
                            sortable: true,
                            title: 'Numéro DECLIC'

                        },  {
                            field: 'Classement_DL',
                            sortable: true,
                            title: 'Classement_DL'

                        },  {
                            field: 'Priorite_DECLIC',
                            sortable: true,
                            title: 'Priorite DECLIC'

                        }, {
                            field: 'Site',
                            sortable: true,
                            title: 'Site'

                        }, {
                            field: 'Trigramme',
                            sortable: true,
                            title: 'Trigramme'

                        }, {
                            field: 'Classification Site',
                            sortable: true,
                            title: 'Priorite DECLIC'

                        }, {
                            field: 'clients',
                            sortable: true,
                            title: 'Clients'

                        }, {
                            field: 'Classification_Operation',
                            sortable: true,
                            title: 'Classification Operation'

                        }, {
                            field: 'Cout',
                            sortable: true,
                            title: 'Cout'

                        }, {
                            field: 'Description',
                            sortable: true,
                            title: 'Description'

                        }, {
                            field: 'Categorie',
                            sortable: true,
                            title: 'Categorie'

                        }, {
                            field: 'Type',
                            sortable: true,
                            title: 'Type'

                        }, {
                            field: 'reno_avant',
                            sortable: true,
                            title: 'reno avant'

                        }, {
                            field: 'reno_apres',
                            sortable: true,
                            title: 'reno apres'
                        }, {
                            field: 'Annee_Coeur_av_tvx',
                            sortable: true,
                            title: 'Annee Coeur av tvx'

                        }, {
                            field: 'Annee_reno_coeur',
                            sortable: true,
                            title: 'Annee reno coeur'
                        }, {
                            field: 'Annee',
                            sortable: true,
                            title: 'Année'
                        }, {
                            field: 'Semestre',
                            sortable: true,
                            title: 'Semestre'
                        }, {
                            field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                $.ajax({
                                    data: row,
                                    type: 'GET',
                                    url: 'Vue/Formulaires/ModifierModipFini.php',

                                })

                                    .done(function (data) {
                                        // console.log(data);
                                        $("#modalBRCfini2").append(data)

                                    })

                                return [
                                    '<button title="Modifier un élément MODIP" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit_modipfini' + row[0] + '" type = "button" >',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                ].join('')
                            }
                        }]

                    })

                    $('#tableMIM3').bootstrapTable({
                        data: data['resultat5'],
                        pagination: true,
                        search: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        showColumns: true,
                        showToggle: true,
                        showExport: true,
                        showColumnsToggleAll: true,
						uniqueId: 'Id_mim',

                        columns: [
						{
                                field: 'selections',
                                checkbox: true,
                                clickToSelect: true,

                        }, {
                                field: 'Id_mim',
                                sortable: true,
                                title: 'ID'
                        }, {
                            field: 'Master_ID',
                            sortable: true,
                            title: 'MASTER ID'

                        },{
                            field: 'Type',
                            sortable: true,
                            title: 'Type'
                        }, {
                            field: 'Debit',
                            sortable: true,
                            title: 'Debit'
                        }, {
                            field: 'Debit_final',
                            sortable: true,
                            title: 'Debit Final'
                        }, {
                            field: 'IP_PFS',
                            sortable: true,
                            title: 'IP PFS'
						},  {
                            field: 'IP_LAN_SUBNET',
                            sortable: true,
                            title: 'IP LAN SUBNET'
                        }, {
                                field: 'Trigramme',
                                sortable: true,
                                title: 'Trigramme'

                        }, {
                            field: 'Organisme',
                            sortable: true,
                            title: 'Organisme'
                        }, {
                            field: 'Date_de_validation',
                            sortable: true,
                            title: 'Date de validation'
                        }, {
                            field: 'Etat',
                            sortable: true,
                            title: 'Etat'
						} , {
                            field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                $.ajax({
                                    data: row,
                                    type: 'GET',
                                    url: 'Vue/Formulaires/modifierMim3.php',

                                })

                                    .done(function (data) {
                                        // console.log(data);
                                        $("#modalBCS2").append(data)

                                    })

                                return [

                                    '<button title="Modifier un élément MIM3" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit_mim3' + row[0] + '" type = "button" >',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                ].join('')
                            
                            }
                        }]
                       
                    })

                    /*$('#tableTrvMIM3').bootstrapTable({
                        data: data['resultat6'],
                        pagination: true,
                        search: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        showColumns: true,
                        showToggle: true,
                        showExport: true,
                        showColumnsToggleAll: true,
						uniqueId:'Id8_trv_mim',

                        columns: [
						{
                                field: 'selections',
                                checkbox: true,
                                clickToSelect: true,

                        },{
                            field: 'Id8_trv_mim',
                            sortable: true,
                            title: 'ID'
                        }, {
                            field: 'Master_ID',
                            sortable: true,
                            title: 'MASTER ID'
                        }, {
                            field: 'Date',
                            sortable: true,
                            title: 'Date'
                        }, {
                            field: 'Debit',
                            sortable: true,
                            title: 'Debit'
                        }, {
                            field: 'Debit_futur',
                            sortable: true,
                            title: 'Débit futur'

                        }, {
                            field: 'Dateintervalle',
                            sortable: true,
                            title: 'date prévisionnelle de fin de travaux'
						},{
                            field: 'Etat',
                            sortable: true,
                            title: 'Etat'
						} , {
                            field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                $.ajax({
                                    data: row,
                                    type: 'GET',
                                    url: 'Vue/Formulaires/TravauxMIM3.php',

                                })

                                    .done(function (data) {
                                        // console.log(data);
                                        $('#modal' + formdata['bureau'].substr(1) + "trv2").append(data)

                                    })

                                return [

                                    '<button title="Modifier un élément MIM3" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#travaux_mim_edit' + row[0] + '" type = "button" >',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                ].join('')
                            
                            }
                        }]
                       
                    })*/
                    $('#tableOPERA').bootstrapTable({
                        data: data['resultat7'],
                        pagination: true,
                        search: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        showColumns: true,
                        showColumnsToggleAll: true,
                        uniqueId: 'Id_opera',

                        columns: [
                            {
                                field: 'selections',
                                checkbox: true,
                                clickToSelect: true,

                            }, {
                                showColumns:false,
                                searchable:false,
                                field: 'Id_opera',
                                sortable: true,
                                title: 'ID'
                                
                            }, {
                                field: 'Id_access',
                                sortable: true,
                                title: 'ID ACCESS'

                            }, {
                                field: 'Type',
                                sortable: true,
                                title: 'Type'
                            } ,{
                                field: 'Debit',
                                sortable: true,
                                title: 'Débit'
                            }, {
                                field: 'Trigramme',
                                sortable: true,
                                title: 'Trigramme',
                                searchable:true
                            }, {
                                field: 'Nom_Quartier',
                                sortable: true,
                                title: 'Nom Quartier'
                            }, {
                            field: 'Etat',
                            sortable: true,
                            title: 'Etat'
						} , {
                                field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                    return [                                        
                                        '<button title="Modifier un élément OPERA" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#opera_' + row[0] + '" type="button">',
                                        '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                        '</button>',                                          
                                    ].join('')
                                }
                        }]

                    })
                    $.each($('#tableOPERA').bootstrapTable('getData'), function(index, value){
                        $.ajax({
                                data: value,
                                type: 'GET',
                                url: 'Vue/Formulaires/Opera.php',
                            }) .done(function (data) {
                                        // console.log(data);
                                        $("#modalBCS").append(data)
                                    })
                    })

                    
       
                    $('#tableTrvOPERA').bootstrapTable({
                        data: data['resultat8'],
                        pagination: true,
                        search: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        showColumns: true,
                        showExport: true,
                        showColumnsToggleAll: true,
                        uniqueId: 'Id_trv_opera',

                        columns: [
                            {
                                field: 'selections',
                                checkbox: true,
                                clickToSelect: true,

                            }, {
                                field: 'Id_trv_opera',
                                sortable: true,
                                title: 'ID'
                            }, {
                                field: 'Id_access',
                                sortable: true,
                                title: 'ID ACCESS'
                            }, {
                                field: 'Date',
                                sortable: true,
                                title: 'Date'
                            }, {
                                field: 'Debit',
                                sortable: true,
                                title: 'Debit'
                            }, {
                                field: 'Debit_futur',
                                sortable: true,
                                title: 'Débit futur'
                            }, {
                                field: 'Trigramme',
                                sortable: true,
                                title: 'Trigramme'
                            }, {
                            field: 'Etat',
                            sortable: true,
                            title: 'Etat'
						} ,{
                            field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                return [
                                    '<button title="Modifier le travail OPERA" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#travaux_opera_edit' + row[0] + '" type="button">',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                    
                                ].join('')
                            }
                        }]
                    })
                    $.each($('#tableTrvOPERA').bootstrapTable('getData'), function(index, value){
                        $.ajax({
                                data: value,
                                type: 'GET',
                                url: 'Vue/Formulaires/TravauxOPERA.php',
                            }) .done(function (data) {
                                        // console.log(data);
                                        $("#modalBCStrv").append(data)
                                    })
                    })

                    break;

                case '/BCS':
				filetitle = "Bureau BCS";
                $('#tableOPERA').bootstrapTable({
                    data: data['resultat'],
                    pagination: true,
                    search: true,
                    pageList: [10, 25, 50, 100, 200, "All"],
                    showColumns: true,
                    showColumnsToggleAll: true,
                    uniqueId: 'Id_opera',

                    columns: [
                        {
                            field: 'selections',
                            checkbox: true,
                            clickToSelect: true,

                        }, {
                            showColumns:false,
                            searchable:false,
                            field: 'Id_opera',
                            sortable: true,
                            title: 'ID'
                            
                        }, {
                            field: 'Id_access',
                            sortable: true,
                            title: 'ID ACCESS'

                        }, {
                            field: 'Type',
                            sortable: true,
                            title: 'Type'
                        } ,{
                            field: 'Debit',
                            sortable: true,
                            title: 'Débit'
                        }, {
                            field: 'Trigramme',
                            sortable: true,
                            title: 'Trigramme',
                            searchable:true
                        }, {
                            field: 'Nom_Quartier',
                            sortable: true,
                            title: 'Nom Quartier'
                        }, {
                        field: 'Etat',
                        sortable: true,
                        title: 'Etat'
                    } , {
                            field: 'operation',
                        formatter: function operateFormatter(value, row, index) {
                                return [                                        
                                    '<button title="Modifier un élément OPERA" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#opera_' + row[0] + '" type="button">',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>',                                          
                                ].join('')
                            }
                    }]

                })
                $.each($('#tableOPERA').bootstrapTable('getData'), function(index, value){
                    $.ajax({
                            data: value,
                            type: 'GET',
                            url: 'Vue/Formulaires/Opera.php',
                        }) .done(function (data) {
                                    // console.log(data);
                                    $("#modalBCS").append(data)
                                })
                })

                
   
                $('#tableTrvOPERA').bootstrapTable({
                    data: data['resultat2'],
                    pagination: true,
                    search: true,
                    pageList: [10, 25, 50, 100, 200, "All"],
                    showColumns: true,
                    showExport: true,
                    showColumnsToggleAll: true,
                    uniqueId: 'Id_trv_opera',

                    columns: [
                        {
                            field: 'selections',
                            checkbox: true,
                            clickToSelect: true,

                        }, {
                            field: 'Id_trv_opera',
                            sortable: true,
                            title: 'ID'
                        }, {
                            field: 'Id_access',
                            sortable: true,
                            title: 'ID ACCESS'
                        }, {
                            field: 'Date',
                            sortable: true,
                            title: 'Date'
                        }, {
                            field: 'Debit',
                            sortable: true,
                            title: 'Debit'
                        }, {
                            field: 'Debit_futur',
                            sortable: true,
                            title: 'Débit futur'
                        }, {
                            field: 'Trigramme',
                            sortable: true,
                            title: 'Trigramme'
                        }, {
                        field: 'Etat',
                        sortable: true,
                        title: 'Etat'
                    } ,{
                        field: 'operation',
                        formatter: function operateFormatter(value, row, index) {
                            return [
                                '<button title="Modifier le travail OPERA" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#travaux_opera_edit' + row[0] + '" type="button">',
                                '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                '</button>'
                                
                            ].join('')
                        }
                    }]
                })
                $.each($('#tableTrvOPERA').bootstrapTable('getData'), function(index, value){
                    $.ajax({
                            data: value,
                            type: 'GET',
                            url: 'Vue/Formulaires/TravauxOPERA.php',
                        }) .done(function (data) {
                                    // console.log(data);
                                    $("#modalBCStrv").append(data)
                                })
                })

                    $('#tableMIM3').bootstrapTable({
                        data: data['resultat3'],
                        pagination: true,
                        search: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        showColumns: true,
                        showToggle: true,
                        showExport: true,
                        showColumnsToggleAll: true,
						uniqueId: 'Id_mim',

                        columns: [
						{
                                field: 'selections',
                                checkbox: true,
                                clickToSelect: true,

                        }, {
                            field: 'Id_mim',
                            sortable: true,
                            title: 'ID'
                    }, {
                        field: 'Master_ID',
                        sortable: true,
                        title: 'MASTER ID'

                    },{
                        field: 'Type',
                        sortable: true,
                        title: 'Type'
                    }, {
                        field: 'Debit',
                        sortable: true,
                        title: 'Debit'
                    }, {
                        field: 'Debit_final',
                        sortable: true,
                        title: 'Debit'
                    }, {
                        field: 'IP_PFS',
                        sortable: true,
                        title: 'IP PFS'
                    },  {
                        field: 'IP_LAN_SUBNET',
                        sortable: true,
                        title: 'IP LAN SUBNET'
                    }, {
                            field: 'Trigramme',
                            sortable: true,
                            title: 'Trigramme'

                    }, {
                        field: 'Organisme',
                        sortable: true,
                        title: 'Organisme'
                    }, {
                        field: 'Date_de_validation',
                        sortable: true,
                        title: 'Date de validation'
                    }, {
                        field: 'Etat',
                        sortable: true,
                        title: 'Etat'
                    } , {
                            field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                $.ajax({
                                    data: row,
                                    type: 'GET',
                                    url: 'Vue/Formulaires/modifierMim3.php',

                                })

                                    .done(function (data) {
                                        // console.log(data);
                                        $('#modal' + formdata['bureau'].substr(1) + "2").append(data)

                                    })

                                return [

                                    '<button title="Modifier un élément MIM3" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#edit_mim3' + row[0] + '" type = "button" >',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                ].join('')
                            
                            }
                        }]
                       
                    })

                    $('#tableTrvMIM3').bootstrapTable({
                        data: data['resultat4'],
                        pagination: true,
                        search: true,
                        pageList: [10, 25, 50, 100, 200, "All"],
                        showColumns: true,
                        showToggle: true,
                        showExport: true,
                        showColumnsToggleAll: true,
						uniqueId:'Id8_trv_mim',

                        columns: [
						{
                                field: 'selections',
                                checkbox: true,
                                clickToSelect: true,

                        },{
                            field: 'Id8_trv_mim',
                            sortable: true,
                            title: 'ID'
                        }, {
                            field: 'Master_ID',
                            sortable: true,
                            title: 'MASTER ID'
                        }, {
                            field: 'Date',
                            sortable: true,
                            title: 'Date'
                        }, {
                            field: 'Debit',
                            sortable: true,
                            title: 'Debit'
                        }, {
                            field: 'Debit_futur',
                            sortable: true,
                            title: 'Débit futur'

                        }, {
                            field: 'Dateintervalle',
                            sortable: true,
                            title: 'date prévisionnelle de fin de travaux'
						},{
                            field: 'Etat',
                            sortable: true,
                            title: 'Etat'
						} , {
                            field: 'operation',
                            formatter: function operateFormatter(value, row, index) {
                                $.ajax({
                                    data: row,
                                    type: 'GET',
                                    url: 'Vue/Formulaires/TravauxMIM3.php',

                                })

                                    .done(function (data) {
                                        // console.log(data);
                                        $('#modal' + formdata['bureau'].substr(1) + "trv2").append(data)

                                    })

                                return [

                                    '<button title="Modifier un élément MIM3" class="col-auto btn" data-bs-toggle="modal" data-bs-target="#travaux_mim_edit' + row[0] + '" type = "button" >',
                                    '<img src = "Ressources/images/edit-regular.svg" width = "20" />',
                                    '</button>'
                                ].join('')
                            
                            }
                        }]
                       
                    })
                    var jsElm = document.createElement("script");
                    // set the type attribute
                    jsElm.type = "application/javascript";
                    // make the script element load file
                    jsElm.src = "Ressources/js/forms.js";
                    // finally insert the element to the body element in order to load the script
                    //document.body.appendChild(jsElm);
                    break;


            }


             
            // here we will handle errors and validation messages
        })

    // var table = $('.table'+formdata['bureau'].substr(1))
    var button_remove = $('.remove')
    var button_export = $('.export')
   

    // var table1 = $('#table'+formdata['bureau'].substr(1)+"2")
    // var button_remove1 = $('#remove'+formdata['bureau'].substr(1)+"2")
    // var button_export1 = $('#export'+formdata['bureau'].substr(1)+"2")


    button_remove.click(function () {
        if (!confirmDesactiv()) {
            return;
        }
        var table = ($("#" + $(this)[0].id + "~ div .table" + window.location.pathname.substr(1)))
        var ids = $.map(table.bootstrapTable('getSelections'), function (row) {
            table.bootstrapTable('removeByUniqueId', row[0])
            console.log(row)
            return row[0]
        })


        // table.bootstrapTable('remove', {
        //     field: 'rows',
        //     values: ids
        // })

        var formdata = {
            'bureau': window.location.pathname,
            'role': frole,
            'Id': ids,
            'source': $(this)[0].id.substr(-1),
            'methode': 'DELETE'
        };

        console.log(formdata);

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'Modèle/gestion.php', // the url where we want to POST
            data: formdata, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        }).done(function (data) {
            // log data to the console so we can see
            console.log(data);
        })

    })
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
  
    button_export.click(function () {
       

                var table = ($("#" + $(this)[0].id + "~ div .table" + window.location.pathname.substr(1)))
                var dataSource = shield.DataSource.create({
                    data: table.bootstrapTable('getData'),
                    fields: table.bootstrapTable('getOptions')['columns'][0]
                })
                dataSource.read().then(function (data) {
                    new shield.exp.OOXMLWorkbook({
                        worksheets: [
                            {
                                name: yyyy,
                                autoWidth: true,

                                rows: [
                                    {
                                        cells: $.map(table.bootstrapTable('getVisibleColumns'), function (item, index) {
                                            item = { value: item.title, type: String, style: { bold: true } }
                                            return item
                                        }),
                                        autoWidth: true,
                                    }
                                ].concat($.map(data, function (item, index) {
                                    if (item[index] == "null") {
                                        item[index] = "";
                                    }
                                    return {
                                        cells: [
                                            { type: String, value: item[0]},
                                            { type: String, value: item[1] },
                                            { type: String, value: item[2] },
                                            { type: String, value: item[3] },
                                            { type: String, value: item[4] },
                                            { type: String, value: item[5] },
                                            { type: String, value: item[6] },
                                            { type: String, value: item[7] },
											{ type: String, value: item[8] },
											
                                        ]
                                    };
                                }))
                            }
                        ]
                    }).saveAs({
                        fileName: yyyy + mm + dd + " " + filetitle
                    });
                });

    });
    
    button_export.click(function(){
        var table = ($("#" + $(this)[0].id + "~ div .table" + window.location.pathname.substr(1)));
        //console.log(table);
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: window.location.pathname, // the url where we want to POST
            data: {'tableData': table.bootstrapTable('getData')}, // our data object
            
        }).done(function (data) {})
    })

                
                    
            });