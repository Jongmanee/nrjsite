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
    <h3><?= __('Bienvenue sur le site ECE NRJ') ?></h3>
    <div>
        <h5><center>Liste des sites</center></h5>
        <center><?php
     echo $this->Html->link(
          $this->Html->image('site.png', array('alt' => "Site",'id'=>'image1')), // Recherche dans le dossier webroot/img
          array('controller' => 'Sites', 'action' => "index"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as une image
     );?></center>

    </div>
        
    <div>
        <h5><center>Liste des voies d'acheminement<center></h5>
        <center><?php echo $this->Html->link(
          $this->Html->image('voie.png', array('alt' => "Voie",'id'=>'image2')), // Recherche dans le dossier webroot/img
          array('controller' => 'Paths', 'action' => "index"),
          array('escape' => false) // Ceci pour indiquer de ne pas échapper les caractères HTML du lien vu qu'ici tu as une image
     );?> </center>
    </div>
    
    
</div>  
