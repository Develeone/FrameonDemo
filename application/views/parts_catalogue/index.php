<div>
    <ul class="grid cs-style-3">

        <h1 class="uk-heading-large uk-text-center" style="padding-top: 65px;">Запчасти для спецтехники</h1>

        <?php
            foreach ($categories as $category) {
        ?>
            <li>
                <figure>
                    <a href="/parts/<?= $category->name_lat ?>"><img src="/assets/images/parts/<?= $category->name_lat ?>.jpg" alt="Продажа запчасти <?= $category->name ?>"></a>
                    <figcaption>
                        <h3><?= $category->name ?></h3>
                        <span><?= $category->description ?></span>
                    </figcaption>
                </figure>
            </li>
        <?php
            }
        ?>

    </ul>
</div>