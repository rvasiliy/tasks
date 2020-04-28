<?php

use helper\CsrfHelper;

?>
<div class="row justify-content-center">
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Authentication
        </div>
        <form class="card-body" action="" method="post">
            <?php CsrfHelper::createFormField(); ?>
            <div class="form-group">
                <label for="username">Username *</span></label>
                <input class="form-control <?= $errors['username'] ? 'is-invalid' : '' ?>"
                       type="text"
                       id="username"
                       name="username"
                       value="<?= $model->username ?>">
                <div class="invalid-feedback"><?= htmlspecialchars($errors['username']) ?></div>
            </div>

            <div class="form-group">
                <label for="password">Password *</label>
                <input class="form-control <?= $errors['password'] ? 'is-invalid' : '' ?>"
                       type="password"
                       id="password"
                       name="password"
                       value="<?= $model->password ?>">
                <div class="invalid-feedback"><?= htmlspecialchars($errors['password']) ?></div>
            </div>

            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit">Sign in</button>
            </div>
        </form>
    </div>
</div>
