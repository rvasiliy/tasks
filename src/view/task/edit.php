<h2>Edit task</h2>

<form action="" method="post">
    <?php \helper\CsrfHelper::createFormField(); ?>
    <input class="form-control" name="id" type="hidden" value="<?= $model->id; ?>">

    <div class="form-group">
        <label for="name">Your name *</label>
        <input class="form-control <?= $errors['name'] ? 'is-invalid' : '' ?>"
               id="name"
               name="name"
               type="text"
               value="<?= $model->name; ?>">
        <div class="invalid-feedback"><?= htmlspecialchars($errors['name']) ?></div>
    </div>

    <div class="form-group">
        <label for="email">Your email *</label>
        <input class="form-control <?= $errors['email'] ? 'is-invalid' : '' ?>"
               id="email"
               name="email"
               type="email"
               value="<?= $model->email; ?>">
        <div class="invalid-feedback"><?= htmlspecialchars($errors['email']) ?></div>
    </div>

    <div class="form-group">
        <label for="description">Description *</label>
        <textarea class="form-control <?= $errors['description'] ? 'is-invalid' : '' ?>"
                  id="description"
                  name="description"><?= $model->description; ?></textarea>
        <div class="invalid-feedback"><?= htmlspecialchars($errors['description']) ?></div>
    </div>

    <div class="form-group d-flex">
        <a href="/" class="btn btn-primary ml-auto">Close</a>
        <button type="submit" class="btn btn-outline-primary ml-2">Save</button>
    </div>
</form>
