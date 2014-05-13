<h1><?php echo h($threads['Thread']['content']); ?></h1>

<?php echo $this->Html->link(
'Add Message',
array('controller' => 'messages', 'action' => 'add', $threads['Thread']['id'])
); 
echo "<br>";
echo $this->Html->link( "Logout",   array('controller'=> 'users','action'=>'logout') ); 
?>

<div id = "view">
<table>
	<tr>
		<th>Id</th>
		<th>Message</th>
		<th>Sent by </th>
		<th>Edit</th>
		<th>The Created Date</th>
		<th>The Last Modified Date </th>
		
	</tr>
	<!-- Here is where we loop through our $posts array, printing out post info -->
	<?php foreach ($messages as $message): ?>
	<tr>
		<td><?php echo $message['Message']['id']; ?></td>
		<td>
			<?php echo $message['Message']['content'] ?>
		</td>
		<td><?php echo $message['User']['username']; ?> </td>
		<td> <?php if($message['Message']['user_id'] == $user_id)  echo $this->Form->postLink( 'Delete',
						array('controller'=>'messages', 'action' => 'delete', $message['Message']['id']),
						array('confirm' => 'Are you sure?')
			);?>
			<?php if($message['Message']['user_id'] == $user_id) echo $this->Html->link('Edit', array('controller'=>'messages','action' => 'edit', $message['Message']['id']));?> 
		</td>
		<td><?php echo $message['Message']['created']; ?></td>
		<td><?php echo $message['Message']['modified']; ?> </td>
		
	</tr>
	<?php endforeach; ?>
	<?php unset($message); ?>
</table>
</div>

<?php
echo $this->Form->create('Message');
echo $this->Form->input('content', array('label' => 'Your message'));
echo $this->Form->end('Save Message');
//echo $ajax->submit('Submit',array('url'=>'/thread'))
?>