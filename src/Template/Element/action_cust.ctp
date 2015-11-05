<td class="actions">
<?= $this->Html->link(__('View'), ['action' => 'view', h($cust_order_id)]) ?>
<?=$this->Html->link(__('Edit'), ['action' => 'edit', h($cust_order_id)]);?>
<?=$this->Form->postLink(__('Delete'), ['action' => 'delete', h($cust_order_id)], ['confirm' => __('Are you sure you want to delete # {0}?', h($cust_order_id))]); ?>
</td>