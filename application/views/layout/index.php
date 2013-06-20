<!doctype html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Stats</title>
	<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" />
	<!--[if lt IE 9]>
	     <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>js/script.js"></script>
</head>
<body>
	<?php if($errors) echo $errors; ?>

	<?php if($clubs) : ?>

		<h2>Men Red:</h2>

	<?php endif; ?>
	
	<?php if($clubs) : ?>		

		<table class="stats">
			<tr>
				<th>Pos</th>
				<th class="left">Clubs</th>
				<th class="extra">W</th>
				<th class="extra">L</th>
				<th class="extra">D</th>
				<th>PTS</th>
				<th class="extra">GF</th>
				<th class="extra">GA</th>
				<th class="extra">GD</th>
				<th>Delete</th>
			</tr>

			<?php foreach ($clubs as $club) : ?>
				<tr id="<?php echo $club->id; ?>">
					<td><?php echo $club->pos; ?></td>
					<td class="left" id="club-name"><?php echo $club->name; ?></td>
					<td><?php echo $club->w; ?></td>
					<td><?php echo $club->l; ?></td>
					<td><?php echo $club->d; ?></td>
					<td><?php echo $club->pts; ?></td>
					<td><?php echo $club->gf; ?></td>
					<td><?php echo $club->ga; ?></td>
					<td><?php echo $club->gd; ?></a></td>
					<td class="admin-delete-team">
						<a href="<?php echo base_url('clubs/delete'); ?>?id=<?php echo $club->id; ?>" title="Delete">x</a>
					</td>
			    </tr>
			<?php endforeach; ?>

		</table><!-- .stats -->
		
		<div class="results">
			<?php if($events) : ?>
					<p class="title">Recent Results:</p>
			<?php endif; ?>
		</div><!--.results -->

	<?php else : ?>
		<table class="stats">
			<tr>
				<th class="left">Currently no clubs. Add some?</th>
			</tr>
		</table><!-- .stats -->
	<?php endif; ?>

	<div class="admin-club">
		<form method="POST" action="<?php echo base_url('clubs/add'); ?>">
			<label for="admin-add-club">Enter Name:</label>

			<input type="text" id="admin-add-club" name="club_name" />

			<button name="add_club">Add Club</button>
		</form>
	</div><!-- .admin-club -->

	<br /><br />

	<?php if($events) : ?>

		<h2>Schedule:</h2>

		<div class="weekly">
			<div class="row">
			</div><!-- .row -->
		</div><!-- .weekly -->

	<?php endif; ?>
</body>
</html>