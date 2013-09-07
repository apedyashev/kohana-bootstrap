<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<!-- Designed & Built by V.Perlerin -->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo $title ?></title>
    <meta name="description" content="<?php echo $description ?>">
    <meta name="keywords" content="<?php echo $keywords ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Vincent Perlerin"> 

    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>  

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if gte IE 9]>
    <style type="text/css">
      .grad {
         filter: none;
      }
    </style>
    <![endif]-->



    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="shortcut icon" href="<?php echo URL::site('assets/img/ico/favicon.ico') ?>" />
    <link rel="icon" type="image/png" href="<?php echo URL::site('assets/img/ico/favicon.png') ?>" />

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo URL::site('assets/img/ico/Icon-72@2x.png') ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo URL::site('assets/img/ico/Icon@2x.png') ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo URL::site('assets/img/ico/Icon-72.png') ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo URL::site('assets/img/ico/Icon.png') ?>">
    <?php echo Helper_HeadImport::renderAll(); ?>
    <?php echo Helper_Js::render() ?>
    <?php echo View::factory('jstranslate')->render(); ?>

  </head>
  <body>
    <?php echo View::factory('partials/navbar')->set('searchQuery', @$searchQuery)->render() ?>

    <?php echo View::factory('partials/header', $headData)->render() ?>



  <section id="main">
    <div class="container">
      <div class="row-fluid">

        <div class="span9 w ">
            <?php echo $content; ?>
        </div>

        <?php echo View::factory('partials/sidebar')->render() ?>      


      </div>
    </div>
  </section>       

  <?php echo View::factory('partials/footer')->render() ?> 


  </body>
</html>

