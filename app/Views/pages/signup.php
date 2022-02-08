<section>
    <div class="container">
        <h2 style="padding:10px; text-align:center;">Sign Up</h2>
        <?php if(isset($validation)):?>
            <div class="alert alert-warning">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif;?>
        <form action="/signup/store" method="post">

        <?= csrf_field() ?>

        <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" name="firstName" class="form-control" id="firstName" aria-describedby="firstName">
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" name="lastName" class="form-control" id="lastName" aria-describedby="lastName">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email1" aria-describedby="email">
            <div id="email" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="Password">
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
            </div>
            <div class="mb-3">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Select Role</option>
                    <option value="0">Psychiatrist</option>
                    <option value="1">Patient</option>
                </select>
            </div>
            
            <button type="submit" name="submit" value="signup" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</section>