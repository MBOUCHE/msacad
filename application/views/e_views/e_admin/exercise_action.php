<?php



if($info->modification_status == '1')
                {
                echo '<a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/delete_exercise/'.$info->id_exercise.'" class="btn btn-default form-group" onclick="return confirm(\'Are you really want to delete -'.$info->ex_label.'- Exercise?\') && confirm(\'This will delete all exercises associated...!!?\'); " ><i class="fa fa-remove fa-1x w3-text-red"></i> Delete this exercise</a>';
                echo '<a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/modify/'.$info->id_exercise.'" class="btn btn-default form-group" ><i class="fa fa-edit fa-1x w3-text-orange"></i> Modify</a>';
                }elseif ($info->modification_status == '-1') {

    $data = $this->db->get_where('e_build' , array('id_ex'=>$info->id_exercise) );
    $time_used = count($data->result());
    $first_used = $data->first_row()->id_test;
                  
                  echo '<div class="alert alert-warning"><b>Modifications of this exercise are disabled</b><br>This is cause the exercise have been used (<b>'.$time_used.'</b>)time(s), first in a test named <b>'.
                  $this->db->get_where('e_test' , array('id_test'=>$first_used) )->row()->label_test
                  .'</b> the <b>'.
                  $this->db->get_where('e_composition' , array( 'id_test'=>$first_used) )->row()->programming_date
                  .'</b></div>';
                }
                echo '<a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/copy_exercise/'.$info->id_exercise.'" class="btn btn-default form-group" ><i class="fa fa-copy fa-1x w3-text-green"></i> Copy</a>';
                echo '<a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/overview/'.$info->id_exercise.'" class="btn btn-default form-group" ><i class="fa fa-dashboard fa-1x w3-text-green"></i> Overview &raquo</a>';
                if ($info->status == 0 ) {
                  echo '<a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/activate/'.$info->id_exercise.'/1" class="btn form-group" ><i class="fa fa-eye fa-1x w3-text-green"></i> Click to activate </a>';
                }else{
                  echo '<a href="'.base_url().'index.php/e_controllers/e_admin/exercise_manager/activate/'.$info->id_exercise.'/0" class="btn form-group" ><i class="fa fa-eye fa-1x w3-text-green"></i> Click to desactivate </a>';
                }


 ?>