<!DOCTYPE html>
<html lang="en">

<head>
    @include('backoffice.layouts.header')
    <link rel="stylesheet" href="/css/backoffice/login-admin.css">
    <title>Admin Login</title>
</head>

<body class="bg-light">

    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form id="login-form">
            <h4 class="bg-dark text-white py-3"><i class="bi bi-person-fill-lock"></i> เข้าสู่ระบบแอดมิน</h4>
            <div class="p-4">
                <div class="mb-3">
                    <p class="invalid text-danger hidden">Username หรือ Password ไม่ถูกต้อง</p>
                    <input name="username" type="email" class="form-control shadow-none text-center"
                        placeholder="Username" required>
                </div>
                <div class="mb-4">
                    <input name="password" type="password" class="form-control shadow-none text-center"
                        placeholder="Password" required>
                </div>
                <button name="btn_login" type="submit" class="btn text-white custom-bg shadow-none">
                    <span class="spinner spinner-border spinner-border-sm hidden" aria-hidden="true"></span>   เข้าสู่ระบบ
                </button>
            </div>
        </form>
    </div>




    @include('backoffice.layouts.scripts')
    <script>
        const spinner = document.querySelector('.spinner')
        document.getElementById("login-form").addEventListener("submit", function(event) {
            event.preventDefault();

            spinner.classList.remove('hidden')
            const form = event.target;
            const formData = new FormData(form);

            axios.post('/admin/signin', formData).then(res => {
                if (res.status) {
                    window.location.href = "/admin";
                }
            }).catch(err => {
                const message = document.querySelector('.invalid')
                if (err.response.status === 403) {
                    message.innerText = "บัญชีนี้ถูกปิดใช้งาน";
                } else {
                    message.innerText = "Username หรือ Password ไม่ถูกต้อง";
                }
                spinner.classList.add('hidden')
                message.classList.remove('hidden')
            })

        });
    </script>
</body>

</html>
