    </div>
    <div class="clear">
    </section>

    <footer class="footer">
       
    </footer>

</div>

<div id="GeneralDialog"></div>

</body>    

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
	    $('#validate').validate();
	    
	    $( '.datepicker' ).datepicker({
            showOn: "button",
            buttonImage: "<?=base_url().'assets/images/calendar.gif' ?> ",
            buttonImageOnly: true
        });
	    $('#accordion').accordion({
                heightStyle:"content",
                collapsible:true,
                clearStyle:true,
                // create: function(event, ui) {
                // //get index in cookie on accordion create event
                    // if($.cookie('saved_index') != null){
                        // act =  parseInt($.cookie('saved_index'));
                    // }
                // },
                // activate: function(event, ui) {
                      // //set cookie for current index on change event
                      // $.cookie('saved_index', null);
                      // var idx = $('.ui-accordion-header').index(ui.newHeader);
                      // //alert(idx);
                      // $.cookie('saved_index', idx);
                   // },
                // active:parseInt($.cookie('saved_index'))
            });
            
	   $('.ui').button(); 
	   
	   $('#cek').on('click',function(){
	      if($(this).attr('checked')){
	          $('.cek').attr('checked',true);
	      }else{
	          $('.cek').attr('checked',false);
	      } 
	   });
	   
	   
	});
	
	$.widget("ui.dialog",$.ui.dialog,{
	    _allowInteraction:function(event){
	        return !!$(event.target).closest(".cke").length||this._super(event);
	    }
	    
	});
	$(document).ready(function() {
        oTable = $('.datatable').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
        $('.datatable').addClass('clear','both')
    } );
	
</script>

</html>