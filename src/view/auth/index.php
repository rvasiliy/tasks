<?php

use helper\CsrfHelper;

?>
<div class="row justify-content-center">
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Authentication
        </div>
        <form class="card-body" action="/auth/login" method="post">
            <?php CsrfHelper::createFormField(); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" id="username" name="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password">
            </div>

            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit">Sign in</button>
            </div>
        </form>
    </div>
</div>
