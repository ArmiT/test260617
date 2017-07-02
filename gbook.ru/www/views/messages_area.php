<div class="col-md-9 col-md-offset-3 main">
  <br><br>
  <div>
    <?php
      foreach ($messages as $msg) {
        include("views/msg_card.php");
      }
    ?>
  </div>
  <div class="text-center">
    <nav>
      <ul class="pagination">
        <?php include("adapters/pager_ind_adapter.php") ?>
      </ul>
    </nav>
  </div>
</div>
