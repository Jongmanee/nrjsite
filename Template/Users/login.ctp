
<?php
	echo $this->Form->create();
	echo $this->Form->control('login',['label'=>"Nom d'utilisateur"]);
	echo $this->Form->control('passwd',['label'=>"Mot de passe"]);
	echo $this->Form->submit('Connexion',array('name'=>'connect'));
	echo $this->Form->end();
?>

<?= $this->Html->link(__("S'enregistrer"), ['action' => 'add']) ?>