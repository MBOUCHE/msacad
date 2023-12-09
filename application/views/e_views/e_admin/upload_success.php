<div class="content-wrapper py-3">

  <div class="container-fluid">


<h3>Your file was successfully uploaded!</h3>
<div >
<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p class="hidden btn alert-primary"><?php echo anchor('e_controllers/e_admin/generate/list_learner', 'Return !!!'); ?></p>

</div>


  </div>
</div>