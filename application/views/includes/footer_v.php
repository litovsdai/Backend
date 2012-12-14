

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

<!-- external javascript
      ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- jQuery -->
<script src="<?= base_url() ?>js/jquery-1.7.2.min.js"></script>
<!-- jQuery UI -->
<script src="<?= base_url() ?>js/jquery-ui-1.8.21.custom.min.js"></script>

<!-- Muestro imagen al poner el mouse sobre el input -->
<script>
    $(document).ready(function(){
        // Boton de submit en subir imagenes
        $(document).ready(function() {
            $("#object").hide();
 
            $("#objectEvent").mouseover(function(){
                $("#object").fadeIn(1000);
            }).mouseout(function(){
                $("#object").fadeOut(2000);
            });
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
<script>   
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
                success: mostrarRespuesta  //funciones que definimos más abajo
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
    // Recojo datos con Array
    $(document).ready(function(){
        $('.comp_check').click(function(){
            var selectedItems= new Array();
            var indice=1;
            $('[name=nameCheckBox]').each(function(){
                if($(this).attr('checked')){                           
                    selectedItems[indice] = $(this).val();//El indice inicial cera 0
                    indice++; //paso a incrementar el indice en 1
                }
            });
            selectedItems[0]=$('.selectError').val();
            //alert(selectedItems);
                    
            $.ajax({        
                type: "POST",
                url: "<?= base_url() ?>backend/b_gallery_c/asign_category",
                data: { activitiesArray : selectedItems },
                beforeSend: mostrarLoader,
                success: function(msg) {//resp_cat
                    $('.resp_asig').fadeOut("slow");
                    $('.resp_cat').html(msg);
                }
            });
            return false;
        });
        function mostrarLoader(){
            $('.resp_asig').fadeIn("slow"); //muestro el loader de ajax
        };
    });
    
</script>

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


</body>
</html>
