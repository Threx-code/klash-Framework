<?php 
namespace App\views;
use App\Core\Form\Form;
?>
<h1>Register View</h1>
 
 <?php $form =  Form::begin("", "post"); ?>

	<?php echo $form->field($model, 'firstname'); ?>
	<?php echo $form->field($model, 'lastname'); ?>
	<?php echo $form->field($model, 'email'); ?>
	<?php echo $form->field($model, 'password')->passwordField(); ?>
	<?php echo $form->field($model, 'password_confirm')->passwordField(); ?>
 	<button type="submit" class="btn btn-primary">Submit</button>

 <?php  Form::end(); ?>