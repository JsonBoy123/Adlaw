 <script src="{{ asset('js/app.js') }}" defer></script>
<li class="dropdown notifications-menu" id="app">
 <notification-component 
  :notifications="{{ json_encode(auth()->user()->unreadNotifications) }}"
  :logged_user="{{ json_encode(auth()->user()) }}">
</notification-component>
 </li>