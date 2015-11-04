<?php
    if ($this->request->session()->read('Auth.User.role') == 'employee'){
        echo $this->element('sb_order_emp_order_id', [
                                        "emp_order_id" => h($order->order_id)]);
    } else {
        echo $this->element('sb_cust');
    }
?>
<div class="orders form large-10 medium-9 columns content">
    <?= $this->Form->create($order,['id' => 'orderform']) ?>
    <fieldset>
        <legend><?= __('Edit Order') ?></legend>
        <h3>Orders ID: <?= h($order->order_id) ?></h3>
        <?php
            $dough_size_option = array_combine(array_keys($doughsize), array_keys($doughsize));
            $crustname_option = array_combine(array_keys($crustname), array_keys($crustname));
    
            $selected=array();
            $selected = explode(',',$order->toppings);
   
            echo '<h5>Emai ID: '.$order->user->email.'</h5>';
            echo $this->Form->input('size',['options' => $dough_size_option]);
            echo $this->Form->input('crustname',['options' => $crustname_option]);
            
            echo "<p>Toppings:</p>";
            echo "VEGGIE";
            echo $this->Form->select('veggie',$veggie,['multiple' => 'checkbox','default' =>$selected]);
            echo "MEAT";
            echo $this->Form->select('meat',$meat,['multiple' => 'checkbox','default' =>$selected]);
            echo "CHEESE";
            echo $this->Form->select('cheese',$cheese,['multiple' => 'checkbox','default' =>$selected]);
            
            echo $this->Form->input('quantity', ['min'=>1, 'max'=>10]);
            echo $this->Form->input('subtotal',['readonly' => 'readonly']);
            echo $this->Form->input('tax',['readonly' => 'readonly']);
            echo $this->Form->input('total',['readonly' => 'readonly']);
            echo $this->Form->input('iscompleted');
    
            echo '<p id="tax_rate">Tax Rate is '.($taxrate*100).'%  <p>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['id' => 'submit']) ?>
    <?= $this->Form->end() ?>
</div>
