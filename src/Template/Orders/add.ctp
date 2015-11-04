<?php
    if ($this->request->session()->read('Auth.User.role') == 'employee'){
        echo $this->element('sb_order_emp_no_id');
    } else {
        echo $this->element('sb_cust');
    }
?>
<div class="orders form large-10 medium-9 columns content">
    <?= $this->Form->create($order) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
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
            echo '<h5>Emai ID: '.$user->email.'</h5>';
            echo $this->Form->input('size', ['options' => $doughsize]);
            echo $this->Form->input('crustname', ['options' => $crustname, 'default' => 'Pan']);
            echo "<p>Toppings:</p>";
            echo "Veggie";
            echo $this->Form->select('veggie',$veggie_names,['multiple' => 'checkbox']);
            echo "Meat";
            echo $this->Form->select('meat',$meat_names,['multiple' => 'checkbox']);
            echo "Cheese";
            echo $this->Form->select('cheese',$cheese_names,['multiple' => 'checkbox']);
            
            echo $this->Form->input('quantity', ['min'=>1, 'max'=>10]);
            echo $this->Form->input('subtotal');
            echo $this->Form->input('tax');
            echo $this->Form->input('total');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
