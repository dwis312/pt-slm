<main class="form-signin w-100 m-auto">
    <form action="" method="POST" autocomplete="off">
        <h1 class="h3 mb-4 fw-normal">Form Register</h1>

        <div class="form-floating">
            <input type="text" name="username" class="form-control head <?= ($user->hasError('username')) ? 'is-invalid shake' : ''; ?>" id="username" placeholder="username" value="<?= $user->username; ?>">
            <label for="username">Nama</label>
            <div class="invalid-feedback mb-2 text-end fst-italic">
                <small><?= $user->getError('username'); ?></small>
            </div>

        </div>
        <div class="form-floating">
            <input type="text" name="nip" class="form-control body <?= ($user->hasError('nip')) ? 'is-invalid shake' : ''; ?>" id="nip" placeholder="nip" value="<?= $user->nip; ?>">
            <label for="nip">NIP</label>
            <div class="invalid-feedback mb-2 text-end fst-italic">
                <small><?= $user->getError('nip'); ?></small>
            </div>
        </div>
        <div class="form-floating">
            <input type="email" name="email" class="form-control body <?= ($user->hasError('email')) ? 'is-invalid shake' : ''; ?>" id="email" placeholder="name@example.com" value="<?= $user->email; ?>">
            <label for="email">Email</label>
            <div class="invalid-feedback mb-2 text-end fst-italic">
                <small><?= $user->getError('email'); ?></small>
            </div>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control body <?= ($user->hasError('password')) ? 'is-invalid shake' : ''; ?>" id="password" placeholder="Password" value="<?= $user->password; ?>">
            <label for="password">Password</label>
            <div class="invalid-feedback mb-2 text-end fst-italic">
                <small><?= $user->getError('password'); ?></small>
            </div>
        </div>
        <div class="form-floating">
            <input type="password" name="cpassword" class="form-control footer <?= ($user->hasError('cpassword')) ? 'is-invalid shake' : ''; ?>" id="cpassword" placeholder="Konfirmasi Password" value="<?= $user->cpassword; ?>">
            <label for="cpassword">Konfirmasi Password</label>
            <div class="invalid-feedback mb-2 text-end fst-italic">
                <small><?= $user->getError('cpassword'); ?></small>
            </div>
        </div>

        <button class="w-100 btn btn-lg btn-dark mt-4" type="submit">Daftar</button>

        <small class="text-muted">Sudah mendaftar ? <strong><a href="/login" class="text-decoration-none">Login</a></strong></small>
    </form>
</main>