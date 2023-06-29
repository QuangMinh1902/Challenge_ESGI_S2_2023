<div class="auth-wrapper">
    <div class="auth-content">
        <div class="card">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <form id="formRegister" action="/processregister" method="POST">
                        <div class="card-body">
                            <img src="assets/images/logo-dark.png" alt="" class="img-fluid mb-4">
                            <h4 class="mb-3 f-w-400">Login</h4>
                            <div class="form-group mb-3">
                                <label class="floating-label" for="Email">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="floating-label" for="Email">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="floating-label" for="Email">Email address</label>
                                <input type="email" class="form-control" name="email" id="Email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group mb-4">
                                <label class="floating-label" for="Password">Password</label>
                                <input type="password" class="form-control" name="password" id="Password" placeholder="Enter Password" required>
                            </div>
                            <div class="form-group mb-4">
                                <label class="floating-label" for="Password">Password Confirm</label>
                                <input type="password" class="form-control" name="confirmPassword" id="Password" placeholder="Confirm Password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mb-4">Sign up </button>
                            <p class="mb-2">Already have an account? <a href="/login" class="f-w-400">Sign in</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>