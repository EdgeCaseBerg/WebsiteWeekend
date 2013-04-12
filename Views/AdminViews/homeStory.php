<?php
	include 'Views/topBar.php';
?>

<script type="text/javascript" src="../Views/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var oTable = $("#manage-articles").dataTable();
		oTable.fnSort([[2,'desc']]);
		var basedir = '<?php echo BASEDIR;?>';
		$(".is_published").live('change',function(){
			published = $(this).val();
			id = $(this).attr('data');

			$.ajax({
				url: basedir+'Admin/?news=updatePublished',
				type: 'POST',
				data: {id:id, is_published: published},
				success: function(message){
					if(message['success']===true){
						console.log('update success');
					}else{
						console.log('update fail');
					}
				},	
				error: function(error){
					console.log('error');
				}
			});
		});

		$(".delete").live('click',function(){
			var id = $(this).attr('data');
			answer = confirm("Are you sure you want to delete the Article? It will be gone forever.");
			if(answer){
				$.ajax({
					url: basedir+"Admin/?news=deleteArticle&output=json",
					type: 'POST',
					data: {id:id},
					success: function(message){
						if(message['success']){
							tableIndex = oTable.fnGetPosition(document.getElementById('article-'+id));
							oTable.fnDeleteRow(tableIndex);
						}
					}
				});
			}
		});
	});
	
</script>
<div id="news-management-container">
	<div class = "row-fluid">
		<div class="span10" id="top-title">
			<h1>Article Management Page</h1>
		</div>
		<div class="span2" id="home-link-container">
				<a id="home-link" href="<?php echo BASEDIR;?>Admin/">Admin Home</a>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12"></div>
	</div>
	
	<div class = "row-fluid">
		<div class = "content-title span12">
				<h3>Publish a New Article</h3>
		</div>
		
		<div class = "content row-fluid" id="top-content">
			<div class = "span1"></div>
			<p class="span10">
				To publish a new article just head <a href="<?php echo BASEDIR?>Admin/?news=new">here</a>.
			</p>
		</div>
	</div>


	<div class = "row-fluid">
		<div class = "content-title span12">
				<h3>Manage Existing Articles</h3>
		</div>
		<div class = "content rowfluid">
			<div class="span12" id="manage-table-container">
				<table id="manage-articles">
					<thead>
						<tr>
							<th width="5%">Id</th>
							<th width="30%">Title</th>
							<th width="15%">Created On</th>
							<th width="30%">Location</th>
							<th width="13%">Published</th>
							<th width="7%">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($this->vars['newsBundle'] as $news){
							echo '<tr id="article-'.$news->getId().'">';
							echo '<td>'.$news->getId().'</td>';
							echo '<td>'.$news->getTitle().'</td>';
							echo '<td class="date">'.$news->getCreatedAt().'</td>';
							echo '<td>'.$news->getPath().'</td>';
							echo '<td class="published">';
							echo '<select class="is_published" data="'.$news->getId().'">';
							if($news->getIsPublished()===1){
								echo '<option selected="true" value="1">Yes</option><option value="0">No</option>';
							}else{
								echo '<option value="1">Yes</option><option selected="true" value="0">No</option>';
							}
							echo '</select></td>';
							echo '<td><a href="'.BASEDIR.'Admin/?news=edit&id='.$news->getId().'">Edit</a> | <a class="delete" data="'.$news->getId().'">Delete</a>';						
							echo '</td>';
							echo '</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="rowfluid span12">
		</div>
	</div>
</div>