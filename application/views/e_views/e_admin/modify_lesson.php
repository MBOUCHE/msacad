<div class="content-wrapper py-3">

  <div class="container-fluid">


        <?php
        echo heading('Choose a lesson on which you want to modify...',3);
        echo br();

        $this->table->set_heading('LABEL','ACTION');
        $template = array(
        'table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table">'
        );
        $this->table->set_template($template);


        foreach ($lesson->result() as $info) {

          $data = array(
                  'value' => $info->id
          );

          $this->table->add_row(
            $info->label,
            '<a href="'.base_url().'e_controllers/e_admin/modify_lesson/details/'.$data['value'].'" class="btn btn-success" >Modify or Add Chapters</a>  '
          );

        }

        echo $this->table->generate();
        ?>


    </div>

     
</div>

