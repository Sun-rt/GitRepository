<div class="groups form">
<?php echo $xx;echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('createdate');
		echo $this->Form->input('portraiturl');
		echo $this->Form->input('info');
		echo $this->Form->input('type');
		echo $this->Form->input('intype');
		echo $this->Form->input('ext1');
		echo $this->Form->input('ext2');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Group.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Group.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?></li>
	</ul>
</div>
