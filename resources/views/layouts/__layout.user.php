<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#000000ee">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
<?php css() ?>
</style>

<body>
    <div class="sidebar">
        <div class="header">
            <a href="/user/profile"><?= $user->username ?></a>
        </div>
        <div>
            <a href="/user"><i class="fa fa-user"></i> Dashboard</a>
            <a href="/user/profile"><i class="fa fa-user"></i> Profile</a>
            <a href="/logout"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
    </div>
    <div class="container">

        <?= VIEW_PLACEHOLDER ?>

    </div>
    <script type="text/javascript">
    <?php javascript() ?>
    </script>
</body>

</html>