<?php
	include 'Views/topBar.php';
?>

<div class="row-fluid">

	<div class="span12">
		<h1>Front Page Image Managment</h1>
	</div>
	<div id="top-content">
		<div id = "galleria-content" class="span12">
			<h3>Galleria Preview</h3>
			<div id="galleria">

			</div>
		</div>
		<div id="image-list-container">
			<h3>Reorder the Images</h3>
			<p>Just drag and drop the items in the list to reorder the images in the galleria!</p>
			<ul id="image-list">
				<?php
					foreach($this->vars['images'] as $image){
						echo '<li id= "list-image-'.$image->getId().'">';
						echo $image->getPath();
						echo '</li>';
					}
				?>
			</ul>
			<h3>Add a New Image</h3>
			<p>To add a new image to the galleria just head <a href="<?php echo BASEDIR;?>Admin/?frontPage=newGalleriaImage">here</a>.</p>
		</div>
	</div>
	<div class="span12"></div>
	<div id="image-table-container">
		<table id="image-table">
			<thead>
				<th width="10%">Id</th>
				<th width="20%">Image Name</th>
				<th width="20%">Title</th>
				<th width="40%">Description</th>
				<th width="10%">Actions</th>
			</thead>
			<tbody>
				<?php
					foreach($this->vars['images'] as $image){
						echo '<tr>';
						echo '<td>'.$image->getId().'</td>';
						echo '<td>'.$image->getPath().'</td>';
						echo '<td>'.$image->getTitle().'</td>';
						echo '<td>'.$image->getDescription().'</td>';
						echo '<td class="center"><a class="delete" data="'.$image->getId().'">Delete</a> | <a href="'.BASEDIR.'Views/images/gallery/'.$image->getPath().'" rel="lightbox" title="'.$image->getTitle().'">View</a></td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<link href="../Views/css/lightbox/lightbox.css" rel="stylesheet" />
<script src="../Views/js/lightbox.js"></script>
<script type="text/javascript" src="../Views/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../Views/js/jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript">
// make the cells equal length

$(document).ready(function(){
	var basedir = <? echo "'".BASEDIR."'"; ?>;
	var initData = <?php echo $this->vars["galleriaData"];?>;
	Galleria.loadTheme(basedir+'Views/js/galleria/themes/classic/galleria.classic.js');
	Galleria.configure({
		dataSource: initData
	});
	Galleria.run('#galleria');
	var gallery = Galleria.get(0);
	var basedir = "<?php echo BASEDIR;?>"
	//('#galleria').galleria({dataSource: initData});
	var oTable = $("#image-table").dataTable();
	oTable.fnSort([[0,'asc']]);
	$("#image-list").sortable({
		start: function(event, ui){
			ui.item.data('startIndex', ui.item.index());
		},
		stop: function(event, ui){
			stopIndex = ui.item.index();
			if(ui.item.data('startIndex') !== stopIndex){
				console.log($("#image-list").sortable("toArray"));
				reorderImages($("#image-list").sortable("toArray"));
				reorderGalleria(ui.item.data('startIndex'), stopIndex);
			}
			
		}
	});
	$("#image-list").disableSelection();

	function reorderImages(imageArray){
		imageOrderString = '';
		for(var i =0; i< imageArray.length;i++){
			imageName = imageArray[i].split("-");
			imageId = imageName.pop();
			if(i < imageArray.length-1){
				imageOrderString += imageId+",";
			}else{
				imageOrderString += imageId;
			}
		}
		console
		$.ajax({
			url: basedir+"Admin/?frontPage=saveGalleriaOrder&output=json",
			type: "POST",
			data: {order: imageOrderString},
			success: function(response){
				console.log('success');
				console.log(response);
			},
			error: function(response){
				console.log('error');
			}
		});
	}

	function reorderGalleria(startIndex, stopIndex){
		picture= gallery.getData(startIndex);
		console.log(picture);
		
		if(startIndex > stopIndex){
			gallery.splice(stopIndex,0,picture);
			console.log('in greater than');
			var startIndex = startIndex + 1;
			gallery.splice(startIndex,1);
		}else{
			gallery.splice((stopIndex +1),0,picture);
			console.log('in less than');
			gallery.splice(startIndex,1);
		}
	}
	$(".delete").live('click', function(){
		var id = $this.attr("data");
		console.log();
	});
});
</script>