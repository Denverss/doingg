
<main class="content__main">
        <h2 class="content__main-heading">Список задач</h2>

        <form class="search-form" action="index.php" method="post" autocomplete="off">
            <input class="search-form__input" type="text" name="search" value="" placeholder="Поиск по задачам">

            <input class="search-form__submit" type="submit" name="search" value="Искать">
        </form>

        <div class="tasks-controls">
            <nav class="tasks-switch">
                <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                <a href="/" class="tasks-switch__item">Повестка дня</a>
                <a href="/" class="tasks-switch__item">Завтра</a>
                <a href="/" class="tasks-switch__item">Просроченные</a>
            </nav>
            <label class="checkbox">

                <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if($show_complete_tasks == 1):?> checked   <?php endif; ?>>
                <span class="checkbox__text">Показывать выполненные</span>
            </label>
         </div>

        <table class="tasks">
        <?php if($tasks): ?>
            <?php foreach ($tasks as $task): ?>
                <?php if ($show_complete_tasks === 0 && $task["is_done"]=== 1): ?>
                     <?php continue; ?>
                 <?php else: ?>
                     <tr class="tasks__item task<?php if (getTime($task['date_end']) <= 24):?> task--important<?php endif;?>  <?= ($task["is_done"])=== 1 ? 'task--completed' : '';?>">
                            <td class="task__select">
                             <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                                <span class="checkbox__text"><?= $task["title"]?></span>
                            </label>
                         </td>
                        <td class="task__file">
                            <a class="download-link" href="#"><?=$task['file']?></a>
                        </td>

                        <td class="task__date"><?= $task["date_end"] ?></td>

                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Авторизуйтесь чтобы увидеть свой список задач</p>
        <?php endif; ?>
        </table>



    </main>

