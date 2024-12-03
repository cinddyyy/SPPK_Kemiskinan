<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SPPK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #F5F2EB;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }

    .login-box {
        background-color: #ffff;
        padding: 60px 50px;
        width: 400px;
        max-width: 90%;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .input-container {
        width: 100%;
        margin-bottom: 15px;
    }

    .input-wrapper {
        display: flex;
        align-items: center;
        background-color: #fff;
        border: 1px solid #ccc;
        /* Tambahkan border abu-abu */
        border-radius: 8px;
        /* Sudut melengkung */
        padding: 15px;
        transition: border-color 0.3s ease;
    }


    .input-wrapper i {
        margin-right: 12px;
        color: #7e8889;
        font-size: 20px;
    }

    input[type="text"],
    input[type="password"] {
        border: none;
        /* Hapus border bawaan */
        outline: none;
        /* Hapus outline bawaan */
        width: 100%;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        background: transparent;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: none;
        text-align: left;
    }

    .button {
        background-color: #E3CAA5;
        border: none;
        color: black;
        padding: 12px 0;
        font-size: 18px;
        font-family: 'Poppins', sans-serif;
        border-radius: 8px;
        width: 100%;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        margin-top: 35px;
    }

    .button:hover {
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.4);
        transform: translateY(-4px);
    }

    .button:active {
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        transform: translateY(2px);
    }

    img {
        width: 300px;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h1 style="color: black; font-size: 40px; margin-bottom: 20px; font-weight: 1500;">Masuk</h1>
            <form id="loginForm" action="/prosesLogin" method="post">
                <?= csrf_field() ?>
                <div class="input-container">
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Nama pengguna">
                    </div>
                    <p class="error-message" id="usernameError">Nama pengguna harus diisi</p>
                </div>
                <div class="input-container">
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Kata sandi">
                    </div>
                    <p class="error-message" id="passwordError">Kata sandi harus diisi</p>
                </div>

                <!-- Pesan Error di Atas Tombol Login -->
                <?php if (session()->getFlashdata('error')) : ?>
                <div id="globalError" style="color: red; margin-top: 30px; font-size: 12px;">
                    <?= session()->getFlashdata('error'); ?>
                </div>
                <?php endif; ?>

                <button type="submit" class="button" onclick="validateForm()">Masuk</button>
            </form>
            <div style="margin-top: 20px; color: black;">
                <span>Belum punya akun? <a href="/registrasi"
                        style="color: black; text-decoration: none; font-weight: 600;">Daftar,
                        yuk!</a></span>
            </div>
        </div>
    </div>

    <script>
    function showError(input, message) {
        const error = input.parentElement.parentElement.querySelector('.error-message');
        error.textContent = message;
        error.style.display = 'block';
    }

    function hideError(input) {
        const error = input.parentElement.parentElement.querySelector('.error-message');
        error.style.display = 'none';
    }

    function validateInput(input) {
        if (input.value.trim() === "") {
            showError(input, `${input.placeholder} harus diisi`);
            return false;
        } else {
            hideError(input);
            return true;
        }
    }

    function validateForm() {
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');

        let valid = true;

        if (!validateInput(usernameInput)) valid = false;
        if (!validateInput(passwordInput)) valid = false;

        if (!valid) {
            event.preventDefault(); // Mencegah form submit jika validasi gagal
        }
    }

    // Fungsi untuk menyembunyikan pesan error global
    function hideGlobalError() {
        const globalError = document.getElementById('globalError');
        if (globalError) {
            globalError.style.display = 'none';
        }
    }

    // Validasi real-time dan hapus error saat pengguna mengetik
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    // Hapus pesan error saat pengguna mulai mengetik
    usernameInput.addEventListener('input', () => {
        hideError(usernameInput);
        hideGlobalError();
    });
    passwordInput.addEventListener('input', () => {
        hideError(passwordInput);
        hideGlobalError();
    });
    </script>
</body>

</html>