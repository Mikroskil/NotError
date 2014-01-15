    </section>
    <!-- <hr /> -->
    <footer class="footer">
        <div class="footercol_container">
            <?php GetFooterColumn('footercol') ?>
        </div>
        
        <div class="copy">
            <p>
                Copyright &copy; <?=date('Y')?> <?=WEBSITENAME?> - All Right Reserved    
            </p>
        </div> 
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