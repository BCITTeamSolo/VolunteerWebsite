<div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h2 class="header center amber-text text-darken-2">Register Myself</h2>
      <div class="row center">
		<div class="input-field col s0 m2 white-text"></div>
		<form method="post" class="col s12 m8">	
			<div class="row">
				<div class="input-field col s0 m2 white-text"></div>
				<div class="input-field col s12 m4">
					<input id="first_name" name="first_name" type="text" class="validate" required>
					<label for="first_name">First Name</label>
				</div>
				<div class="input-field col s12 m4">
					<input id="last_name" name="last_name" type="text" class="validate">
					<label for="last_name">Last Name</label>
				</div>
				<div class="input-field col s0 m2 white-text"></div>
			</div>
			<div class="row">
				<div class="input-field col s0 m2 white-text"></div>
				<div class="input-field col s12 m4">
					<input id="email" name="email" type="email" class="validate" required>
					<label for="email">Email</label>
				</div>
				<div class="input-field col s12 m4">
					<input id="password" name="password" type="password" class="validate" required>
					<label for="password">Password</label>
				</div>
				<div class="input-field col s0 m2 white-text"></div>
			</div>
			<div class="row">
				<div class="input-field col s0 m2 white-text"></div>
				<div class="file-field input-field col s12 m8">
					<input class="file-path validate valid" type="text" />
					<div class="btn">
						<span>Profile Picture</span>
						<input id="profile_picture" name="profile_picture" type="file" />
					</div>
				</div>
				<div class="input-field col s0 m2 white-text"></div>
			</div>
			<div class="row">
				<div class="input-field col s0 m2 white-text"></div>
				<div class="input-field col s12 m8">
					<textarea id="about_me" name="about_me" class="materialize-textarea" required></textarea>
					<label for="about_me">About Me</label>
				</div>
				<div class="input-field col s0 m2 white-text"></div>
			</div>
			<div class="row">
				<h4 class="col s12">My Causes:</h4><br>
				<h5 class="col s12">Your choices help match you up with potential volunteer opportunities!</h5><br>
				<div class="input-field col s6 m3">
					<input type="checkbox" id="cause_animals" name="cause_animals" />
					<label for="cause_animals">Animals</label>
				</div>
				<div class="input-field col s6 m3">
					<input type="checkbox" id="cause_environment" name="cause_environment" />
					<label for="cause_environment">The Environment</label>
				</div>
				<div class="input-field col s6 m3">
					<input type="checkbox" id="cause_welfare" name="cause_welfare" />
					<label for="cause_welfare">Social Welfare</label>
				</div>
				<div class="input-field col s6 m3">
					<input type="checkbox" id="cause_disabilities" name="cause_disabilities" />
					<label for="cause_disabilities">Disabilities</label>
				</div>
			</div>
			<br>
			<div class="row right">
				<button class="btn waves-effect waves-light btn-large amber darken-2" type="submit" name="action">Submit
					<i class="mdi-content-send right"></i>
				</button>
			</div>
		</form>
		<div class="input-field col s0 m2 white-text"></div>
      </div>
      <br><br>
    </div>
</div>