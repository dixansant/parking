<form class="navbar-form form-signin" action="{{ route('login',[],false) }}">
    @csrf
    <div class="form-group">
        <input type="email" id="email"  name="email"  class="form-control" placeholder="Email address" style="width: 180px" required autofocus>
    </div>
    <div class="form-group">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" style="width: 180px" required>

    </div>
    <button type="submit" class="btn btn-success">Sign in</button>
</form>