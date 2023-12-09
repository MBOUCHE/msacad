<?php

class Send extends CI_Controller {

      public function index()
      {
        $this->load->model('Courses');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('message', 'message');
        $message=htmlspecialchars($this->input->post('message'));
        $wave=$this->input->post('id_wav');
        $user=session_data('id');
        $now=moment()->format(NO_TZ_MYSQL);
        $data=array('id_wav'=>$wave,'id_user'=>$user,'message'=>$message,'time_send'=>$now);
        $this->db->insert('e_communication',$data);
        $this->load->view('trainner/headerAdmin');
        $listes['liste'] =$this->Courses->wave();
        $this->load->view('trainner/menu',$listes);
        $list['lists'] =$this->Courses->name();
        $list['listes'] =$this->Courses->nombre();
        $list['list']=$this->Courses->stud($_GET['name']);
        $list['lister']=$this->Courses->lesson($_GET['name']);
        $list['message']=$this->Courses->sms($_GET['name']);
        $this->load->view('trainner/virtual',$list);
        $this->load->view('trainner/footerAdmin');
      }

      public function ajax()
      {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('message', 'message');
        $message=htmlentities($this->input->post('message'));
        $wave=$this->input->post('id_wav');
        $user=session_data('id');
        $now=moment()->format(NO_TZ_MYSQL);
        $data=array('id_wav'=>$wave,'id_user'=>$user,'message'=>$message,'time_send'=>$now);
        $this->db->insert('e_communication', $data);

        $data=[];
        $data['message'] = $message;
        $data['time_send'] = $now;

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'UTF-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES))
            ->_display();
          exit;
      }
}
