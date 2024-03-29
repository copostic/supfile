<section class="content" id="register">

    <div class="container login-box">
        <div class="row">
            <div class="left col-md-5 col-sm-12">

                <h1>Sign up</h1>

                <form id="register">
                    <input type="text" name="first_name" placeholder="First name" />
                    <input type="text" name="last_name" placeholder="Last name" />
                    <input type="text" name="email" placeholder="E-mail" />
                    <input type="password" name="password" placeholder="Password" />
                    <input type="password" name="password_verify" placeholder="Retype password" />

                    <input type="submit" name="signup_submit" value="Sign me up" />
                </form>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="or-container">OR</div>
            </div>

            <div class="right col-md-5 col-sm-12">
                <ul class="loginwith">
                    <li>
                        <a href="/auth/social?provider=Facebook" class="social-signin facebook">Log in with facebook</a>
                    </li>
                    <li>
                        <a href="/auth/social?provider=Twitter" class="social-signin twitter">Log in with Twitter</a>
                    </li>
                    <li>
                        <a href="/auth/social?provider=Google" class="social-signin google">Log in with Google+</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</section>