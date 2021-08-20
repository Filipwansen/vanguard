<?php
	// Start the session
	session_start(); 	

	if(!isset($_SESSION['ocrlabeling'])){
		echo "Sorry, You need to purchase Valid Key!";
		
		// $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		// $base_url .= "://" . $_SERVER['HTTP_HOST'];
		// $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
		// header('Location: '.$base_url);
		return;
	}else{
		$info = json_decode($_SESSION['ocrlabeling']);		
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="img/favicons/logo.png">	
	<!-- <link rel="manifest" href="img/favicons/manifest.json"> -->
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="./img/favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119603824-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-119603824-1');
		//company_name & user_name
		var companyName = '<?= $info->company_name ?>';
		var userName 	= '<?= $info->user_name ?>';
		var uploadUrl 	= '<?= $info->upload_url ?>';
	</script>

<title>OCR Labeling tool</title>

	<link rel="stylesheet" href="css/style.min.css">
	<link rel="stylesheet" href="css/slider.1.min.css">
	<link rel="stylesheet" href="css/tags.min.css">
	<link rel="stylesheet" href="css/svg.select.min.css">
	<link rel="stylesheet" href="css/svg.min.css">
	<link rel="stylesheet" href="css/jquery-confirm.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/snackbar.min.css">
	<link rel="stylesheet" href="css/menu.min.css">
	<link rel="stylesheet" href="css/imglabfonts.css">
	<link rel="stylesheet" href="css/jquery-editable-select.min.css">
	<link rel="stylesheet" href="css/taggle.min.css">

	<script src="js/thirdparty/jquery.min.js"></script>
	<script src="js/thirdparty/jquery-confirm.min.js"></script>
	<script src="js/thirdparty/bootstrap.min.js"></script>
	<script src="js/thirdparty/riot.min.js"></script>

	<script src="js/thirdparty/Blob.js"></script>
	<script src="js/thirdparty/FileSaver.min.js"></script>
	<script src="js/thirdparty/fxp.js"></script>
	<script src="js/thirdparty/jquery-ui.min.js"></script>
	<script src="js/thirdparty/nimn.js"></script>
	<script src="js/thirdparty/jquery-editable-select.min.js"></script>
	<script src="js/thirdparty/taggle.min.js"></script>
</head>

<body>
	
	<div class="container-fluid">
		<div id="menubar" class="row overlay-color align-items-center" style="height: 50px;">
			<div class="col-3 col-sm-2 col-md-1 col-xl-1 no-pl">
				<!-- <menu-dropdown></menu-dropdown> -->
			</div>
			<div class="col-6 col-sm-6 col-md-7 col-xl-7 text-center">
				<!-- form-inline input-group -->
				<div class="row justify-content-center align-content-center">
					<a href="javascript:void(0)">
						<img src="img/logo.png" height="48px" style="margin-top: 2px">
					</a>
					<span style="font-size: 2em; margin-left: 10px;">OCR Img Labeling</span>
				</div>
			</div>
			<div class="col-3 col-sm-4 col-md-4 col-xl-4">
				<div class="form-inline flex-row-reverse float-right">					
					<shortcuts class="d-none d-md-block"></shortcuts>
					<menu-dropdown></menu-dropdown>
				</div>
			</div>

		</div>
		<!-- End of Menubar -->
	</div>
	<div class="flex-row">
		<div class="d-flex flex-row" style="height: calc(100vh - 50px);">
			<div id="toolbar" class="d-flex flex-column overlay-color grey-border">
				<toolbox tools="labelling"></toolbox>
				<toolbox class="mt-auto toolbox-border-top" tools="canvas"></toolbox>
			</div>
			<div class="d-flex flex-column base-color" style="width: 100vw">
				<div>
					<actionbar></actionbar>
				</div>
				<div>
					<workarea></workarea>
				</div>
				<div class="grey-border mt-auto" style="height: 100px; width: 100%; margin: 0px 2px;">
					<images-slider thumbnail_width="90px" class="mt-auto"></images-slider>
				</div>
			</div>
			<div id="sidebar" class="p-2 overlay-color grey-border" style="width: 350px;">
				<label-panel></label-panel>
			</div>
		</div>

		<div id="snackbar"></div>
		<plugin-window></plugin-window>
	</div>

	<!-- <cookie-alert></cookie-alert> -->

	<script src="js/prompt.js"></script>
	<script src="js/config.js"></script>
	<!-- <script src="tags/tags.js"></script> -->
	<script src="js/thirdparty/riot+compiler.min.js"></script>

	<script src="tags/images-slider.tag.html" type="riot/tag"></script>
	<script src="tags/menu.tag.html" type="riot/tag"></script>
	<script src="tags/pluginsMenu.tag.html" type="riot/tag"></script>
	<script src="tags/shortcuts.tag.html" type="riot/tag"></script>
	<script src="tags/toolbox.tag.html" type="riot/tag"></script>
	<script src="tags/workarea.tag.html" type="riot/tag"></script>
	<script src="tags/pluginWindow.tag.html" type="riot/tag"></script>
	<script src="tags/plugins/facepp.tag.html" type="riot/tag"></script>
	<script src="tags/actionbar.tag.html" type="riot/tag"></script>
	<script src="tags/trackinglines.tag.html" type="riot/tag"></script>
	<script src="tags/settings-window.tag.html" type="riot/tag"></script>
	<script src="tags/label-panel.tag.html" type="riot/tag"></script>
	<script src="tags/attributes-list.tag.html" type="riot/tag"></script>

	<script src="tags/actions/lightbulb-action.tag.html" type="riot/tag"></script>
	<script src="tags/actions/landmark-action.tag.html" type="riot/tag"></script>
	<script src="tags/actions/zoom-action.tag.html" type="riot/tag"></script>
	<script src="tags/actions/colorpicker-action.tag.html" type="riot/tag"></script>

	<script type="text/javascript">
		eventBus = riot.observable();
		riot.mount("menu-dropdown, plugins-menu, shortcuts");
		riot.mount("actionbar");
		riot.mount("toolbox");
		riot.mount("images-slider");

		$(function () {
			$('[data-toggle="tooltip"]').tooltip();
		})
	</script>
	<script src="js/settings.js"></script>
	<script src="js/thirdparty/svg.min.js"></script>
	<script src="js/thirdparty/svg.draw.min.js"></script>
	<script src="js/thirdparty/svg.select.min.js"></script>
	<script src="js/thirdparty/svg.resize.min.js"></script>
	<script src="js/thirdparty/svg.draggable.min.js"></script>

	<script src="js/storePersistor.js"></script>
	<script src="js/store.js"></script>
	<script src="js/savefile.js"></script>
	<script src="js/openfile.js"></script>
	<script src="dataformaters/dlib.js"></script>
	<script src="js/app.js"></script>
	<script src="js/nimnObjStructure.js"></script>

	<script src="dataformaters/coco.js"></script>
	<script src="dataformaters/pascal_voc.js"></script>
	<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
