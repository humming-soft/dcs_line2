<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Admin extends CI_Model
{
    // Function to fetch total number of Data Attribute Group records
    function totaldataattrgrp($data)
    {
        $data = strtolower($data);
        $data = str_replace("'", "''", $data);
        $sql = "SELECT * FROM data_attribute_group";
        if ($data != "") {
            $sql .= " where lower(data_attribute_group_desc) like '%" . $data . "%' ";

        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    // Function To Fetch All Data Attribute Group Record
    function show_dataattrgrps()
    {
        $query = "SELECT * FROM  data_attribute_group";
        $q = $this->db->query($query);
        return $q->result();
    }

    // Function To Fetch All Data Attribute Group Record
    function show_dataattrgrp($data, $offset, $perPage)
    {
        $data = strtolower($data);
        $data = str_replace("'", "''", $data);
        $query = "SELECT * FROM  data_attribute_group";
        if ($data != "") {
            $query .= " where lower(data_attribute_group_desc) like '%" . $data . "%' ";

        }
        $query .= " Order By data_attribute_group_desc asc ";
        $q = $this->db->query($query);
        return $q->result();
    }

    // Add Check Query For Selected Data attribute Group
    function add_check_dataattrgrp($data)
    {
        $data = str_replace("'", "''", $data);
        $query = $this->db->query("select data_attribute_group_id from data_attribute_group where data_attribute_group_desc='$data'");
        return $query->num_rows();
    }

    //Function to add new Data attribute Group record
    function add_dataattrgrp($data)
    {
        // Inserting in Table data_attribute_group
        $this->db->insert('data_attribute_group', $data);
        return true;
    }

    // Update Check Query For Selected Data attribute Group
    function update_check_dataattrgrp($id, $data)
    {
        $data = str_replace("'", "''", $data);
        $query = $this->db->query("select data_attribute_group_id from data_attribute_group where data_attribute_group_id!=$id and data_attribute_group_desc='$data'");
        return $query->num_rows();
    }

    // Update Query For Selected Data attribute Group
    function update_dataattrgrp($id, $data)
    {
        $this->db->where('data_attribute_group_id', $id);
        $this->db->update('data_attribute_group', $data);
    }

    // Delete Check Query For Selected Data Attribute Group
    function delete_check_dataattrgrp($id)
    {

        $query = $this->db->query("select data_attribute_group_id from data_attribute where data_attribute_group_id=$id");
        return $query->num_rows();
    }

    // Delete the selected record
    function delete_dataattrgrp($id)
    {
        $this->db->where('data_attribute_group_id', $id);
        $this->db->delete('data_attribute_group');
    }

    // Function to fetch all Data Type
    function show_datatype()
    {
        $query = $this->db->get('data_attribute_data_type');
        $query_result = $query->result();
        return $query_result;
    }

    // Function to fetch all Data Type
    function show_attbgroup()
    {
        $query = $this->db->get('data_attribute_group');
        $query_result = $query->result();
        return $query_result;
    }

    // Function to fetch all Data Type
    function show_inputtype()
    {
        $query = $this->db->get('data_attribute_type');
        $query_result = $query->result();
        return $query_result;
    }

    // Function to fetch total number of records
    function totaldataatt($data)
    {
        $data = strtolower($data);
        $data = str_replace("'", "''", $data);
        $sql = "SELECT da.*,(select data_attb_data_type_desc from data_attribute_data_type dadt where da.data_attb_data_type_id=dadt.data_attb_data_type_id) as data_attb_data_type_desc,(select lk_code from lookup_data ld where da.data_set_id=ld.data_set_id) as lk_code,(select data_attribute_group_desc from data_attribute_group dag where da.data_attribute_group_id=dag.data_attribute_group_id) as data_attribute_group_desc,(select data_attb_type_desc from data_attribute_type where data_attribute_type.data_attb_type_id=da.data_attb_type_id) as data_attb_type_desc,(select uom_name from unit_measure where unit_measure.uom_id=da.uom_id ) as uom_name FROM data_attribute da where 1=1";
        if ($data != "") {
            $sql .= " and (";
            $sql .= " lower(data_attb_label) like '%" . $data . "%' ";
            //$sql .=" or lower(data_attb_data_type_desc) like '%".$data."%' ";
            $sql .= " or data_attb_type_id in (select data_attb_type_id from data_attribute_type where lower(data_attb_type_desc) like '%" . $data . "%') ";
            //$sql .=" or lower(lk_code) like '%".$data."%' ";
            $sql .= " or uom_id in (select uom_id from unit_measure where lower(uom_name) like '%" . $data . "%') ";
            $sql .= " or data_attribute_group_id in (select data_attribute_group_id from data_attribute_group where lower(data_attribute_group_desc) like '%" . $data . "%') ";
            $sql .= " ) ";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    //Function to Fetch All Data Attribute Record
    function show_dataatts()
    {
        $sql = "SELECT da.data_attb_id,da.data_attb_label,da.data_attribute_group_id,(select data_attb_type_desc from data_attribute_type where data_attribute_type.data_attb_type_id=da.data_attb_type_id) as data_attb_type_desc,(select uom_name from unit_measure where unit_measure.uom_id=da.uom_id ) as uom_name FROM data_attribute da order by da.data_attb_label ";
        $q = $this->db->query($sql);
        return $q->result();
    }

    // Function To Fetch All Data Attribute Record
    function show_dataatt($data, $offset, $perPage)
    {
        $data = strtolower($data);
        $data = str_replace("'", "''", $data);
        $sql = "SELECT da.*,(select data_attb_data_type_desc from data_attribute_data_type dadt where da.data_attb_data_type_id=dadt.data_attb_data_type_id) as data_attb_data_type_desc,(select lk_code from lookup_data ld where da.data_set_id=ld.data_set_id) as lk_code,(select data_attribute_group_desc from data_attribute_group dag where da.data_attribute_group_id=dag.data_attribute_group_id) as data_attribute_group_desc,(select data_attb_type_desc from data_attribute_type where data_attribute_type.data_attb_type_id=da.data_attb_type_id) as data_attb_type_desc,(select uom_name from unit_measure where unit_measure.uom_id=da.uom_id ) as uom_name FROM data_attribute da where 1=1 ";
        if ($data != "") {
            $data = str_replace(array('%'), array('\%'), $data);
            $sql .= " and (";
            $sql .= " lower(data_attb_label) like '%" . $data . "%' ";
            //$sql .=" or lower(data_attb_data_type_desc) like '%".$data."%' ";
            $sql .= " or data_attb_type_id in (select data_attb_type_id from data_attribute_type where lower(data_attb_type_desc) like '%" . $data . "%') ";
            //$sql .=" or lower(lk_code) like '%".$data."%' ";
            $sql .= " or uom_id in (select uom_id from unit_measure where lower(uom_name) like '%" . $data . "%') ";
            $sql .= " or data_attribute_group_id in (select data_attribute_group_id from data_attribute_group where lower(data_attribute_group_desc) like '%" . $data . "%') ";
            $sql .= " ) ";
        }
        $sql .= " Order By data_attb_label asc";
        $q = $this->db->query($sql);
        return $q->result();
    }

    // Add Check Query For Selected Data Attribute
    function add_check_dataatt($data, $inputtype, $datatype, $uom,$atbgrp)
    {
      /*  echo "LABEL--" . $data . "INPUT TYPE----" . $inputtype . "DATATYPE----" . $datatype . "UOM----" . $uom . "ATTBGROUP----" . $atbgrp;*/
        $data = str_replace("'", "''", $data);
        if ($datatype && $uom && $atbgrp) {
            $query = $this->db->query("select data_attb_label from data_attribute where data_attb_label='$data' AND data_attb_type_id=$inputtype AND data_attb_data_type_id=$datatype AND uom_id=$uom AND data_attribute_group_id=$atbgrp");
        } elseif ($datatype && $uom) {
            $query = $this->db->query("select data_attb_label from data_attribute where data_attb_label='$data' AND data_attb_type_id=$inputtype AND data_attb_data_type_id=$datatype AND uom_id=$uom");
        } elseif ($datatype) {
            $query = $this->db->query("select data_attb_label from data_attribute where data_attb_label='$data' AND data_attb_type_id=$inputtype AND data_attb_data_type_id=$datatype");
        } elseif ($uom && $atbgrp){
            $query = $this->db->query("select data_attb_label from data_attribute where data_attb_label='$data' AND data_attb_type_id=$inputtype AND uom_id=$uom AND data_attribute_group_id=$atbgrp");
        }else {
            $query = $this->db->query("select data_attb_label from data_attribute where data_attb_label='$data' AND data_attb_type_id=$inputtype");
        }
        return $query->num_rows();
    }

    //Function to add new record
    function add_dataatt($data)
    {
        // Inserting in Table Data Attribute
        $this->db->insert('data_attribute', $data);
        return true;
    }

    // Update Check Query For Selected Data Attribute
    function update_check_dataatt($id, $data)
    {
        $data = str_replace("'", "''", $data);
        $query = $this->db->query("select data_attb_label from data_attribute where data_attb_id!=$id and data_attb_label='$data'");
        return $query->num_rows();
    }

    // Update Query For Selected Data Attribute
    function update_dataatt($id, $data)
    {
        $this->db->where('data_attb_id', $id);
        $this->db->update('data_attribute', $data);
    }

    // Delete Check Query For Selected Data Attribute
    function delete_check_dataatt($id)
    {//journal_data_entry_audit_log journal_data_entry_detail journal_data_validate_detail journal_detail
        $query = $this->db->query("select data_attb_id from journal_detail where data_attb_id=$id");
        if ($query->num_rows() == 0) {
            $query1 = $this->db->query("select data_attb_id from journal_data_entry_detail where data_attb_id=$id");
            if ($query1->num_rows() == 0) {
                $query2 = $this->db->query("select data_attb_id from journal_data_validate_detail where data_attb_id=$id");
                if ($query2->num_rows() == 0) {
                    $query3 = $this->db->query("select data_attb_id from journal_data_entry_audit_log where data_attb_id=$id");
                    return $query3->num_rows();
                } else {
                    return $query2->num_rows();
                }
            } else {
                return $query1->num_rows();
            }
        } else {
            return $query->num_rows();
        }
    }

    // Delete the Selected Data Attribute record
    function delete_dataatt($id)
    {
        $this->db->where('data_attb_id', $id);
        $this->db->delete('data_attribute');
    }

    // Function to fetch all Data Type
    function show_inputtype_nonp()
    {
        $query = $this->db->get('data_attribute_type_nonprogressive');
        $query_result = $query->result();
        return $query_result;
    }

    // Function to fetch total number of records
    function totaldataattnop($data)
    {
        $data = strtolower($data);
        $data = str_replace("'", "''", $data);
        $sql = "SELECT da.*,(select data_attb_type_desc from data_attribute_type_nonprogressive where data_attribute_type_nonprogressive.data_attb_type_id=da.data_attb_type_id) as data_attb_type_desc FROM data_attribute_nonprogressive da where 1=1";
        if ($data != "") {
            $sql .= " and (";
            $sql .= " lower(data_attb_label) like '%" . $data . "%' ";
            $sql .= " or data_attb_type_id in (select data_attb_type_id from data_attribute_type_nonprogressive where lower(data_attb_type_desc) like '%" . $data . "%') ";
            $sql .= " ) ";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    //Function to Fetch All Data Attribute Record

    function show_dataattsnonp()
    {
        $sql = "SELECT da.data_attb_id,da.data_attb_label,dat.data_attb_type_desc FROM data_attribute_nonprogressive da,data_attribute_type_nonprogressive dat where da.data_attb_type_id=dat.data_attb_type_id ";
        $q = $this->db->query($sql);
        return $q->result();
    }

    // Function To Fetch All Data Attribute Record
    function show_dataattnop($data, $offset, $perPage)
    {
        $data = strtolower($data);
        $data = str_replace("'", "''", $data);
        $sql = "SELECT da.*,(select data_attb_type_desc from data_attribute_type_nonprogressive where data_attribute_type_nonprogressive.data_attb_type_id=da.data_attb_type_id) as data_attb_type_desc FROM data_attribute_nonprogressive da where 1=1";
        if ($data != "") {
            $sql .= " and (";
            $sql .= " lower(data_attb_label) like '%" . $data . "%' ";
            $sql .= " or data_attb_type_id in (select data_attb_type_id from data_attribute_type_nonprogressive where lower(data_attb_type_desc) like '%" . $data . "%') ";
            $sql .= " ) ";
        }
        $sql .= " Order By data_attb_label asc OFFSET " . $offset . "LIMIT " . $perPage;
        $q = $this->db->query($sql);
        return $q->result();
    }

    // Add Check Query For Selected Data Attribute
    function add_check_dataattnop($data)
    {
        $data = str_replace("'", "''", $data);
        $query = $this->db->query("select data_attb_label from data_attribute_nonprogressive where data_attb_label='$data'");
        return $query->num_rows();
    }

    //Function to add new record
    function add_dataattnop($data)
    {
        // Inserting in Table Data Attribute
        $this->db->insert('data_attribute_nonprogressive', $data);
        return true;
    }

    // Update Check Query For Selected Data Attribute
    function update_check_dataattnop($id, $data)
    {
        $data = str_replace("'", "''", $data);
        $query = $this->db->query("select data_attb_label from data_attribute_nonprogressive where data_attb_id!=$id and data_attb_label='$data'");
        return $query->num_rows();
    }

    // Update Query For Selected Data Attribute
    function update_dataattnop($id, $data)
    {
        $this->db->where('data_attb_id', $id);
        $this->db->update('data_attribute_nonprogressive', $data);
    }

    // Delete Check Query For Selected Data Attribute
    function delete_check_dataattnop($id)
    {
        //journal_data_entry_audit_log journal_data_entry_detail journal_data_validate_detail journal_detail
        return '0';
    }

    // Delete the Selected Data Attribute record
    function delete_dataattnop($id)
    {
        $this->db->where('data_attb_id', $id);
        $this->db->delete('data_attribute_nonprogressive');
    }

    // Function to fetch total number of records
    function totaluom($data)
    {
        $data = strtolower($data);
        $data = str_replace("'", "''", $data);
        $sql = "SELECT * FROM unit_measure";
        if ($data != "") {
			$sql .=" where lower(uom_name) like '%".$data."%' ";
			$sql .=" or lower(uom_desc) like '%".$data."%' ";
		}
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	// Function To Fetch All UOM Record
	function show_uom($data,$offset,$perPage)
	{
		$data=strtolower($data);
		$data=str_replace("'","''",$data);
		$query ="SELECT * FROM  unit_measure";
		if($data!="")
		{
			$query .=" where lower(uom_name) like '%".$data."%' ";
			$query .=" or lower(uom_desc) like '%".$data."%' ";
		}
		$query .=" Order By uom_name asc";
        $q = $this->db->query($query);
        return $q->result();
	}

	// Function to fetch all UOM
	function show_uoms()
	{
		$query = $this->db->get('unit_measure');
		$query_result = $query->result();
		return $query_result;
	}

	// Function To Fetch Selected Uom Record
	function show_uom_id($data)
	{
		$this->db->select('*');
		$this->db->from('unit_measure');
		$this->db->where('uom_id', $data);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	// Add Check Query For Selected UOM
	function add_check_uom($data)
	{
		$data=str_replace("'","''",$data);
		$query=$this->db->query("select uom_id from unit_measure where uom_name='$data'");
		return $query->num_rows();
	}

	//Function to add new record
	function add_uom($data)
	{
		// Inserting in Table unit_measure
		$this->db->insert('unit_measure', $data);
		return true;
	}

	// Update Check Query For Selected UOM
	function update_check_uom($id,$data)
	{
		$data=str_replace("'","''",$data);
		$query=$this->db->query("select uom_id from unit_measure where uom_id!=$id and uom_name='$data'");
		return $query->num_rows();
	}

	// Update Query For Selected Uom
	function update_uom($id,$data)
	{
		$this->db->where('uom_id', $id);
		$this->db->update('unit_measure', $data);
	}

	// Delete Check Query For Selected UOM
	function delete_check_uom($id)
	{

		$query=$this->db->query("select uom_id from data_attribute where uom_id=$id");
		return $query->num_rows();
	}

	// Delete the selected record
	function delete_uom($id)
	{
		$this->db->where('uom_id', $id);
		$this->db->delete('unit_measure');
	}

	// Function to fetch total number of records
	function totallookupdata($data)
    {
        $data=strtolower($data);
        $data=str_replace("'","''",$data);
		$sql = "SELECT * FROM lookup_data,lookup_data_detail where lookup_data.data_set_id=lookup_data_detail.data_set_id ";
		if($data!="")
		{
			$sql .=" and ( lower(lk_code) like '%".$data."%' ";
			$sql .=" or lower(lk_data) like '%".$data."%' ";
			if (is_numeric($data))
			{
				$sql .=" or lk_value='".$data."'";
			}
			$sql .=" )";
		}
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	// Function To Fetch All Lookup Data Record
	function show_lookupdata($data,$offset,$perPage)
	{
		$data=strtolower($data);
		$data=str_replace("'","''",$data);
		$query = "SELECT lookup_data.data_set_id,lk_code,data_set_detail_id,lk_data,lk_value FROM lookup_data,lookup_data_detail where lookup_data.data_set_id=lookup_data_detail.data_set_id ";
		if($data!="")
		{
			$data = str_replace(array('%'), array('\%'), $data);
			$query .=" and ( lower(lk_code) like '%".$data."%' ";
			$query .=" or lower(lk_data) like '%".$data."%' ";
			if (is_numeric($data))
			{
				$query .=" or lk_value='".$data."'";
			}
			$query .=" )";
		}
		$query .=" Order By lookup_data.lk_code asc,lookup_data_detail.lk_data asc";
        $q = $this->db->query($query);
        return $q->result();
	}

	// Function to fetch all Lookup Data
	function show_lookupdatas()
	{
		$query = $this->db->get('lookup_data');
		$query_result = $query->result();
		return $query_result;
	}

	// Add Check Query For Selected Lookup Data
	function add_check_lookupdata($code,$data)
	{
		$data=str_replace("'","''",$data);
		$code=str_replace("'","''",$code);
		$query=$this->db->query("select data_set_id from lookup_data where lk_code='$code'");
		if($query->num_rows()==0)
		{
			return $query->num_rows();
		}
		else
		{
			$rows=$query->result();
			foreach ($rows as $row):
				$dataid=$row->data_set_id;
			endforeach;
			$query1=$this->db->query("select data_set_id from lookup_data_detail where lk_data='$data' and data_set_id=$dataid");
			return $query1->num_rows();
		}
	}

	//Function to add new record
	function add_lookupdata($code,$data,$value)
	{
		$code=str_replace("'","''",$code);
		$query=$this->db->query("select data_set_id from lookup_data where lk_code='".$code."'");
		$norow=$query->num_rows();
		$rows=$query->result();
		if($norow==1)
		{
			foreach ($rows as $row):
			$dataid=$row->data_set_id;
			endforeach;
		}
		else
		{
			$this->db->query("insert into lookup_data (lk_code) values('$code') ");
			$query1=$this->db->query("select data_set_id from lookup_data where lk_code='".$code."'");
			$rows1=$query1->result();
			foreach ($rows1 as $row1):
			$dataid=$row1->data_set_id;
			endforeach;
		}
		$data1 = array('data_set_id' => $dataid ,'lk_data' => $data,'lk_value' => $value);
		$this->db->insert('lookup_data_detail', $data1);
	}

	// Update Check Query For Selected Lookup Data
	function update_check_lookupdata($id,$id1,$code)
	{

		$query=$this->db->query("select data_set_id from data_attribute where data_set_id=$id");
		if($query->num_rows()==0)
		{
			return $query->num_rows();
		}
		else
		{
			$query1=$this->db->query("select lk_code from lookup_data where data_set_id=$id");
			$rows=$query1->result();
			foreach ($rows as $row):
				$codeold=$row->lk_code;
			endforeach;
			if($code==$codeold)
			{
				return 0;
			}
			else
			{
				$query2=$this->db->query("select data_set_id from lookup_data_detail where data_set_id=$id and data_set_detail_id!=$id1");
				if($query2->num_rows()==0)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
	}

	// Update Check Query For Selected Lookup Data
	function update_check_lookupdata1($id1,$code,$data)
	{
		$data=str_replace("'","''",$data);
		$code=str_replace("'","''",$code);
		$query=$this->db->query("select data_set_id from lookup_data where lk_code='".$code."'");
		$norow=$query->num_rows();
		if($norow==1)
		{
			$rows=$query->result();
			foreach ($rows as $row):
				$dataid=$row->data_set_id;
			endforeach;
			$query1=$this->db->query("select data_set_id from lookup_data_detail where data_set_id=$dataid and lk_data='$data' and data_set_detail_id!=$id1");
			return $query1->num_rows();
		}
		else
		{
			return 0;
		}
	}

	// Update Query For Selected Lookup Data
	function update_lookupdata($id,$id1,$code,$data,$value)
	{
		$code=str_replace("'","''",$code);
		$query=$this->db->query("select data_set_id from lookup_data where lk_code='".$code."'");
		$norow=$query->num_rows();
		$rows=$query->result();
		if($norow==1)
		{
			foreach ($rows as $row):
			$dataid=$row->data_set_id;
			endforeach;
		}
		else
		{
			$this->db->query("insert into lookup_data (lk_code) values('$code') ");
			$query1=$this->db->query("select data_set_id from lookup_data where lk_code='".$code."'");
			$rows1=$query1->result();
			foreach ($rows1 as $row1):
			$dataid=$row1->data_set_id;
			endforeach;
		}
		$data1 = array('data_set_id' => $dataid ,'lk_data' => $data,'lk_value' => $value);
		$this->db->where('data_set_detail_id', $id1);
		$this->db->update('lookup_data_detail', $data1);

		$query = $this->db->query("select lk_data from lookup_data_detail where data_set_id='".$id."'");
		$rows= $query->num_rows();

		if($rows==0)
		{
			$this->db->where('data_set_id',$id);
			$this->db->delete('lookup_data');
		}
	}

	// Delete Check Query For Selected Lookup Data
	function delete_check_lookupdata($id)
	{
		$query=$this->db->query("select data_set_id from data_attribute where data_set_id=$id");
		if($query->num_rows()==0)
		{
			return $query->num_rows();
		}
		else
		{
			$query1=$this->db->query("select data_set_id from lookup_data_detail where data_set_id=$id");
			if($query1->num_rows()==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
	}

	// Delete the selected record
	function delete_lookupdata($id,$id1)
	{
		$this->db->where('data_set_detail_id', $id1);
		$this->db->delete('lookup_data_detail');


		$query = $this->db->query("select lk_data from lookup_data_detail where data_set_id='".$id."'");
		$rows= $query->num_rows();

		if($rows==0)
		{
			$this->db->where('data_set_id',$id);
			$this->db->delete('lookup_data');
		}
	}

    // done by jane for listing templates in a hierarchical order
    function get_template_hierarchy(){
        $sql1 = "SELECT project_template_hierarchy.id, project_template_hierarchy.template_id, project_template.project_name as name, project_template_hierarchy.parent_id, project_template.project_name as text
                                FROM project_template_hierarchy
                                INNER JOIN project_template
                                ON project_template_hierarchy.template_id = project_template.project_no order by project_template_hierarchy.id;";
        $res1 = $this->db->query($sql1);
        $sql2 = "SELECT * FROM project_template_hierarchy WHERE template_id IS NULL";
        $res2 = $this->db->query($sql2);
        $result = array_merge($res1->result_array(),$res2->result_array());
        return $result;
    }

    // done by jane for returning template hierarchy list
    function get_template_hierarchy_list($session_data){
//        $validator_id = $session_data['id'];
//            if($session_data['roleid'] == 1 || $session_data['roleid'] == 16) {
            $query1 = "SELECT project_template_hierarchy.id, project_template_hierarchy.template_id, project_template.project_name as name, project_template_hierarchy.parent_id, project_template.project_name as text
                                FROM project_template_hierarchy
                                INNER JOIN project_template
                                ON project_template_hierarchy.template_id = project_template.project_no order by project_template_hierarchy.id;";
            $res1 = $this->db->query($query1)->result_array();
            /*$query2 = "SELECT * FROM project_template_hierarchy WHERE template_id IS NULL";
            $res2 = $this->db->query($query2);
            $result = array_merge($res1->result_array(), $res2->result_array());*/
            return $res1;
//        } else {
//            $query = "SELECT journal_master.project_no FROM journal_master
//                    INNER JOIN journal_validator
//                    ON journal_master.journal_no = journal_validator.journal_no and journal_validator.validate_user_id = $validator_id";
//            $res1 = $this->db->query($query)->result_array();
//            if(!empty($res1)) {
//                $value_string = "";
//                foreach ($res1 as $key => $value) {
//                    $p_no = $value['project_no'];
//                    $value_string .= "$p_no" . ",";
//                }
//                $project_no = rtrim($value_string, ',');
//                if($project_no){
//                    $query = "SELECT project_template_hierarchy.id, project_template_hierarchy.template_id, project_template.project_name as name, project_template_hierarchy.parent_id, project_template.project_name as text
//                                FROM project_template_hierarchy
//                                INNER JOIN project_template
//                                ON project_template_hierarchy.template_id = project_template.project_no AND project_template_hierarchy.template_id
//                                IN ($project_no)
//                                order by project_template_hierarchy.id;";
//                    $res1 = $this->db->query($query)->result_array();
//                    /*$sql2 = "SELECT * FROM project_template_hierarchy WHERE template_id IS NULL";
//                    $res2 = $this->db->query($sql2);
//                    $result = array_merge($res1->result_array(), $res2->result_array());*/
//                    return $res1;
//                }
//            }
//        }
    }

    // done by jane for inserting template hierarchy
    function insert_template_hierarchy($nodeText,$node, $template_id){
        $sql ="INSERT INTO project_template_hierarchy (template_id, name, text, parent_id) VALUES($template_id, '".$nodeText."', '".$nodeText."', '".$node."')";
        $this->db->query($sql);
        $last_id = "SELECT currval('project_template_hierarchy_id_seq')";
        return $last_id;
    }

    // done by jane for updating template hierarchy
    function update_template_hierarchy($nodeText,$node){
        $sql ="UPDATE project_template_hierarchy SET name='".$nodeText."', text='".$nodeText."' WHERE id= '".$node."'";
        $this->db->query($sql);
    }

    // done by jane for deleting template hierarchy nodes
    function delete_template_hierarchy($node){
        $temp_query = "SELECT parent_id FROM project_template_hierarchy WHERE parent_id='".$node."'";
        $res = $this->db->query($temp_query)->result_array();
        if(empty($res)) {
            $sql = "DELETE FROM project_template_hierarchy WHERE id= '" . $node . "'";
            $this->db->query($sql);
            return true;
        } else{
            return false;
        }
    }

    // done by jane for getting template list
    function get_template_list(){
        $temp_query = "SELECT template_id FROM project_template_hierarchy";
        $res = $this->db->query($temp_query)->result_array();
        if(!empty($res)) {
          
            $sql = "SELECT project_no, project_name FROM project_template WHERE project_no NOT IN (SELECT template_id FROM project_template_hierarchy WHERE template_id IS NOT NULL) order by project_name";
        }else{
            $sql = "SELECT project_no, project_name FROM project_template order by project_name";
        }
        $result = $this->db->query($sql)->result_array();
        return $result;
    }

    // done by jane for getting project list
    function get_projects($ids){
        $query = "SELECT template_id FROM project_template_hierarchy WHERE id IN ($ids)";
        $res = $this->db->query($query)->result_array();
        return $res;
    }

    // done by jane for getting ids for disabling template selection
    function get_disable_ids($session_data){
        $validator_id = $session_data['id'];
                    $query = "SELECT journal_master.project_no FROM journal_master
                    INNER JOIN journal_validator
                    ON journal_master.journal_no = journal_validator.journal_no and journal_validator.validate_user_id = $validator_id";
            $res1 = $this->db->query($query)->result_array();
            if(!empty($res1)) {
                $value_string = "";
                foreach ($res1 as $key => $value) {
                    $p_no = $value['project_no'];
                    $value_string .= "$p_no" . ",";
                }
                $project_no = rtrim($value_string, ',');
                if($project_no){
                    $query = "SELECT project_template_hierarchy.id
                                FROM project_template_hierarchy
                                INNER JOIN project_template
                                ON project_template_hierarchy.template_id = project_template.project_no AND project_template_hierarchy.template_id
                                NOT IN ($project_no)
                                order by project_template_hierarchy.id;";
                    $res1 = $this->db->query($query)->result_array();
                    return $res1;
                }
            }
    }
	
	// to fetch the parent and child name - agaile 05/07/2016
	
	function get_parent_child($ids){
	
	/*echo '<pre>';
	print_r($ids);
	echo '</pre>';
	exit;*/
	$query = "select a.template_id,a.parent_id,b.name as parentname ,a.name as childname from project_template_hierarchy a join project_template_hierarchy b on a.parent_id = b.id where a.id =$ids";
        $res = $this->db->query($query)->result_array();
			if($res[0]['parent_id']==1){
				return $res;
			}else{
			$res1=array();
			$temp_id = $res[0]['template_id'];
			$child = $res[0]['childname'];
			  $temp=$res[0]['parent_id'];
				while($temp!=1){
						$query = "select $temp_id as template_id,a.parent_id,a.name as parentname ,'$child' as childname from project_template_hierarchy a join project_template_hierarchy b on a.parent_id = b.id where a.id =$temp";
						$res1 = $this->db->query($query)->result_array();
						$temp=$res1[0]['parent_id'];
					}
				return $res1;
			}

		}

    function piertype()
    {
        $query = $this->db->get('pier_type');
        $query_result = $query->result();
        return $query_result;
    }
    function pierposition()
    {
        $query = $this->db->get('pier_position');
        $query_result = $query->result();
        return $query_result;
    }
    function add_check_pier($data)
    {
        $data = str_replace("'", "''", $data);
        $query = $this->db->query("SELECT id FROM pier where p_uid='$data'");
        return $query->num_rows();
    }
    function add_piers($data)
    {
        // Inserting in Table data_attribute_group
        $this->db->insert('pier', $data);
        return true;
    }
    // Function To Fetch All Data Attribute Group Record
    function show_pierdata()
    {
        $query = "SELECT * FROM  pier Order By id asc";
        $q = $this->db->query($query);
        return $q->result();
    }
    function delete_check_pierdata($id)
    {

        $query = $this->db->query("SELECT * FROM pier where id=$id");
        return $query->num_rows();
    }

    // Delete the selected record
    function delete_pierdata($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pier');
    }

    function show_leftpier()
    {
        $query = "SELECT id, p_uid FROM pier where pier_position_id=1";
        $q = $this->db->query($query);
        return $q->result();
    }
    function show_rightpier()
    {
        $query = "SELECT id, p_uid FROM pier where pier_position_id=2";
        $q = $this->db->query($query);
        return $q->result();
    }
    //done by jane for checking pier_uid duplication
    function update_check_pier($pier_id,$pieruid)
    {
        $query = $this->db->query("SELECT p_uid FROM pier where id='$pier_id'");
        $re = $query->result();
        if(!empty($re[0]->p_uid)) {
            if ($re[0]->p_uid != $pieruid) {
                $query = $this->db->query("SELECT id FROM pier where p_uid='$pieruid'");
                $re = $query->result();
                return $query->num_rows();
            } else {
                return 0;
            }
        }
    }
    function add_check_piers($data)
    {
        $data=str_replace("'","''",$data);
        $query=$this->db->query("SELECT * FROM pier where p_uid='$data'");
        return $query->num_rows();
    }
    //done by jane for updating pier modified by ANCY MATHEW 28-11-2016
    function update_pier($pier_id, $pieruid,$north,$south,$type){
      //  , pier_position_id='".$pier_position_id."'
        $sql ="UPDATE pier SET p_uid='".$pieruid."',piernorth='".$north."', piersouth='".$south."',pier_type_id='".$type."',modified_on=now() WHERE id= '".$pier_id."'";
        $this->db->query($sql);
    }
    //done by ANCY MATHEW for show the journal category
    function show_journalcategory()
    {
        $query = "SELECT journal_category_id, journal_category_name FROM journal_category";
        $q = $this->db->query($query);
        return $q->result();
    }
    //done by ANCY MATHEW for show all the piers modified by 23-11-2016update_pier
    function show_piers()
    {
        $allpier=array(
            "pier"=>array()
        );
        $query = "SELECT id, p_uid FROM pier";
        $q = $this->db->query($query);
        $rows1=$q->result();
        foreach ($rows1 as $row1):
                $countuid=0;
                $journalname=$row1->p_uid;
                $query3 = "SELECT progrssive_journal_category_id FROM progrssive_journal_category where journal_category_id=2 and journal_name='$journalname'";
                $q3 = $this->db->query($query3);
                $rows3 = $q3->result();
                $countuid=$q3->num_rows();
        if($countuid==0){
            array_push($allpier["pier"], array(
                "id" => $row1->id,
                "p_uid" => $row1->p_uid

            ));
        }
        endforeach;
        return $allpier;
    }
    //done by ANCY MATHEW for show the piers completed
    function show_piers_completed(){
    $pier=array(
        "right"=>array(),
        "left"=>array(),
        "specialspan"=>array()
        );
        $query = "select a.project_name,b.journal_name,b.journal_no,f.frequency_detail_name,e.user_full_name,c.publish_date,d.data_validate_no,d.validate_level_no,g.journal_no,c.data_entry_no from project_template a, journal_master b,journal_data_entry_master c,journal_data_validate_master d,sec_user e,frequency_detail f,progrssive_journal_category g where a.project_no=b.project_no and c.journal_no=g.journal_no and c.journal_no=b.journal_no and c.data_entry_no=d.data_entry_no and d.validate_status=4 and c.publish_user_id=e.user_id and f.frequency_detail_no=c.frequency_detail_no and g.journal_category_id=2";
        $q = $this->db->query($query);
        $rows1=$q->result();
        foreach ($rows1 as $row1):
            $dataentryno=$row1->data_entry_no;
            $query2 = "SELECT data_entry_no, data_attb_id, actual_value, start_value, end_value FROM journal_data_entry_detail where data_entry_no='$dataentryno'";
            $q2 = $this->db->query($query2);
            $rows2=$q2->result();
            $temp=array();
            foreach ($rows2 as $row2):
                if($row2->actual_value==$row2->end_value){
                    $journalname=$row1->journal_name;
                    if (!in_array($row2->data_entry_no, $temp)) {
                        $query3 = "SELECT id, p_uid FROM pier where p_uid ='$journalname'";
                        $q3 = $this->db->query($query3);
                        $rows3 = $q3->result();
                        foreach ($rows3 as $row3):
                            $query4 = "SELECT id from  span_detail where  pier_id_one ='$row3->id' and span_type=1";
                            $q4 = $this->db->query($query4);
                            $cou=$q4->result();
                            $countleft=$q4->num_rows();
                            if ($countleft == 0) {
                                array_push($pier["left"], array(
                                    "id" => $row3->id,
                                    "p_uid" => $row3->p_uid
                                ));
                            }
                            $query5 = "SELECT id from  span_detail where pier_id_two ='$row3->id' and span_type=1";
                            $q5 = $this->db->query($query5);
                            $cour=$q5->result();
                            $countright=$q5->num_rows();
                            if ($countright == 0) {
                                array_push($pier["right"], array(
                                    "id" => $row3->id,
                                    "p_uid" => $row3->p_uid
                                ));
                            }
                            $query5 = "SELECT id from  span_detail where pier_id_one ='$row3->id' and  span_type=2";
                            $q5 = $this->db->query($query5);
                            $cour=$q5->result();
                            $countright=$q5->num_rows();
                            if ($countright == 0) {
                                array_push($pier["specialspan"], array(
                                    "id" => $row3->id,
                                    "p_uid" => $row3->p_uid
                                ));
                            }
                        endforeach;
                    }
                    array_push($temp, $row2->data_entry_no);
                }
            endforeach;
        endforeach;

       return $pier;
    }
    function show_span_completed(){
        $span=array(
            "span_cpmplete"=>array()
        );
        $query = "select a.project_name,b.journal_name,b.journal_no,f.frequency_detail_name,e.user_full_name,c.publish_date,d.data_validate_no,d.validate_level_no,g.journal_no,c.data_entry_no from project_template a, journal_master b,journal_data_entry_master c,journal_data_validate_master d,sec_user e,frequency_detail f,progrssive_journal_category g where a.project_no=b.project_no and c.journal_no=g.journal_no and c.journal_no=b.journal_no and c.data_entry_no=d.data_entry_no and d.validate_status=4 and c.publish_user_id=e.user_id and f.frequency_detail_no=c.frequency_detail_no and g.journal_category_id=1";
        $q = $this->db->query($query);
        $rows1=$q->result();
        foreach ($rows1 as $row1):
            $dataentryno=$row1->data_entry_no;
            $query2 = "SELECT data_entry_no, data_attb_id, actual_value, start_value, end_value FROM journal_data_entry_detail where data_entry_no='$dataentryno'";
            $q2 = $this->db->query($query2);
            $rows2=$q2->result();
            $temp=array();
            foreach ($rows2 as $row2):
                if($row2->actual_value==$row2->end_value){
                    $journalname=$row1->journal_name;
                    if (!in_array($row2->data_entry_no, $temp)) {
                        $query3 = "SELECT journal_no,journal_name FROM progrssive_journal_category where journal_category_id=1 and journal_name='$journalname'";
                        $q3 = $this->db->query($query3);
                        $rows3 = $q3->result();
                        foreach ($rows3 as $row3):
                            $query5 = "SELECT id, journal_no, span_journal_no FROM parapet_detail where  span_journal_no='$row3->journal_no'";
                            $q5 = $this->db->query($query5);
                            $cour=$q5->result();
                            $countspan=$q5->num_rows();
                            if($countspan==0){
                                array_push($span["span_cpmplete"], array(
                                    "journal_no" => $row3->journal_no,
                                    "journal_name" => $row3->journal_name
                                ));
                            }
                        endforeach;
                    }
                    array_push($temp, $row2->data_entry_no);
                }
            endforeach;
        endforeach;
        return $span;
    }
}
?>