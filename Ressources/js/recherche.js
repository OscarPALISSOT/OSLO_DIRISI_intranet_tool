
$(document).ready(function () {


    // process the form

    var formdata = {
        'test': window.location.pathname,
        'role': frole,
        'methode': 'POST'

    };



    // process the form
    console.log(formdata);
    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: 'Vue/recherche.php', // the url where we want to POST
        data: formdata, // our data object
        dataType: 'json', // what type of data do we expect back from the server
        encode: true
    })
        // using the done promise callback
        .done(function (data) {


            // log data to the console so we can see
            console.log(data);

            switch (formdata['test']) {
                case '/recherche':
				filetitle = "MODIP PLANIF DL METZ";
                $('#table36').bootstrapTable({

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
                                $.done(function (data) {
                                        // console.log(data);
                                        $("#").append(data)

                                    })
.join('')
                            }

                        }]

                })

                

            }


             
            // here we will handle errors and validation messages
        })

 
   
  
                    
            });
