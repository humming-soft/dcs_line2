<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Journalauditlog extends CI_Controller
{
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('assessment','',TRUE);
   	   $this->load->model('securitys','',TRUE);
	   $this->load->model('ilyasmodel','',TRUE);
	   $this->load->model('alertreminder','',TRUE);
	}
     // if anything goes wrong copy the codes from journalauditlog_bk_agaile.php its the correct backup before i started modifing this codes
	function index()
	{
		$this->load->helper(array('form','url'));
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$roleid=$session_data['roleid'];
			$userid=$session_data['id'];
			$roleperms=$this->securitys->show_permission_object_data($roleid,"5");
			foreach ($roleperms as $roleperm):
				$viewperm=$roleperm->view_opt;
				$addperm=$roleperm->add_opt;
				$editperm=$roleperm->edit_opt;
				$delperm=$roleperm->del_opt;
			endforeach;
			if($viewperm==0)
				redirect('/home','refresh');

			    // Config setup for Pagination
			$config['base_url'] = base_url().'index.php/journalauditlog/index';

                // Modified by : Agaile for segregating the records based on role
            if($roleid == 1) { // means admin
                $data['records'] = $this->assessment->show_log_audit(); // this is taking progressive journal data only
            }
            else{
                $data['records'] = $this->assessment->show_log_id_audit($userid); // this is taking progressive journal data only
            }
			    // Audit for non progressive
			$data['cpagename']='journalauditlog';
			$data['labels']=$this->securitys->get_label(5);
			$data['labelgroup']=$this->securitys->get_label_group(5);
			$data['labelobject']=$this->securitys->get_label_object(5);
			$data['addperm']=$addperm;
			$data['editperm']=$editperm;
			$data['delperm']=$delperm;

			    //Load data entry owner for each journal
			$data['audlog'] = array ();
			foreach ( $data['records'] as $aulog )
			{

				$dataulog="";
				$data['aulog1'] = $this->assessment->show_log_id($aulog->data_entry_no);

				foreach ( $data['aulog1'] as $auditlog )
				{
					$pname="";
					$cname="";
					$data['cname2'] = $this->assessment->show_uname($auditlog->cur_user_id);
					
					foreach ($data['cname2'] as $cname1 )
					{
						$cname=$cname1->user_full_name;
					}
					if($auditlog->prv_user_id!="") {
						$data['pname2'] = $this->assessment->show_uname($auditlog->prv_user_id);
						
						foreach ($data['pname2'] as $pname1 )
						{
							$pname=$pname1->user_full_name;
						}
					}
					$curdate=date("d-m-Y", strtotime($auditlog->cur_date));
					if($auditlog->prv_date!="") {
						$prvdate=date("d-m-Y", strtotime($auditlog->prv_date));
					} else {
						$prvdate="";
					}
					$dataulog.=$auditlog->data_attb_label.",".$auditlog->cur_value.",".$cname.",".$curdate.",".$auditlog->prv_value.",".$pname.",".$prvdate.",777,";
				}
				$data['audlog'][$aulog->data_entry_no]=$dataulog;
			}

			$is_nonp_available = false;
			$nonp_records = [];
                if($roleid == 1) {
				$nonp_records = $this->ilyasmodel->get_audit_newz();
                    $is_nonp_available = true;
                }
                else{
                    $nonp_records = $this->ilyasmodel->get_audit_id_audit($userid);
                    $is_nonp_available = true;
                }

			if ($is_nonp_available) {
				foreach($nonp_records as $k=>$v):
					$nonp_records[$k]->publish_date = '-';
					$nonp_records[$k]->data_entry_no = '-';
					$nonp_records[$k]->validate_level_no = '1';
					$nonp_records[$k]->frequency_detail_name = '-';
				endforeach;
				$data['records'] = array_merge($data['records'], $nonp_records);
			}

			$data1['username'] = $session_data['username'];
			$data1['alerts']=$this->alertreminder->show_alert($session_data['id']);
            $data1['alertcount']=count($data1['alerts']);
			$data1['reminders']=$this->alertreminder->show_reminder($session_data['id']);
			$data1['remindercount']=$this->alertreminder->count_reminder($session_data['id']);
			$data1['alabels']=$this->securitys->get_label(22);
			$data1['alabelobject']=$this->securitys->get_label_object(22);
			$data1['rlabels']=$this->securitys->get_label(23);
			$data1['rlabelobject']=$this->securitys->get_label_object(23);
			$data1['alabels']=$this->securitys->get_label(22);
			$data1['alabelobject']=$this->securitys->get_label_object(22);
			$data1['rlabels']=$this->securitys->get_label(23);
			$data1['rlabelobject']=$this->securitys->get_label_object(23);
			
			$data['search'] = "";
			if ($this->input->get('search')) {
				$data['search'] = $this->input->get('search');
			}


			$this->load->view('header', $data1);
			$this->load->view('assess_journalauditlog', $data);
			$this->load->view('footer');
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
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