<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <meta name="description" content="Ceci est ma super page">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Original path -->
    <base href="http://localhost/admin/">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!--  css data table -->
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include $this->view; ?>
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!--  -->
    <script>
        $(document).ready(function() {
            $('#formLogin').on('submit', function(e) {
                e.preventDefault();
                const email = $('#Email').val()
                const password = $('#Password').val()
                // send ajax
                $.ajax({
                    url: '/processlogin',
                    type: 'POST',
                    data: {
                        email,
                        password
                    },
                    success: function(result) {
                        if (result == 'Logged in successfully') {
                            alert(result)
                            window.location.href = '/admin/dashboard/index';
                        } else {
                            alert(result);
                        }
                    }
                });
                return false;
            })
        })
    </script>
</body>

</html>