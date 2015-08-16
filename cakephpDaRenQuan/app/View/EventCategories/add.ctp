<div class="eventCategories form">
<?php echo $this->Form->create('EventCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Event Category'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Event Categories'), array('action' => 'index')); ?></li>
	</ul>
</div>
