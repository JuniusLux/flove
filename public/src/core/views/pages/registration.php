<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Italiana&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="/css/reset.css">
  <link rel="stylesheet" href="/css/style.css">

  <script src="https://unpkg.com/imask "></script>
  <title>Document</title>
</head>

<body>
  <? require_once __DIR__ . '/components/header.php' ?>

  <main style="background: linear-gradient(0deg, #4E6060 0%, rgba(78, 96, 96, 0.1) 100%);
">
    <style>

.login-form {
        display: flex;
        flex-direction: column;
        gap: 45px;
        align-items: center;
        color: #000000;
        font-size: 24px;
      }
      .login .button {
        font-family: "Inter";
        background: linear-gradient(180deg, #D16E82 0%, #E4ABAA 100%);
        padding: 5px 20px;
        height: 30px;
        border-radius: 10px;
        box-sizing: border-box;
        width: 340px;
        color: #fff;
        text-decoration: none !important;
        display: flex;
        justify-content: center;
        align-items: center;
        border: none;
        font-size: 28px;
        font-weight: 200;
        padding: 8px 20px;
        height: fit-content;
        border-radius: 18px;
        box-shadow: 4px 4px 14px #D16E82;
      }


      .login-form h2 {
        background: radial-gradient(ellipse at center,
            rgba(78, 96, 96, 0.6) 0%,
            rgba(78, 96, 96, 0) 70%);
        padding: 25px 120px;
        border-radius: 18px;
        font-size: 32px;
        color: #fff;
        font-weight: 350;
      }
      
      
    </style>


    <section class="login">
      <form action="/reg" method="post" class="login-form">
        <h2>Регистрация</h2>
        <div class="input">
          <input type="text" required name="name" placeholder="Имя">
          <img src="svg/smile.svg" alt="">
        </div>
        <div class="input">
          <input type="text" required name="phone" id="phone" placeholder="+7(000)000-00-00" pattern="+7(***)***-**-**">
          <img src="svg/phone.svg" alt="">
        </div>
        <div class="input">
          <input type="password" minlength="8" autocomplete="current-password" pattern="^(?=.*[A-Z]).{6,}$" title="Пароль должен содержать минимум 6 символов английского алфавита и хотя бы одну заглавную букву" required name="password" placeholder="Пароль">
          <img src="svg/lock.svg" alt="">
        </div>
        <div class="input">
          <input type="password" required name="password_ver" placeholder="Повторите пароль">
          <img src="svg/lock.svg" alt="">
        </div>
        <?php if (isset($_GET['message'])): ?>
          <h1 class="message" >
            <?= $_GET['message'] ?>
          </h1>
        <?php endif; ?>
        <button type="submit" class="button">Зарегестрироваться</button>
      </form>
      <p>Уже есть аккаунт?</p>
      <a href="/login" class="button">Войти</a>
    </section>
  </main>

  <? require_once __DIR__ . '/components/footer.php' ?>
</body>

<script>
  const phoneInput = document.getElementById('phone');
  const mask = new IMask(phoneInput, {
    mask: '+7 (000) 000-00-00'
  });
</script>

</html>