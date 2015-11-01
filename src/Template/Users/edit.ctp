<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->user_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-10 medium-9 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('role',[
                'options' => ['employee' => 'Admin', 'customer' => 'Customer']]);
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('name');
            echo $this->Form->input('address');
            echo $this->Form->input('province');
            echo $this->Form->input('city');
            echo $this->Form->input('postalcode');
            echo $this->Form->input('phonenumber');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>
