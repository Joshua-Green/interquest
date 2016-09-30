<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $vocation->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $vocation->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Vocations'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Npcs'), ['controller' => 'Npcs', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Npc'), ['controller' => 'Npcs', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?=
    $this->Form->postLink(
        __('Delete'),
        ['action' => 'delete', $vocation->id],
        ['confirm' => __('Are you sure you want to delete # {0}?', $vocation->id)]
    )
    ?>
    </li>
    <li><?= $this->Html->link(__('List Vocations'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Npcs'), ['controller' => 'Npcs', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Npc'), ['controller' => 'Npcs', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Personas'), ['controller' => 'Personas', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Persona'), ['controller' => 'Personas', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>
<?= $this->Form->create($vocation); ?>
<fieldset>
    <legend><?= __('Edit {0}', ['Vocation']) ?></legend>
    <?php
    echo $this->Form->input('name');
    echo $this->Form->input('ability');
    echo $this->Form->input('ability_description');
    ?>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>
