<!-- src/Template/Members/login.ctp-->
<?= $this->Flash->render('auth') ?>
<form class="form-signin" role="form" method="post">
    <h2 class="form-signin-heading"><?= __('Please sign in') ?></h2>
    <input name="email" type="email" class="form-control" placeholder="<?= __('Email address') ?>" required autofocus>
    <input name="password" type="password" class="form-control" placeholder="<?= __('Password') ?>" required>
    <label class="checkbox">
        <input name="remember_me" type="checkbox" value="1"> <?= __('Remember me') ?>
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit"><?= __('Sign in') ?></button>
</form>