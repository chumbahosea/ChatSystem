
<div class="header">
<?php
if($this->Session->read('Auth')) {
   // user is logged in, show logout..user menu etc
   echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout')); 
} else {
   // the user is not logged in
   echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login')); 
}
?>
</div>