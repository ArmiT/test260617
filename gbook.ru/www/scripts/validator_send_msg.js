$(document).ready(function() {
  $("#msg_form").validate({
    errorClass: "error-validator",
    validClass: "ok-validator",

    rules: {

      username: {
        required: true,
        maxlength: 255
      },

      email: {
        required: true,
        email: true
      },

      msg: {
        required: true,
        maxlength: 512
      }

    },

    submitHandler: function (form) {
      $.ajax({
        type: "POST",
        dataType: "html",
        data: $(form).serialize(),
        url: "scripts/send_msg_proc.php",
        success: function (data) {
          switch (data) {
            case "status:null":
              $("#res").text("Необходимо заполнить все поля!");
              break;

            case "status:len":
              $("#res").text("Длина полей Имя и Сообщение не должна превышать 255 и 512 символов соответственно!");
              break;

            case "status:ok":
              alert("Сообщение успешно отправлено! Нажмите ОК для продолжения...");
              document.location = "index.php";
              break;

            case "status:fail":
              $("#res").text("Проблема с подключением к БД! Попробуйте позднее...");
              break;
            default:
              $("#res").text("В настоящее время сервер недоступен! Попробуйте позднее...");
              break;
          }
        }
      });

      return false;
    },

    messages: {

      username: {
        required: "Это поле обязательно для заполнения",
        maxlength: "Количество символов не более 255"
      },

      email: {
        required: "Это поле обязательно для заполнения",
        email: "Введите корректный email адрес"
      },

      msg: {
        required: "Это поле обязательно для заполнения",
        maxlength: "Количество символов не более 512"
      }

    }
  });
});
