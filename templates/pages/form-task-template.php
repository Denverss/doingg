<main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="add.php" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <input class="form__input" type="text" id="name" value="" placeholder="Введите название" name="title">
              <span class="text-danger"><?=$errors['title'] ?? "" ?></span>
          </div>

          <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select" name="project" id="project">
                <?php foreach ($projects as $project): ?>
                    <option value="<?=$project['id']?>"><?=$project['title']?></option>
                <?php endforeach; ?>
            </select>
              <span class="text-danger"><?=$errors['project_id'] ?? "" ?></span>
          </div>

          <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date" type="text" id="date" value="" placeholder="Введите дату в формате ГГГГ-ММ-ДД" name="due_date">
              <span class="text-danger"><?=$errors['due_date'] ?? "" ?></span>
          </div>

          <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
              <input class="visually-hidden" type="file" name="file" id="file" value="">

              <label class="button button--transparent" for="file">
                <span>Выберите файл</span>
              </label>
                <span class="text-danger"><?=$errors['file'] ?? "" ?></span>
            </div>
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
</main>
