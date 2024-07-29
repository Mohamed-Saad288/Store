<x-front-layout title="Register">
    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Register Now</h3>
                                <p>You can Register using your social media account or email address.</p>
                            </div>
                            <div class="social-login">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn facebook-btn"
                                                                             href="{{ route('auth.socialite.redirect','facebook') }}"><i class="lni lni-facebook-filled"></i> Facebook
                                            login</a></div>
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn twitter-btn"
                                                                             href="javascript:void(0)"><i class="lni lni-twitter-original"></i> Twitter
                                            login</a></div>
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn google-btn"
                                                                             href="{{ route('auth.socialite.redirect','google') }}"><i class="lni lni-google"></i> Google login</a>
                                    </div>
                                </div>
                            </div>
                            <div class="alt-option">
                                <span>Or</span>
                            </div>
                            @if($errors->has(config('fortify.username')))
                                <div class="alert alert-danger">
                                    {{ $errors->first(config('fortify.username')) }}
                                </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="nae">Name</label>
                                <input class="form-control" type="text" name="name" id="name" required>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Email</label>
                                <input class="form-control" type="text" name="{{ config('fortify.username') }}" id="reg-email" required>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Password</label>
                                <input class="form-control" type="password" name="password" id="reg-pass" required>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" value="1" class="form-check-input width-auto" id="exampleCheck1">
                                    <label class="form-check-label">Remember me</label>
                                </div>

                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Register</button>
                            </div>
                            @if(Route::has('password.register'))
                            <p class="outer-link">Already have an account? <a href="{{ route('Login') }}">Login here </a>
                                @endif
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->
</x-front-layout>
