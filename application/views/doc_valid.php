<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Bottom navbar example for Bootstrap</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/navbar-bottom/"> -->

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/template/dist/css/') ?>bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://ff.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=mIb8Qg8UDS9-C6oVnXbJDOjyKQQokp89cD97o4Wwr4xnL-LBD53mkEhhuuB3K94-9QPCJxMCnX0tzThBb1UoyHe926gU1bLYwyK2SCTTVko" charset="UTF-8"></script></head>

  <body>
    <div class="container">
      <div class="jumbotron mt-3 bg-success">
        <h1>Dokumen Valid</h1>

        <p class="lead">Dokumen "<?= ucwords($doc['original_file_name']) ?>" telah ditandatangani secara digital pada <?= formatTglIndo_datetime($doc['signed_at']) ?></p>

        <!-- <a class="btn btn-lg btn-primary" href="../../components/navbar/" role="button">View navbar docs &raquo;</a> -->
      </div>
    </div>
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
