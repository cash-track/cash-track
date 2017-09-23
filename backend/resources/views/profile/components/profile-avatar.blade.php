<div class="profile-image">
    <a href="{{ route('profile.settings', 'general') }}"
       class="profile-image-container rounded-circle"
       title="Change profile image">
        <img src="{{ $user->image }}" alt="Profile image">
    </a>
</div>