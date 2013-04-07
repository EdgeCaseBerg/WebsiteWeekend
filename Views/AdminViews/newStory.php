<?php
	include 'Views/topBar.php';
	require_once 'Models/NewsBundle.php';
?>

<script type="text/javascript" src="../Views/js/file_upload.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		/*
		$('.save').click(function(){
			var title=$("input#story-title").val();
			var html = $("textarea#story-html").val();
			if(validate(html) && validate(title)){
				$.ajax({
					type: "POST",
					url: "<?php echo BASEDIR.'Admin/?news=save'?>",
					data: {title: title, html: html},
					success: function(){
						console.log('success');
					},
					error: function(){
						console.log('there was an error');
					}
				});
			}else{

			}
			
		});
		*/

		function validate(input){
			input = input.trim();
			if(input.length>0){
				return true;
			}else{
				return false;
			}
		}

		var basePath = "<?php echo BASEDIR;?>" 

		$('#save').click(function(){
			//Move the values from separate froms to the hidden fields in the form being submitted
			var title = $('#story-title').val();
			var image = $('#story-image-path').attr("src");
			if(image === basePath){
				image = ''
			}
			$("#news-title").attr("value", title);
			$("#news-image").attr("value", image);
			$("#form-news-content").submit();

		});

		
		$('#story-image-container').hide();

		//AJAX call for tempory load of file
		$('#story-image').live('change',function(){
			var replace = true;
			$("#upload-story-picture").vPB({
				//
				url:"<?php echo BASEDIR.'Admin/?news=uploadImg';?>",
				//need the output: json in the data otherwise the post variables that get added to the url by the plugin will be
				//hit the default case in the controller for each variable, need the last switch to hit hte output case in the controller 
				data:{replace:replace, output:'json'},
				success: function(response){
					console.log('Picture update was a sucess');
					//This is all for splitting off a random pre-tag that is attached to the json
					response = response.split('>');
					if(response.length>1){
						response = response[1].split('</pre');
						response = response[0];
					}else{
						response = response[0];
					}
					response = $.parseJSON(response);
					$('#upload-story-picture').hide();
					$('#story-image').val('');
					var path = $('#story-image-path').attr('src');
					path += response['imagePath'];
					$('#story-image-path').attr('src',path);
					$('#story-image-container').fadeIn();
				},
				error: function(){
					console.log('there was an error');
				}
			}).submit();
		});

		$('#remove-image').click(function(){
			//get the path to the image from image source
			var imagePath = $('#story-image-path').attr('src');
			$.ajax({
				type:"POST",
				url: basePath+"Admin/?news=removePicture&output=json",
				data: {imagePath: imagePath},
				success: function(response){
					if(response['success']){
						//hide the image container and reset the image source
						$('#story-image-container').hide();
						$('#story-image-path').attr('src', basePath+'Views/Stories/Images/');
						//show the upload form
						$('#upload-story-picture').show();
					}
				}
			});

		});


	});
</script>
<div class="admin-edit-news">
	<div class="row-fluid">
		<div class="header span12">
			<div class="span2"></div>
			<h1 class="span6">Publish a New Story</h1>
		</div>
	</div>
	<div class="row-fluid">
		<div class="sidebar-left span2">
			<h4>Other Articles</h4>
			<ul class='news-list'>
				<?php $newsBundle = new NewsBundle();
					  $news = $newsBundle->retrieveAll();
					  foreach($news as $story){
				?>
				<li>
					<a href='<?php echo BASEDIR.'Admin/?news=edit&id='.$story->getId()?>'> <?php echo $story->getTitle()?></a>
				</li>
				<?php }?>
			</ul>
		</div>
		<div class ="create-form span10">
			<!--Form that submits the title-->
			<form id = "form-news-title" action = "">
				<input type="text" class="span4" name="story-title" id="story-title"></input>
			</form>

			<!--Form that saves the image as tmp file and loads a preview-->
			<div class ="row-fluid">
				<form  enctype="multipart/form-data" id="upload-story-picture" action="javascript:void(0)">
					<input type="file" class ="span8" name="story-image" id="story-image" accept="image/*"></input>
				</form>
				<div id="story-image-container">
					<img src = "<?php echo BASEDIR.'Views/Stories/Images/';?>" id="story-image-path" class="span4"></img><br />
					<button id ="remove-image" class = "span1">Remove</button>
				</div>
			<div>

			<div class ="span10">
			</div>
			<!--Form that submits the text and the picture if there is one-->
			<form id = "form-news-content" method="post" action = "<?php echo BASEDIR.'Admin/?news=saveNew';?>">
				<input type ="hidden" name="news-image" id="news-image" value="">
				<input type= "hidden" name="news-title" id = "news-title" value = ""></input>
				<textarea class="span8" rows="20" name="news-html" id="news-html"></textarea>
				<input type="button" id ='save' value ="Save"> <input type="button" id="preview" value="Preview">
			<form>
		</div>
	</div>
</div>