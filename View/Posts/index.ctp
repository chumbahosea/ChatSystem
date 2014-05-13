<h1>Chat System</h1>
<?php echo $this->Html->link(
'Add Post',
array('controller' => 'posts', 'action' => 'add')
); 
echo "<br>";
echo $this->Html->link( "Logout",   array('controller'=> 'users','action'=>'logout') ); 
?>


<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Edit</th>
		<th>The Created Date</th>
		<th>The Last Modified Date </th>
	</tr>
	<!-- Here is where we loop through our $posts array, printing out post info -->
	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($post['Post']['title'],
array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
		</td>
		<td> <?php if($post['Post']['user_id'] == $user_id) echo $this->Form->postLink( 'Delete',
						array('action' => 'delete', $post['Post']['id']),
						array('confirm' => 'Are you sure?')
			);?>
			<?php if($post['Post']['user_id'] == $user_id) echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']));?> 
		</td>
		<td><?php echo $post['Post']['created']; ?></td>
		<td><?php echo $post['Post']['modified']; ?> </td>
	</tr>
	<?php endforeach; ?>
	<?php unset($post); ?>
</table>