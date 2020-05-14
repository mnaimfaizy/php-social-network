<!DOCTYPE html>
<html lang="en">
<head>        
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    
    <title>Facebook+</title>

    <link rel="icon" type="image/ico" href="favicon.ico"/>
    
    <link href="css/stylesheets.css" rel="stylesheet" type="text/css" />  
    <!--[if lt IE 8]>
        <link href="css/ie7.css" rel="stylesheet" type="text/css" />
    <![endif]-->            
    <link rel='stylesheet' type='text/css' href='css/fullcalendar.print.css' media='print' />
    
    <script type='text/javascript' src='js/jquery.min.js'></script>
    <script type='text/javascript' src='js/jquery-ui.min.js'></script>
    <script type='text/javascript' src='js/plugins/jquery/jquery.mousewheel.min.js'></script>
    
    <script type='text/javascript' src='js/plugins/cookie/jquery.cookies.2.2.0.min.js'></script>
    
    <script type='text/javascript' src='js/plugins/bootstrap.min.js'></script>
    
    <script type='text/javascript' src='js/plugins/charts/excanvas.min.js'></script>
    <script type='text/javascript' src='js/plugins/charts/jquery.flot.js'></script>    
    <script type='text/javascript' src='js/plugins/charts/jquery.flot.stack.js'></script>    
    <script type='text/javascript' src='js/plugins/charts/jquery.flot.pie.js'></script>
    <script type='text/javascript' src='js/plugins/charts/jquery.flot.resize.js'></script>
    
    <script type='text/javascript' src='js/plugins/sparklines/jquery.sparkline.min.js'></script>
    
    <script type='text/javascript' src='js/plugins/fullcalendar/fullcalendar.min.js'></script>
    
    <script type='text/javascript' src='js/plugins/select2/select2.min.js'></script>
    
    <script type='text/javascript' src='js/plugins/uniform/uniform.js'></script>
    
    <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput-1.3.min.js'></script>
    
    <script type='text/javascript' src='js/plugins/validation/languages/jquery.validationEngine-en.js' charset='utf-8'></script>
    <script type='text/javascript' src='js/plugins/validation/jquery.validationEngine.js' charset='utf-8'></script>
    
    <script type='text/javascript' src='js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>
    <script type='text/javascript' src='js/plugins/animatedprogressbar/animated_progressbar.js'></script>
    
    <script type='text/javascript' src='js/plugins/qtip/jquery.qtip-1.0.0-rc3.min.js'></script>
    
    <script type='text/javascript' src='js/plugins/cleditor/jquery.cleditor.js'></script>
    
    <script type='text/javascript' src='js/plugins/dataTables/jquery.dataTables.min.js'></script>    
    
    <script type='text/javascript' src='js/plugins/fancybox/jquery.fancybox.pack.js'></script>
    
    <script type='text/javascript' src='js/cookies.js'></script>
    <script type='text/javascript' src='js/actions.js'></script>
    <script type='text/javascript' src='js/charts.js'></script>
    <script type='text/javascript' src='js/plugins.js'></script>
    <style type="text/css">
        .logo {
			color: #ffffff;
			font-weight: bold;
			font-size: 20px;
			margin-left: 10px;
		}
		.online {
			color: #1CC725 !important;
			position: absolute;
			right: 0px;
			text-align: right;
			font-weight: bold;
			padding-right: 18px;
			background: url(img/star.png) no-repeat right;
			margin-right: 5px;
		}
		.offline {
			color: #707070 !important;
			position: absolute;
			right: 0px;
			text-align: right;
			font-weight: bold;
			padding-right: 10px;
		}
		.page_footer {
		clear:both;
		width: 100%;
		height: 30px;
		color: #3B2DB0;
		text-align: center;	
		font-family:Constantia, "Lucida Bright", "DejaVu Serif", Georgia, serif;
		position: absolute;
		bottom: 0;
	}
	.footer_text {
		font-size: 16px;
		font-weight: bold;	
	}
	.logo {
			color: #ffffff;
			font-weight: bold;
			font-size: 18px;	
		}
	</style>
    <script type="text/javascript">

	$(function () {
		$.fn.extend({
			SetOnline: function () {
				$.ajax({
					url: "ajax.php",
					type: "post",
					success: function (data) {
						setTimeout($.fn.SetOnline(), 10000);
					}
				});
			}
		});
		
		$.fn.SetOnline();
	});
	
	</script>
</head>
<body>
    <div class="header">
        <p class="logo">PHP Social Network</p>   
    </div>