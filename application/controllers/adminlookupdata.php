<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Adminlookupdata extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin','',TRUE);
		$this->load->model('securitys','',TRUE);
		$this->load->model('alertreminder','',TRUE);
	}

	function index($offset=0)
	{
   		// Load Form
		$this->load->helper(array('form','url'));

		// Load Pagination
		$this->load->library('pagination');

		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];

			$roleid=$session_data['roleid'];
			$roleperms=$this->securitys->show_permission_object_data($roleid,"11");
			foreach ($roleperms as $roleperm):
				$viewperm=$roleperm->view_opt;
				$addperm=$roleperm->add_opt;
				$editperm=$roleperm->edit_opt;
				$delperm=$roleperm->del_opt;
			endforeach;
			if($viewperm==0)
				redirect('/home','refresh');

			if($this->uri->uri_string()=="adminlookupdata" && $_SERVER['QUERY_STRING']=="")
			{
				$this->session->unset_userdata('selectrecord');
				$this->session->unset_userdata('searchrecord');
			}
			if($this->session->userdata('message'))
			{
				$messagehrecord=$this->session->userdata('message');
				$message=$messagehrecord['message'];
				$type=$messagehrecord['type'];
				$this->session->unset_userdata('message');
			}
			else
			{
				$message='';
				$type = '';
			}
			if($this->session->userdata('searchrecord'))
			{
				$searchrecord=$this->session->userdata('searchrecord');
				$search=$searchrecord['searchrecord'];
			}
			else
			{
				$search='';
			}

			// Config setup for Pagination
			$config['base_url'] = base_url().'index.php/adminlookupdata/index';
			$config['total_rows'] = $this->admin->totallookupdata($search);
			if($this->session->userdata('selectrecord'))
			{
				$selectrecord=$this->session->userdata('selectrecord');
				$config['per_page'] = $selectrecord['selectrecord'];
			}
			else
			{
				$config['per_page'] = 10;
			}
			$config['uri_segment'] = 3;
			$config["num_links"] = 1;

			// Initialize
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


			//Load all record data
			$data['records'] = $this->admin->show_lookupdata($search,$offset,$config['per_page']);
			$data['totalrows'] = $config['total_rows'];
			$data['mpage'] = $config['per_page'];
			$data['page']= $page+1;
			$data['selectrecord']=$config['per_page'];
			$data['searchrecord']=$search;
			$data['cpagename']='adminlookupdata';
			$data['labels']=$this->securitys->get_label(11);
			$data['labelgroup']=$this->securitys->get_label_group(11);
			$data['labelobject']=$this->securitys->get_label_object(11);
			$data['addperm']=$addperm;
			$data['editperm']=$editperm;
			$data['delperm']=$delperm;
			$data['message']=$message;
			$data1['username'] = $session_data['username'];
			$data1['alerts']=$this->alertreminder->show_alert($session_data['id']);
			/*$data1['alertcount']=$this->alertreminder->count_alert($session_data['id']);*/
            $data1['alertcount']=count($data1['alerts']);
			$data1['reminders']=$this->alertreminder->show_reminder($session_data['id']);
			$data1['remindercount']=$this->alertreminder->count_reminder($session_data['id']);
			$data1['alabels']=$this->securitys->get_label(22);
			$data1['alabelobject']=$this->securitys->get_label_object(22);
			$data1['rlabels']=$this->securitys->get_label(23);
			$data1['rlabelobject']=$this->securitys->get_label_object(23);
			
			$data['message_type']=$type;


			$this->load->view('header', $data1);
			$this->load->view('admin_lookupdata', $data);
			$this->load->view('footer');
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function add()
	{
		$label=$this->securitys->get_label_object_name(33);
		$label1=$this->securitys->get_label_object_name(34);
		$label2=$this->securitys->get_label_object_name(35);
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('code', $label, 'trim|required|alpha_numeric_spaces_special|xss_clean');
		$this->form_validation->set_rules('code', $label, 'trim|required|xss_clean');
		$this->form_validation->set_rules('data', $label1, 'trim|required|xss_clean');
		$this->form_validation->set_rules('value', $label2, 'trim|required|xss_clean|numeric');

		if($this->form_validation->run() == FALSE)
		{
			echo json_encode(array('st'=>0, 'msg' => form_error('code'),'msg1'=>form_error('data'),'msg2'=>form_error('value')));
		}
		else
		{
			$code=$this->input->post('code');
			$data=$this->input->post('data');
			if($this->admin->add_check_lookupdata($code,$data)==0)
			{
				//query the database
				$result = $this->admin->add_lookupdata($code,$data,$this->input->post('value'));
				$sess_array = array('message' => $this->securitys->get_label_object(11)." Added Successfully","type" => 1);
				$this->session->set_userdata('message', $sess_array);
				echo json_encode(array('st'=>1, 'msg' => 'Success','msg1'=>'','msg2'=>''));
			}
			else
			{
				echo json_encode(array('st'=>0, 'msg' => $this->securitys->get_label_object(11)." already exists",'msg1'=>'','msg2'=>''));
			}
		}
	}

	function update()
	{
		$label=$this->securitys->get_label_object_name(33);
		$label1=$this->securitys->get_label_object_name(34);
		$label2=$this->securitys->get_label_object_name(35);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('code1', $label, 'trim|required|alpha_numeric_spaces_special|xss_clean');
		$this->form_validation->set_rules('data1', $label1, 'trim|required|alpha_numeric_spaces_special|xss_clean');
		$this->form_validation->set_rules('value1', $label2, 'trim|required|xss_clean|numeric');

		if($this->form_validation->run() == FALSE)
		{
			echo json_encode(array('st'=>0, 'msg' => form_error('code1'),'msg1'=>form_error('data1'),'msg2'=>form_error('value1')));
		}
		else
		{
			$id=$this->input->post('datasetid');
			$id1=$this->input->post('datadetailid');
			$code=$this->input->post('code1');
			$data= $this->input->post('data1');
			$value = $this->input->post('value1');

			if($this->admin->update_check_lookupdata($id,$id1,$code)==0)
			{
				if($this->admin->update_check_lookupdata1($id1,$code,$data)==0)
				{
					//query the database
					$result = $this->admin->update_lookupdata($id,$id1,$code,$data,$value);
					$sess_array = array('message' => $this->securitys->get_label_object(11)." Updated Successfully","type" => 1);
					$this->session->set_userdata('message', $sess_array);
					echo json_encode(array('st'=>1, 'msg' => 'Success','msg1'=>'','msg2'=>''));
				}
				else
				{
					echo json_encode(array('st'=>0, 'msg' => $this->securitys->get_label_object(11)." already exists",'msg1'=>'','msg2'=>''));
				}
			}
			else
			{
				echo json_encode(array('st'=>0, 'msg' => "Cannot Modify the ".$this->securitys->get_label_object(10).", Assigned to ".$this->securitys->get_label_object(9),'msg1'=>'','msg2'=>''));
			}
		}
	}

	function delete()
	{
		$id=$this->input->post('id');
		$id1=$this->input->post('id1');
		if($this->admin->delete_check_lookupdata($id,$id1)==0)
		{
			//query the database
			$result = $this->admin->delete_lookupdata($id,$id1);
			$sess_array = array('message' => "Lookup Data Deleted Successfully","type" => 1);
			$this->session->set_userdata('message', $sess_array);
			echo json_encode(array('st'=>1, 'msg' => 'Success'));
		}
		else
		{
			$sess_array = array('message' => "Cannot delete Lookup Data, Assigned to Data Attributes","type" => 0);
			$this->session->set_userdata('message', $sess_array);
		}
	}

	function selectrecord()
	{
		$sess_array = array(
	         'selectrecord' => $this->input->post('recordselect')
	       );
	    $this->session->set_userdata('selectrecord', $sess_array);
		echo json_encode(array('st'=>1, 'msg' => 'Success'));
	}

	function select()
	{
		$this->index();
	}

	function searchrecord()
	{
		$sess_array = array(
	         'searchrecord' => $this->input->post('search')
	       );
	    $this->session->set_userdata('searchrecord', $sess_array);
		echo json_encode(array('st'=>1, 'msg' => 'Success'));
	}

	function search()
	{
		$this->index();
	}
}
?>