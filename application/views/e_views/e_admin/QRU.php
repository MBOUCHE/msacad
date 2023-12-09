<?php
if (isset($_POST['question']) && isset($_POST['answer']) && isset($_POST['prop1']) && isset($_POST['prop2']) && isset($_POST['prop3']) ) {
  $default = array(
            'question'=>$_POST['question'],
            'answer'=>$_POST['answer'],
            'prop1'=>$_POST['prop1'],
            'prop2'=>$_POST['prop2'],
            'prop3'=>$_POST['prop3']
          );
}else{
  $default = array(
            'question'=>'',
            'answer'=>'',
            'prop1'=>'',
            'prop2'=>'',
            'prop3'=>''
          );
}
?>
<label for="question">Question</label>
    <input id="question" type="text" class="form-control" size="50" name="question" value=<?=$default['question']?>> 
    <?php echo form_error('question','<div class="form-control alert-warning">', '</div>'); ?>

  <label for="answer">Reponse</label>
    <input id="answer" type="text" class="form-control" name="answer" value=<?=$default['answer']?>>
    <?php echo form_error('answer','<div class="form-control alert-warning">', '</div>'); ?>

  <label for="prop1">Proposition fausse 1</label>
    <input id="prop1" type="text" class="form-control" name="prop1" value=<?=$default['prop1']?>>
    <?php echo form_error('prop1','<div class="form-control alert-warning">', '</div>'); ?>

  <label for="prop2">Proposition fausse 2</label>
    <input id="prop2" type="text" class="form-control" name="prop2" value=<?=$default['prop2']?>>
    <?php echo form_error('prop2','<div class="form-control alert-warning">', '</div>'); ?>

  <label for="prop3">Proposition fausse 3</label>
    <input id="prop3" type="text" class="form-control" name="prop3" value=<?=$default['prop3']?>>
    <?php echo form_error('prop3','<div class="form-control alert-warning">', '</div>'); ?>

  <div class="row">
    <div class="col-sm-5">
      <label>Points + :</label>
      <select class="form-control" name="point">
        <option name="point" value=1>+1</option>
        <option name="point" value=2>+2</option>
        <option name="point" value=3>+3</option>
        <option name="point" value=4>+4</option>
        <option name="point" value=5>+5</option>
      </select>
    </div>
    
  </div>
