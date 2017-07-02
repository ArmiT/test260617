<div class="col-md-3 sidebar">
  <br>
  <form id="msg_form" method="post" role="form">
    <div class="form-group">
      <label for="text">Имя</label>
      <input name="username" type="text" class="form-control" placeholder="Введите имя">
    </div>
    <div class="form-group">
      <label for="text">Email</label>
      <input name="email" type="email" class="form-control" placeholder="Введите email">
    </div>
    <div class="form-group">
      <label for="text">Сообщение</label>
      <textarea name="msg" type="text" class="form-control msg-area" placeholder="Введите текст сообщения"></textarea>
      <p class="help-block"><em>Примечание: перед публикацией ваше сообщение будет проверено администратором!</em></p>
    </div>
    <button name="msg_send" type="submit" class="btn btn-success btn-send">Отправить</button>
    <br>
    <div class="form-group has-error">
      <h4><span style="color: red" id="res"></span></h4>
    </div>
  </form>
</div>
