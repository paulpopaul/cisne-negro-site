<!DOCTYPE html>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Cisne Negro Studio</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
	<link href="<? echo plugins_url('template/fonts/stylesheet.css', dirname(__FILE__)) ?>" rel="stylesheet">
	<style>
		/* GENERAL */
		html, body {
			height: 100%;
			overflow: hidden;
		}

		body {
			background-image: url('<? echo plugins_url('template/img/bg.jpg', dirname(__FILE__)) ?>');
			background-repeat: no-repeat;
    		background-size: cover;
    		display: flex ;
			justify-content: center;
			align-items: center;
		}

		/* DESIGN */
		.logo-container { 
			text-align: center; 
		}

		.logo {
			width: 500px;
			padding-bottom: 50px;
		}

		.container .social {
			color: #fff;
			text-align: center;
		}

		/* SOCIAL */
		ul.social-network {
			list-style: none;
			display: inline;
			padding: 0;
			margin-left: 0 !important;
		}

		ul.social-network li {
			display: inline;
			margin: 0 5px;
		}
		.social-network a.facebook:hover { background-color: #3B5998; }
		.social-network a.twitter:hover { background-color: #33ccff; }
		.social-network a.youtube:hover { background-color: #BD3518; }
		.social-network a.vimeo:hover { background-color: #0590B8; }
		.social-network a.instagram:hover { background-color: #c32aa3; }
		.social-network a.soundcloud:hover { background-color: #ff5500; }
		.social-network a.instagram2:hover { background-color: #252424 }

		.social-circle li a {
			width: 50px;
			height: 50px;
			display: inline-block;
			position: relative;
			margin: 0 auto 0 auto;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			border-radius: 50%;
			font-size: 20px;
			text-align: center;
		}

		.social-circle li i {
			line-height: 50px;
			text-align: center;
			margin: 0;
		}

		.social-circle li a:hover i {
			transform: rotate(360deg);
			-moz-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			-ms--transform: rotate(360deg);
			transition: all 0.2s;
			-webkit-transition: all 0.2s;
			-moz-transition: all 0.2s;
			-o-transition: all 0.2s;
			-ms-transition: all 0.2s;
		}

		.social-circle i {
			color: #fff;
			transition: all 0.8s;
			-webkit-transition: all 0.8s;
			-moz-transition: all 0.8s;
			-o-transition: all 0.8s;
			-ms-transition: all 0.8s;
		}

		a {
			background-color: transparent;
			border: 1px solid #fff;
		}

		/* TEXT */
		.text{
			color: #fff;
			text-align: center;
		    font-family: 'Josefin Sans';
		    font-weight: 200 !important;
			font-style: normal;
			font-size: 16px;
			padding-top: 50px;		
		}

		/* RESPONSIVE */
		@media only screen and (max-width: 1920px) {
		}
		@media only screen and (max-width: 1366px) {
			.logo {
				width: 360px;
			}
			.social-circle li a {
				width: 42px;
				height: 42px;
				font-size: 18px;
			}
			.social-circle li i { 
				line-height: 42px; 
			}

			.text{
				font-size: 16px;	
			}
		}
		@media only screen and (max-width: 1024px) {
			.logo {
				width: 360px;
			}
			.social-circle li a {
				width: 42px;
				height: 42px;
				font-size: 18px;
			}
			.social-circle li i { 
				line-height: 42px; 
			}

			.text{
				font-size: 16px;	
			}
		}
		@media only screen and (max-width: 800px) {
			.logo {
				width: 360px;
			}
			.social-circle li a {
				width: 42px;
				height: 42px;
				font-size: 18px;
			}
			.social-circle li i { 
				line-height: 42px; 
			}

			.text{
				font-size: 16px;	
			}
		}
		@media only screen and (max-width: 768px) {
			.logo {
				width: 360px;
			}
			.social-circle li a {
				width: 42px;
				height: 42px;
				font-size: 18px;
			}
			.social-circle li i { 
				line-height: 42px; 
			}

			.text{
				font-size: 16px;	
			}
		}
		@media only screen and (max-width: 414px) {
			.logo {
				width: 280px;
				padding-bottom: 50px;
			}
			.social-circle li a {
				width: 42px;
				height: 42px;
				font-size: 18px;
			}
			.social-circle li i { 
				line-height: 42px; 
			}
			.text{
				font-size: 14px;
				padding-top: 45px;		
			}
		}
		@media only screen and (max-width: 375px) {
			.logo {
				width: 260px;
				padding-bottom: 45px;
			}
			.social-circle li a {
				width: 36px;
				height: 36px;
				font-size: 16px;
			}
			.social-circle li i { 
				line-height: 36px; 
			}
			.text{
				font-size: 14px;
				padding-top: 35px;		
			}
		}
		@media only screen and (max-width: 320px) {
			/* overwrite rules */
			.logo {
				width: 260px;
				padding-bottom: 40px;
			}
			.social-circle li a {
				width: 32px;
				height: 32px;
				font-size: 16px;
			}
			.social-circle li i { 
				line-height: 32px; 
			}
			.text{
				font-size: 14px;
				padding-top: 30px;		
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="logo-container">
			<img class="logo" src="<? echo plugins_url('template/img/logo.svg', dirname(__FILE__)) ?>" alt="">
		</div>
		<div class="social">
			<ul class="social-network social-circle">
		       <li><a target="_blank" href="https://www.facebook.com/cisnenegrorecords/" class="facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
		       <li><a target="_blank" href="https://soundcloud.com/cisnenegroestudio" class="soundcloud" title="Soundcloud"><i class="fab fa-soundcloud"></i></a></li>
		       <li><a target="_blank" href="https://www.youtube.com/user/9876tfgvbhjnkl/videos" class="youtube" title="Youtube"><i class="fab fa-youtube"></i></a></li>
		       <li><a target="_blank" href="https://www.instagram.com/cisne_negro_studio/" class="instagram2" title="Instagram"><i class="fab fa-instagram"></i></a></li>
		       <li><a target="_blank" href="https://www.instagram.com/cisnenegrorecords/" class="instagram" title="Instagram"><i class="fab fa-instagram"></i></a></li>
		    </ul>				
		</div> <!-- /social -->

		<div class="text-container">
			<p class="text">VALDIVIA · CHILE</p>
		</div><!-- /text -->
	</div> <!-- /container -->
</body>
</html>