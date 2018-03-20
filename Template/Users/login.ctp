<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Navigation') ?></li>
        <li><?= $this->Html->link(__('Se connecter'), ['action' => 'login']) ?></li>
        <li><?= $this->Html->link(__("S'enregistrer"), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
<?php
	echo $this->Form->create();
	echo $this->Form->control('login',['label'=>"Nom d'utilisateur"]);
	echo $this->Form->control('passwd',['label'=>"Mot de passe"]);
	echo $this->Form->submit('Connexion',array('name'=>'connect'));
	echo $this->Form->end();
?>

<?= $this->Html->link(__("S'enregistrer"), ['action' => 'add']) ?>

</div>
