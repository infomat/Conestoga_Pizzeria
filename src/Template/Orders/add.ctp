<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('size');
            echo $this->Form->input('cruststyle');
            echo $this->Form->input('quantity');
            echo $this->Form->input('subtotal');
            echo $this->Form->input('tax');
            echo $this->Form->input('total');
            echo $this->Form->input('orderdate');
            echo $this->Form->input('iscompleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
