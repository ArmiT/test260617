<tr>
  <td><?php echo $msg['name'] ?></td>
  <td><?php echo $msg['email'] ?></td>
  <td><?php echo $msg['date'] ?></td>
  <td><?php echo $msg['msg'] ?></td>
  <td class="text-right">
    <form method="post" action="action.php">
      <input type="hidden" name="msgID" value="<?php echo $msg['id'] ?>">
      <button name="msgDel" type="submit" class="btn btn-danger">Удалить</button>
      <button name="msgPush" type="submit" class="btn btn-info">Опубликовать</button>
    </form>
  </td>
</tr>
