<div class="container">

	<div class='row'>
		<ul class="list-inline">
			<li>
				<button onclick="location.href = '<?php echo BASE_URL; ?>entry/';">Back</button>
			</li>
		</ul>
	</div>

	<div class="row">
	        
	    <form class="form" enctype="multipart/form-data" method="post" action="<?php echo BASE_URL; ?>entry/create/">

	    	<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />

	        <div class="form-group">
	            <label for="place">Place: </label>
	            <input type="text" name="place" placeholder="Place" class="form-control" id="place" />
	        </div>

	        <div class="form-group">
	            <label for="comments">Comments: </label>
	            <textarea rows="5" id="comments" class="form-control" placeholder="Comments" name="comments"></textarea>
	        </div>

	        <div class="form-group">
	            <label for="image">Image: </label>
	            <input type="file" name="image" class="img-thumbnail form-control-file" id="image" />
	        </div>

	        <!--csrf-->
	        
	        <input type="submit" class="btn btn-default" value="Create" />

	    </form>

	</div>

</div>

	