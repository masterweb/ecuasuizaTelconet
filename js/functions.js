$( document ).ready(function() {
    // toggle para preguntas frecuentes
    $('#faq-list h4').click(function() {
                
        $(this).next('.answer').slideToggle(500);
        $(this).toggleClass('close-faq');
                
    });
        
    var categoriaCms = $('#categoria').val();
    //console.log(categoriaCms)   
    // oficinas 
    $('.text-more-content').hide();
    $('.text-more-content2').hide();
    $('.text-more-content3').hide();
    $('#more-content').click(function(){
        $('.text-more-content').slideToggle(500);
    });
    
    $('#more-content2').click(function(){
        $('.text-more-content2').slideToggle(500);
    });
    
    $('#more-content3').click(function(){
        $('.text-more-content3').slideToggle(500);
    });

    $('.chat-tool').tooltip()
    $('.carousel').carousel({
        interval: 4000
    })
    $("#ingresoOferta").validate({
        rules:{
            'Seguros[categoria]':{
                required:true
            },
            'Seguros[img_banner]':{
                required:true
            },
            'Seguros[title]':{
                required:true
            },
            'Seguros[desc_min]':{
                required:true
            },
            'Seguros[contenido]':{
                required:true
            }
        //,
        //'Seguros[tipo_attachment]':{
        //    required:true
        //}
        },
        messages:{
            'Seguros[categoria]':{
                required:'Seleccione una categoría'
            },
            'Seguros[img_banner]':{
                required:'Seleccione una opción'
            },
            'Seguros[title]':{
                required:'Ingrese el título'
            },
            'Seguros[desc_min]':{
                required:'Ingrese un descripción breve'
            },
            'Seguros[contenido]':{
                required:'Ingrese contenido'
            }
        //            'Seguros[tipo_attachment]':{
        //                required:'Seleccione una opción'
        //            }
        },
        submitHandler: function(form) {
            var imageSelected = $("#imageSelect").val();
            var success = 0;
            // ver si tiene imagen principal
            if(imageSelected == 'Si'){
                var validateInput = check();
                if(validateInput == true){
                    alert('Debe seleccionar una imágen')
                    return false;
                }
                var filename = $('#Seguros_link_img').val();
                var ext = filename.split('.').pop();
                            
                if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' ){
                    success++
                }else{
                    alert('Debe seleccionar una imágen válida')
                    return false;
                }
                            
                // obtener extension del archivo adjunto
                var attachment = $('#Seguros_link_attachment').val();
                //var tipodoc = $( "#tipodoc option:selected" ).text();
                var tipodoc = $('#tipodoc').val()
                var extAttach = attachment.split('.').pop();
                            
                //alert('attachment: '+attachment + ' tipodoc:  '+tipodoc + ' extAtachment: '+extAttach)
                            
                switch(tipodoc)
                {
                    case 'pdf':
                        //console.log('entra a pdf')
                        if(extAttach != 'pdf'){
                            alert('Seleccione un archivo válido pdf')
                            return false;
                        }else{
                            form.submit();
                        }
                        break;
                    case 'word':
                        if(extAttach != 'docx'){
                            alert('Seleccione un archivo válido word')
                            return false;
                        }else{
                            form.submit();
                        }
                        break;
                    case 'excel':
                        if(extAttach != 'xlsx'){
                            alert('Seleccione un archivo válido excel')
                            return false;
                        }else{
                            form.submit();
                        }
                        break;
                    case '':
                        form.submit();
                        break;    
                    default:
                }
            }else{
                // obtener extension del archivo adjunto
                var attachment = $('#Seguros_link_attachment').val();
                //var tipodoc = $( "#tipodoc option:selected" ).text();
                var tipodoc = $('#tipodoc').val()
                var extAttach = attachment.split('.').pop();
                            
                //alert('attachment: '+attachment + ' tipodoc:  '+tipodoc + ' extAtachment: '+extAttach)
                            
                switch(tipodoc)
                {
                    case 'pdf':
                        //console.log('entra a pdf')
                        if(extAttach != 'pdf'){
                            alert('Seleccione un archivo válido pdf')
                            return false;
                        }else{
                            form.submit();
                        }
                        break;
                    case 'word':
                        if(extAttach != 'docx'){
                            alert('Seleccione un archivo válido word')
                            return false;
                        }else{
                            form.submit();
                        }
                        break;
                    case 'excel':
                        if(extAttach != 'xlsx'){
                            alert('Seleccione un archivo válido excel')
                            return false;
                        }else{
                            form.submit();
                        }
                        break;
                    case '':
                        form.submit();
                        break;    
                    default:
                        form.submit();
                        break;    
                        
                        
                } 
            }
        }
    });
    
    //    $("#updateSeguros").validate({
    //        rules:{
    //            'Seguros[categoria]':{
    //                required:true
    //            },
    //           
    //            'Seguros[title]':{
    //                required:true
    //            },
    //            'Seguros[desc_min]':{
    //                required:true
    //            },
    //            'Seguros[contenido]':{
    //                required:true
    //            }
    //        //,
    //        //'Seguros[tipo_attachment]':{
    //        //    required:true
    //        //}
    //        },
    //        messages:{
    //            'Seguros[categoria]':{
    //                required:'Seleccione una categoría'
    //            },
    //            
    //            'Seguros[title]':{
    //                required:'Ingrese el título'
    //            },
    //            'Seguros[desc_min]':{
    //                required:'Ingrese un descripción breve'
    //            },
    //            'Seguros[contenido]':{
    //                required:'Ingrese contenido'
    //            }
    //           
    //        },
    //        submitHandler: function(form) {
    //            var numAdjuntos = $("#num_attachment").val();
    //            if(numAdjuntos > 0){
    //                for (var i=1;i<=numAdjuntos;i++)
    //                { 
    //                    var valueField = $('#field_'+i).val();
    //                    if(valueField == '' ){
    //                        alert('Debe seleccionar un archivo para el Adjunto: '+i);
    //                        return false;
    //                    }else{
    //                        ext = valueField.split('.').pop();
    //                            
    //                        if(ext == 'pdf' || ext == 'docx' || ext == 'xlsx' ){
    //                            form.submit();
    //                        }else{
    //                            alert('Debe seleccionar un documento válido con extensión .pdf, .docx. o .xlsx')
    //                            return false;
    //                        }
    //                    }
    //                }
    //            }
    //        }
    //    });// fin de validate 
    
    // validar cotizador vida hogar
    $("#cotizador-form-hogar").validate({
        rules:{
            'Cotizador[nombres]':{
                required:true
            },
            'Cotizador[email]':{
                required:true,
                email:true
            },
            'Cotizador[apellidos]':{
                required:true
            },
            'Cotizador[cedula]':{
                required:true,
                number:true
            },
            'Cotizador[telefono]':{
                required:true,
                number:true
            },
            'Cotizador[provincia]':{
                required:true
            },
            'Cotizador[celular]':{
                required:true,
                number:true,
                rangelegth:[10,10]
            },
            'Cotizador[ciudad]':{
                required:true
            }
        },
        messages:{
            'Cotizador[nombres]':{
                required:'Ingrese su nombre'
            },
            'Cotizador[email]':{
                required:'Ingrese su email',
                email:'Ingrese un email válido'
            },
            'Cotizador[apellidos]':{
                required:'Ingrese su apellido'
            },
            'Cotizador[cedula]':{
                required:'Ingrese su cédula',
                number:'Ingrese sólo números'
            },
            'Cotizador[telefono]':{
                required:'Ingrese su teléfono',
                number:'Ingrese sólo números'
            },
            'Cotizador[provincia]':{
                required:'Seleccione una provincia'
            },
            'Cotizador[celular]':{
                required:'Ingrese su celular',
                number:'Ingrese sólo números',
                rangelegth:'Ingrese 10 números'
            },
            'Cotizador[ciudad]':{
                required:'Seleccione una ciudad'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    // validar cotizador auto
    $("#cotizador-form-auto").validate({
        rules:{
            'Cotizador[nombres]':{
                required:true
            },
            'Cotizador[email]':{
                required:true,
                email:true
            },
            'Cotizador[apellidos]':{
                required:true
            },
            'Cotizador[cedula]':{
                required:true,
                number:true,
                rangelength:[10,10]
            },
            'Cotizador[telefono]':{
                required:true,
                number:true,
                rangelength:[6,9]
            },
            'Cotizador[provincia]':{
                required:true
            },
            'Cotizador[celular]':{
                required:true,
                number:true,
                rangelength:[10,10]
            },
            'Cotizador[ciudad]':{
                required:true
            },
            'Cotizador[marca]':{
                required:true
            },
            'Cotizador[modelo]':{
                required:true
            },
            'Cotizador[year]':{
                required:true
            },
            'Cotizador[uso]':{
                required:true
            }
        },
        messages:{
            'Cotizador[nombres]':{
                required:'Ingrese su nombre'
            },
            'Cotizador[email]':{
                required:'Ingrese su email',
                email:'Ingrese un email válido'
            },
            'Cotizador[apellidos]':{
                required:'Ingrese su apellido'
            },
            'Cotizador[cedula]':{
                required:'Ingrese su cédula',
                number:'Ingrese sólo números',
                rangelength:'Ingrese 9 dígitos'
            },
            'Cotizador[telefono]':{
                required:'Ingrese su teléfono',
                number:'Ingrese sólo números',
                rangelength:'Ingrese 7 o 9 dígitos'
            },
            'Cotizador[provincia]':{
                required:'Seleccione una provincia'
            },
            'Cotizador[celular]':{
                required:'Ingrese su celular',
                number:'Ingrese sólo números',
                rangelength:'Ingrese 10 números'
            },
            'Cotizador[ciudad]':{
                required:'Seleccione una ciudad'
            },
            'Cotizador[marca]':{
                required:'Seleccione una marca'
            },
            'Cotizador[modelo]':{
                required:'Seleccione un modelo'
            },
            'Cotizador[year]':{
                required:'Seleccione el año'
            },
            'Cotizador[uso]':{
                required:'Seleccione el uso'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    // validar el login del usuario
    $("#form-login").validate({
        rules:{
            'LoginForm[username]':{
                required:true
            },
            'LoginForm[password]':{
                required:true
            }
        },
        messages:{
            'LoginForm[username]':{
                required:'Ingrese su usuario'
            },
            'LoginForm[password]':{
                required:'Ingrese su contraseña'
            }
        },
        submitHandler: function(form) {
            var username = $('#LoginForm_username').val();
            var password = $('#LoginForm_password').val();
            
            $( 'input[name="LoginForm[username]"]' ).focus(function() {
                $('#error-login').html('');
            });
            $( 'input[name="LoginForm[password]"]' ).focus(function() {
                $('#error-login').html('');
            });
            $.ajax({
                url:'/index.php/site/getUserPassword',
                type: 'post',
                data:{
                    username:username,
                    password:password
                },
                //dataType: 'json',
                success: function(data){
                    //alert(data)
                    if(data == 1){
                        form.submit();
                    }else{
                        var html = 'Usuario o contraseña incorrectos';
                        $('#error-login').html(html);
                    }
                }
            });
        }
    });
    
    $("#tbl-user-form").validate({
        rules:{
            'TblUser[email]':{
                required:true
            },
            'TblUser[pregunta_secreta]':{
                required:true
            },
            'TblUser[respuesta_secreta]':{
                required:true
            }
        },
        messages:{
            'TblUser[email]':{
                required:'Ingresa tu email'
            },
            'TblUser[pregunta_secreta]':{
                required:'Selecciona una pregunta'
            },
            'TblUser[respuesta_secreta]':{
                required:'Ingresa una respuesta'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    $("#upload-file").hide();
    $('#imageSelect').change(function() {
        var value = $(this).attr('value');
        //alert(value)
        if(value == 'Si'){
            $("#upload-file").show(); 
        }else if(value == 'No'){
            $("#upload-file").hide();
        }
    });
    $('#Articulos_principal').change(function() {
        var value = $(this).attr('value');
        //alert(value)
        if(value == '1'){
            $('#selec-menu2').hide(); 
        }else if(value == '0'){
            var cat = $('#categoria').val();
            //alert(cat)
            $.ajax({
                url:'/index.php/articulos/getmenus',
                //dataType: "json",
                data:{
                    categoria:cat
                },
                type: 'post',
                success:function(data){
                    //alert(data.options)
                    //$('#menus-id').html(data.options);
                    $('#menus-id').html(data);
                    $('#selec-menu2').show();
                    
                }
            });
        }
    });
    
    $('#Pdf_categoria').change(function() {
        var value = $(this).attr('value');
        //alert(cat)
        $.ajax({
            url:'/index.php/articulos/getsubmenus',
            //dataType: "json",
            data:{
                menu:value
            },
            type: 'post',
            success:function(data){
                //alert(data.options)
                //$('#Pdf_subcategoria').html(data.options);
                $('#Pdf_subcategoria').html(data);
            }
        });
    });
   
    $('#Pdf_subcategoria').change(function() {
        var value = $(this).attr('value');
        $.ajax({
            url:'/index.php/articulos/getdesplegables',
            //dataType: "json",
            data:{
                idarticulo:value
            },
            type: 'post',
            success:function(data){
                //alert(data.pdfs)
                if(data != '' ){
                    $('#titulo-desplegable').html(data);
                }else{
                    $('#titulo-desplegable').html(data);
                    $('#titulo-cat-field').hide();
                }
                
            }
        });
    });
    $('#titulo-desplegable').change(function() {
        var value = $(this).attr('value');
        if(value == 'nuevo'){
            $('#titulo-cat-field').show();
        }else{
            $('#titulo-cat-field').hide();
        }
    });
    
    $('#galeria-select').change(function() {
        var value = $(this).attr('value');
        //alert(value)
        if(value == '1'){
            $("#fields-galeria").show();
            
        }else if(value == '0'){
            $("#fields-galeria").hide();
        /*var arc = $("#num_attachment").val();
            for (var i = 2; i <= arc; i++) { 
                $('#field_'+i).remove();
            }
            $('.removeclass').remove();*/
        }
    });
    
    $("#contactenos-contactenos-form").validate({
        rules:{
            'Contactenos[nombres]':{
                required:true
            },
            'Contactenos[apellidos]':{
                required:true
            },
            'Contactenos[provincia]':{
                required:true
            },
            'Contactenos[ciudad]':{
                required:true
            },
            'Contactenos[telefono]':{
                required:true,
                number:true,
                rangelength:[7,9]
            },
            'Contactenos[celular]':{
                required:true,
                number:true,
                rangelength:[10,10]
            },
            'Contactenos[email]':{
                required:true,
                email:true
            }
        },
        messages:{
            'Contactenos[nombres]':{
                required:'Ingrese sus nombres'
            },
            'Contactenos[apellidos]':{
                required:'Ingrese sus apellidos'
            },
            'Contactenos[provincia]':{
                required:'Ingrese su provincia'
            },
            'Contactenos[ciudad]':{
                required:'Ingrese su ciudad'
            },
            'Contactenos[telefono]':{
                required:'Ingrese su teléfono',
                number:'Ingrese sólo números',
                rangelength:'Mínimo 7 máximo 9 dígitos'
            },
            'Contactenos[celular]':{
                required:'Ingrese su celular',
                number:'Ingrese sólo números',
                rangelength:'Máximo 10 caracteres'
            },
            'Contactenos[email]':{
                required:'Ingrese su email',
                email:'Ingrese un email correcto'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
        
    });// end of validate
    
    $("#trabaja-nosotros-form").validate({
        rules:{
            'TrabajaNosotros[nombres]':{
                required:true
            },
            'TrabajaNosotros[apellidos]':{
                required:true
            },
            'TrabajaNosotros[telefono]':{
                required:true,
                number:true,
                rangelength:[7,9]
            },
            'TrabajaNosotros[celular]':{
                required:true,
                number:true,
                rangelength:[10,10]
            },
            'TrabajaNosotros[ciudad]':{
                required:true
            },
            'TrabajaNosotros[email]':{
                required:true,
                email:true
            }
            
        },
        messages:{
            'TrabajaNosotros[nombres]':{
                required:'Ingrese sus nombres'
            },
            'TrabajaNosotros[apellidos]':{
                required:'Ingrese sus apellidos'
            },
            'TrabajaNosotros[provincia]':{
                required:'Ingrese su provincia'
            },
            'TrabajaNosotros[ciudad]':{
                required:'Ingrese su ciudad'
            },
            'TrabajaNosotros[telefono]':{
                required:'Ingrese su teléfono',
                number:'Ingrese sólo números',
                rangelength:'Mínimo 7 máximo 9 dígitos'
            },
            'TrabajaNosotros[celular]':{
                required:'Ingrese su celular',
                number:'Ingrese sólo números',
                rangelength:'Máximo 10 caracteres'
            },
            'TrabajaNosotros[email]':{
                required:'Ingrese su email',
                email:'Ingrese un email correcto'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
        
    });
    
    //$("#trabaja-nosotros-form").validationEngine();
    $('#imageSelectServicios').change(function() {
        var value = $(this).attr('value');
        if(value == '1'){
            $("#upload-file").show(); 
        }else if(value == 'No'){
            $("#upload-file").hide();
        }
    });
    $('#change-image').click(function(){
        $('#upload-file').show();
    });
    
    // cambiar documento adjunto
    $('#change-attachment').click(function(){
        $('#upload-attachment').show();
        $('#upload-attachment-link').show();
    });
    
    // borrar documento adjunto
    $('#delete-attachment').click(function(){
        if (confirm('Desea borrar el documento')){
            $('.name-document').remove();
            $('#delete-attachment').css('margin-left','15px');
            $('#change-attachment').css('margin-left','15px');
            //$('#change-attachment').text('Adjuntar elemento');
            $('#link_attachment_ready').val(''); 
        }
        
    });
    
    $('#select-num-adjuntos').hide();
    $('input[type=radio][name=adjuntoRadio]').change(function() {
        if (this.value == 'si') {
            //alert("adjunto archivo");
            $('#select-num-adjuntos').show();
        }
        else if (this.value == 'no') {
            //alert("no adjunto");
            $('#select-num-adjuntos').hide();
        }
    });
    
    // cambiar provincias en el formulario de cotizacion vida y hogar
    
    $('#Cotizador_provincia').change(function() {
        var value = $(this).attr('value');
        var data = '';
        //alert(value)
        $.ajax({
            url:'/index.php/provincias/getciudades',
            dataType: "json",
            type: 'post',
            data:{
                id:value
            },
            success:function(data){
                //alert(data.options)
                $('#Cotizador_ciudad').html(data.options);
            }
        });
        
        switch(value){
            case 'azuay':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="cuenca">Cuenca</option>\n';
                break;
            case 'bolivar':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="guaranda">Guaranda</option>';
                break;  
            case 'canar':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="azoguez">Azóguez</option>';
                break;    
            case 'chimborazo':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="riobamba">Riobamba</option>';
                break;    
            case 'eloro':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="machala">Machala</option>';
                break;
            case 'esmeraldas':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="esmeraldas">Esmeraldas</option>';
                break;
            case 'galapagos':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="puertoayora">Puerto Ayora</option>';
                break;
            case 'guayas':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="guayaquil">Guayaquil</option>\n\
                        <option value="milagro">Milagro</option>';
                break;
            case 'imbabura':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="ibarra">Ibarra</option>';
                break;
            case 'loja':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="loja">Loja</option>';
                break;
            case 'losrios':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="babahoyo">Babahoyo</option>';
                break;
            case 'manabi':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="portoviejo">Portoviejo</option><option value="manta">Manta</option>';
                break;
            case 'moronasantiago':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="macas">Macas</option>';
                break;
            case 'napo':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="tena">Tena</option>';
                break;
            case 'orellana':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="franciscodeorellana">Francisco de Orellana</option>';
                break;
            case 'pastaza':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="puyo">Puyo</option>';
                break;
            case 'pichincha':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="quito">Quito</option>';
                break;
            case 'santaelena':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="santaelena">Santa Elena</option>';
                break;
            case 'santodomingo':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="santodomingo">Santo Domingo</option>';
                break;
            case 'sucumbios':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="nuevaloja">Nueva Loja</option>';
                break;
            case 'tungurahua':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="ambato">Ambato</option>';
                break;
            case 'zamorachinchipe':
                data = '<option value="">--Seleccione una ciudad--</option>\n\
                        <option value="zamora">Zamora</option>';
                break;
            default:
                break;
        }
        
        $('#Cotizador_ciudad').html(data);
        
    });
    
    // cambiar provincias en el formulario de cotizacion vida y hogar
    
    $('#Contactenos_provinciares').change(function() {
        var value = $(this).attr('value');
        //console.log(value)
        var data = '';
        $.ajax({
            url:'/index.php/provincias/getciudades',
            dataType: "json",
            type: 'post',
            data:{
                id:value
            },
            success:function(data){
                //alert(data.options)
                $('#Contactenos_ciudad').html(data.options);
            }
        });
        //alert(value)
        $('#Contactenos_ciudad').html(data);
        
    });
    
    
    $('#num-adjuntos').change(function() {
        var value = $(this).attr('value');
        var data = '';
        //alert(value)
        if(value == '1'){
            data = '<div class="control-group">\n\
                   <div class="controls"><input name="Servicios[adjunto]" id="Servicios_link_attachment1" type="file">\n\
                    </div></div>';
            $('#file-uploads').html(data);
        }else if(value == '2'){
            data = '<div class="control-group">\n\
                   <div class="controls"><input name="Servicios[adjunto]" id="Servicios_link_attachment1" type="file">\n\
                    </div></div>\n\
                    <div class="control-group">\n\
                   <div class="controls"><input name="Servicios[adjunto2]" id="Servicios_link_attachment2" type="file">\n\
                    </div></div>';
            $('#file-uploads').html(data); 
        }else if(value == '3'){
            data = '<div class="control-group">\n\
                   <div class="controls"><input name="Servicios[adjunto]" id="Servicios_link_attachment1" type="file">\n\
                    </div></div>\n\
                    <div class="control-group">\n\
                   <div class="controls"><input name="Servicios[adjunto2]" id="Servicios_link_attachment2" type="file">\n\
                    </div></div>\n\
                    <div class="control-group">\n\
                   <div class="controls"><input name="Servicios[adjunto3]" id="Servicios_link_attachment3" type="file">\n\
                    </div></div>';
            $('#file-uploads').html(data);
        }
    });
    
    // cambiar subcategoria de pdf
    $('#Pdf_categoria').change(function() {
        var value = $(this).attr('value');
        switch(value){
            case 'leyTransparencia':
                data = '<option value="">--Escoja una subcategoría--</option>\n\
                        <option value="informacionAccionistas">Información para Accionistas</option>\n\
                        <option value="informacionFinanciera">Información Financiera</option>\n\
                        <option value="indicadoresServicioCliente">Indicadores de Servicio al Cliente</option>';
                break;
            case 'lavadoActivos':
                data = '<option value="">--Escoja una subcategoría--</option>\n\
                        <option value="manualPrevencion">Manual de Prevención</option>\n\
                        <option value="formularioPersonaJuridica">Formulario Persona Jurídica</option>\n\
                        <option value="formularioPersonaNatural">Formulario Persona Natural</option>';
                break;
            case 'noticias':
                $.ajax({
                    url:'/index.php/site/getnoticias',
                    type: 'post',
                    //dataType: "json",
                    data:{
                        categoria:'noticias'
                    },
                    success: function(data){
                        //$('#Pdf_subcategoria').html(data.options);
                        $('#Pdf_subcategoria').html(data);
                    }
                });
                break;
            default:
                data = '<option value="" selected="selected">---Seleccione una opción---</option>';
                break;
        }
        $('#Pdf_subcategoria').html(data);
    });
    
    // cambiar subcategoria de documento word
    $('#Word_categoria').change(function() {
        var value = $(this).attr('value');
        switch(value){
            case 'leyTransparencia':
                data = '<option value="">--Escoja una subcategoría--</option>\n\
                        <option value="informacionAccionistas">Información para Accionistas</option>\n\
                        <option value="informacionFinanciera">Información Financiera</option>\n\
                        <option value="indicadoresServicioCliente">Indicadores de Servicio al Cliente</option>';
                break;
            case 'lavadoActivos':
                data = '<option value="">--Escoja una subcategoría--</option>\n\
                        <option value="manualPrevencion">Manual de Prevención</option>\n\
                        <option value="formularioPersonaJuridica">Formulario Persona Jurídica</option>\n\
                        <option value="formularioPersonaNatural">Formulario Persona Natural</option>';
                break;
            default:     
        }
        $('#Word_subcategoria').html(data);
    });
    
    // crear input files dinamicamente en el admin de seguros
    var MaxInputs       = 7; //maximum input boxes allowed
    //var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
    var AddButton       = $("#AddMoreFileBox2"); //Add button ID

    var x = 0; //initlal text box count
    var FieldCount=0; //to keep track of text box added

    $(AddButton).click(function (e)  //on add input button click
    {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++; //text box added increment
            //add input box
            $(InputsWrapper).append('<div style="margin: 2px 0px;"><input type="file" name="myfile[]" id="field_'+ FieldCount +'" value="Text '+ FieldCount +'"/>\n\
<button class="btn btn-primary btn-warning removeclass" type="button">Eliminar</button></div>');
            x++; //text box increment
            $("#num_attachment").val(x);
        }
        
        return false;
    });

    $("body").on("click",".removeclass2", function(e){ //user click on remove text
        if( x >= 1 ) {
            $(this).parent('div').remove(); //remove text box
            x--; //decrement textbox
            $("#num_attachment").val(x);
        }
        
        return false;
    })
    
    $("#ley-trans").click(function(){
        $(".submenu-transparencia").slideToggle();
    });
    
    
});// END OF JQUERY

function check()
{
    var d = document.getElementById('Seguros_link_img');
    if(d.value == ''){
        return true;
    }
}
        
function checkInputFile(){
                
    var tipodoc = $( "#tipodoc option:selected" ).text();
                
    var validateInput;
    var filename = $('#fileGeneral').val();
    var ext = filename.split('.').pop();
    //alert('extension: '+ext)
               
    switch(tipodoc)
    {
        case 'pdf':
            if(ext != 'pdf'){
                return false;
            }
            break;
        case 'word':
            if(ext != 'docx'){
                return options.allrules.validate2fields.alertText;
            }
            break;
        case 'excel':
            if(ext != 'xlsx'){
                return options.allrules.validate2fields.alertText;
            }
            break;
        default:
                        
    }
}

