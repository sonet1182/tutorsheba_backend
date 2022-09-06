<h6>Welcome To Admin Dashboard</h6>
<h1>{{ Auth::guard('admin')->user()->name }}</h1>

<hr>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf

    <h2 :href="route('admin.logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
        {{ __('Log Out') }}
</h2>
</form>
