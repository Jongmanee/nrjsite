<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Path $path
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Path'), ['action' => 'edit', $path->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Path'), ['action' => 'delete', $path->id], ['confirm' => __('Are you sure you want to delete # {0}?', $path->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Paths'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Path'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="paths view large-9 medium-8 columns content">
    <h3><?= h($path->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($path->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($path->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Starting Site Id') ?></th>
            <td><?= $this->Number->format($path->starting_site_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ending Site Id') ?></th>
            <td><?= $this->Number->format($path->ending_site_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Max Capacity') ?></th>
            <td><?= $this->Number->format($path->max_capacity) ?></td>
        </tr>
    </table>
</div>
