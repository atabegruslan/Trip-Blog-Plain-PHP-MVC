<div class="container">

	<div class='row'>
		<ul class="list-inline">
			<li>
				<button onclick="location.href = '<?php echo BASE_URL; ?>entry/';">Back</button>
			</li>
		</ul>
	</div>

	<div class="row">        

	    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

	        <form class="form" enctype="multipart/form-data" method="post" action="<?php echo BASE_URL; ?>entry/update/<?php echo $this->data['id']; ?>">

	            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />

	            <div class="form-group">
	                <label for="place">Place: </label>
	            	<input type="text" name="place" placeholder="<?php echo $this->data['place']; ?>" class="form-control" id="place" />
	            </div>

	            <div class="form-group">
	                <label for="comments">Comments: </label>
	            	<textarea rows="10" id="comments" class="form-control" placeholder="<?php echo $this->data['comments']; ?>" name="comments"></textarea>
	            </div>

	            <div class="form-group">
	                <label for="image">Image: </label>
	            	<input type="file" name="image" class="img-thumbnail form-control-file" id="image" />
	            </div>

	            <input type="hidden" name="_method" value="put" />

	            <input type="submit" class="btn btn-default" value="Update" />
	            
	        </form>

	    </div>
	        
	    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
	                
	        <img src="<?php echo $this->data['img']; ?>" class="img-responsive medium" alt="<?php echo $this->data['place']; ?>">

	        <table class="table">
	            <thead>
	                <tr>
	                    <th>Place: </th>
	                    <th><?php echo $this->data['place']; ?></th>
	                </tr>
	            </thead>
	            <tbody>
	                <tr>
	                    <td><strong>By: </strong></td>
	                    <td><?php echo $this->data['user_id']; ?></td>
	                </tr>
	                <tr>
	                    <td><strong>Modified: </strong></td>
	                    <td><?php echo $this->data['time']; ?></td>
	                </tr>
	            </tbody>
	        </table>     

	        <div>
	            <p><strong>Comments: </strong></p>
	            <p><?php echo $this->data['comments']; ?></p>
	        </div>   

	    </div>

	</div>

</div>

	