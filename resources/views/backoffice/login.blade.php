<!DOCTYPE html>
<html lang="en">

<head>
    @include('backoffice.layouts.header')
    <link rel="stylesheet" href="css/backoffice/login-admin.css">
    <title>Admin Login</title>
</head>

<body class="bg-light">


    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form>
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" type="text" class="form-control shadow-nonea text-center" placeholder="Admin name" required>
                </div>
                <div class="mb-4">
                    <input name="admin_pass" type="password" class="form-control shadow-none text-center" placeholder="Password" required>
                </div>
                <button name="btn_login" type="submit" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>






    @include('backoffice.layouts.scripts')
</body>

</html>
