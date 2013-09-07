<?php $langTable = I18N::load(Helper_Output::getCurrentLanguageAlias()); ?>
<script type="text/javascript">
var I18N = {
  alias: '<?php echo Helper_Output::getCurrentLanguageAlias(); ?>',
  __: function(key){
         if( (this.phrases[key] != 'undefined') && (this.phrases[key] != null) ){
           return this.phrases[key];
         }
         else{
           return key;
         }
       },

  phrases: []
};


<?php foreach( $langTable as $key => $val ):?>  
    I18N.phrases["<?php echo $key ?>"] = "<?php echo $val ?>";
<?php endforeach;?>
</script>
