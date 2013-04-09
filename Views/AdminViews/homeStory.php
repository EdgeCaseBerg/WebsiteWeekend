<?php
	include 'Views/topBar.php';
?>

<script type="text/javascript" src="../Views/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var oTable= $("#manage-articles").dataTable().fnSort([[2,'desc']]);
	});
	
</script>
<div class="row-fluid" id="news-management-container">
	<div class = "span12">
		<div class = "rowfluid" id="top-title">
			<div class="span1">
			</div>
			<div class="span11">
				<h1>Article Management Page</h1>
				<hr>
			</div>
		</div>

		<div class = "rowfluid" id="top-content">
		</div>
	</div>


	<div class = "rowfluid">
		<div class="span1">
		</div>
		<div class = "content-title span10">
				<h3>Publish a New Article</h3>
		</div>
		<div class="span1">
		</div>
		<div class = "content rowfluid">
			<div class = "span2">
			</div>
			<p class="span10">
				To publish a new article juse head <a href="<?php echo BASEDIR?>Admin/?news=new">here</a>
			</p>
		</div>
	</div>


	<div class = "rowfluid">
		<div class="span1">
		</div>
		<div class = "content-title span10">
				<h3>Manage Existing Articles</h3>
		</div>
		<div class="span1">
		</div>
		<div class = "content rowfluid">
			<div class="span1">
			</div>
			<div class="span10" id="manage-table-container">
				<table id="manage-articles">
					<thead>
						<tr>
							<th width="5%">Id</th>
							<th width="30%">Title</th>
							<th width="22%">Creation Date</th>
							<th width="30%">Location</th>
							<th width="13%">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($this->vars['newsBundle'] as $news){
							echo '<tr>';
							echo '<td>'.$news->getId().'</td>';
							echo '<td>'.$news->getTitle().'</td>';
							echo '<td>'.$news->getCreatedAt().'</td>';
							echo '<td>'.$news->getPath().'</td>';
							echo '<td><a href="'.BASEDIR.'Admin/?news=edit&id='.$news->getId().'">Edit</a> | <a class="delete">Delete</a> | <a class="publish">Publish</td>';
							echo '</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="span1">
			</div>
		</div>
		<div class="rowfluid span12">
		</div>
	</div>
</div>