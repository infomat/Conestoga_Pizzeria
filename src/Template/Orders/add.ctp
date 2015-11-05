<?php
    if ($this->request->session()->read('Auth.User.role') == 'employee'){
        echo $this->element('sb_order_emp_no_id');
    } else {
        echo $this->element('sb_cust');
    }
?>

<div class="orders form large-10 medium-9 columns content">

    <?= $this->Form->create($order,['id' => 'orderform']) ?>
    <fieldset>
        <legend><?= __('Add Order') ?></legend>
        <?php
            echo '<h5>Emai ID: '.$user->email.'</h5>';
            echo $this->Form->input('size', ['options' =>$doughsize_w_price]);
            echo $this->Form->input('crustname', ['options' => $crustname_w_price]);
            echo "<label class='topping'>Toppings:</label>";
            echo "<p id='topping_p'>First topping ia free, but additional toppings are $0.50 each.</p>";
            echo "<label class='topping'>VEGGIE</label>";
            echo $this->Form->select('veggie',$veggie,['multiple' => 'checkbox']);
            echo "<label class='topping'>MEAT</label>";
            echo $this->Form->select('meat',$meat,['multiple' => 'checkbox']);
            echo "<label class='topping'>CHEESE</label>";
            echo $this->Form->select('cheese',$cheese,['multiple' => 'checkbox']);
        
            echo $this->Form->input('quantity', ['min'=>1, 'default'=>1]);
            echo $this->Form->input('subtotal',['readonly' => 'readonly']);
            echo $this->Form->input('tax',['readonly' => 'readonly']);
            echo $this->Form->input('total',['readonly' => 'readonly']);
    
            echo '<p id="tax_rate">Tax Rate is '.($taxrate*100).'%  <p>';
        ?>

    </fieldset>
    <?= $this->Form->button(__('Submit'), ['id' => 'submit']) ?>
    <?= $this->Form->end() ?>
</div>
