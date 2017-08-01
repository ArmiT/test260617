<?php

  $page_down = $this_page - 1;
  $page_up = $this_page + 1;

  if ($count_pages == 1) {
    echo "<li class=\"disabled\"><span>&laquo;</span></li>
          <li class=\"active\"><span>$this_page</span></li>
          <li class=\"disabled\"><span>&raquo;</span></li>";
  } else {
    if ($this_page == 1) {
      echo "<li class=\"disabled\"><span>&laquo;</span></li>";
      set_pages($count_pages, $this_page);
      echo "<li><a href=\"?p=". $page_up ."\"><span>&raquo;</span></a></li>";
    } elseif ($this_page == $count_pages) {
      echo "<li><a href=\"?p=". $page_down ."\"><span>&laquo;</span></a></li>";
      set_pages($count_pages, $this_page);
      echo "<li class=\"disabled\"><span>&raquo;</span></li>";
    } else {
      echo "<li><a href=\"?p=". $page_down ."\"><span>&laquo;</span></a></li>";
      set_pages($count_pages, $this_page);
      echo "<li><a href=\"?p=". $page_up ."\"<span>&raquo;</span></a></li>";
    }
  }

  function set_pages($count, $active_page) {
    for ($i = 1; $i <= $count; $i++) {
        if ($i == $active_page) {
          echo "<li class=\"active\"><span>$active_page</span></li>";
          continue;
        }

        echo "<li><a href=\"?p=$i\">$i</a></li>";
      }
  }
?>
