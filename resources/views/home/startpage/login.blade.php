
<form class="form-signin" action="{{ route('login',[],false) }}">
    @csrf
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Login</h1>
    </div>

    <div class="form-label-group">
        <input type="email" id="email"  name="email"  class="form-control" placeholder="Email address" required autofocus>

    </div>

    <div class="form-label-group">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

    </div>

    <div class="checkbox">
        <label>
            <input type="checkbox" name="remember" id="remember" class="form-check-input"> Remember me
        </label>
    </div>
    <div >
        <div class="col-md-3">
            <button class="btn btn-lg btn-info" type="submit">Sign in</button>
        </div>
        <div class="col-md-9">
        <a href="?dialog={{ route('forgot',[],false) }}" style="margin-left: 20px;"> {{ __('Forgot Your Password?') }}</a><br>
            <a href="?dialog={{ route('register',[],false) }}" style="margin-left: 20px;"> {{ __('Register a new User') }}</a>
        </div>
    </div>





</form>

<style>

    .form-signin {
        width: 100%;
        max-width: 360px;
        padding: 15px;
        margin: auto;
    }

    .form-label-group .form-control {
        height: 44px;
    }

    .form-signin > DIV {
        position: relative;
        margin-bottom: 10px;
        height: 44px;
    }


</style>
