
        <form class="form" action="authorization.php" method="post" autocomplete="off">
            <h2 class="content__main-heading">Вход на сайт</h2>

            <div class="form__row">
            <label class="form__label" for="email">E-mail <sup>*</sup></label>

            <input class="form__input form__input--error" type="text" name="email" id="email" value="<?=  getPostVal('email') ?>" placeholder="Введите e-mail">

                <p class="form__message"><?= $errors['email'] ?? ""?></p>
          </div>

          <div class="form__row">
            <label class="form__label" for="password">Пароль <sup>*</sup></label>

            <input class="form__input" type="password" name="password" id="password" value="<?=  getPostVal('password') ?>" placeholder="Введите пароль">
              <p class="form__message"><?= $errors['password'] ?? ""?></p>
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Войти">
          </div>
        </form>
