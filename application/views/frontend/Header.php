<?php 
	$this->load->helper('url');
	$currentURL = current_url();
	define("CURRENTURL", $currentURL);
	?><!DOCTYPE html>
	<html lang="en">
		<head>
		    <meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="icon" href="<?php echo base_url() ?>assets/frontend/img/fav-icon.png" type="image/gif" sizes="16x16">
		    <meta name="description" content="">
		    <meta name="author" content="">
		    <title><?php echo $title; ?></title>
		    <meta property="og:title" content="Eman"/>
			<meta property="og:image" content=""/>
			<meta property="og:image:width" content="1200" />
			<meta property="og:image:height" content="630" />
			<meta property="og:image:type" content="image/png" />
			<link rel=icon href="<?php echo base_url() ?>favicon.png" sizes=32x32>
			<link rel=icon href="<?php echo base_url() ?>favicon.png" sizes=192x192>
			<link rel=apple-touch-icon-precomposed href="<?php echo base_url() ?>favicon.png">
		    <!-- Custom fonts for this template-->
		    <link href="<?php echo base_url() ?>assets/web/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		        rel="stylesheet">
		    <!-- Custom styles for this template-->
			<link href="<?php echo base_url() ?>assets/web/css/sb-admin-2.min.css" rel="stylesheet">
			<link href="<?php echo base_url() ?>assets/web/css/style.css" rel="stylesheet">
			<link href="<?php echo base_url() ?>assets/web/css/owl.carousel.min.css" rel="stylesheet">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
			
		</head>

		<body id="page-top" class="<?php if(isset($currentpage)){ echo $currentpage; } ?>">