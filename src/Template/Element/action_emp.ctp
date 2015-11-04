<td class="actions">
    <?=$this->Html->link(__('View'), ['action' => 'view', $emp_order_id]);?>
    <?=$this->Html->link(__('Edit'), ['action' => 'edit', h($emp_order_id)]);?>
    <?=$this->Form->postLink(__('Complete'), ['action' => 'complete', h($emp_order_id)], ['confirm' => __('Are you sure you want to complete # {0}?', h($emp_order_id))]);?>
    <?=$this->Form->postLink(__('Delete'), ['action' => 'delete', h($emp_order_id)], ['confirm' => __('Are you sure you want to delete # {0}?', h($emp_order_id))]); ?>
</td>