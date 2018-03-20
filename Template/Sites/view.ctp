<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Site $site
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
<div class="sites view large-9 medium-8 columns content">
    <h3><?= h($site->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nom du site') ?></th>
            <td><?= h($site->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type du site') ?></th>
            <?php if ($site->type=='producer') {?>
            <td><?= 'Producteur';?></td>
            <?php
            }
                else {
                    if ($site->type=='consumer') {?>
            <td><?= 'Consommateur';?></td>
                        <?php
                    }
                }
            ?>
        </tr>
        <tr>
            <th scope="row"><?= __('Location X') ?></th>
            <td><?= $this->Number->format($site->location_x) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location Y') ?></th>
            <td><?= $this->Number->format($site->location_y) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock') ?></th>
            <td><?= $this->Number->format($site->stock) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre de relevés') ?></th>
            <?php
                $nbreleve=0;
                foreach ($records as $record):
                    if ($record->site_id==$site->id) {
                        $nbreleve=$nbreleve+1;
                    }
                endforeach;
            ?>
            <td><?=$nbreleve;?></td>
        </tr>
        <tr>
            <th scope="row">
                <?php if($site->type=='consumer') {?>
                    <?= __('Consommation totale') ?>
                    <?php } else {
                        if ($site->type=='producer') {?>
                            <?= __('Production totale') ?>
                        <?php }
                    }?>
            </th>
            <?php
                $total=0;
                foreach ($records as $record):
                    if ($record->site_id==$site->id) {
                        $total=$total+$record->value;
                    }
                endforeach;
            ?>
            <td><?=$total;?></td>
        </tr>
        <tr>
            <th scope="row">
                <?php if($site->type=='consumer') {?>
                    <?= __('Consommation moyenne') ?>
                    <?php } else {
                        if ($site->type=='producer') {?>
                            <?= __('Production moyenne') ?>
                        <?php }
                    }?>
            </th>
            <?php
               $bdd = new PDO('mysql:host=localhost;dbname=ece_nrj;charset=utf8', 'root', ''); 
               $reponse = $bdd->query('SELECT AVG(value) AS relmoy FROM Records WHERE site_id="'.$site->id.'"');
               while ($donnees = $reponse->fetch()) {?>
            <td><?=$donnees['relmoy'];?></td>
                <?php   }
            ?>
        </tr>
        <tr>
            <th scope="row">
                <?php if($site->type=='consumer') {?>
                    <?= __('Consommation minimale') ?>
                    <?php } else {
                        if ($site->type=='producer') {?>
                            <?= __('Production minimale') ?>
                        <?php }
                    }?>
            </th>
            <?php
               $reponse = $bdd->query('SELECT MIN(value) AS relmin FROM Records WHERE site_id="'.$site->id.'"');
               while ($donnees = $reponse->fetch()) {?>
            <td><?=$donnees['relmin'];?></td>
                <?php   }
            ?>
        </tr>
        <tr>
            <th scope="row">
                <?php if($site->type=='consumer') {?>
                    <?= __('Consommation maximale') ?>
                    <?php } else {
                        if ($site->type=='producer') {?>
                            <?= __('Production maximale') ?>
                        <?php }
                    }?>
            </th>
            <?php
               $reponse = $bdd->query('SELECT MAX(value) AS relmax FROM Records WHERE site_id="'.$site->id.'"');
               while ($donnees = $reponse->fetch()) {?>
            <td><?=$donnees['relmax'];?></td>
                <?php   }
            ?>
        </tr>
        <tr>
            <th scope="row">Capacité totale d'approvisionnement</th>
            <?php
               $reponse = $bdd->query('SELECT SUM(max_capacity) AS debsum FROM Paths WHERE (starting_site_id="'.$site->id.'" OR ending_site_id="'.$site->id.'")');
               while ($donnees = $reponse->fetch()) {?>
            <td><?=$donnees['debsum'];?></td>
                <?php   }
            ?>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Liste des relévés du site') ?></h4>
        <?php if (!empty($site->records)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Valeur') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($site->records as $record): ?>
            <tr>
                <td><?= h($record->date) ?></td>
                <td><?= h($record->value) ?></td>
                <td class="actions">
                    <?= $this->Form->postLink(__('Supprimer le relevé'), ['controller' => 'Records', 'action' => 'delete', $record->id], ['confirm' => __('Etes-vous sûr de vouloir supprimer le relevé du {0} ?', $record->date)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">>
        <h4><?= __('Liste des voies associées') ?></h4>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Nom de la voie') ?></th>
            </tr>
            <?php foreach ($paths as $path): ?>
            <tr>
                <?php if ((h($site->id) == $path->starting_site_id) || (h($site->id) == $path -> ending_site_id)) { ?>
                <td><?= $path->name; ?></td>
            </tr>
                <?php } endforeach; ?>
        </table>
    </div>
    <div>
     <?= $this->Form->create($records) ?>
        <fieldset>  
            <legend><?= __('Ajouter un relevé') ?></legend>
        <?php
            echo $this->Form->control('site_id',['type'=>'hidden','default'=>h($site->id)]);
            echo $this->Form->control('date',['label'=>'Date']);
            echo $this->Form->control('value',['label'=>'Valeur du relevé']);
            ?>
        </fieldset>
    <?= $this->Form->submit('Ajouter', array('name'=>'ajoutreleve'))?>
    <?= $this->Form->end() ?>
    </div>
    <div>
        <?= $this->Form->create($site) ?>
        <fieldset>
            <legend><?= __('Mettre à jour le Site') ?><a href='#' onclick="hideForm()"> Montrer/Cacher</a></legend>
            <ul id='masque'>
             <li><?= $this->Form->input('type', array(
                'type' => 'radio',
                'options' => array(
                    'consumer' => 'Consommateur',
                    'producer' => 'Producteur'
                )
                 ));?></li>
             <li><?= $this->Form->control('location_x');?></li>
             <li><?=$this->Form->control('location_y');?></li>
            <li><?= $this->Form->control('stock');?></li>
        
        </fieldset>
    <?= $this->Form->submit('Modifier', array('name'=>'modifsite'))?>
    <?= $this->Form->end() ?>
    </div>
    <div>
        <?= $this->Form->create($paths) ?>
        <fieldset>
            <legend><?= __('Ajouter une voie au site') ?></legend>
            <?= $this->Form->control('name', ['value'=>'','label'=>'Nom de la voie']);?>
            <?php
                $tableau=array();
                if ($site->type=='producer') {
                    echo $this->Form->control('starting_site_id',['type'=>'hidden','default'=>$site->id]);
                    foreach ($sites as $site0):
                        if ($site0->type=='consumer') {
                            $tableau[] = array($site0->id => $site0->name);
                        }
                    endforeach;
                    echo $this->Form->select(
                            'ending_site_id',
                            $tableau,
                            [
                                'empty'=> 'Choisir un consommateur à relier'
                            ]
                            );
                }
                else {
                    if ($site->type=='consumer') {
                        foreach ($sites as $site0):
                            if ($site0->type=='producer') {
                                $tableau[] = array($site0->id => $site0->name);
                            }
                        endforeach;
                        echo $this->Form->select(
                            'starting_site_id',
                            $tableau,
                            [
                                'empty'=> 'Choisir un producteur à relier'
                            ]
                            );
                        echo $this->Form->control('ending_site_id',['type'=>'hidden','default'=>$site->id]);
                    }
                }
                ?>
            <?= $this->Form->control('max_capacity',['value'=>'','label'=>'Débit maximal']);?>


        </fieldset>
    <?= $this->Form->submit('Ajouter', array('name'=>'ajoutvoie'))?>
    <?= $this->Form->end() ?>
    </div>
</div>
