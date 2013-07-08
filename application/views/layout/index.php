<?php if($this->session->userdata('logged_in')) : ?>
	<div class="login">
		Loggin in: <?php echo $this->session->userdata('email'); ?> <a href="logout">(Log out)</a>
	</div><!-- .login -->
<?php endif; ?>

<?php if($errors) echo $errors; ?>

<?php if($division) : ?>
	<h2 id="<?php echo $division->id; ?>" class="division">
		<?php echo $division->name; ?>:

		<?php if($this->session->userdata('logged_in')) : ?>
			<a href="<?php echo base_url('divisions/delete'); ?>?id=<?php echo $division->id; ?>" title="Delete" class="admin-delete-division">Delete X</a>

			<form id="admin-add-division" method="post" action="divisions/add">
				<label for="admin-add-division-name">Division Name:</label>
				<input type="text" name="division_name" id="admin-add-division-name" />
				<input type="hidden" name="division_id" value="<?php echo $division->id; ?>" />

				<button>Add New</button>
			</form>
		<?php endif; ?>
	</h2>
<?php else : ?>
	<h2 class="division">Currenty no divisions...

		<?php if($this->session->userdata('logged_in')) : ?>
			<form id="admin-add-division" method="post" action="divisions/add">
				<label for="admin-add-division-name">Division Name:</label>
				<input type="text" name="division_name" id="admin-add-division-name" />
				<input type="hidden" name="division_id" value="" />

				<button>Add New</button>
			</form>
		<?php endif; ?>
	</h2>
<?php endif; ?>

<?php if($clubs) : ?>		

	<div class="stats">
		<div class="stats-row-head">
			<div>Pos</div>
			<div class="left">Clubs</div>
			<div class="extra">W</div>
			<div class="extra">L</div>
			<div class="extra">D</div>
			<div>PTS</div>
			<div class="extra">GF</div>
			<div class="extra">GA</div>
			<div class="extra">GD</div>
			<?php if($this->session->userdata('logged_in')) : ?>
				<div>Delete</div>
			<?php endif; ?>
		</div>

		<?php foreach ($clubs as $club) : ?>
			<div class="stats-row" id="<?php echo $club->id; ?>">
				<div><?php echo $club->pos; ?></div>
				<div class="left" id="club-name"><?php echo $club->name; ?></div>
				<div class="extra"><?php echo $club->w; ?></div>
				<div class="extra"><?php echo $club->l; ?></div>
				<div class="extra"><?php echo $club->d; ?></div>
				<div><?php echo $club->pts; ?></div>
				<div class="extra"><?php echo $club->gf; ?></div>
				<div class="extra"><?php echo $club->ga; ?></div>
				<div class="extra"><?php echo $club->gd; ?></a></div>
				<?php if($this->session->userdata('logged_in')) : ?>
					<div class="admin-delete-team">
						<a href="<?php echo base_url('clubs/delete'); ?>?id=<?php echo $club->id; ?>&division_id=<?php echo $division->id; ?>" title="Delete">x</a>
					</div>
				<?php endif; ?>
		    </div>
		<?php endforeach; ?>

	</div><!-- .stats -->
	
	<div class="recent">
		<div class="upcoming">
			<?php if($upcoming) : ?>
				<p class="title">Upcoming:</p>

				<?php foreach($upcoming as $event) : ?>
						<span class="recent-title"><?php echo $event->date; ?> (<?php echo $event->time; ?>)</span><?php echo $event->h_club; ?> - <?php echo $event->v_club; ?><br />
				<?php endforeach; ?>
			<?php endif; ?>
		</div><!-- .upcoming -->

		<div class="results">
		<?php if($recent) : ?>
				<p class="title">Recent:</p>

				<?php foreach($recent as $event) : ?>
						<span class="recent-title"><?php echo $event->h_score; ?> - <?php echo $event->v_score; ?></span>

						<?php echo $event->h_club; ?> - <?php echo $event->v_club; ?><br />
				<?php endforeach; ?>
			<?php endif; ?>
		</div><!-- .results -->
	</div><!--.recent -->

<?php else : ?>
	<div class="no-results">
		Currently no clubs.
	</div><!-- .row -->
<?php endif; ?>

<?php if($this->session->userdata('logged_in') && ($division)) : ?>
	<div class="admin-edit admin-club">
		<form method="POST" action="<?php echo base_url('clubs/add'); ?>">
			<label for="admin-add-club">Enter Club Name:</label>

			<input type="text" id="admin-add-club" name="club_name" />

			<input type="hidden" name="division_id" value="<?php if($division) echo $division->id; ?>" />
			<button name="add_club">Add Club</button>
		</form>
	</div><!-- .admin-edit -->
<?php endif; ?>

<br /><br />

