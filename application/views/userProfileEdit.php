<div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h2 class="header center amber-text text-darken-2">Editing {first_name}'s Profile</h2>
      <div class="row center">
		<div class="input-field col s0 m2 white-text"></div>
		<form method="post" enctype="multipart/form-data" class="col s12 m8">	
			<div class="row">
				<h4 class="col s12">Basic Info</h4>
			</div>
			<div class="row">
				<div class="input-field col s0 m2 white-text"></div>
				<div class="input-field col s12 m4">
					<input id="first_name" name="first_name" type="text" class="validate" value="{first_name}" required>
					<label for="first_name">First Name</label>
				</div>
				<div class="input-field col s12 m4">
					<input id="last_name" name="last_name" type="text" class="validate" value="{last_name}">
					<label for="last_name">Last Name</label>
				</div>
				<div class="input-field col s0 m2 white-text"></div>
			</div>
			<div class="row">
				<h4 class="col s12">About Me</h4>
			</div>
			<div class="row">
				<div class="input-field col s0 m2 white-text"></div>
				<div class="col s12 m8">
					<textarea id="about_me" name="about_me" class="materialize-textarea" value="{about_me}" required>{about_me}</textarea>
					<script>
						// replaces above textarea with CKEDITOR
						var editor = CKEDITOR.replace('about_me');
						//editor.setData({about_me});
					</script>
				</div>
				<div class="input-field col s0 m2 white-text"></div>
			</div>
			<div class="row">
				<h4 class="col s12">My Causes</h4><br>
				<h6 class="col s12">Your choices help match you up with potential volunteer opportunities!</h6><br>
				<div class="input-field col s6 m3">
					<input type="checkbox" id="cause_animals" name="cause_animals" {animals} />
					<label for="cause_animals">Animals</label>
				</div>
				<div class="input-field col s6 m3">
					<input type="checkbox" id="cause_environment" name="cause_environment" {environment} />
					<label for="cause_environment">The Environment</label>
				</div>
				<div class="input-field col s6 m3">
					<input type="checkbox" id="cause_welfare" name="cause_welfare" {welfare} />
					<label for="cause_welfare">Social Welfare</label>
				</div>
				<div class="input-field col s6 m3">
					<input type="checkbox" id="cause_disabilities" name="cause_disabilities" {disabilities} />
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
