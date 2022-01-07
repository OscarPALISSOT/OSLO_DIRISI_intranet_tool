$(document).ready(function() { 
        
    var formsOpera = $('form.formOpera');
    var formsTravaux = $('form.formTravaux');


    // Formulaire ajout et modification OPERA
    $.each(formsOpera, function(){
        var $this = $(this);

        $this.submit(function(event){
            $('#erreurs').html('');
            var formData = {
                'fTrigramme'              : $this.find('input[name=fTrigramme]').val(),
                'fId_opera'              : $this.find('input[name=fId_opera]').val(),
                'fType'              : $this.find('select[name=fType]').val(),
                'fDebit'              : $this.find('input[name=fDebit]').val(),
                'fEtat'              : $this.find('select[name=fEtat]').val(),
                'fAccess'              : $this.find('input[name=faccess]').val()
            };
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : '../Modèle/scripts/script_Opera.php', // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true
            })
                // using the done promise callback
                .done(function(data) {
                    console.log(data);
                                        
                    if(data["success"]){
                        window.location.href = data["loadpage"] ;
                    } else {
                        $.each(data["errors"], function(index, value){
                            $this.find('#erreurs').append(value);
                        })
                    }
                });
                
                event.preventDefault();
        })
    })
		
	
    // Forumulaire ajout et modification travaux
    $.each(formsTravaux, function(){
        var $this = $(this);

        $this.submit(function(event){
            
            var formData = {
                'fId'              : $this.find('select[name=fId]').val(),
                'fIdtrv'              : $this.find('input[name=fIdtrv]').val(),
                'fDate'              : $this.find('input[name=fDate]').val(),
                'fDebit'              : $this.find('input[name=fDebit]').val(),
                'fDebit_futur'              : $this.find('input[name=fDebit_futur]').val(),
                'fEtat'              : $this.find('select[name=fEtat]').val(),
				'identification'              : $this.find('input[name=identification]').val(),
				'script'              : $this.find('input[name=script]').val()
            };
            $('#erreursTrv'+formData['identification']).html('');
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : '../Modèle/scripts/script_Travaux.php', // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode      : true
            })
                // using the done promise callback
                .done(function(data) {
                    console.log(data);       
                    if(data["success"]){
                        window.location.href = data["loadpage"] ;
                    } else {
                        $.each(data["errors"], function(index, value){
                            $this.find('#erreursTrv').append(value);
                        })
                    }
                    
                });
                event.preventDefault();
        })
    })

});
