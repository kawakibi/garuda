<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Document Numbering</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A calm, blue sky.">
	<meta name="author" content="Thomas Park">

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<link href="/css/bootstrap-cer.min.css" rel="stylesheet">
	<link href="/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="/css/bootswatch.css" rel="stylesheet">
	<link href="/css/datepicker.css" rel="stylesheet">

</head>

<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">
<!-- Navbar
	================================================== -->
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			 <span class="icon-bar"></span>
			 <span class="icon-bar"></span>
			 <span class="icon-bar"></span>
			</a>
			<a class="brand" href="../">Document Numbering</a>
			<div class="nav-collapse" id="main-menu">
			<ul class="nav pull-right" id="main-menu-right">
				<li><a rel="tooltip" href="/history" title="View History">View History <i class="icon-share-alt"></i></a></li>
				<?php
					if($this->_admin != FALSE):
				?>
					<li><a rel="tooltip" href="/admincp/logout" title="View History">Logout</a></li>
				<?php
				endif;
				?>
			</ul>
			</div>
		</div>
		</div>
</div>