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

  <main style="background: linear-gradient(0deg, #4E6060 0%, rgba(78, 96, 96, 0.1) 100%) ;">

    <style>
      .login {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 60px;
        padding: 50px;
      }

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
      <form action="/auth" method="post" class="login-form">
        <h2>Вход в аккаунт</h2>
        <div class="input">
          <input type="text" required id="phone" name="phone" placeholder="Номер телефона" pattern="+7(***)***-**-**">
          <img src="svg/phone.svg" alt="">
        </div>
        <div class="input" >
          <input type="password" id="password" required name="password" placeholder="Пароль">
          <button class="toggle-password" id="togglePassword" type="button">👁️</button>
          <img src="svg/lock.svg" alt="">
        </div>
        <?php if (isset($_GET['message'])): ?>
          <h1 class="message" color="black">
            <?= $_GET['message'] ?>
          </h1>
        <?php endif; ?>
        <button type="submit" class="button">Войти</button>
      </form>
      <p>Нет аккаунта?</p>
      <a href="/registration" class="button">Зарегестрироваться</a>
    </section>
  </main>

  <? require_once __DIR__ . '/components/footer.php' ?>
</body>
    <script src="/js/toggle.js"></script>

<script>
  const phoneInput = document.getElementById('phone');
  const mask = new IMask(phoneInput, {
    mask: '+7 (000) 000-00-00'
  });
</script>

</html>