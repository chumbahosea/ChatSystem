<legend>Chat System ver 1.1</legend>
<?php echo $this->Html->link(
'Sign up',
array('controller' => 'users', 'action' => 'signup')
); ?>

<?php
//echo $this->Form->create('User');
//echo $this->Form->input('username',array('rows' => '1'));
//echo $this->Form->input('password', array('rows' => '1'));
//echo $this->Form->end('Login');
?>

<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>
			<?php echo __('Please enter your username and password'); ?>
		</legend>
		<?php echo $this->Form->input('username');
		echo $this->Form->input('password');
		?>
	</fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>