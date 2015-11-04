<?php
    if ($this->request->session()->read('Auth.User.role') == 'employee'){
        echo $this->element('sb_order_emp_no_id');
    } else {
        echo $this->element('sb_cust');
    }
?>
<div class="orders index large-10 medium-9 columns content">
    <h3><?= __('Orders') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('order_id') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= 'Size' ?></th>
                <th><?= 'Cruststyle' ?></th>
                <th><?= '# Of Toppings' ?></th>
                <th><?= 'Quantity' ?></th>
                <th><?= $this->Paginator->sort('orderdate') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('iscompleted') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $this->Html->link($this->Number->format($order->order_id),['action' => 'view', $order->order_id]) ?></td>
                <td><?= $order->has('user') ? $this->Html->link($order->user->email, ['controller' => 'Users', 'action' => 'view', $order->user->user_id]) : 'Anonymous' ?></td>
                <td><?= h($order->size) ?></td>
                <td><?= h($order->crustname) ?></td>
                <td><?= h($order->toppings)==0 ? 0 : (substr_count($order->toppings, ",")+1) ?></td>
                <td><?= $this->Number->format($order->quantity) ?></td>
                <td><?= $this->Time->format($order->orderdate) ?></td>
                <td><?= $this->Time->format($order->modified) ?></td>
                <td><?= $order->iscompleted ? __('Yes') : __('No'); ?></td>
                <?php
                    if ($this->request->session()->read('Auth.User.role') == 'employee'){
                         echo $this->element('action_emp',["emp_order_id" => $order->order_id]);
                    } else {
                         echo $this->element('action_cust',[
                                        "cust_order_id" => $order->order_id]);
                    }
                ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
