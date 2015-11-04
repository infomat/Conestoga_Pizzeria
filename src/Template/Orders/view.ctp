<?php
    if ($this->request->session()->read('Auth.User.role') == 'employee'){
    echo $this->element('sb_order_emp_order_id', [
                                    "emp_order_id" => h($order->order_id)]);
    } else {
        echo $this->element('sb_cust');
    }
?>
        
<div class="orders view large-10 medium-9 columns content">
    <h3>Orders ID: <?= h($order->order_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= $order->has('user') ? $this->Html->link($order->user->name, ['controller' => 'Users', 'action' => 'view', $order->user->user_id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= $order->has('user') ? $order->user->email : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Phone') ?></th>
            <td><?= $order->has('user') ? $order->user->phonenumber : ''?></td>
        </tr>

        <tr>
            <th><?= __('Size') ?></th>
            <td><?= h($order->size) ?></td>
        </tr>
        <tr>
            <th><?= __('Cruststyle') ?></th>
            <td><?= h($order->crustname) ?></td>
        </tr>
        <tr>
            <th><?= __('Toppings') ?></th>
            <td><?=  $topping_name_ar==null ? 'None' : h(implode($topping_name_ar,',')) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($order->quantity) ?></td>
        </tr>
        <tr>
            <th><?= __('Subtotal') ?></th>
            <td><?= $this->Number->format($order->subtotal) ?></td>
        </tr>
        <tr>
            <th><?= __('Tax') ?></th>
            <td><?= $this->Number->format($order->tax) ?></td>
        </tr>
        <tr>
            <th><?= __('Total') ?></th>
            <td><?= $this->Number->format($order->total) ?></td>
        </tr>
        <tr>
            <th><?= __('Orderdate') ?></th>
            <td><?= h($order->orderdate) ?></tr>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($order->modified) ?></tr>
        </tr>
        <tr>
            <th><?= __('Iscompleted') ?></th>
            <td><?= $order->iscompleted ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
