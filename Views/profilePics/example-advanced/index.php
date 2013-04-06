<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Uber Upload Cropper -v2</title>
		
		<script type="text/javascript">
			$(function() {
				
				$('#UploadImages').uberuploadcropper({
					//---------------------------------------------------
					// uploadify options..
					//---------------------------------------------------
					//'debug'		: true,
					'action'	: '/cscrew-website-2.0/Views/profilePics/example-advanced/upload.php',
					'params'	: {},
					'allowedExtensions': ['jpg','jpeg','png','gif'],
					//'sizeLimit'	: 0,
					//'multiple'	: true,
					//---------------------------------------------------
					//now the cropper options..
					//---------------------------------------------------
					'aspectRatio': 1, 
					'allowSelect': false,			//can reselect
					'allowResize' : true,			//can resize selection
					'setSelect': [ 0, 0, 200, 200 ],	//these are the dimensions of the crop box x1,y1,x2,y2
					'minSize': [ 200, 200 ],			//if you want to be able to resize, use these
					'maxSize': [ 500, 500 ],
					//---------------------------------------------------
					//now the uber options..
					//---------------------------------------------------
					'folder': '/cscrew-website-2.0/Views/profilePics/example-advanced/uploads/',// only used in uber, not passed to server
					'cropAction': '/cscrew-website-2.0/Views/profilePics/example-advanced/crop.php',		// server side request to crop image
					'onComplete': function(imgs,data){ 
						var $PhotoPrevs = $('#PhotoPrevs');

						for(var i=0,l=imgs.length; i<l; i++){
							$PhotoPrevs.append('<img src="/cscrew-website-2.0/Views/profilePics/example-advanced/uploads/'+ imgs[i].filename +'?d='+ (new Date()).getTime() +'" />');
						}
					}
				});
				
			});
		</script>
	</head>

	<body>
		<div id="wrapper">

		</div>
	</body>
</html>
