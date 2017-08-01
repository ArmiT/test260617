<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Гостевая книга</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Custom style -->
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include("views/toolbar.html") ?>
        <div class="container-fluid">
          <div class="row">
            <?php include_once("views/send_msg_pane.html") ?>
            <?php include_once("adapters/msg_area_adapter.php") ?>
          </div>
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <!-- jQuery Validation Plugin -->
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <!-- Validation Script -->
        <script src="scripts/validator_send_msg.js"></script>
    </body>
</html>
