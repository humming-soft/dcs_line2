<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class duplication extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('duplicationmodel', '', TRUE);
        $this->load->model('design','',TRUE);

    }
    //Author:ANCY MATHEW
    //Code for journal duplication for span
    //call Via URL- pass the project name( http://localhost/dcs_line2/index.php/duplication?project=V201 Project Progress)
    //"Left Span" => "15,0,1,1","Right Span" => "16,0,1,1","Span-1" => "18,0,1,1","Span-2"=> "19,0,1,1","Span-3" => "20,0,1,1"
    //type 1- span 1
    //type 2 -span1, span 2
    //type 3 -span1, span 2,span 3
    //type 4 -left only
    //type 5 -right only
    //type 6 -left and right
    function index()
    {
        $start_date="2017-01-05";
        $V201 = array(
            "SB01-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SB01",
                "right_pier"=>"SB02",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ), "SB02-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SB02",
                "right_pier"=>"SB03",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"
            ),
                "SB03-L" => array("type" => 4,
                "journal_defnition" => "",
                "left_pier"=>"SB03",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,1,1"
        ),
            "SB04-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"SB04",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,1,1",
                "Right_Span" => "16,0,1,1"

            ), "SB05-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"SB05",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,1,1",
                "Right_Span" => "16,0,1,1"

            ), "SB06-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"SB06",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,1,1",
                "Right_Span" => "16,0,1,1"

            ), "SB07-R" => array("type" => 5,
                "journal_defnition" => "",
                "left_pier"=>"SB07",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Right_Span" => "16,0,1,1"

            ), "SB07-SPAN" => array("type" => 5,
                "journal_defnition" => "",
                "left_pier"=>"",
                "right_pier"=>"",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"


            ), "SB08-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"",
                "right_pier"=>"",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SB09-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"",
                "right_pier"=>"",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),  "SB10-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"",
                "right_pier"=>"",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),  "SB11-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"",
                "right_pier"=>"",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            )
            );
        $V202 = array();
        $V203 = array();
        $V204 = array();
        $V205 = array();
        $V206 = array();
        $V207 = array();
        $V208 = array();
        $V209 = array();
        $V210 = array();
        $projectName = $this->input->get('project');
        //$start_d=$this->input->get('date');
        //echo $start_d;
       // echo $projectName;
        $project_id = $this->duplicationmodel->get_project_id($projectName); //get  project id using project name
        //echo $project_id;
        $i_count = 0;//How much journal inserted
        $s_count = 0;//How much Journal skipped
        $dependency = "";
        $span=array(
            "Inserted"=>array(),
            "Not_Inserted"=>array()
        );
        if ($project_id != 0) {//check the project in the data base
            if($projectName == 'V201 Construction Progress'){
                $viaduct=$V201;
                $via="v201";
            }
            if($projectName == 'V202 Construction Progress'){
                $viaduct=$V202;
                $via="v202";
            }
            if($projectName == 'V203 Construction Progress'){
                $viaduct=$V203;
                $via="v203";
            }
            if($projectName == 'V204 Construction Progress'){
                $viaduct=$V204;
                $via="v204";
            }
            if($projectName == 'V205 Construction Progress'){
                $viaduct=$V205;
                $via="v205";
            }
            if($projectName == 'V206 Construction Progress'){
                $viaduct=$V206;
                $via="v206";
            }
            if($projectName == 'V207 Construction Progress'){
                $viaduct=$V207;
                $via="v207";
            }
            if($projectName == 'V208 Construction Progress'){
                $viaduct=$V208;
                $via="v208";
            }
            if($projectName == 'V209 Construction Progress'){
                $viaduct=$V209;
                $via="v209";
            }
            if($projectName == 'V210 Construction Progress'){
                $viaduct=$V210;
                $via="v210";
            }
            foreach ($viaduct as $name => $prop) {
                if ($name != null) {
                    if($this->duplicationmodel->add_check_pier($name)==0) {
                        $data = array('p_uid' => $name, 'pier_type_id' => 1);
                        $this->duplicationmodel->add_piers($data);
                    }
                    $viaductName=$via;
                    if ($this->duplicationmodel->add_check_journal($name, $project_id) == 0)//check the journal name is already exist or not
                    {
                        $data = array('project_no' => $project_id, 'journal_name' => $name, 'journal_property' => $prop['journal_property'], 'user_id' => $prop['user_id'], 'start_date' => $prop['start_date'], 'end_date' => $prop['end_date'], 'frequency_no' => $prop['frequency_no'], 'dependency' => $dependency, 'is_image' => 0, 'album_name' => $prop['album_name']);
                        $journalid = $this->duplicationmodel->add_journal($data, $project_id, $name);
                        if ($journalid) {
                            $datacategory = array('journal_no' => $journalid, 'journal_category_id' => 2, 'journal_name' => $name);
                            $this->duplicationmodel->add_category_detail($datacategory);
                        }
                        $validatordata = array('journal_no' => $journalid, 'validate_user_id' => 14, 'validate_level_no' => 1);
                        $this->duplicationmodel->add_journal_validator($validatordata);
                        $dataentrydata = array('journal_no' => $journalid, 'data_user_id' => 24, 'default_owner_opt' => '1');
                        $this->duplicationmodel->add_journal_data_entry($dataentrydata);
                        //"Left Span" => "15,0,1,1","Right Span" => "16,0,1,1","Span-1" => "18,0,1,1","Span-2"=> "19,0,1,1","Span-3" => "20,0,1,1"
                        switch ($prop['type']) {
                            case 1  :
                                $x = 1;
                                $span1 = explode(',', $prop['Span-1']);
                                    if ($x = 1) {
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $span1[0], 'start_value' => $span1[1], 'end_value' => $span1[2], 'frequency_max_value' => $span1[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }
                                $left_pier_id=$this->design->get_pierid($prop['left_pier']);
                                $right_pier_id=$this->design->get_pierid($prop['right_pier']);
                                $spandata=array('journal_id'=>$journalid,'pier_id_one'=>$left_pier_id,'pier_id_two'=>$right_pier_id,'span_type'=>2,'span_count'=>1);
                                $this->design->add_span_detail($spandata);
                                break;
                            case 2 :
                                $x = 1;
                                $span1 = explode(',', $prop['Span-1']);
                                $span2 = explode(',', $prop['Span-2']);
                                while ($x < 2) {
                                    if ($x = 1) {
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $span1[0], 'start_value' => $span1[1], 'end_value' => $span1[2], 'frequency_max_value' => $span1[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }if($x = 2){
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $span2[0], 'start_value' => $span2[1], 'end_value' => $span2[2], 'frequency_max_value' => $span2[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }
                                    $x++;
                                }
                                $left_pier_id=$this->design->get_pierid($prop['left_pier']);
                                $right_pier_id=$this->design->get_pierid($prop['right_pier']);
                                $spandata=array('journal_id'=>$journalid,'pier_id_one'=>$left_pier_id,'pier_id_two'=>$right_pier_id,'span_type'=>2,'span_count'=>2);
                                $this->design->add_span_detail($spandata);
                                break;
                            case 3 : $x=1;
                                $span1 = explode(',', $prop['Span-1']);
                                $span2 = explode(',', $prop['Span-2']);
                                $span3 = explode(',', $prop['Span-3']);
                                    while($x < 3){
                                        if ($x = 1) {
                                            $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $span1[0], 'start_value' => $span1[1], 'end_value' => $span1[2], 'frequency_max_value' => $span1[3], 'display_seq_no' => $x);
                                            $this->duplicationmodel->add_journal_detail($dataattbdata);
                                        }if($x = 2){
                                            $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $span2[0], 'start_value' => $span2[1], 'end_value' => $span2[2], 'frequency_max_value' => $span2[3], 'display_seq_no' => $x);
                                            $this->duplicationmodel->add_journal_detail($dataattbdata);
                                        }if($x = 3){
                                            $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $span3[0], 'start_value' => $span3[1], 'end_value' => $span3[2], 'frequency_max_value' => $span3[3], 'display_seq_no' => $x);
                                            $this->duplicationmodel->add_journal_detail($dataattbdata);
                                        }
                                       $x++;
                                    }
                                $left_pier_id=$this->design->get_pierid($prop['left_pier']);
                                $right_pier_id=$this->design->get_pierid($prop['right_pier']);
                                $spandata=array('journal_id'=>$journalid,'pier_id_one'=>$left_pier_id,'pier_id_two'=>$right_pier_id,'span_type'=>2,'span_count'=>3);
                                $this->design->add_span_detail($spandata);
                                break;
                            case 4 :$x=1;
                                $Left_Span = explode(',', $prop['Left_Span']);
                                    if ($x = 1) {
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $Left_Span[0], 'start_value' => $Left_Span[1], 'end_value' => $Left_Span[2], 'frequency_max_value' => $Left_Span[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }
                                $spandata=array('journal_id'=>$journalid,'pier_id_one'=>$prop['left_pier'],'pier_id_two'=>$prop['left_pier'],'span_type'=>1,'span_count'=>0);
                                $this->design->add_span_detail($spandata);
                                break;
                            case 5 :$x=1;
                                $Right_Span = explode(',', $prop['Right_Span']);

                                    if ($x = 1) {
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $Right_Span[0], 'start_value' => $Right_Span[1], 'end_value' => $Right_Span[2], 'frequency_max_value' => $Right_Span[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }
                                $left_pier_id=$this->design->get_pierid($prop['left_pier']);
                                $right_pier_id=$this->design->get_pierid($prop['right_pier']);
                                $spandata=array('journal_id'=>$journalid,'pier_id_one'=>$left_pier_id,'pier_id_two'=>$right_pier_id,'span_type'=>1,'span_count'=>0);
                                $this->design->add_span_detail($spandata);
                                break;
                            case 6 :$x = 1;
                                $Left_Span = explode(',', $prop['Left_Span']);
                                $Right_Span = explode(',', $prop['Right_Span']);
                                    while ($x < 2) {
                                        if ($x = 1) {
                                            $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $Left_Span[0], 'start_value' => $Left_Span[1], 'end_value' => $Left_Span[2], 'frequency_max_value' => $Left_Span[3], 'display_seq_no' => $x);
                                            $this->duplicationmodel->add_journal_detail($dataattbdata);
                                        }if($x = 2){
                                            $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $Right_Span[0], 'start_value' => $Right_Span[1], 'end_value' => $Right_Span[2], 'frequency_max_value' => $Right_Span[3], 'display_seq_no' => $x);
                                            $this->duplicationmodel->add_journal_detail($dataattbdata);
                                        }
                                        $x++;
                                    }
                                        $left_pier_id=$this->design->get_pierid($prop['left_pier']);
                                        $right_pier_id=$this->design->get_pierid($prop['right_pier']);
                                        $spandata=array('journal_id'=>$journalid,'pier_id_one'=>$left_pier_id,'pier_id_two'=>$right_pier_id,'span_type'=>1,'span_count'=>0);
                                        $this->design->add_span_detail($spandata);
                                    break;
                            default :
                                break;
                        }
                        $frequencystart=$this->duplicationmodel->show_frequency_detail_no($prop['start_date']);
                        $session_data = $this->session->userdata('logged_in');
                        $loginid = $session_data['id'];
                        if($prop['end_date']!='')
                        {
                            $frequencyend=$this->duplicationmodel->show_frequency_detail_no($prop['end_date']);
                            for($j=$frequencystart;$j<=$frequencyend;$j++)
                            {
                                if($j==$frequencystart)
                                    $status="1";
                                else
                                    $status="0";
                                $frequencydata=array('journal_no'=>$journalid,'frequency_detail_no'=>$j,'data_entry_status_id'=>$status,'created_user_id'=>$loginid,'created_date'=>date("Y-m-d"));
                                $this->duplicationmodel->add_journal_data_entry_master($frequencydata);
                            }
                        }
                        else
                        {
                            $frequencydata=array('journal_no'=>$journalid,'frequency_detail_no'=>$frequencystart,'data_entry_status_id'=>'1','created_user_id'=>$loginid,'created_date'=>date("Y-m-d"));
                            $this->duplicationmodel->add_journal_data_entry_master($frequencydata);
                        }
                        array_push($span["Inserted"], array(
                            "SPAN_NAME" => $name
                        ));
                        $i_count++;
                    } else {
                        array_push($span["Not_Inserted"], array(
                            "SPAN_NAME" => $name
                        ));
                        $s_count++;
                    }
                }
            }
            echo "------".$i_count." Span Inserted------";
            echo "<br>";
            foreach ($span['Inserted'] as $pname) {
                echo $pname['SPAN_NAME'];
                echo "<br>";
            }
            echo "<br>";
            echo "------".$s_count." Span  Not-Inserted------";
            echo "<br>";
            foreach ($span['Not_Inserted'] as $pname) {
                echo $pname['SPAN_NAME'];
                echo "<br>";
            }
        }
        else{
                echo "First you crate the project";
        }

    }
}
?>