<section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">
                    <ul class="main-navigation__list"> <?php foreach ($projects as $value): ?> 
                        <li class="main-navigation__list-item">
                        <a class="main-navigation__list-item-link <?php if ($projects_id == $value['projects_id']):?> main-navigation__list-item--active <?php endif;?>" href="?projects_id=<?= $value['projects_id']?>"> <?= htmlspecialchars($value['name_projects']);?></a>
                            <span class="main-navigation__list-item-count"><?=$value['value_tasks']?></span>
                        </li>
                    <?php endforeach;?>
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button"
                   href="pages/form-project.html" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="post" autocomplete="off">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                        <a href="/" class="tasks-switch__item">Повестка дня</a>
                        <a href="/" class="tasks-switch__item">Завтра</a>
                        <a href="/" class="tasks-switch__item">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                       
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox"
                         <?php if ($show_complete_tasks === 1): ?>checked<?php endif; ?>>
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

               <table class="tasks">
                 <?php foreach ($tasks as $key => $value): ?>
                    <?php if (($show_complete_tasks === 1) || ($value['status_tasks'] === 0)): ?>
                    <tr class="tasks__item task <?php if ($value['status_tasks']): ?> task--completed<?php endif; ?> <?php if ((number_of_hour($value['end_time']) <= 24) && ($value['status_tasks'] === 0)):?> task--important <?php endif;?>"> 
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden" type="checkbox"<?php if ($value['status_tasks']): ?>checked<?php endif;?> value="1">
                                <span class="checkbox__text"><?=htmlspecialchars($value['name_tasks']); ?> <td class="task__date"><?= number_of_hour($value['end_time'])?></td></span>
                            </label>
                        </td>
                        <td class="task__date"><?= htmlspecialchars($value['end_time'])?></td>
                        <td class="task__controls"><?=htmlspecialchars($value['name_projects']); ?></td>
                        <td class="task__file"><a href="/uploads/<?= $value['random_file'] ?>"><?=$value['random_file'] ?> </a></td>
                    </tr>
                    <?php endif; ?>
                 <?php endforeach; ?>
                </table>
            </main>



            