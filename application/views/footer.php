    </section>
    <footer class="footer">
        <div clas="copy"><center>Copyright&copy; NotError!</center></div> 
    </footer>

</div>

</body>    

<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $('#validate').validate();
        
        $('.ui').button();

       	$('a[href="<?=current_url()?>"]').parent('li.navv').addClass('current');
       	
    });
</script>

</html>