<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
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
                <td><?= h(substr_count($order->toppings, ",")+1) ?></td>
                <td><?= $this->Number->format($order->quantity) ?></td>
                <td><?= $this->Time->format($order->orderdate) ?></td>
                <td><?= $this->Time->format($order->modified) ?></td>
                <td><?= $order->iscompleted ? __('Yes') : __('No'); ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $order->order_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->order_id]) ?>
                    <?= $this->Form->postLink(__('Complete'), ['action' => 'complete', $order->order_id], ['confirm' => __('Are you sure you want to complete # {0}?', $order->order_id)]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $order->order_id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->order_id)]) ?>
                </td>
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
