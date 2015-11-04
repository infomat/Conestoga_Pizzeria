<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>  
        <li><?= $this->Html->link(__('List My Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('View My Information'), ['controller' => 'Users', 'action' => 'view',$this->request->session()->read('Auth.User.user_id')]) ?> </li>
        <li><?= $this->Html->link(__('Edit My Information'), ['controller' => 'Users', 'action' => 'edit',$this->request->session()->read('Auth.User.user_id')]) ?> </li>
    </ul>
</nav>