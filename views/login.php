<?php

use app\core\App;
?>

<main class="form-signin w-100 m-auto">
    <form action="" method="POST" autocomplete="off">
        <h1 class="h3 mb-2 fw-semibold">Login</h1>
        <p class="mb-5">Selamat datang, silahkan masukan username dan password yang sudah anda daftarkan.</p>

        <!-- Flash Message -->
        <?php if (App::$app->session->getFlash('success')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <small><?= App::$app->session->getFlash('success'); ?></small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- ENd Flash Message -->

        <div class="form-floating">
            <input type="text" name="username" class="form-control head <?= ($user->hasError('username')) ? 'is-invalid shake' : ''; ?>" id="username" placeholder="username" value="<?= $user->username; ?>">
            <label for="username">Nama</label>
            <div class="invalid-feedback mb-2 text-end fst-italic">
                <small><?= $user->getError('username'); ?></small>
            </div>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control footer <?= ($user->hasError('password')) ? 'is-invalid shake' : ''; ?>" id="password" placeholder="Password" value="<?= $user->password; ?>">
            <label for="password">Password</label>
            <div class="invalid-feedback mb-2 text-end fst-italic">
                <small><?= $user->getError('password'); ?></small>
            </div>
        </div>

        <button class="w-100 btn btn-lg btn-dark mt-4" type="submit">Masuk</button>

        <small class="text-muted">Daftar user baru <strong><a href="/register" class="text-decoration-none">Daftar</a></strong></small>
    </form>
</main>