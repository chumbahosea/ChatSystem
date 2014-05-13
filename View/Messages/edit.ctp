<h1>Edit your message</h1>
<?php
echo $this->Form->create('Message');
echo $this->Form->input('content');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('user_id', array('type' => 'hidden'));
echo $this->Form->input('thread_id', array('type' => 'hidden'));
echo $this->Form->end('Save Message');
?>