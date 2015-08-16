<div class="eventCategories form">
<?php echo $this->Form->create('EventCategory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Event Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('createtime');
		echo $this->Form->input('ext1');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('EventCategory.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('EventCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Event Categories'), array('action' => 'index')); ?></li>
	</ul>
</div>
