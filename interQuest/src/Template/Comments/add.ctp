<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Npcs'), ['controller' => 'Npcs', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Npc'), ['controller' => 'Npcs', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Parks'), ['controller' => 'Parks', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Park'), ['controller' => 'Parks', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Sectors'), ['controller' => 'Sectors', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Sector'), ['controller' => 'Sectors', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Territories'), ['controller' => 'Territories', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Territory'), ['controller' => 'Territories', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Npcs'), ['controller' => 'Npcs', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Npc'), ['controller' => 'Npcs', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Parks'), ['controller' => 'Parks', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Park'), ['controller' => 'Parks', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Sectors'), ['controller' => 'Sectors', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Sector'), ['controller' => 'Sectors', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Territories'), ['controller' => 'Territories', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Territory'), ['controller' => 'Territories', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($comment); ?>
<fieldset>
    <legend><?= __('Add {0}', ['Comment']) ?></legend>
    <?php
    echo $this->Form->input('npc_id', ['options' => $npcs]);
    echo $this->Form->input('park_id', ['options' => $parks]);
    echo $this->Form->input('persona_id');
    echo $this->Form->input('sector_id', ['options' => $sectors]);
    echo $this->Form->input('territory_id', ['options' => $territories]);
    echo $this->Form->input('author_persona_id', ['options' => $personas]);
    echo $this->Form->input('subject');
    echo $this->Form->input('message');
    echo $this->Form->input('show_mapkeepers');
    echo $this->Form->input('deleted');
    ?>
</fieldset>
<?= $this->Form->button(__("Add")); ?>
<?= $this->Form->end() ?>
