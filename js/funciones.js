
        // Boton de submit en subir imagenes
        $(document).ready(function() {
            $("#object").hide();
 
            $("#objectEvent").mouseover(function(){
                $("#object").fadeIn(1000);
            }).mouseout(function(){
                $("#object").fadeOut(2000);
            });
        }); 
        // Ajax loader en subir imagenes
        $(document).ready(function() {           
            $("#ajax").click(function(){
                $("#o").show();
            });
        }); 
        // Paginacion JQuery
        $(function() {
            applyPagination();
            function applyPagination() {
                $("#ajax_paging a").click(function() {
                    var url = $(this).attr("href");
                    $.ajax({
                        type: "POST",
                        data: "ajax=1",
                        url: url,
                        success: function(msg) {
                            $("#data").html(msg);
                            applyPagination();
                        }
                    });
                    return false;
                });
            };
        });

        // Checkear todos los checkbox
        $(document).ready(function(){    
            $("#activa_check").click(function() {  
                $(".check").attr('checked', true);  
            });  

            $("#checkbox_desactivar").click(function() {  
                $(".check").attr('checked', false);  
            });  

        });
        // Nueva categoria
        $(document).ready(function() {  
            $('#myForm').click(function(){ //en el evento submit del fomulario
                //event.preventDefault();  //detenemos el comportamiento por default 
                var datos = $('input#n_cat').val();  //la url del action del formulario
                $('#n_cat').val('');
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url() ?>backend/b_gallery_c/new_category",
                    data: {name:datos},
                    beforeSend: mostrarLoader, //funciones que definimos más abajo
                    success: function(responseText){
                        $("#refresh_list").load("<?= base_url() ?>backend/b_gallery_c/refresh_list");
                        $("#refresh_delete").load("<?= base_url() ?>backend/b_gallery_c/refresh_delete");
                        $("#img_new_cat").fadeOut("slow"); // Hago desaparecer el loader de ajax
                        $("#resp_new_cat").html(responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
                    
                    }            
                }); 
                return false;
            });	
        });
 
        function mostrarLoader(){
            $('#img_new_cat').fadeIn("slow"); //muestro el loader de ajax
        };
        function mostrarRespuesta (responseText){
            //alert("Mensaje enviado: "+responseText);  //responseText es lo que devuelve la página contacto.php. Si en contacto.php hacemos echo "Hola" , la variable responseText = "Hola" . Aca hago un alert con el valor de response text
            $("#img_new_cat").fadeOut("slow"); // Hago desaparecer el loader de ajax
            $("#resp_new_cat").html(responseText); // Aca utilizo la función append de JQuery para añadir el responseText  dentro del div "ajax_loader"
        };
        // Asigna categorias a las imagenes seleccionadas
        $(document).ready(function(){
            $('.comp_check').on("click", function(){
                var selectedItems= new Array();
                var indice=1;
                $('[name=nameCheckBox]').each(function(){
                    if($(this).attr('checked')){                           
                        selectedItems[indice] = $(this).val();//El indice inicial cera 0
                        var a=$(this).attr('value');
                        $('li#'+a).detach();
                        indice++; //paso a incrementar el indice en 1
                        $(this).parent().detach();
                    }
                });
                selectedItems[0]=$('.selectError').val();
                //alert(selectedItems);
                    
                $.ajax({        
                    type: "POST",
                    url: "<?= base_url() ?>backend/b_gallery_c/asign_category",
                    data: {activitiesArray:selectedItems},
                    beforeSend: mostrarLoader,
                    success: function(msg) {//resp_cat
                        //$("#containerdiv").load("<?= base_url() ?>backend/b_gallery_c/refresh_div"); 
                        $('.resp_asig').fadeOut("slow");
                        $('.resp_cat').html(msg);                  
                    }
                });
                return  false;
            });

            function mostrarLoader(){
                $('.resp_asig').fadeIn("slow"); //muestro el loader de ajax
            };
        });
    
        // Recojo las categorias a eliminar
        $(document).ready(function(){
            $('#submit_delete').click(function(){
                var selectedItems= new Array();
                var indice=0;
                $("#sel :selected").each(function(){
                    selectedItems[indice]=$(this).attr('value');
                    indice++;
                });
                //alert(selectedItems);
                    
                $.ajax({        
                    type: "POST",
                    url: "<?= base_url() ?>backend/b_gallery_c/delete_category",
                    data: { activitiesArray : selectedItems },
                    beforeSend: mostrarLoader,
                    success: function(msg) {//resp_cat
                        $("#refresh_list").load("<?= base_url() ?>backend/b_gallery_c/refresh_list");
                        $("#refresh_delete").load("<?= base_url() ?>backend/b_gallery_c/refresh_delete");
                        $('#img_del').fadeOut("slow");
                        $('#resp_del').html(msg);
                    
                 
                    }
                });
                return false;
            });
            function mostrarLoader(){
                $('#img_del').fadeIn("slow"); //muestro el loader de ajax
            };
        });
        // Recorro lasimagenes seleccionadas para elimin arlas de la base d datos y del los ficheros
        $(document).ready(function(){
            $('.submit_delete_img').click(function(){
                var selectedItems= new Array();
                var indice=0;
                $('[name=nameCheckBox]').each(function(){
                    if($(this).attr('checked')){                           
                        selectedItems[indice] = $(this).val();//El indice inicial cera 0
                        indice++; //paso a incrementar el indice en 1
                    }
                });
                //alert(selectedItems);
                if(indice > 0){                      
                    $('.refr').fadeIn(2000);
                }
                $.ajax({        
                    type: "POST",
                    url: "<?= base_url() ?>backend/b_gallery_c/delete_image",
                    data: { activitiesArray : selectedItems },
                    beforeSend:function() { $('.ajax_load').fadeIn("slow")},
                    success: function(msg) {//resp_cat
                        //alert(msg);
                        $('.ajax_load').fadeOut("slow");
                        $('.resp_del_img').html(msg);
                   
                    }
                });
                return false;
            });
        });
        $(document).ready(function(){
            $(".show_").toggle(function(){
                $(".show_edit").slideToggle('slow');
            },function(){
                $(".show_edit").slideToggle('slow');
            });
        });
        //Elimina imagen con botn pequeño
        $(document).ready(function(){
            $('.delete_one').on('click',function(){
                var name = new Array();
                name[0] = $(this).attr('value');
                $.ajax({
                    type : "POST",
                    url : "<?= base_url() ?>backend/b_gallery_c/delete_image",
                    data: { activitiesArray : name },
                    success : function(msg){
                        $('.resp_del_img').html(msg); 
                    }
                });
            });
        
            $('.refr').on('click',function(){
                location.reload();
            });
        });
        //Elimina imagen con botn pequeño
        $(document).ready(function(){
            $('.ed_img').on('click',function(){
                alert($(this).attr('value'));
            });
        });