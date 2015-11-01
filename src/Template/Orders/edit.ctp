<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $order->order_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $order->order_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orders form large-9 medium-8 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Edit Order') ?></legend>
        <?php
            $veggie_names = array();
            foreach($veggie as $veggie_item):
                $veggie_names[$veggie_item->topping_id] = $veggie_item->name;
            endforeach;
            
            $meat_names = array();
            foreach($meat as $meat_item):
                $meat_names[$meat_item->topping_id] = $meat_item->name;
            endforeach;
            
            $cheese_names = array();
            foreach($cheese as $cheese_item):
                $cheese_names[$cheese_item->topping_id] = $cheese_item->name;
            endforeach;
            $selected=array();
            $selected = explode(',',$order->toppings);
   
            echo $order->user->email;
            echo $this->Form->input('size',['options' => $doughsize]);
            echo $this->Form->input('crustname',['options' => $crustname]);
            
            echo "<p>Toppings:</p>";
            echo "Veggie";
            echo $this->Form->select('veggie',$veggie_names,['multiple' => 'checkbox','default' =>$selected]);
            echo "Meat";
            echo $this->Form->select('meat',$meat_names,['multiple' => 'checkbox','default' =>$selected]);
            echo "Cheese";
            echo $this->Form->select('cheese',$cheese_names,['multiple' => 'checkbox','default' =>$selected]);
            
            echo $this->Form->input('quantity', ['min'=>1, 'max'=>10]);
            echo $this->Form->input('subtotal');
            echo $this->Form->input('tax');
            echo $this->Form->input('total');
            echo $this->Form->input('iscompleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