<?php if($groups) : ?>
	<h2>Schedule:</h2>
	
	<div class="weekly">
		<?php foreach($groups as $group) : ?>

			<div class="week">
				<?php if($this->session->userdata('logged_in')) : ?>
					<a href="<?php echo base_url('groups/delete'); ?>?id=<?php echo $group->id; ?>&division_id=<?php echo $division->id; ?>" title="Delete" class="admin-delete-group">x</a>
				<?php endif; ?>
				
				<h3 id="<?php echo $group->id; ?>"><?php echo $group->name; ?></h3>
				
				<div class="info">
					<?php
						$results = find_group_id($events, $group->id);
					?>

					<?php if($results) : ?>
						<?php foreach($results as $result) : ?>
							<p><?php echo $result->date; ?></p>
							<?php
								$current_loc = false;
							?>

							<?php foreach($result->events as $event) : ?>
								<?php 
									if($current_loc !== $event->loc){

										echo '<p>(' . $event->loc . ')</p>';

										$current_loc = $event->loc;
									} 
								?>

								<?php if($this->session->userdata('logged_in')) : ?>
									<a href="<?php echo base_url('events/delete'); ?>?id=<?php echo $event->id; ?>&division_id=<?php echo $division->id; ?>" title="Delete" class="admin-delete-event">x</a>
								<?php endif; ?>

								<div class="event">
									<?php if(!is_numeric($event->h_score) || !is_numeric($event->v_score)) : ?>
										<div>
											<span class="time" style="display: inline;"><?php echo $event->time; ?></span>
										</div>
										<span class="h-score" style="display: none;"><?php echo $event->h_score; ?></span>
										<span class="v-score" style="display: none;"><?php echo $event->v_score; ?></span>
									<?php else : ?>
										<div>
											<span class="h-score"><?php echo $event->h_score; ?></span> - 
											<span class="v-score"><?php echo $event->v_score; ?></span>
										</div>
									<?php endif; ?>

									<span class="h-club"><?php echo $event->h_club; ?></span> - 
									<span class="v-club"><?php echo $event->v_club; ?></span>
									<span class="group-id"><?php echo $group->id; ?></span>
									<span class="event-id"><?php echo $event->id; ?></span>
									<span class="loc"><?php echo $event->loc; ?></span>
									<span class="date"><?php echo $result->date; ?></span>
									<span class="time"><?php echo $event->time; ?></span>
								</div>
							<?php endforeach; ?>

						<?php endforeach; ?>
					<?php else : ?>
						<p>Currently no events have been planned.</p>
					<?php endif; ?>

					<?php if($this->session->userdata('logged_in')) : ?>
						<div class="admin-event-ctn">
							<div class="admin-event-add">+ Add New Event</div><!-- .admin-event-add -->

							<div class="admin-event">
								<form method="post" action="events/add">
									<div class="admin-event-row-1">
										<label for="admin-event-h-team">Home:</label>
										<select id="admin-event-h-team" name="h_team">
											<?php foreach($clubs as $club) : ?>
												<option value="<?php echo $club->id; ?>" id="<?php echo $club->id; ?>"><?php echo $club->name; ?></option>
											<?php endforeach; ?>
										</select>

										<label for="admin-event-v-team">Visitor:</label>
										<select id="admin-event-v-team" name="v_team">
											<?php foreach($clubs as $club) : ?>
												<option value="<?php echo $club->id; ?>" id="<?php echo $club->id; ?>"><?php echo $club->name; ?></option>
											<?php endforeach; ?>
										</select>
									</div><!-- .admin-event-row-1 -->

									<div class="admin-event-row-2">
										<label for="admin-event-h-score">Score:</label>
										<input type="text" id="admin-event-h-score" name="h_score" />

										<label for="admin-event-v-score">Score:</label>
										<input type="text" id="admin-event-v-score" name="v_score" />
									</div><!-- .admin-event-row-2 -->

									<div class="admin-event-row-3">
										<label for="admin-event-location">Location:</label>
										<input type="text" id="admin-event-location" name="location" />
									</div><!-- .admin-event-row-3 -->

									<div class="admin-event-row-4">
										<label for="admin-event-date">Date:</label>
										<input type="text" id="admin-event-date" name="date" />

										<label for="admin-event-time">Time:</label>
										<input type="text" id="admin-event-time" name="time" />
									</div><!-- .admin-event-row-4 -->

									<input type="hidden" name="division_id" value="<?php echo $division->id; ?>" />
									<input type="hidden" id="admin-event-group-id" name="group_id" value="<?php echo $group->id; ?>" />
									<input type="hidden" id="admin-event-event-id" name="event_id" value="0"/>

									<button>Save</button>
								</form>
							</div><!-- .admin-event -->
						</div><!-- .admin-event-ctn -->
					<?php endif; ?>
				</div><!-- .info -->
			</div><!-- .week -->
		<?php endforeach; ?>
	</div><!-- .weekly -->

<?php else : ?>
	<div class="no-results">
		Currently no groups.
	</div><!-- .row -->
<?php endif; ?>

<?php if($this->session->userdata('logged_in')  && ($division)) : ?>
	<div class="admin-edit admin-group">
		<form method="POST" action="<?php echo base_url('groups/add'); ?>">
			<label for="admin-add-group">Enter Group Name:</label>

			<input type="text" id="admin-add-group" name="group_name" />

			<input type="hidden" name="division_id" value="<?php if($division) echo $division->id; ?>" />

			<button name="add_group">Add Group</button>
		</form>
	</div><!-- .admin-edit -->
<?php endif; ?>