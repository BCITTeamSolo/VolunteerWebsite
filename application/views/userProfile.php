<div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
	  <div class="row center">
		<h1 class="header center amber-text text-darken-2">{firstName} {lastName}</h1>
	  </div>
      <div class="row center">
		<div class="input-field col s0 m2 white-text"></div>
		<div class="col s12 m8">
			<div class="card-panel row center light-blue valign-wrapper" style="{match_display}">
				<p class="white-text col s8 flow-text">Your compatability rating with {firstName} {lastName} is...
				</p>
				<div class="card-panel col s4 red white-text flow-text valign">{matchPercent}%
				</div>
			</div>
			<div class="card-panel row center light-blue valign-wrapper" style="{edit_display}">
				<p class="white-text col s8 flow-text">This is you! Why not edit your profile?
				</p>
				<a href="/{type}/{id}/edit" id="download-button" class="btn-large waves-effect waves-light amber darken-2">Edit Profile</a>
			</div>
			{loginMessage}
		</div>
		<div class="input-field col s0 m2 white-text"></div>
      </div>
      <br><br>
    </div>
  </div>
<div class="container">
	<div class="section">

		<div class="row center">
			<div class="input-field col s0 m2 white-text"></div>
			<div class="col s4 m2">
				<span class="row black-text flow-text">About Me:</span>
			</div>
			<div class="col s8 m6">
				<span class="row black-text flow-text">{about}</span>
			</div>
			<div class="input-field col s0 m2 white-text"></div>
		</div>
		<div class="row center">
			<div class="input-field col s0 m2 white-text"></div>
			<div class="col s4 m2">
				<span class="row black-text flow-text">Causes:</span>
			</div>
			<div class="col s8 m6">
				{causes}
					<span class="row black-text flow-text">{cause}</span><br>
				{/causes}
			</div>
			<div class="input-field col s0 m2 white-text"></div>
		</div>
    </div>  
    <br><br>

    <div class="section">

    </div>
</div>