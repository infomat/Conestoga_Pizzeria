<?php
if ($this->request->session()->read('Auth.User.role') == 'employee'){
    echo $this->element('sb_user_emp_user_id', [
                                        "emp_user_id" => h($user->user_id)]);
} else {
    echo $this->element('sb_cust');
}
?>
<div class="users form large-10 medium-9 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            if ($this->request->session()->read('Auth.User.role') == 'employee'){
                echo $this->Form->input('role',[
                    'options' => ['employee' => 'Admin', 'customer' => 'Customer']]);
            }
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
