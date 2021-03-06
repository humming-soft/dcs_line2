<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Assessment extends CI_Model
{

	// Function to fetch total number of records
	function totalpjde($data,$userid)
    {
        $data=strtolower($data);
        $data=str_replace("'","''",$data);
		$query ="select a.project_name,b.journal_name,b.journal_no from project_template a, journal_master b where a.project_no=b.project_no";
		if($userid!="1")
		{
			$query .=" and journal_no in (select journal_no from journal_data_user where data_user_id=$userid)";
		}
		if($data!="")
		{
		$query .=" and ( lower(a.project_name) like '%".$data."%' ";
		$query .=" or lower(b.journal_name) like '%".$data."%' )";
		}
		$query = $this->db->query($query);
		return $query->num_rows();
	}

	// Function To Fetch All data entry owner Record
	function show_pjde($data,$offset,$perPage,$userid)
	{
		$data=strtolower($data);
		$data=str_replace("'","''",$data);
		$query ="select a.project_name,b.journal_name,b.journal_no from project_template a, journal_master b where a.project_no=b.project_no ";
		if($userid!="1")
		{
			$query .=" and journal_no in (select journal_no from journal_data_user where data_user_id=$userid and default_owner_opt=1)";
		}
		if($data!="")
		{
			$query .=" and( lower(a.project_name) like '%".$data."%' ";
			$query .=" or lower(b.journal_name) like '%".$data."%' )";

		}
		$query .=" Order By project_name asc,journal_name asc OFFSET ".$offset."LIMIT ".$perPage;
        $q = $this->db->query($query);
        return $q->result();
	}

	// Function To Fetch Selected data entry owner journal Record
	function show_pjde_id($data)
	{
		$query="select c.data_entry_status_id,d.frequency_detail_name,c.data_entry_no from journal_data_entry_master c, frequency_detail d where c.frequency_detail_no=d.frequency_detail_no and c.journal_no=".$data;
		$q = $this->db->query($query);
    	return $q->result();
	}

	function get_journal_data_entry_detail($id)
	{
		$query="select data_entry_no from journal_data_entry_detail where data_entry_no=$id";
		$q=$this->db->query($query);
		return $q->num_rows();
	}

	function add_journal_data_entry_detail($id,$loginid)
	{
		$query="select data_entry_no from journal_data_entry_detail where data_entry_no=$id";
		$q=$this->db->query($query);
		if($q->num_rows()==0)
		{
			$query="select journal_no from journal_data_entry_master where data_entry_no=$id";
			$res=$this->db->query($query);
			$rows=$res->result();
			foreach ($rows as $row):
				$journalno=$row->journal_no;
			endforeach;
			$query="select * from journal_detail where journal_no=$journalno";
			$res=$this->db->query($query);
			$rows=$res->result();
			foreach ($rows as $row):
				$query="insert into journal_data_entry_detail";
				$query .="(data_entry_no,data_attb_id,start_value,end_value,frequency_max_value,display_seq_no,data_source,created_user_id,created_date)";
				$query .=" values('$id','".$row->data_attb_id."','".$row->start_value."','".$row->end_value."','".$row->frequency_max_value."','".$row->display_seq_no."',1,'$loginid','".date("Y-m-d")."')";
				$this->db->query($query);
			endforeach;

			$query="select * from journal_validator where journal_no=$journalno";
			$res=$this->db->query($query);
			$rows=$res->result();
			foreach ($rows as $row):
				$query="insert into journal_data_validate_master";
				$query .="(data_entry_no,validate_user_id,validate_level_no,validate_status)";
				$query .=" values('$id','".$row->validate_user_id."','".$row->validate_level_no."',0)";
				$this->db->query($query);
			endforeach;

			$query="select frequency_detail_no from journal_data_entry_master where data_entry_no=$id";
			$q=$this->db->query($query);
			$rows=$q->result();
			foreach($rows as $row):
				$frequencyno=$row->frequency_detail_no;
				$frequencyno--;
			endforeach;
			$query="select data_attb_id,actual_value,data_entry_no from journal_data_entry_detail where data_entry_no=(select data_entry_no from journal_data_entry_master where frequency_detail_no=$frequencyno and journal_no=$journalno)";
			$q=$this->db->query($query);
			$rows=$q->result();
			foreach($rows as $row):
				if($row->actual_value!="")
				{
					$this->db->query("update journal_data_entry_detail set actual_value='".$row->actual_value."',prev_actual_value='".$row->actual_value."'  where data_entry_no=$id and data_attb_id=".$row->data_attb_id);
					$q1=$this->db->query("select cur_user_id,cur_date from journal_data_entry_audit_log where data_entry_no=".$row->data_entry_no." and data_attb_id=".$row->data_attb_id." order by audit_log_no desc limit 1");
					$rows1=$q1->result();
					foreach($rows1 as $row1):
						$prevuserid=$row1->cur_user_id;
						$prevdate=$row1->cur_date;
					endforeach;
					$query="insert into journal_data_entry_audit_log";
					$query .="(data_entry_no,data_attb_id,cur_user_id,cur_date,cur_value,prv_value,prv_user_id,prv_date)";
					$query .=" values('$id','".$row->data_attb_id."','$loginid','".date("Y-m-d")."','".$row->actual_value."','".$row->actual_value."',".$prevuserid.",'".$prevdate."')";
					$this->db->query($query);
				}
			endforeach;
		}
	}

	
	
	/** Added by ilyas **/
	function show_journalnonp($id)
	{
		$query="select jm.journal_no,frequency_period,journal_name,project_name,user_full_name,frequency_detail_name from journal_data_entry_master_nonprogressive jdem,journal_master_nonprogressive jm,project_template pt,sec_user su,frequency_detail fd where jm.journal_no=$id and jdem.journal_no=jm.journal_no and jm.project_no=pt.project_no and jm.user_id=su.user_id and fd.frequency_detail_no=jdem.frequency_detail_no";
		$q=$this->db->query($query);
		return $q->result();
	}
	/** End **/

	function show_lookup_details()
	{
		$query="select * from lookup_data_detail";
		$q=$this->db->query($query);
		return $q->result();
	}

	function show_journal_data_entry($id)
	{
		$query="select frequency_period,journal_name,project_name,user_full_name,frequency_detail_name from journal_data_entry_master jdem,journal_master jm,project_template pt,sec_user su,frequency_detail fd where jdem.data_entry_no=$id and jdem.journal_no=jm.journal_no and jm.project_no=pt.project_no and jm.user_id=su.user_id and fd.frequency_detail_no=jdem.frequency_detail_no";
		$q=$this->db->query($query);
		return $q->result();
	}

	


	function show_journal_validator($id)
	{
		$query="select user_full_name,validate_level_no from sec_user su,journal_data_validate_master jdvm where jdvm.data_entry_no=$id and jdvm.validate_user_id=su.user_id";
		$q=$this->db->query($query);
		return $q->result();
	}

	function show_journal_data_entry_detail($id)
	{
		//$query="select jded.*,da.data_attb_label,da.data_attb_type_id,da.data_set_id,da.data_attb_data_type_id,da.data_attb_digits,(select uom_name from unit_measure where unit_measure.uom_id=da.uom_id) as uom_name from  journal_data_entry_detail jded,data_attribute da where jded.data_attb_id=da.data_attb_id and jded.data_entry_no=$id order by display_seq_no asc";
		$query="select jded.*,da.data_attb_label,da.data_attb_type_id,da.data_set_id,da.data_attb_data_type_id,da.data_attb_digits,(select uom_name from unit_measure where unit_measure.uom_id=da.uom_id) as uom_name,(SELECT validate_comment FROM journal_data_validate_detail jdvd where jdvd.data_attb_id = jded.data_attb_id AND jdvd.data_entry_no = jded.data_entry_no) as comments,prev_actual_value,end_value from  journal_data_entry_detail jded,data_attribute da where jded.data_attb_id=da.data_attb_id and jded.data_entry_no=$id order by display_seq_no asc";
		$q=$this->db->query($query);
		return $q->result();
	}
	

	function add_journal_data_entry_audit_log($data)
	{
		$this->db->insert("journal_data_entry_audit_log",$data);
	}

	function update_journal_data_entry_detail($dataentryno,$attid,$value,$userid)
	{
		$this->db->query("update journal_data_entry_detail set actual_value='$value' where data_entry_no=$dataentryno and data_attb_id=$attid");

		$result=$this->db->query("select cur_value,cur_user_id,cur_date from journal_data_entry_audit_log where data_entry_no=$dataentryno and data_attb_id=$attid order by audit_log_no desc limit 1");
		if($result->num_rows()==0)
		{
			$data=array('data_entry_no'=>$dataentryno,'data_attb_id'=>$attid,'cur_value'=>$value,'cur_user_id'=>$userid,'cur_date'=>date('Y-m-d'));

			$this->add_journal_data_entry_audit_log($data);
		}
		else
		{
			$rows=$result->result();
			foreach ($rows as $row):
				$prevvalue=$row->cur_value;
				$prevuser=$row->cur_user_id;
				$prevdate=$row->cur_date;
			endforeach;
			if($value!=$prevvalue)
			{
				$data=array('data_entry_no'=>$dataentryno,'data_attb_id'=>$attid,'cur_value'=>$value,'cur_user_id'=>$userid,'cur_date'=>date('Y-m-d'),'prv_value'=>$prevvalue,'prv_user_id'=>$prevuser,'prv_date'=>$prevdate);

				$this->add_journal_data_entry_audit_log($data);
			}
		}
	}

	function update_varient_journal_data_entry_detail($dataentryno,$dataattb,$value)
	{
		$this->db->query("update journal_data_entry_detail set frequency_max_opt=$value where data_entry_no=$dataentryno and data_attb_id=$dataattb");
		return "update journal_data_entry_detail set frequency_max_opt=$value where data_entry_no=$dataentryno and data_attb_id=$dataattb";
	}

	function publish_journal_data_entry($id,$userid)
	{
		$this->db->query("update journal_data_entry_master set data_entry_status_id=2,publish_user_id=$userid,publish_date='".date("Y-m-d")."' where data_entry_no=$id");

		$query="select data_validate_no from journal_data_validate_master where data_entry_no=$id and validate_status in (0,3) order by validate_level_no asc limit 1";
		$q=$this->db->query($query);
		$rows=$q->result();
		$datavalid='';
		foreach($rows as $row):
			$datavalid=$row->data_validate_no;
		endforeach;
		if($datavalid!="")
			$this->db->query("update journal_data_validate_master set validate_status=1 where data_validate_no=$datavalid");
	}
	
	function publish_journal_data_entry_email($id,$userid)
	{
		$query="select data_validate_no from journal_data_validate_master where data_entry_no=$id and validate_status=1 order by validate_level_no desc limit 1";
		$q=$this->db->query($query);
		$rows=$q->result();
		$datavalid='';
		foreach($rows as $row):
			$datavalid=$row->data_validate_no;
		endforeach;
		$query="select (select journal_name from journal_master jm where jm.journal_no=jdem.journal_no) as journalname,(select user_full_name from sec_user su where su.user_id=jdem.publish_user_id) as dataentryname,(select email_id from sec_user su where su.user_id=jdem.publish_user_id) as dataentryemail,(select user_id from sec_user su where su.user_id=jdem.publish_user_id) as dataentryid,(select user_full_name from sec_user su,journal_data_validate_master jdvm where su.user_id=jdvm.validate_user_id and jdvm.data_validate_no=$datavalid ) as validatorname,(select email_id from sec_user su,journal_data_validate_master jdvm where su.user_id=jdvm.validate_user_id and jdvm.data_validate_no=$datavalid) as validatoremail,(select validate_user_id from journal_data_validate_master jdvm where jdvm.data_validate_no=$datavalid) as validatorid  from journal_data_entry_master jdem where jdem.data_entry_no=$id";
		$q=$this->db->query($query);
		return $q->result();
	}
	
	function add_user_alert($data)
	{
		$this->db->insert("user_alert",$data);
	}
	
	function add_journal_data_entry_picture($data)
	{
		$this->db->insert("journal_data_entry_picture",$data);
	}

	function update_journal_data_entry_picture($data,$id)
	{
		$this->db->where('data_entry_pict_no', $id);
		$this->db->update('journal_data_entry_picture', $data);
	}

	function add_seq_journal_data_entry_picture($id)
	{
		$query="select data_entry_pict_no from journal_data_entry_picture where data_entry_no=$id order by data_entry_pict_no asc";
		$result=$this->db->query($query);
		$rows=$result->result();
		$sno=1;
		foreach ($rows as $row):
			$this->db->query("update journal_data_entry_picture set pict_seq_no=$sno where data_entry_pict_no=".$row->data_entry_pict_no);
			$sno++;
		endforeach;
	}

	function show_journal_data_entry_picture($id)
	{
		$query="select * from journal_data_entry_picture where data_entry_no=$id";
		$q=$this->db->query($query);
		return $q->result();
	}


	function delete_journal_data_entry_picture($id)
	{
		$this->db->where('data_entry_pict_no', $id);
		$this->db->delete('journal_data_entry_picture');
	}

	function check_data_entry($id)
	{
		$query="select * from journal_data_entry_detail where actual_value is null and data_entry_no=$id";
		$result=$this->db->query($query);
		return $query->num_rows();
	}

	// Function to fetch total number of records
	function totalpjdenonp($data,$userid)
	{
		$data=strtolower($data);
		$data=str_replace("'","''",$data);
		$query ="select a.project_name,b.journal_name,b.journal_no from project_template a, journal_master_nonprogressive b where a.project_no=b.project_no";
		if($userid!="1")
		{
			$query .=" and journal_no in (select journal_no from journal_data_user_nonprogressive where data_user_id=$userid)";
		}
		if($data!="")
		{
		$query .=" and ( lower(a.project_name) like '%".$data."%' ";
		$query .=" or lower(b.journal_name) like '%".$data."%' )";
		}
		$query = $this->db->query($query);
		return $query->num_rows();
	}

	// Function To Fetch All data entry owner Record
	function show_pjdenonp($data,$offset,$perPage,$userid)
	{
		$data=strtolower($data);
		$data=str_replace("'","''",$data);
		$query ="select a.project_name,b.journal_name,b.journal_no from project_template a, journal_master_nonprogressive b where a.project_no=b.project_no ";
		if($userid!="1")
		{
			$query .=" and journal_no in (select journal_no from journal_data_user_nonprogressive where data_user_id=$userid and default_owner_opt=1)";
		}			
		

		if($data!="")
		{
			$query .=" and( lower(a.project_name) like '%".$data."%' ";
			$query .=" or lower(b.journal_name) like '%".$data."%' )";

		}
		$query .=" Order By project_name asc,journal_name asc OFFSET ".$offset."LIMIT ".$perPage;
		$q = $this->db->query($query);
		return $q->result();
	}

	// Function To Fetch Selected data entry owner journal Record
	function show_pjdenonp_id($data)
	{
		$query="select c.data_entry_status_id,d.frequency_detail_name,c.data_entry_no from journal_data_entry_master_nonprogressive c, frequency_detail d where c.frequency_detail_no=d.frequency_detail_no and c.journal_no=".$data;
		$q = $this->db->query($query);
    		return $q->result();
	}

	function get_journal_data_entry_detailnonp($id)
	{
		$query="select data_entry_no from journal_data_entry_detail_nonprogressive where data_entry_no=$id";
		$q=$this->db->query($query);
		return $q->num_rows();
	}

	function add_journal_data_entry_detailnonp($id,$loginid)
	{
		$query="select journal_no from journal_data_entry_master_nonprogressive where data_entry_no=$id";
		$res=$this->db->query($query);
		$rows=$res->result();
		foreach ($rows as $row):
			$journalno=$row->journal_no;
		endforeach;
		$query="select * from journal_detail_nonprogressive where journal_no=$journalno";
		$res=$this->db->query($query);
		$rows=$res->result();
		foreach ($rows as $row):
			$query="select data_entry_no from journal_data_entry_detail_nonprogressive where data_entry_no=$id and data_attb_id='".$row->data_attb_id."'";
			$q=$this->db->query($query);
			if($q->num_rows()==0)
			{
				$query="insert into journal_data_entry_detail_nonprogressive";
				$query .="(data_entry_no,data_attb_id,display_seq_no,data_source,created_user_id,created_date)";
				$query .=" values('$id','".$row->data_attb_id."','".$row->display_seq_no."',1,'$loginid','".date("Y-m-d")."')";
				$this->db->query($query);
			}
		endforeach;
	}

	function show_journal_data_entrynonp($id)
	{
		$query="select frequency_period,journal_name,project_name,user_full_name,frequency_detail_name from journal_data_entry_master_nonprogressive jdem,journal_master_nonprogressive jm,project_template pt,sec_user su,frequency_detail fd where jdem.data_entry_no=$id and jdem.journal_no=jm.journal_no and jm.project_no=pt.project_no and jm.user_id=su.user_id and fd.frequency_detail_no=jdem.frequency_detail_no";
		$q=$this->db->query($query);
		return $q->result();
	}

	function show_journal_data_entry_detailnonp($id)
	{
		$query="select jded.*,da.data_attb_label,da.data_attb_type_id,(SELECT validate_comment FROM journal_data_validate_detail jdvd where jdvd.data_attb_id = jded.data_attb_id AND jdvd.data_entry_no = jded.data_entry_no) as comments from journal_data_entry_detail_nonprogressive jded,data_attribute_nonprogressive da where jded.data_attb_id=da.data_attb_id and jded.data_entry_no=$id order by display_seq_no asc";
		$q=$this->db->query($query);
		return $q->result();
	}

	function add_journal_data_entry_picturenonp($data)
	{
		$this->db->insert("journal_data_entry_picture_nonprogressive",$data);
	}

	function update_journal_data_entry_picturenonp($data,$id)
	{
		$this->db->where('data_entry_pict_no', $id);
		$this->db->update('journal_data_entry_picture_nonprogressive', $data);
	}

	function add_seq_journal_data_entry_picturenonp($id)
	{
		$query="select data_entry_pict_no from journal_data_entry_picture_nonprogressive where data_entry_no=$id order by data_entry_pict_no asc";
		$result=$this->db->query($query);
		$rows=$result->result();
		$sno=1;
		foreach ($rows as $row):
			$this->db->query("update journal_data_entry_picture_nonprogressive set pict_seq_no=$sno where data_entry_pict_no=".$row->data_entry_pict_no);
			$sno++;
		endforeach;
	}

	function show_journal_data_entry_picturenonp($id)
	{
		$query="select * from journal_data_entry_picture_nonprogressive where data_entry_no=$id";
		$q=$this->db->query($query);
		return $q->result();
	}


	function delete_journal_data_entry_picturenonp($id)
	{
		$this->db->where('data_entry_pict_no', $id);
		$this->db->delete('journal_data_entry_picture_nonprogressive');
	}

	function update_journal_data_entry_detailnonp($dataentryno,$attid,$value,$userid)
	{
		$this->db->query("update journal_data_entry_detail_nonprogressive set actual_value='$value' where data_entry_no=$dataentryno and data_attb_id=$attid");
		$this->db->query("update journal_data_entry_master_nonprogressive set data_entry_status_id=1 where data_entry_no=$dataentryno ");
	}

	function publish_journal_data_entrynonp($id,$userid)
	{
		$this->db->query("update journal_data_entry_master_nonprogressive set data_entry_status_id=4,publish_user_id=$userid,publish_date='".date("Y-m-d")."' where data_entry_no=$id");
	}

	// Function to fetch total number of records to be validated
	function totalvalde($data,$userid)
    {
        $data=strtolower($data);
        $data=str_replace("'","''",$data);
		$query ="select a.project_name,b.journal_name,b.journal_no,f.frequency_detail_name,e.user_full_name,c.publish_date,d.data_validate_no,d.validate_level_no from project_template a, journal_master b,journal_data_entry_master c,journal_data_validate_master d,sec_user e,frequency_detail f where a.project_no=b.project_no and c.journal_no=b.journal_no and c.data_entry_no=d.data_entry_no and d.validate_status=1 and c.publish_user_id=e.user_id and f.frequency_detail_no=c.frequency_detail_no";
		if($userid!="1")
		{
			$query .=" and validate_user_id=$userid";
		}
		if($data!="")
		{
		$query .=" and ( lower(a.project_name) like '%".$data."%' ";
		$query .=" or lower(b.journal_name) like '%".$data."%' ";
		$query .=" or lower(e.user_full_name) like '%".$data."%' ";
		$query .=" or lower(f.frequency_detail_name) like '%".$data."%' )";
		}
		$query = $this->db->query($query);
		return $query->num_rows();
	}

	// Function To Fetch All data entry owner Record to be validated
	function show_valde($data,$offset,$perPage,$userid)
	{
		$data=strtolower($data);
		$data=str_replace("'","''",$data);
		$query ="select a.project_name,b.journal_name,b.journal_no,f.frequency_detail_name,e.user_full_name,c.publish_date,d.data_validate_no,d.validate_level_no from project_template a, journal_master b,journal_data_entry_master c,journal_data_validate_master d,sec_user e,frequency_detail f where a.project_no=b.project_no and c.journal_no=b.journal_no and c.data_entry_no=d.data_entry_no and d.validate_status=1 and c.publish_user_id=e.user_id and f.frequency_detail_no=c.frequency_detail_no";
		if($userid!="1")
		{
			$query .=" and validate_user_id=$userid";
		}
		if($data!="")
		{
			$query .=" and( lower(a.project_name) like '%".$data."%' ";
			$query .=" or lower(b.journal_name) like '%".$data."%' ";
			$query .=" or lower(e.user_full_name) like '%".$data."%' ";
		    $query .=" or lower(f.frequency_detail_name) like '%".$data."%' )";

		}
		$query .=" Order By project_name asc, journal_name asc OFFSET ".$offset."LIMIT ".$perPage;
        $q = $this->db->query($query);
        return $q->result();
	}

	function show_validation_journal_data_entry($id)
	{
		$query="select frequency_period,journal_name,project_name,user_full_name,frequency_detail_name,publish_date,(select user_full_name from sec_user where sec_user.user_id=jdem.publish_user_id) as publishname,validate_level_no,jdvm.data_entry_no from journal_data_entry_master jdem,journal_master jm,project_template pt,sec_user su,frequency_detail fd,journal_data_validate_master jdvm where data_validate_no=$id and jdem.data_entry_no=jdvm.data_entry_no and jdem.journal_no=jm.journal_no and jm.project_no=pt.project_no and jm.user_id=su.user_id and fd.frequency_detail_no=jdem.frequency_detail_no";
		$q=$this->db->query($query);
		return $q->result();
	}

	function show_validation_journal_validator($id)
	{
		$query="select user_full_name,validate_level_no,accept_date from journal_data_validate_master jdvm,sec_user su where su.user_id=jdvm.validate_user_id and data_entry_no=(select data_entry_no from journal_data_validate_master where data_validate_no=$id) and validate_level_no < (select validate_level_no from journal_data_validate_master where data_validate_no=$id)";
		$q=$this->db->query($query);
		return $q->result();
	}

	function total_validation_journal_validator($id)
	{
		$query="select user_full_name,validate_level_no,accept_date from journal_data_validate_master jdvm,sec_user su where su.user_id=jdvm.validate_user_id and data_entry_no=(select data_entry_no from journal_data_validate_master where data_validate_no=$id) and validate_level_no < (select validate_level_no from journal_data_validate_master where data_validate_no=$id)";
		$q=$this->db->query($query);
		return $q->num_rows();
	}

	function show_validation_journal_data_entry_detail($id)
	{
		$query="select jdvm.data_validate_no,jded.data_entry_no,da.data_attb_id,da.data_attb_type_id,da.data_attb_label,case da.data_attb_type_id when '2' then (select lk_data from lookup_data_detail ldd where ldd.data_set_id=da.data_set_id and lk_value=cast(jded.actual_value as NUMERIC)) else jded.actual_value end  as actual_value,jded.start_value,jded.end_value,jded.frequency_max_value,case da.data_attb_type_id when '2' then (select lk_data from lookup_data_detail ldd where ldd.data_set_id=da.data_set_id and lk_value=cast(jded.prev_actual_value as NUMERIC)) else jded.prev_actual_value end  as prev_actual_value,frequency_max_opt,da.data_set_id,da.data_attb_data_type_id,da.data_attb_digits,(select uom_name from unit_measure where unit_measure.uom_id=da.uom_id) as uom_name from  journal_data_entry_detail jded,data_attribute da ,journal_data_validate_master jdvm where jded.data_attb_id=da.data_attb_id and jded.data_entry_no=jdvm.data_entry_no and jdvm.data_validate_no=$id order by display_seq_no asc";
		$q=$this->db->query($query);
		return $q->result();
	}

	function show_validation_journal_data_entry_picture($id)
	{
		$query="select * from journal_data_entry_picture where data_entry_no=(select data_entry_no from journal_data_validate_master where data_validate_no=$id)";
		$q=$this->db->query($query);
		return $q->result();
	}

	function update_journal_data_validate_detail($validateno,$dataentryno,$dataattbid,$comment)
	{
		$query="select validate_comment	 from journal_data_validate_detail where data_validate_no=$validateno and data_entry_no=$dataentryno and data_attb_id=$dataattbid";
		$q=$this->db->query($query);
		if($q->num_rows()==0)
		{
			$this->db->query("insert into journal_data_validate_detail values($validateno,$dataentryno,$dataattbid,'$comment')");
		}
		else
		{
			$this->db->query("update journal_data_validate_detail set validate_comment='$comment' where data_validate_no=$validateno and data_entry_no=$dataentryno and data_attb_id=$dataattbid");
		}

	}
	
	function update_journal_date_status($validateno)
	{
		$this->db->query("update journal_data_entry_master set data_entry_status_id=3 where data_entry_no in (select data_entry_no from journal_data_validate_master where data_validate_no=$validateno)");
	}

	function update_validate_accept($valid,$dataid)
	{
		$query="select data_validate_no from journal_data_validate_master where data_entry_no=$dataid and validate_status=0 order by validate_level_no asc limit 1 ";
		$q=$this->db->query($query);
		if($q->num_rows()==0)
		{
			$this->db->query("update journal_data_validate_master set validate_status=2,accept_date='".date("Y-m-d")."' where data_validate_no=$valid");
			$this->db->query("update journal_data_entry_master set data_entry_status_id=4 where data_entry_no=$dataid");
			
			$query="select data_entry_no from journal_data_entry_master where data_entry_status_id=0 and journal_no=(select journal_no from journal_data_entry_master where data_entry_no=$dataid) order by data_entry_no asc limit 1 ";
			$q=$this->db->query($query);
			if($q->num_rows()!=0)
			{
				$rows=$q->result();
				foreach($rows as $row):
					$dataentryno=$row->data_entry_no;
				endforeach;
				$this->db->query("update journal_data_entry_master set data_entry_status_id=1 where data_entry_no=$dataentryno");
			}
			$query="select end_date from journal_master where journal_no=(select journal_no from journal_data_entry_master where data_entry_no=$dataid)";
			$q=$this->db->query($query);
			$rows=$q->result();
			foreach($rows as $row):
				$end=$row->end_date;
			endforeach;
			if($end=='')
			{
				$query="select journal_no,frequency_detail_no,created_user_id from journal_data_entry_master where data_entry_no=$dataid";
				$q=$this->db->query($query);
				$rows=$q->result();
				foreach($rows as $row):
					$freq=$row->frequency_detail_no;
					$frequencydata=array('journal_no'=>$row->journal_no,'frequency_detail_no'=>($freq+1),'data_entry_status_id'=>'1','created_user_id'=>$row->created_user_id,'created_date'=>date("Y-m-d"));
					$this->db->insert('journal_data_entry_master', $frequencydata);
				endforeach;
				
			}
		}
		else
		{
			$this->db->query("update journal_data_validate_master set validate_status=2,accept_date='".date("Y-m-d")."' where data_validate_no=$valid");
			$rows=$q->result();
			foreach($rows as $row):
				$datavalidateno=$row->data_validate_no;
			endforeach;
			$this->db->query("update journal_data_validate_master set validate_status=1 where data_validate_no=$datavalidateno");
		}
	}
	
	function update_validate_close($valid,$dataid)
	{
		$this->db->query("update journal_data_validate_master set validate_status=4,accept_date='".date("Y-m-d")."' where data_validate_no=$valid");
		$this->db->query("update journal_data_entry_master set data_entry_status_id=4 where data_entry_no=$dataid");
		
		$query="select data_entry_no from journal_data_entry_master where data_entry_status_id=0 and journal_no=(select journal_no from journal_data_entry_master where data_entry_no=$dataid) order by data_entry_no asc";
		$q=$this->db->query($query);
		if($q->num_rows()!=0)
		{
			$rows=$q->result();
			foreach($rows as $row):
				$dataentryno=$row->data_entry_no;
				$this->db->query("update journal_data_entry_master set data_entry_status_id=4 where data_entry_no=$dataentryno");
			endforeach;
			
		}
	}

	function update_validate_accept_email_check($id)
	{
		$query="select data_entry_status_id from journal_data_entry_master where data_entry_no=$id and data_entry_status_id=4";
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	
	function update_validate_accept_email($id,$userid)
	{
		$query="select data_validate_no from journal_data_validate_master where data_entry_no=$id and validate_status=2 order by validate_level_no desc limit 1";
		$q=$this->db->query($query);
		$rows=$q->result();
		foreach($rows as $row):
			$datavalid=$row->data_validate_no;
		endforeach;
		$query="select (select journal_name from journal_master jm where jm.journal_no=jdem.journal_no) as journalname,(select user_full_name from sec_user su where su.user_id=jdem.publish_user_id) as dataentryname,(select email_id from sec_user su where su.user_id=jdem.publish_user_id) as dataentryemail,(select user_id from sec_user su where su.user_id=jdem.publish_user_id) as dataentryid,(select user_full_name from sec_user su,journal_data_validate_master jdvm where su.user_id=jdvm.validate_user_id and jdvm.data_validate_no=$datavalid ) as validatorname,(select email_id from sec_user su,journal_data_validate_master jdvm where su.user_id=jdvm.validate_user_id and jdvm.data_validate_no=$datavalid) as validatoremail,(select validate_user_id from journal_data_validate_master jdvm where jdvm.data_validate_no=$datavalid) as validatorid  from journal_data_entry_master jdem where jdem.data_entry_no=$id";
		$q=$this->db->query($query);
		return $q->result();
	}

	function update_validate_reject($valid,$dataid,$comment,$userid)
	{
		$this->db->query("update journal_data_validate_master set validate_status=3 where data_validate_no=$valid");
		$this->db->query("update journal_data_entry_master set data_entry_status_id=1 where data_entry_no=$dataid");

		$query="select data_validate_no	from journal_data_validate_reject where data_validate_no=$valid";
		$q=$this->db->query($query);
		if($q->num_rows()==0)
		{
			$this->db->query("insert into journal_data_validate_reject values($valid,$userid,'$comment','".date("Y-m-d")."')");
		}
		else
		{
			$this->db->query("update journal_data_validate_reject set reject_date='".date("Y-m-d")."',reject_user_id=$userid,reject_notes='$comment' where data_validate_no=$valid");
		}
	}
	
	function update_validate_reject_email($id,$userid)
	{
		$query="select data_validate_no from journal_data_validate_master where data_entry_no=$id and validate_status=3 order by validate_level_no desc limit 1 ";
		$q=$this->db->query($query);
		$rows=$q->result();
		foreach($rows as $row):
			$datavalid=$row->data_validate_no;
		endforeach;
		$query="select (select journal_name from journal_master jm where jm.journal_no=jdem.journal_no) as journalname,(select user_full_name from sec_user su where su.user_id=jdem.publish_user_id) as dataentryname,(select email_id from sec_user su where su.user_id=jdem.publish_user_id) as dataentryemail,(select user_id from sec_user su where su.user_id=jdem.publish_user_id) as dataentryid,(select user_full_name from sec_user su,journal_data_validate_master jdvm where su.user_id=jdvm.validate_user_id and jdvm.data_validate_no=$datavalid ) as validatorname,(select email_id from sec_user su,journal_data_validate_master jdvm where su.user_id=jdvm.validate_user_id and jdvm.data_validate_no=$datavalid) as validatoremail,(select validate_user_id from journal_data_validate_master jdvm where jdvm.data_validate_no=$datavalid) as validatorid  from journal_data_entry_master jdem where jdem.data_entry_no=$id";
		$q=$this->db->query($query);
		return $q->result();
	}

	function get_journal_data_entry_details($id)
    {
        $query="select data_entry_no,jded.data_attb_id,actual_value,jded.prev_actual_value,frequency_max_value,start_value,end_value,da.data_attb_label,um.uom_name,CAST(jded.actual_value as DECIMAL(20,4))-(coalesce(CAST(jded.prev_actual_value as DECIMAL(20,4)),0)+CAST(jded.frequency_max_value as DECIMAL(20,4))) as varient from journal_data_entry_detail jded,data_attribute da,unit_measure um where da.data_attb_data_type_id!=2 and da.data_attb_type_id!=4 and (frequency_max_opt is null or frequency_max_opt=0) and da.data_attb_id=jded.data_attb_id and um.uom_id=da.uom_id and (actual_value is not null and actual_value <>'') and jded.data_entry_no=$id";
        $q=$this->db->query($query);
        return $q->result();
    }
    
    function update_validate_reject_varient($id)
    {
        $query="select data_attb_id from journal_data_entry_detail where data_entry_no=$id";
        $q=$this->db->query($query);
        $rows=$q->result();
        foreach($rows as $row):
        	$this->db->query("update journal_data_entry_detail set frequency_max_opt=null where data_entry_no='$id' and data_attb_id=".$row->data_attb_id);
        endforeach;
    }

	// Function to fetch total number of records to view audit log
	function totallog($data)
	{
		$data=strtolower($data);
		$data=str_replace("'","''",$data);
		$query ="select a.project_name,b.journal_name,b.journal_no,c.publish_date,c.data_entry_no,(select validate_level_no from journal_data_validate_master jdvm where jdvm.data_entry_no=c.data_entry_no and jdvm.validate_status!=0 order by validate_level_no desc limit 1)as validate_level_no ,d.user_full_name,f.frequency_detail_name from project_template a, journal_master b,journal_data_entry_master c,sec_user d,frequency_detail f where a.project_no=b.project_no and c.publish_user_id=d.user_id and f.frequency_detail_no=c.frequency_detail_no and c.journal_no=b.journal_no";
		if($data!="")
		{
		$query .=" and ( lower(a.project_name) like '%".$data."%' ";
		$query .=" or lower(b.journal_name) like '%".$data."%' ";
		$query .=" or lower(d.user_full_name) like '%".$data."%' ";
		$query .=" or lower(f.frequency_detail_name) like '%".$data."%' )";
		}
		$query = $this->db->query($query);
		return $query->num_rows();
	}

	// Function To Fetch All records to view audit log
	function show_log($data,$offset,$perPage)
	{
		$data=strtolower($data);
		$data=str_replace("'","''",$data);
		$query ="select a.project_name,b.journal_name,b.journal_no,c.publish_date,c.data_entry_no,(select validate_level_no from journal_data_validate_master jdvm where jdvm.data_entry_no=c.data_entry_no and jdvm.validate_status!=0 order by validate_level_no desc limit 1)as validate_level_no ,d.user_full_name,f.frequency_detail_name from project_template a, journal_master b,journal_data_entry_master c,sec_user d,frequency_detail f where a.project_no=b.project_no and c.publish_user_id=d.user_id and f.frequency_detail_no=c.frequency_detail_no and c.journal_no=b.journal_no";
		if($data!="")
		{
			$query .=" and( lower(a.project_name) like '%".$data."%' ";
			$query .=" or lower(b.journal_name) like '%".$data."%' ";
			$query .=" or lower(d.user_full_name) like '%".$data."%' ";
			$query .=" or lower(f.frequency_detail_name) like '%".$data."%' )";

		}
		$query .=" Order By project_name asc,journal_name asc OFFSET ".$offset."LIMIT ".$perPage;
		$q = $this->db->query($query);
		return $q->result();
	}

	// Function To Fetch All records to view audit log for respective journal week
	function show_log_id($data)
	{
		$query ="select a.data_attb_label, b.* from data_attribute a , journal_data_entry_audit_log b where a.data_attb_id=b.data_attb_id and b.data_entry_no=".$data;
		$q = $this->db->query($query);
		return $q->result();
	}
	// Function To Fetch User Full Name from sec_user
	function show_uname($data)
	{

		$query ="select user_full_name from sec_user where user_id=".$data;
		$q = $this->db->query($query);
		return $q->result();
	}

}
?>