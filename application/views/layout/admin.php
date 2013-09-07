<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="de" xmlns="http://www.w3.org/1999/xhtml">
  <meta charset="utf-8" />
   <title><?php echo $title ?></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   
   <link rel="shortcut icon" href="<?php echo URL::site('assets/img/ico/favicon.ico') ?>" />
    <link rel="icon" type="image/png" href="<?php echo URL::site('assets/img/ico/favicon.png') ?>" />
    
  <?php echo Helper_HeadImport::renderAll(); ?>
  <?php echo Helper_Js::render() ?>
  <?php echo View::factory('jstranslate')->render(); ?>
  </head>

  <body>

   <?php echo $header; ?>
    
    <div class="row">
      <br/>
      <?php $alert = Helper_Alert::getAlert(); ?>
      <div data-alert class="alert-box <?php echo $alert->class ?>" style="<?php echo $alert->message?'':'display:none;' ?> ">
        <?php echo $alert->message ?>
        <a href="#" class="close">&times;</a>
      </div>

      <?php echo $content; ?>
    </div>
  </body>
</html>

