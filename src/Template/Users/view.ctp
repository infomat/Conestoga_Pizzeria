<?php
if ($this->request->session()->read('Auth.User.role') == 'employee'){
    echo $this->element('sb_user_emp_user_id', [
                                        "emp_user_id" => h($user->user_id)]);
} else {
    echo $this->element('sb_cust');
}
?>

<div class="users view large-10 medium-9 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('UserID') ?></th>
            <td><?=  h($user->user_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th><?= __('Province') ?></th>
            <td><?= h($user->province) ?></td>
        </tr>
        <tr>
            <th><?= __('City') ?></th>
            <td><?= h($user->city) ?></td>
        </tr>
        <tr>
            <th><?= __('Postalcode') ?></th>
            <td><?= h($user->postalcode) ?></td>
        </tr>
        <tr>
            <th><?= __('Phonenumber') ?></th>
            <td><?= h($user->phonenumber) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($user->created) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></tr>
        </tr>
    </table>
</div>
