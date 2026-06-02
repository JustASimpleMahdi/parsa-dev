<a href="{{ route('employee.announcements.index') }}" class="notification-icon">
    <i class="fas fa-bell"></i>
    @if($unreadAnnouncementsCount)
        <span class="notification-badge">{{ $unreadAnnouncementsCount }}</span>
    @endif
</a>
