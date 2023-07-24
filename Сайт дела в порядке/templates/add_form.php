<section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>

                <nav class="main-navigation">
                    <ul class="main-navigation__list"> <?php foreach ($projects as $value): ?>
                        <li class="main-navigation__list-item">
                            <a class="main-navigation__list-item-link <?php if ((int)$projects_id === $value['projects_id']):?> main-navigation__list-item--active 
                            <?php endif;?>"href="?projects_id=<?= $value['projects_id']?>"> <?= htmlspecialchars($value['name_projects']);?></a>
                            <span class="main-navigation__list-item-count"><?=($value['value_tasks']);?></span>
                        </li>
                    <?php endforeach;?>
                    </ul>
                </nav>

                <a class="button button--transparent button--plus content__side-button" href="form-project.html">Добавить проект</a>
            </section>

            <main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="index.html" method="post" autocomplete="off">
          <div class="form__row">

            <?php $classname = isset($errors['name']) ? "form__input--error" : ""; ?>
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <input class="form__input <? $classname; ?>" type="text" name="name" id="name" value="<?= getPostVal('name'); ?> " placeholder="Введите название">
            <p class="form__message"><?= $errors['name'] ?? ""; ?></p>
          </div>

          <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select <? $classname; ?>" name="project" id="project" value="<? getPostVal('projects'); ?>">
              <option value="">Выберите категорию</option>
              <?php foreach ($projects as $value): ?>
                <option value=<?= $value['projects_id'] ?> <?php if ((int)$projects_id === $value['projects_id'] || (int)getPostVal('projects') === $value['projects_id']) : ?> selected<?php endif;?>><?=$value['name_projects'];?> </option>
              <?php endforeach; ?>
            </select>
            <p class="form__message"><?= $errors['projects'] ?? ""; ?></p>
          </div>

          <div class="form__row">
          <?php $classname = isset($errors['end_time']) ? "form__input--error" : ""; ?>
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date <?= $classname; ?>" type="text" name="date" id="date" value="<?= getPostVal('end_time'); ?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <p class="form__message"><? $errors['end_time'] ?? ""; ?></p>
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