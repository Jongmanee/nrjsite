<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Path[]|\Cake\Collection\CollectionInterface $paths
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Navigation') ?></li>
        <li><?= $this->Html->link(__('Accueil'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des sites'), ['controller' => 'Sites', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Liste des voies'), ['controller' => 'Paths', 'action' => 'index']) ?></li>
        <li><?= $this->Form->postLink(__('Se déconnecter'), ['controller' => 'Users', 'action' => 'deco', ]) ?></li>
    </ul>
</nav>
<div class="paths index large-9 medium-8 columns content">
    <h3><?= __('Liste des voies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Nom de la voie') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Site producteur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Site consommateur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Débit maximal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Dernier relevé producteur') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Dernier relevé consommateur') ?></th>
            </tr>
        </thead>
            
            <?php foreach ($paths as $path): ?>
        <tr>
                <td><?= h($path->name) ?></td>
                <?php foreach ($sites as $site): ?>
                    <?php if ($path->starting_site_id == $site->id) { ?>
                        <td><?= $this->Html->link(__(h($site->name)), ['controller' => 'Sites','action' => 'view', $site->id]) ?></td> 
                    <?php }endforeach;?>
               <?php foreach ($sites as $site): 
                    if ($path->ending_site_id == $site->id) { ?>
                        <td><?= $this->Html->link(__(h($site->name)), ['controller' => 'Sites','action' => 'view', $site->id]) ?></td> 
                    <?php }endforeach;?>
                <td><?= $this->Number->format($path->max_capacity) ?></td>
                <?php
                    $date='1900-01-01 20:20:20';
                    foreach ($sites as $site):
                        if ($site->id==$path->starting_site_id) {
                            foreach ($records as $record):
                                if ($record->site_id==$site->id) {
                                    if ($date<$record->date)
                                    {
                                        $date=$record->date;
                                    }
                                }
                            endforeach;
                        }
                    endforeach;
                    ?> <td><?=$date;?></td>
                <?php
                    $date='1900-01-01 20:20:20';
                    foreach ($sites as $site):
                        if ($site->id==$path->ending_site_id) {
                            foreach ($records as $record):
                                if ($record->site_id==$site->id) {
                                    if ($date<$record->date)
                                    {
                                        $date=$record->date;
                                    }
                                }
                            endforeach;
                        }
                    endforeach;
                    ?> <td><?=$date;?></td>
                
        </tr>
            <?php endforeach; ?>
        
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('première page')) ?>
            <?= $this->Paginator->prev('< ' . __('page précédente')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('page suivante') . ' >') ?>
            <?= $this->Paginator->last(__('dernière page') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} sur {{pages}}, affiche {{current}} voie(s) sur un total de {{count}}')]) ?></p>
    </div>
    
</div>
