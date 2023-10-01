<div>
	<!-- usersTeam START -->
	<x-head.h2>{{ __('users') }}</x-head.h2>
	<div class="my-5">
	@foreach ($usersTeam as $user)
		<x-item.event-user :item="$user" :model="$model" />
	@endforeach
	<!-- usersTeam END -->
	</div>
</div>