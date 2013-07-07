<!doctype html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Stats</title>
	<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" />
	<?php if($this->session->userdata('logged_in')) : ?>
		<link href="<?php echo base_url(); ?>css/admin.css" rel="stylesheet" />
	<?php endif; ?>
	<!--[if lt IE 9]>
	     <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>js/script.js"></script>
	<?php if($this->session->userdata('logged_in')) : ?>
		<script src="<?php echo base_url(); ?>js/admin.js"></script>
	<?php endif; ?>
</head>
<body>