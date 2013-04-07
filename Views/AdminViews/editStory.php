<?php
	include 'Views/topBar.php';
?>

<script type="text/javascript" src="../Views/js/file_upload.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.save').click(function(){
			var id=$("input#story-id").val();
			var html = $("textarea#story-html").val();
			if(validate(html)){
				$.ajax({
					type: "POST",
					url: "<?php echo BASEDIR.'Admin/?news=updateTxt&output=json';?>",
					data: {id: id, html: html},
					success: function(response){
						console.log('sucess');
						if(response['sucess']){
							message = "Content saved sucessfully";
						}else{
							message = "Content was not saved sucessfully";
						}
						console.log(message);
						$('#textResponse').html(message);
						$('.updateTextResponse').fadeIn().delay(1000).fadeOut();
					},
					error: function(){
						console.log('there was an error');
					}
				});
				return false;	
			}else{
				console.log("Not a valid string");
			}
			
		});

		var basePath = "<?php echo BASEDIR;?>" 

		$('#remove-image').click(function(){
			var id = $("#story-id").attr("value");
			$.ajax({
				type:"POST",
				url: basePath+"Admin/?news=removePicture&output=json",
				data: {id:id},
				success: function(response){
					console.log('success');
				},

			});
		});
			

		

		$('#story-image').live('change',function(){
			var replace = true;
			$("#upload-story-picture").vPB({
				url:"<?php echo BASEDIR.'Admin/?news=updateImg&output=json';?>",
				data:{replace:replace},
				success: function(response){
					console.log('Picture update was a sucess');
					console.log(response);
					response = response.split('>');
					console.log(response);
					if(response.length>1){
						response = response[1].split('</pre');
						response = response[0];
					}else{
						response = response[0];
					}
					response = $.parseJSON(response);
					$('#upload-image-form').hide();
					var path = $('#news-image').attr('src');
					path += response['imagePath'];
					$('#news-image').attr('src', path);
					$('#news-image').fadeIn();
				},
				error: function(){
					console.log('there was an error');
				}
			}).submit();
		});

		$('.updateTextResponse').hide();

		function validate(input){
			input = input.trim();
			if(input.length>0){
				return true;
			}else{
				return false;
			}
		}

		<?php
			if($this->vars['news']['image'] === ''){
				echo "$('#news-image').hide();";
			}else{
				echo "$('#upload-image-form').hide();";
			}

		?>
	});
</script>
<div class="admin-edit-news">
	<div class="row-fluid">
		<div class="header span12">
			<div class="span2"></div>
			<h1 class="span6">Edit your article</h1>
		</div>
	</div>
	<div class ="row-fluid">
		<div class ="sidebar-left span2">
			<h4>Other Articles</h4>
			<ul class="news-list">
				<?php 	$newsBundle = new NewsBundle();
					 	$otherNews = $newsBundle->retrieveAll();
					 	foreach($otherNews as $story){
							if($story->getId() === $this->vars['news']['id']){
								echo '<li class="active">';
							}else{
								echo '<li>';
							}
							echo '<a href="'.BASEDIR.'Admin/?news=edit&id='.$story->getId().'">'.$story->getTitle().'</a>';
							echo '</li>';
				 		}
				 ?>
			</ul>
		</div>
		<div class ="news-update-content span10">
			<h2><?php echo $this->vars['news']['title'];?></h2>
			<div class='row-fluid'>
				<div id="upload-image-form" class ="span4">
					<form  enctype="multipart/form-data" id="upload-story-picture" action="javascript:void(0)">
						<input type="hidden" name ="story-id" id="story-id" value="<?php echo $this->vars['news']['id']?>">
						<input type="file" class ="span8" name="story-image" id="story-image" accept="image/*">
					</form>
				</div>
				<div id="news-image-container">
					<img id = "news-image" class = "span4" src="<?php echo BASEDIR.'Views/Stories/Images/'.$this->vars["news"]["image"];?>"></img>
					<button id ="remove-image" class = "span1">Remove</button>
				</div>
			</div>
			<div class ="span10">
			</div>
			<div class= "news-text row-fluid">
				<form name="edit-story" action="">
					<input type="hidden" name ="story-id" id="story-id" value="<?php echo $this->vars['news']['id']?>">
					<textarea class="span8" rows="20" name="story-html" id="story-html"><?php echo $this->vars['file_text'];?></textarea>
					<input type="button" class="save" value ="Save"> <input type="button" id="preview" value="Preview"><br />
					<div class="updateTextResponse span3">
						<span id="textResponse"></span>
					</div>
				<form>
			</div>
			
		</div>
	</div>
</div>