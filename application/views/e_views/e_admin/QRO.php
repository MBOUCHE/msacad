<?php
if ( isset($_POST['question']) && isset($_POST['answer']) ) {
  $default = array(
            'question'=>$_POST['question'],
            'answer'=>$_POST['answer']
          );
}else{
  $default = array(
            'question'=>'',
            'answer'=>''
          );
}
?>

<label for="question">Question</label>
    <input id="question" type="text" class="form-control" size="50" name="question" value=<?=$default['question']?>> 
    <?php echo form_error('question','<div class="form-control alert-warning">', '</div>'); ?>

  <label for="answer">Answer</label>
    <input id="answer" type="text" class="form-control" name="answer" value=<?=$default['answer']?>>
    <?php echo form_error('answer','<div class="form-control alert-warning">', '</div>'); ?>

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
