

<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->

<hr><div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Herramientas</h3>
    </div>
    <div class="modal-body">
        <p>Algunas opciones de confiración..</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Cerrar</a>
        <a href="#" class="btn btn-primary">Guardar cambios</a>
    </div>
</div>

<footer>
    <p class="pull-left">&copy;&nbsp; 2012&nbsp;-&nbsp;<?php echo date('Y') ?> <a href="http://blogdelito.casualweb.org" target="_blank">&nbsp;Backend de Lito</a></p>
    <p class="pull-right">Powered by: <a href="http://twitter.com/soy_lito" target="_blank">Lito</a></p>
</footer>
</div><!--/.fluid-container-->
<div id="all_j">
    <!-- external javascript
          ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- jQuery -->
    <script src="<?= base_url() ?>js/jquery-1.7.2.min.js"></script>
    <!-- jQuery UI -->
    <script src="<?= base_url() ?>js/jquery-ui-1.8.21.custom.min.js"></script>
    <!-- transition / effect library -->
    <script src="<?= base_url() ?>js/bootstrap-transition.js"></script>
    <!-- alert enhancer library -->
    <script src="<?= base_url() ?>js/bootstrap-alert.js"></script>
    <!-- modal / dialog library -->
    <script src="<?= base_url() ?>js/bootstrap-modal.js"></script>
    <!-- custom dropdown library -->
    <script src="<?= base_url() ?>js/bootstrap-dropdown.js"></script>
    <!-- scrolspy library -->
    <script src="<?= base_url() ?>js/bootstrap-scrollspy.js"></script>
    <!-- library for creating tabs -->
    <script src="<?= base_url() ?>js/bootstrap-tab.js"></script>
    <!-- library for advanced tooltip -->
    <script src="<?= base_url() ?>js/bootstrap-tooltip.js"></script>
    <!-- popover effect library -->
    <script src="<?= base_url() ?>js/bootstrap-popover.js"></script>
    <!-- button enhancer library -->
    <script src="<?= base_url() ?>js/bootstrap-button.js"></script>
    <!-- accordion library (optional, not used in demo) -->
    <script src="<?= base_url() ?>js/bootstrap-collapse.js"></script>
    <!-- carousel slideshow library (optional, not used in demo) -->
    <script src="<?= base_url() ?>js/bootstrap-carousel.js"></script>
    <!-- autocomplete library -->
    <script src="<?= base_url() ?>js/bootstrap-typeahead.js"></script>
    <!-- tour library -->
    <script src="<?= base_url() ?>js/bootstrap-tour.js"></script>
    <!-- library for cookie management -->
    <script src="<?= base_url() ?>js/jquery.cookie.js"></script>
    <!-- calander plugin -->
    <script src='<?= base_url() ?>js/fullcalendar.min.js'></script>
    <!-- data table plugin -->
    <script src='<?= base_url() ?>js/jquery.dataTables.min.js'></script>
    <!-- chart libraries start -->
    <script src="<?= base_url() ?>js/excanvas.js"></script>
    <script src="<?= base_url() ?>js/jquery.flot.min.js"></script>
    <script src="<?= base_url() ?>js/jquery.flot.pie.min.js"></script>
    <script src="<?= base_url() ?>js/jquery.flot.stack.js"></script>
    <script src="<?= base_url() ?>js/jquery.flot.resize.min.js"></script>
    <!-- chart libraries end -->
    <!-- select or dropdown enhancer -->
    <script src="<?= base_url() ?>js/jquery.chosen.min.js"></script>
    <!-- checkbox, radio, and file input styler -->
    <script src="<?= base_url() ?>js/jquery.uniform.min.js"></script>
    <!-- plugin for gallery image view -->
    <script src="<?= base_url() ?>js/jquery.colorbox.min.js"></script>
    <!-- rich text editor library -->
    <script src="<?= base_url() ?>js/jquery.cleditor.min.js"></script>
    <!-- notification plugin -->
    <script src="<?= base_url() ?>js/jquery.noty.js"></script>
    <!-- file manager library -->
    <script src="<?= base_url() ?>js/jquery.elfinder.min.js"></script>
    <!-- star rating plugin -->
    <script src="<?= base_url() ?>js/jquery.raty.min.js"></script>
    <!-- for iOS style toggle switch -->
    <script src="<?= base_url() ?>js/jquery.iphone.toggle.js"></script>
    <!-- autogrowing textarea plugin -->
    <script src="<?= base_url() ?>js/jquery.autogrow-textarea.js"></script>
    <!-- multiple file upload plugin -->
    <script src="<?= base_url() ?>js/jquery.uploadify-3.1.min.js"></script>
    <!-- history.js for cross-browser state change on ajax -->
    <script src="<?= base_url() ?>js/jquery.history.js"></script>
    <!-- application script for Charisma demo -->
    <script src="<?= base_url() ?>js/charisma.js"></script>

    <!-- Muestro imagen al poner el mouse sobre el input -->
    <script>
        // Boton de submit en subir imagenes
        $(document).ready(function() {
            $("#object").hide();
 
            $("#objectEvent").mouseover(function(){
                $("#object").fadeIn(1000);
            }).mouseout(function(){
                $("#object").fadeOut(2000);
            });
        });
    </script>  
    <script>  
        // Ajax loader en subir imagenes
        $(document).ready(function() {           
            $("#ajax").click(function(){
                $("#o").show();
            });
        });
    </script>  

    <script>  
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

    </script>  
    <script>  
        // Checkear todos los checkbox
        $(document).ready(function(){    
            $("#activa_check").click(function() {  
                $(".check").attr('checked', true);  
            });  

            $("#checkbox_desactivar").click(function() {  
                $(".check").attr('checked', false);  
            });  

        });
    </script>  
    <!-- -->
    <script>   
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
    </script>  
    <script>
        // Devanece el mensaje informativo 
        //    $(document).ready(function(){
        //        setInterval(function(){
        //            // $('#delete').css("display", "none");
        //            $('#delete').delay(400);
        //            $('#delete').fadeOut(2500, function () {
        //                $('#delete').remove().fadeOut(15000);
        //            })
        //            
        //        }, 20000);
        //    });
    </script>
    <script>  
        // Asigna categorias a las imagenes seleccionadas
        $(document).ready(function(){
            $('.comp_check').live("click",function(){
                var selectedItems= new Array();
                var indice=1;
                $('[name=nameCheckBox]').each(function(){
                    if($(this).attr('checked')){                           
                        selectedItems[indice] = $(this).val();//El indice inicial cera 0
                        $("#"+selectedItems[indice]).css('display','none');
                        indice++; //paso a incrementar el indice en 1
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
                        $("#containerdiv").load("<?= base_url() ?>backend/b_gallery_c/refresh_div"); 
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
    
    </script>

    <script>
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
    </script>
    <script>
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
    </script>
    <script>
        $(document).ready(function(){
            $(".show_").toggle(function(){
                $(".show_edit").slideToggle('slow');
            },function(){
                $(".show_edit").slideToggle('slow');
            });
        });
    </script>
    <script>
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
    </script>
    <script>
        //Elimina imagen con botn pequeño
        $(document).ready(function(){
            $('.ed_img').on('click',function(){
                alert($(this).attr('value'));
            });
        });
    </script>
</div>
</body>
</html>
