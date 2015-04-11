<div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center amber-text text-darken-2">Search Volunteer Website</h1>
      <div class="row center">
        <h5 class="header col s12 light">Looking for people or organizations? Browse users below!</h5>
      </div>
      <br><br>

    </div>
  </div>
<div class="container">
	<div class="section">
		{users}
		<br>
			<div class="row">
				<div class="input-field col s0 m2 white-text"></div>
				<div class="col s12 m8">
					<a href="/{typename}/{typeid}">
						<div class="card-panel row center light-blue valign-wrapper">
							<p class="white-text col s8 flow-text">{name}</p>
							<div class="card-panel col s4 red white-text flow-text valign">{matchPercent}%</div>
						</div>
					</a>
				</div>
				<div class="input-field col s0 m2 white-text"></div>
			</div>
		<br>
		{/users}
    </div>
	<br>
    <div class="section">
    </div>
</div>