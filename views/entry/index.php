<div class="container">

	<div class='row'>
		<ul class="list-inline">
			<li>
				<button onclick="location.href = '<?php echo BASE_URL; ?>entry/create/';">Create New</button>
			</li>
		</ul>
	</div>

	<table class="table">
		<thead>
			<tr>
				<th>Place</th>
				<th>Time</th>
				<th>User</th>
				<th>Comments</th>
				<th>Pic</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($this->data as $entry) : ?>
				<tr>
					<td>
						<a href="<?php echo BASE_URL; ?>entry/read/<?php echo $entry['id']; ?>">
							<?php echo $entry['place']; ?>
						</a>
					</td>
					<td><?php echo $entry['time']; ?></td>
					<td><?php echo $entry['user_id']; ?></td>
					<td><?php echo $entry['comments']; ?></td>
					<td><img src="<?php echo $entry['img']; ?>" class="img-responsive small"></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>