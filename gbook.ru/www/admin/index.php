<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Админка</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Custom style -->
        <link type="text/css" rel="stylesheet" href="../style.css">
    </head>
    <body>
        <?php include_once("../views/toolbar.php") ?>
        <br><br><br>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Имя</th>
              <th>Email</th>
              <th>Дата</th>
              <th>Сообщение</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php include_once("admin_pane.php") ?>
          </tbody>
        </table>
    </body>
</html>
