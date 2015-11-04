<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Users', 'action' => 'index']) ?> </li>  
        <li><?= $this->Html->link(__('Edit Order'), ['action' => 'edit', h($emp_order_id)]) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Form->postLink(__('Complete Order'), ['action' => 'complete', h($emp_order_id)], 
                                      ['confirm' => __('Are you sure you want to complete # {0}?', h($emp_order_id))]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order'), ['action' => 'delete', h($emp_order_id)], 
                                      ['confirm' => __('Are you sure you want to delete # {0}?', h($emp_order_id))]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
