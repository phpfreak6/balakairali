
<div class="profile-user-info profile-user-info-striped">
	
    @foreach($parents as $key => $parent)

		<div class="profile-info-row">
			<div class="profile-info-name"><span><input type="checkbox" class="parent_select" value="{{ $parent['p1_mobile'] }}" name="parent_select"></span> </div>

			<div class="profile-info-value">
				<span class="editable editable-click" id="username">{{ $parent['p1_first_name'] }} {{ $parent['p1_last_name'] }} - <strong>{{ $parent['p1_mobile'] }}</strong></span>
			</div>
		</div>
	
    @endforeach
</div>
