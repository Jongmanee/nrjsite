<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Path[]|\Cake\Collection\CollectionInterface $paths
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Path'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="paths index large-9 medium-8 columns content">
    <h3><?= __('Paths') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('starting_site_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ending_site_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('max_capacity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paths as $path): ?>
            <tr>
                <td><?= $this->Number->format($path->id) ?></td>
                <td><?= h($path->name) ?></td>
                <td><?= $this->Number->format($path->starting_site_id) ?></td>
                <td><?= $this->Number->format($path->ending_site_id) ?></td>
                <td><?= $this->Number->format($path->max_capacity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $path->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $path->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $path->id], ['confirm' => __('Are you sure you want to delete # {0}?', $path->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
