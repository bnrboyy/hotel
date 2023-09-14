<!DOCTYPE html>
<html lang="en">

<head>
    @include('backoffice.layouts.header')
    <link rel="stylesheet" href="css/backoffice/dashboard.css">
    <title>Dashboard</title>
</head>

<body class="bg-light">
    <div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between">
        <h3 class="mb-0">ADMIN PANEL</h3>
        <button class="btn btn-light btn-sm shadow-none" onclick="onLogout()">
            <span class="spinner spinner-border spinner-border-sm hidden text-dark" aria-hidden="true"></span>   ออกจากระบบ
        </button>
    </div>










    @include('backoffice.layouts.scripts')

    <script>
        const spinner = document.querySelector('.spinner')
        function onLogout() {
            spinner.classList.remove('hidden')
            axios.get('/admin/logout').then(res => {
                if (res.status) {
                    spinner.classList.add('hidden')
                    window.location.href = "/admin";
                }
            }).catch(err => {
                spinner.classList.add('hidden')
                cosnole.log(err)
            })
        }
    </script>
</body>

</html>
