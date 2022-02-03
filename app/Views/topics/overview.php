<h2><?= esc($title) ?></h2>

<?php if (! empty($topics) && is_array($topics)): ?>
    <?php foreach ($topics as $topics_item): ?>

        <h3><?= esc($topics_item['title']) ?></h3>

        <div class="main">
            <?= esc($topics_item['body']) ?>
    </div>
    <p><a href="/topics/<?= esc($topics_item['slug'], 'url') ?>">View article</a></p>

    <?php endforeach ?>

<?php else: ?>
    <h3>No Topics</h3>
    <p> Unabale to find any topics for you.</p>
<?php endif ?>