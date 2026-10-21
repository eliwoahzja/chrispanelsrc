<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<style>
    :root {
        --background-color: #ffffff;
        --text-color: #000000;
        --card-background: #ffffff;
        --card-header-bg: #343a40;
        --card-header-text: #ffffff;
        --btn-outline-dark: #000000;
        --form-control-bg: #ffffff;
        --form-control-text: #000000;
        --form-control-border: #ced4da;
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
        transition: background-color 0.3s, color 0.3s;
    }

    .card {
        background-color: var(--card-background);
        transition: background-color 0.3s;
    }

    .card-header {
        background-color: var(--card-header-bg);
        color: var(--card-header-text);
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-outline-dark {
        border-color: var(--btn-outline-dark);
        color: var(--btn-outline-dark);
        transition: border-color 0.3s, color 0.3s;
    }

    .btn-outline-dark:hover {
        background-color: var(--btn-outline-dark);
        color: var(--background-color);
    }

    .splash-screen {
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }

    .splash-logo {
        width: 350px;
        height: auto;
    }

    .blurred {
        filter: blur(5px);
        transition: filter 0.3s;
    }

    .form-control {
        background-color: var(--form-control-bg);
        color: var(--form-control-text);
        border-color: var(--form-control-border);
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .form-control::placeholder {
        color: var(--form-control-text);
    }

    .form-control:focus {
        color: var(--form-control-text);
        background-color: var(--form-control-bg);
    }

    label, small {
        color: var(--text-color);
    }

    .btn-outline-secondary, .btn-outline-primary {
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .btn-outline-secondary:hover, .btn-outline-primary:hover {
        background-color: var(--text-color);
        color: var(--background-color);
    }
</style>

<div class="splash-screen">
    <img src="uploads/images/logo.png" alt="Logo" class="splash-logo">
</div>

<div class="row justify-content-center pt-5">
    <div class="col-lg-4">
        <?= $this->include('Layout/msgStatus') ?>

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header text-center h5 p-3">
                Login
            </div>
            <div class="card-body">
                <?= form_open() ?>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Your username" required minlength="4">
                    <label for="username">Username</label>
                    <?php if ($validation->hasError('username')) : ?>
                        <small class="text-danger"><?= $validation->getError('username') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Your password" required minlength="6">
                    <label for="password">Password</label>
                    <?php if ($validation->hasError('password')) : ?>
                        <small class="text-danger"><?= $validation->getError('password') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="mb-3">
                    <input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR']; ?>" id="ip" required>
                    <?php if ($validation->hasError('ip')) : ?>
                        <small class="text-danger"><?= $validation->getError('ip') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="stay_log" id="stay_log" value="yes">
                        <label class="form-check-label" for="stay_log" data-bs-toggle="tooltip" data-bs-placement="top" title="Keep session more than 30 minutes">
                            Stay login?
                        </label>
                    </div>
                    <button type="button" class="btn btn-outline-dark shadow-sm" id="togglePassword">Show Password</button>
                </div>
                
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-outline-dark w-100 shadow-sm"><i class="bi bi-box-arrow-in-right"></i> Log in</button>
                </div>
                <?= form_close() ?>
                
                <div class="d-grid mb-3">
                    <a href="<?= site_url('register') ?>" class="btn btn-outline-secondary w-100 shadow-sm">Register here</a>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="https://t.me/ZiaaDev" class="btn btn-outline-primary w-50 shadow-sm me-1" target="_blank">Join Telegram</a>
                    <a href="https://t.me/ZiaaDev" class="btn btn-outline-secondary w-50 shadow-sm ms-1" target="_blank">Reset Password</a>
                </div>

                <!-- IP Section -->
                <div class="mt-4 d-flex align-items-center justify-content-center">
                    <div id="ipAddress" class="blurred me-2">
                        <?= htmlspecialchars($_SERVER['REMOTE_ADDR']); ?>
                    </div>
                    <button type="button" class="btn btn-outline-dark shadow-sm" id="showIpButton">Show IP</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Keep the splash screen for 5 seconds, then fade out
        setTimeout(function() {
            $('.splash-screen').fadeOut(1000, function() { // Fade out duration is 1 second (1000ms)
                $(this).remove();
            });
        }, 350); // Keep the splash screen for 5 seconds (5000ms)

        // Toggle password visibility
        $(document).on('click', '#togglePassword', function() {
            var input = $("#password");
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                $(this).text('Hide Password');
            } else {
                input.attr('type', 'password');
                $(this).text('Show Password');
            }
        });

        // Toggle IP visibility
        $(document).on('click', '#showIpButton', function() {
            $('#ipAddress').toggleClass('blurred');
            var button = $(this);
            button.text() === 'Show IP' ? button.text('Hide IP') : button.text('Show IP');
        });
    });
</script>
<?= $this->endSection() ?>
