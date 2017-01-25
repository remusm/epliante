<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<link href="catalog/view/theme/epliante/stylesheet/stylesheet.css" rel="stylesheet">
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="catalog/view/javascript/common.js" type="text/javascript"></script>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
</head>
<body class="<?php echo $class; ?>">
<nav id="top">
  <div class="container">
    <div id="top-links" class="nav pull-right">
      <ul class="list-inline">
        <li><a href="<?php echo $contact; ?>"><i class="fa fa-phone"></i></a> <span>Informatii si comenzi: <?php echo $telephone; ?></span></li>
      </ul>
    </div>
  </div>
</nav>
<header>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div id="logo">
          <?php if ($logo) { ?>
          <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
          <?php } else { ?>
          <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</header>
<?php if ($categories) { ?>
<div class="container">
  <nav id="menu" class="navbar">
    <div class="navbar-header"><span id="category" class="visible-xs">MENIU</span>
      <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        
        <?php
            $tabModele = $tabDistributie = $tabComanda = $tabPortofoliu = $tabDespre = $tabContact = ''; 
            if ($_SERVER['REQUEST_URI'] === '/modele-pliante.html') $tabModele = 'active activat'; 
            if ($_SERVER['REQUEST_URI'] === '/distributie-flyere.html') $tabPortofoliu = 'active activat';
            if ($_SERVER['REQUEST_URI'] === '/index.php?route=information/uploadform') $tabComanda = 'active activat';
            if ($_SERVER['REQUEST_URI'] === '/portofoliu.html') $tabPortofoliu = 'active activat';
            if ($_SERVER['REQUEST_URI'] === '/despre-noi.html') $tabDespre = 'active activat';
            if ($_SERVER['REQUEST_URI'] === '/index.php?route=information/contact') $tabContact = 'active activat';
        ?>

        <li class="fth2 <?php echo $tabModele;?>"><a href="<?php print HTTP_SERVER; ?>modele-pliante.html">MODELE</a></li>
        <li class="fth2 <?php echo $tabComanda;?>"><a href="<?php print HTTP_SERVER; ?>index.php?route=information/uploadform">COMANDA</a></li>
        <li class="fth2 <?php echo $tabPortofoliu;?>"><a href="<?php print HTTP_SERVER; ?>portofoliu.html">PORTOFOLIU</a></li>
        <li class="fth2 <?php echo $tabDespre;?>"><a href="<?php print HTTP_SERVER; ?>despre-noi.html">DESPRE NOI</a></li>
        <li class="fth2 <?php echo $tabContact;?>"><a href="<?php print HTTP_SERVER; ?>index.php?route=information/contact">CONTACT</a></li>
        
        
      </ul>
    </div>
  </nav>
    <hr class="divider-line">
</div>
<?php } ?>
