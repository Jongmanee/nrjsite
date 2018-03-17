<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Path $path
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $path->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $path->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Paths'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="paths form large-9 medium-8 columns content">
    <?= $this->Form->create($path) ?>
    <fieldset>
        <legend><?= __('Edit Path') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('starting_site_id');
            echo $this->Form->control('ending_site_id');
            echo $this->Form->control('max_capacity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
