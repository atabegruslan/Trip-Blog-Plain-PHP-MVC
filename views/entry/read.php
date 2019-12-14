<div class="container">

	<div class='row'>
		<ul class="list-inline">
			<li>
				<button onclick="location.href = '<?php echo BASE_URL; ?>entry/';">Back</button>
			</li>
			<li>
				<button onclick="location.href = '<?php echo BASE_URL; ?>entry/update/<?php echo $this->data['id']; ?>';">Update</button>
			</li>
			<li>

				<form action="<?php echo BASE_URL; ?>entry/delete/<?php echo $this->data['id']; ?>" method="post">
				    <button>Delete</button>
				</form>

			</li>
		</ul>
	</div>

	<div class="row">
	        
	    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

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

	        <hr />

	        <div>
	            <p><strong>Comments: </strong></p>
	            <p><?php echo $this->data['comments']; ?></p>
	        </div>

	    </div>
	        
	    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
	        <img src="<?php echo $this->data['img']; ?>" class="img-responsive medium" alt="<?php echo $this->data['place']; ?>">
	    </div>

	</div>

</div>

	