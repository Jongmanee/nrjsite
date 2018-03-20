<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Site[]|\Cake\Collection\CollectionInterface $sites
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Navigation') ?></li>
        <li><?= $this->Html->link(__('Accueil'), ['controller' => 'Pages', 'action' => 'accueil']) ?></li>
        <li><?= $this->Html->link(__('Liste des sites'), ['controller' => 'Sites', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des voies'), ['controller' => 'Paths', 'action' => 'index']) ?></li>
        <li><?= $this->Form->postLink(__('Se déconnecter'), ['controller' => 'Users', 'action' => 'deco', ]) ?></li>
    </ul>
</nav>
<div class="sites index large-9 medium-8 columns content">
    <h3><?= __('Liste des sites') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('nom du site') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_x') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_y') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sites as $site): ?>
            <tr>
                <td><?= h($site->name) ?></td>
                <td><?= $this->Number->format($site->location_x) ?></td>
                <td><?= $this->Number->format($site->location_y) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Détail'), ['action' => 'view', $site->id]) ?>
                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $site->id], ['confirm' => __('Etes-vous sûr de vouloir supprimer le site de {0} ?', $site->name)]) ?>
                    <?= $this->Html->link(__('Position'), ['action' => '', $site->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('première page')) ?>
            <?= $this->Paginator->prev('< ' . __('page précédente')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('page suivante') . ' >') ?>
            <?= $this->Paginator->last(__('dernière page') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} sur {{pages}}, affiche {{current}} sites(s) sur un total de {{count}}')]) ?></p>
    </div>
    <div class="ajout">
        <?= $this->Form->create($site) ?>
    <fieldset>
        <legend><?= __('Ajouter un site') ?></legend>
        <?php
            echo $this->Form->control('name', ['value'=>'','label'=>'Nom du site']);
            echo $this->Form->input('type', array(
                'type' => 'radio',
                'options' => array(
                    'consumer' => 'Consommateur',
                    'producer' => 'Producteur'
                )
            ));
            echo $this->Form->control('location_x',['value'=>'','label'=>'Location X']);
            echo $this->Form->control('location_y',['value'=>'','label'=>'Location Y']);
            echo $this->Form->control('stock',['value'=>'']);
            ?>
    </fieldset>
    <?= $this->Form->submit('Ajouter', array('name'=>'ajoutsite'))?>
    <?= $this->Form->end() ?>
    </div>
    
</div>  
