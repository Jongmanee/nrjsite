<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">


    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __("S'enregister") ?></legend>
        <?php
            echo $this->Form->control('login',['label'=>"Nom d'utilisateur"]);
            echo $this->Form->control('passwd',['label'=>'Mot de passe']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Confirmer')) ?>
    <?= $this->Form->end() ?>
</div>
