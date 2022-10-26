


  <form class="form"  action="add-project.php" method="post" autocomplete="off"  enctype="multipart/form-data">
      <h2 class="content__main-heading">Добавление проекта</h2>
    <div class="form__row">
      <label class="form__label" for="project_name">Название <sup>*</sup></label>

        <input class="form__input <?= isset($errors['title']) ? 'form__input--error' : '' ?>" type="text" name="title" id="project_name" value="" placeholder="Введите название проекта">
        <p class="form__message"><?=$errors['title'] ?? "" ?></p>
      </div>

    <div class="form__row form__row--controls">
      <input class="button" type="submit" name="" value="Добавить">
    </div>
  </form>
