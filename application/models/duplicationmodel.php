<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

Class duplicationmodel extends CI_Model
{
    // Function to fetch total number of Data Attribute Group records

    function get_project_id($name)
    {
        $query=$this->db->query("SELECT project_no FROM project_template where project_name='$name'");
        $rows=$query->result();
        $count=$query->num_rows();
        if($count==1){
            foreach ($rows as $row):
                $project_no=$row->project_no;
            endforeach;
            return $project_no;
        }else{
            return 0;
        }

    }
    function add_check_journal($data,$projectno)
    {
        $data=str_replace("'","''",$data);
        $query=$this->db->query("select journal_name from journal_master where journal_name='$data'");
        return $query->num_rows();
    }
    function add_journal($data,$projectno,$name)
    {
        // Inserting in Table Journal Master
        $this->db->insert('journal_master', $data);
        $query=$this->db->query("select journal_no from journal_master where journal_name='$name'");
        $rows=$query->result();
        foreach ($rows as $row):
            $journalno=$row->journal_no;
        endforeach;
        return $journalno;
    }
    function add_category_detail($data)
    {
        // Inserting in Table Journal Detail
        return $this->db->insert('progrssive_journal_category', $data);

    }
    function add_journal_validator($data)
    {
        // Inserting in Table Journal Validator
        $this->db->insert('journal_validator', $data);
    }
    function add_journal_data_entry($data)
    {
        // Inserting in Table Journal Data User
        $this->db->insert('journal_data_user', $data);
    }
    function add_journal_detail($data)
    {
        // Inserting in Table Journal Detail
        return $this->db->insert('journal_detail', $data);

    }
    //Function to Fetch All Frequency
    function show_frequency_detail_no($date)
    {
        $sql="select frequency_detail_no from frequency_detail where '$date' between start_date and end_date";
        $query = $this->db->query($sql);
        $query_result = $query->result();
        foreach ($query_result as $row):
            $frequencyno=$row->frequency_detail_no;
        endforeach;
        return $frequencyno;
    }
    function add_journal_data_entry_master($data)
    {
        // Inserting in Table Journal Data Entry Master
        $this->db->insert('journal_data_entry_master', $data);
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
}
?>