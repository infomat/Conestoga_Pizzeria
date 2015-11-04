<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Sign Up'), ['action' => 'signup']) ?></li>
    </ul>
</nav>
<!-- File: src/Template/Users/login.ctp -->
<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
<fieldset>
<legend><?= __('Please enter your email ID and password') ?></legend>
<?= $this->Form->input('email') ?>
<?= $this->Form->input('password') ?>
</fieldset>
    <?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>