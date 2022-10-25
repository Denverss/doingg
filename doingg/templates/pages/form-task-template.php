<main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="add.php" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="form__row">
            <label class="form__label " for="name">Название <sup>*</sup></label>
            <input class="form__input <?= isset($errors['title']) ? 'form__input--error' : '' ?>" type="text" id="name" value="" placeholder="Введите название" name="title">
              <p class="form__message"><?=$errors['title'] ?? "" ?></p>
          </div>

          <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select <?= isset($errors['project']) ? 'form__input--error' : '' ?>" name="project" id="project">
                <?php foreach ($projects as $project): ?>
                    <option value="<?=$project['id']?>"><?=$project['title']?></option>
                <?php endforeach; ?>
            </select>
            <p class="form__message"><?=$errors['project'] ?? "" ?></p>
          </div>

          <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date <?= isset($errors['due_date']) ? 'form__input--error' : '' ?>" type="text" id="date" value="" placeholder="Введите дату в формате ГГГГ-ММ-ДД" name="due_date">
              <p class="form__message"><?=$errors['due_date'] ?? "" ?></p>
          </div>

          <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
              <input class="visually-hidden" type="file" name="file" id="file" value="">

              <label class="button button--transparent" for="file">
                <span>Выберите файл</span>
              </label>
            </div>
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
</main>
