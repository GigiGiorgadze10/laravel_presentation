<!DOCTYPE html>
<html>
<head>
    <title>Socialite Demo</title>
</head>
<body>
    <h1>Welcome to the Laravel Socialite Demo</h1>
    @if (Auth::check())
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <a href="{{ route('github.login') }}">Sign in with GitHub</a>
    @endif
</body>
</html>
