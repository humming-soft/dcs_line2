    <?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Journaldataentryadd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('assessment', '', TRUE);
        $this->load->model('design', '', TRUE);
        $this->load->model('securitys', '', TRUE);
        $this->load->library(array('email', 'swiftmailer'));
        $this->load->helper(array('form', 'url', 'general'));
        $this->load->model('alertreminder', '', TRUE);
        $this->load->model('agailemodel', '', TRUE);
        $this->load->model('reminder','',TRUE);
    }

    function test()
    {
        //echo __DIR__;
        $this->load->library("imageresize", array('./journalimage/24/4/26112014174929.png'));
        //$this->imageresize->crop(1900, 1900);
        //$this->imageresize->save('image2.jpg');
    }

    function index($offset = 0)
    {
        // Load Pagination
        $this->load->library('pagination');

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];

            $roleid = $session_data['roleid'];
            $roleperms = $this->securitys->show_permission_object_data($roleid, "3");
            foreach ($roleperms as $roleperm):
                $viewperm = $roleperm->view_opt;
                $addperm = $roleperm->add_opt;
                $editperm = $roleperm->edit_opt;
                $delperm = $roleperm->del_opt;
            endforeach;
            if ($viewperm == 0)
                redirect('/home', 'refresh');

            if ($this->session->userdata('message')) {
                $messagehrecord = $this->session->userdata('message');
                $message = $messagehrecord['message'];
                $type = $messagehrecord['type'];
                $this->session->unset_userdata('message');
            } else {
                $message = '';
                $type = '';
            }
            if ($this->input->get('jid') != "") {

                $id = $this->input->get('jid');
                //ADDED BY ANCY MATHEW
                $jno = $this->assessment->get_journal_no($id);
                $dno = $this->assessment->get_data_entry_no($jno);
                if(($dno == $session_data['id']) ){
                    $this->alertreminder->update_reminder_hide_status($id,$session_data['id']);
                }
                //END BY ANCY MATHEW

            } else {
                $id = "";
            }

            if (!$this->assessment->check_access($session_data['id'], $id) && $roleid != 1) {
                /*if(!$this->assessment->check_access($session_data['id'],$id)){*/
                redirect('/journaldataentry', 'refresh');
            }

            if(!empty($id)) {
                $loginid = $session_data['id'];
                $this->assessment->add_journal_data_entry_detail($id, $loginid);
            }

            //Load all record data
            $data['cpagename'] = 'journaldataentryadd';
            $data['labels'] = $this->securitys->get_label(3);
            $data['labelgroup'] = $this->securitys->get_label_group(3);
            $data['labelobject'] = $this->securitys->get_label_object(3);
            $data['message'] = $message;
            $data['details'] = $this->assessment->show_journal_data_entry($id);

            $data['validators'] = $this->assessment->show_journal_validator($id);
            $data['dataentryattbs'] = $this->assessment->show_journal_data_entry_detail($id);
            $data['lookupdetail'] = $this->assessment->show_lookup_details();
            $data['dataimages'] = $this->assessment->show_journal_data_entry_picture($id);
            $data['reject_note'] = $this->assessment->show_journal_reject_note($id);
            $data['dataentryno'] = $id;
            $data1['username'] = $session_data['username'];
            $data1['alerts'] = $this->alertreminder->show_alert($session_data['id']);
            /*$data1['alertcount'] = $this->alertreminder->count_alert($session_data['id']);*/
            $data1['alertcount']=count($data1['alerts']);
            $data1['reminders'] = $this->alertreminder->show_reminder($session_data['id']);
            $data1['remindercount'] = $this->alertreminder->count_reminder($session_data['id']);
            $data1['alabels'] = $this->securitys->get_label(22);
            $data1['alabelobject'] = $this->securitys->get_label_object(22);
            $data1['rlabels'] = $this->securitys->get_label(23);
            $data1['rlabelobject'] = $this->securitys->get_label_object(23);


            // echo "<br /><br /><br /><br /><br /><br />";
            // echo "<br><br>cpagename<br>"; var_dump($data['cpagename']);
            // echo "<br><br>labels<br>"; var_dump($data['labels']);
            // echo "<br><br>labelgroup<br>"; var_dump($data['labelgroup']);
            // echo "<br><br>labelobject<br>"; var_dump($data['labelobject']);
            // echo "<br><br>message<br>"; var_dump($data['message']);
            // echo "<br><br>details<br>"; var_dump($data['details']);
            // echo "<br><br>validators<br>"; var_dump($data['validators']);
            // echo "<br><br>dataentryattbs<br>"; var_dump($data['dataentryattbs']);
            // echo "<br><br>lookupdetail<br>"; var_dump($data['lookupdetail']);
            // echo "<br><br>dataimages<br>"; var_dump($data['dataimages']);
            // echo "<br><br>dataentryno<br>"; var_dump($data['dataentryno']);
            // echo "<br><br>username<br>"; var_dump($data1['username']);
            // echo "<br><br>alerts<br>"; var_dump($data1['alerts']);
            // echo "<br><br>alertcount<br>"; var_dump($data1['alertcount']);
            // echo "<br><br>reminders<br>"; var_dump($data1['reminders']);
            // echo "<br><br>remindercount<br>"; var_dump($data1['remindercount']);
            // echo "<br><br>alabels<br>"; var_dump($data1['alabels']);
            // echo "<br><br>alabelobject<br>"; var_dump($data1['alabelobject']);
            // echo "<br><br>rlabels<br>"; var_dump($data1['rlabels']);
            // echo "<br><br>rlabelobject<br>"; var_dump($data1['rlabelobject']);


            $data['message_type'] = $type;


            $this->load->view('header', $data1);
            $this->load->view('assess_journalentryadd', $data);
            $this->load->view('footer');
        } else {
            //If no session, redirect to login page
            if ($this->input->get("jid") != "") redirect(make_login_redirect(uri_string() . "?jid=" . $this->input->get("jid")), 'refresh');
            else redirect('login', 'refresh');
        }
    }

    function addimage()
    {
        $this->load->helper('image_upload');
        //upload_image();
    }

// created by agaile 17/11/2015
    function replaceimage()
    {
        $data_entry_pict_no = trim($_POST['data_entry_pic_no']);
        $data_entry_no = trim($_POST['data_entry_no']);
        $data = array();
        if ($data_entry_pict_no != "" && $data_entry_no != "") {
            $result = $this->agailemodel->delete_image_for_replace($data_entry_pict_no, $data_entry_no);
            if ($result) {
                $this->load->helper('image_upload');
            } else {
                $data['status'] = '';
            }
        } else {
            $data['status'] = '';
        }
        echo json_encode($data);
        //$this->load->helper('image_upload');
        //upload_image();
    }

    function updateimage()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('imagedesc1', 'Definition', 'trim|required|xss_clean|max_length[200]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('st' => 0, 'msg' => '', 'msg1' => form_error('imagedesc1')));
        } else {
            $id = $this->input->post('picid');
            $data = array('sec_group_id' => $this->input->post('imagedesc1'));
            //$this->assessment->update_journal_data_entry_picture($id,$data);
            $sess_array = array('message' => "Picture Attached to the Journal", "type" => 1);
            $this->session->set_userdata('message', $sess_array);
            echo json_encode(array('st' => 1, 'msg' => 'Success'));

        }
    }

    function updateimagedesc()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('imagedesc1', 'Definition', 'trim|required|xss_clean|max_length[1000]');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('st' => 0, 'msg' => '', 'msg1' => form_error('imagedesc1')));
        } else {
            $id = $this->input->post('picid');
            $data = array('pict_definition' => $this->input->post('imagedesc1'));
            $this->assessment->update_journal_data_entry_picture($data, $id);
            //$sess_array = array('message' => "Image description has been updated","type" => 1);
            //$this->session->set_userdata('message', $sess_array);
            echo json_encode(array('st' => 1, 'msg' => 'Success'));
        }
    }

    function deleteimage()
    {
        header('Access-Control-Allow-Origin: *');
        $id = $this->input->post('id');
        $dataid = $this->input->post('dataid');
        //query the database
        $result = $this->assessment->delete_journal_data_entry_picture($id);
        $this->assessment->add_seq_journal_data_entry_picture($dataid);

        $result = $this->assessment->show_journal_data_entry_picture($dataid);
        $value = array();
        foreach ($result as $row) {
            array_push($value, array(
                $row->pict_seq_no,
                $row->pict_file_path,
                $row->pict_file_name,
                $row->pict_definition,
                $row->data_entry_pict_no,
                $row->data_entry_no,
            ));
            //$value .=','..','..','..','..','..',777,';
        }
        echo json_encode(array('st' => 1, 'msg' => 'Success', 'imgval' => $value));
    }

    /*function to remove uploaded image from data entry. added by jane*/
    function removeimage()
    {
        header('Access-Control-Allow-Origin: *');
        $dataid = $this->input->post('data_entry_no');
        $pict_user_id = $this->input->post('pict_user_id');
        $pict_file_name = $this->input->post('pict_file_name');
        //query the database
        $result = $this->assessment->remove_journal_data_entry_picture($dataid, $pict_user_id, $pict_file_name);
        echo json_encode(array('st' => 1, 'msg' => 'Success'));
    }

    function greaterthan($input, $limit)
    {
        if ($input > $limit) {
            //echo "INPUT GREATER THAN LIMIT";
            $this->form_validation->set_message('greaterthan', '%s\'s maximum value is ' . $limit);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function lessthan($input, $limit)
    {
        if ($input < $limit) {
            //echo "INPUT LOWER THAN LIMIT";
            $this->form_validation->set_message('lessthan', '%s\'s minimum value is ' . $limit);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function add()
    {
     //echo "inside";
//        exit;
        $this->load->library('form_validation');

        $dataattbcount = $this->input->post('dataattbcount');
        $venki = '';
        for ($i = 1; $i <= $dataattbcount; $i++) {
            $dataattbtype = 'dataattbtype' . $i;
            $dataattb = 'dataattb' . $i;
            $dataattbvalidate = 'dataattbvalidate' . $i;
            $dataattbvalidatedigit = 'dataattbvalidatedigit' . $i;
            $datalabel = 'datalabel' . $i;
            //$datadisable='datadisable'.$i;
            $minvalue = 'minvalue' . $i;
            $maxvalue = 'maxvalue' . $i;
            $previousvalue = 'previousvalue' . $i;
            //var_dump($this->input->post($dataattbtype));
            //var_dump($this->input->post($maxvalue));
            //var_dump($this->input->post($datadisable));

            /*if($this->input->post($datadisable)=="0")
            {*/
            if ($this->input->post($dataattbtype) == "1") {
                if ($this->input->post($dataattbvalidate) == "1") {
                    $this->form_validation->set_rules($dataattb, $this->input->post($datalabel), 'trim|required|xss_clean|integer');
                } else if ($this->input->post($dataattbvalidate) == "3") {
                    $this->form_validation->set_rules($dataattb, $this->input->post($datalabel), 'trim|required|xss_clean|decimal');
                } else {
                    $this->form_validation->set_rules($dataattb, $this->input->post($datalabel), 'trim|required|alpha_numeric_spaces_special|xss_clean');
                }
            } else if ($this->input->post($dataattbtype) == "3") {
                //$minvalueequal=($this->input->post($minvalue)-1);
                //$maxvalueequal=($this->input->post($maxvalue)+1);
                //var_dump($this->form_validation);
                //$this->form_validation->set_rules($dataattb, $this->input->post($datalabel), 'trim|required|xss_clean|greater_than['.$minvalueequal.']|less_than['.$maxvalueequal.']');
                $v_string = 'trim|integer|required|xss_clean';
                $min = $this->input->post($minvalue);
                $max = $this->input->post($maxvalue);
                //var_dump($max);
                if ($min != "") $v_string .= '|callback_lessthan[' . $this->input->post($minvalue) . ']';
                if ($max != "") $v_string .= '|callback_greaterthan[' . $this->input->post($maxvalue) . ']';
                $this->form_validation->set_rules($dataattb, $this->input->post($datalabel), $v_string);
            } else if ($this->input->post($dataattbtype) == "4") {
                $this->form_validation->set_rules($dataattb, $this->input->post($datalabel), 'trim|required|callback_staticcheck[' . $this->input->post($datalabel) . ',' . $this->input->post($previousvalue) . ']|xss_clean');

            } else {
                $this->form_validation->set_rules($dataattb, $this->input->post($datalabel), 'trim|required|alpha_numeric_spaces_special|xss_clean');
            }
            //}
        }

        $status_validation_form = $this->form_validation->run();
        //var_dump($this->form_validation);

        if ($status_validation_form == FALSE) {
            $error = '';
            $dataattbcount = $this->input->post('dataattbcount');
            for ($i = 1; $i <= $dataattbcount; $i++) {
                $dataattb = 'dataattb' . $i;
                $error = form_error($dataattb);
                //var_dump($error);
                if ($error != '')
                    break;
            }
            if (!$this->input->post('isimage')) {
                echo json_encode(array('st' => 0, 'msg' => $error, 'id' => $i));//'id' => $i
            } else //solution for image journal
            {
                $sess_array = array('message' => "Project Journal Data Entry Updated Successfully", "type" => 1);
                $this->session->set_userdata('message', $sess_array);
                echo json_encode(array('st' => 1, 'msg' => 'Image', 'id' => $i));//'id' => $i

            }
        } else {
            $dataid_one = $this->input->post('dataentryno');
            $journal_no =$this->assessment->get_journal_id($dataid_one);
            $dataid = $this->input->post('dataentryno');
            $session_data = $this->session->userdata('logged_in');
            $userid = $session_data['id'];
            $dataattbcount = $this->input->post('dataattbcount');
            for ($i = 1; $i <= $dataattbcount; $i++) {
                $dataattb = 'dataattb' . $i;
                $dataattbid = 'dataattbid' . $i;
                $dataattbtype = 'dataattbtype' . $i;
                $previousvalue = 'previousvalue' . $i;
                $this->assessment->update_journal_data_entry_detail($dataid, $this->input->post($dataattbid), $this->input->post($dataattb), $userid,$journal_no);
            }
            //Coded By ANCY MATHEW 10-01-2017
            //for add the data entry details to the table pier_span_col
            if($journal_no != null){
                $cat_no =$this->assessment->get_cat_id($journal_no);//category of journal eg:1 span,2 pier, 4 others

                if($cat_no !=null){
                    $journalType = $this->assessment->get_journal_type($cat_no);// take category name
                }
                if(strtolower($journalType)=='pier'){
                    for ($i = 1; $i <= $dataattbcount; $i++) {
                        $dataattb = 'dataattb' . $i;
                        $dataattbid = 'dataattbid' . $i;
                        if($this->input->post($dataattbid)==1){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),1);
                        }
                        if($this->input->post($dataattbid)==2){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),2);
                        }
                        if($this->input->post($dataattbid)==3){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),3);
                        }
                        if($this->input->post($dataattbid)==4){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),4);
                        }
                        if($this->input->post($dataattbid)==5){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),5);
                        }
                        if($this->input->post($dataattbid)==6){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),6);
                        }
                        if($this->input->post($dataattbid)==7){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),7);
                        }
                        if($this->input->post($dataattbid)==8){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),8);
                        }
                        if($this->input->post($dataattbid)==9){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),9);
                        }
                        if($this->input->post($dataattbid)==10){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),10);
                        }
                        if($this->input->post($dataattbid)==11){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),11);
                        }
                        if($this->input->post($dataattbid)==12){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),12);
                        }
                        if($this->input->post($dataattbid)==13){
                            $this->assessment->update_pier_span_col($journal_no,$this->input->post($dataattb),13);
                        }

                    }
                }
                if(strtolower($journalType)=='span') {
                    $pier_id=$this->design->get_span_pier_id($journal_no);
                    $pier_uid=$this->design->get_pier_name($pier_id);
                    for ($i = 1; $i <= $dataattbcount; $i++) {
                        $dataattb = 'dataattb' . $i;
                        $dataattbid = 'dataattbid' . $i;

                        if($this->input->post($dataattbid)==18){
                            $this->assessment->update_pier_span_col_span($pier_uid,$this->input->post($dataattb),18);
                        }
                        if($this->input->post($dataattbid)==19){
                            $this->assessment->update_pier_span_col_span($pier_uid,$this->input->post($dataattb),19);
                        }
                        if($this->input->post($dataattbid)==20){
                            $this->assessment->update_pier_span_col_span($pier_uid,$this->input->post($dataattb),20);
                        }
                        if($this->input->post($dataattbid)==15){
                            $this->assessment->update_pier_span_col_span($pier_uid,$this->input->post($dataattb),15);
                        }
                        if($this->input->post($dataattbid)==16){
                            $this->assessment->update_pier_span_col_span($pier_uid,$this->input->post($dataattb),16);
                        }
                    }
                }
                if(strtolower($journalType)=='parapet') {
                    $span_journal_no=$this->design->get_parapet_span_id($journal_no);
                    $pier_id=$this->design->get_span_pier_id($span_journal_no);
                    $pier_uid=$this->design->get_pier_name($pier_id);
                    for ($i = 1; $i <= $dataattbcount; $i++) {
                        $dataattb = 'dataattb' . $i;
                        $dataattbid = 'dataattbid' . $i;
                        if($this->input->post($dataattbid)==21){
                            $this->assessment->update_pier_span_col_parapet($pier_uid,$this->input->post($dataattb),21);
                        }
                        if($this->input->post($dataattbid)==22){
                            $this->assessment->update_pier_span_col_parapet($pier_uid,$this->input->post($dataattb),22);
                        }
                        if($this->input->post($dataattbid)==23){
                            $this->assessment->update_pier_span_col_parapet($pier_uid,$this->input->post($dataattb),23);
                        }

                    }
                }
            }
            //END
            $sess_array = array('message' => "Project Journal Data Entry Updated Successfully", "type" => 1); //1 success , 0 error
            $this->session->set_userdata('message', $sess_array);
            echo json_encode(array('st' => 1, 'msg' => 'Success'));
        }
    }

    function staticcheck($currentvalue, $data)
    {
        $param = preg_split('/,/', $data);
        $label = $param[0];
        $previousvalue = $param[1];
        if ($previousvalue == "Yes") {
            if ($currentvalue == "No") {
                $this->form_validation->set_message('staticcheck', 'The ' . $label . ' field must be Yes.');
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function varient()
    {
        $varientcount = $this->input->post('varientcount');
        $error = '';
        for ($i = 1; $i <= $varientcount; $i++) {
            $chkvarient = 'chkvarient' . $i;
            if ($this->input->post($chkvarient) != "on") {
                $error = 'off';
            }
        }
        if ($error != '') {
            echo json_encode(array('st' => 0, 'msg' => 'You can only save when you accept the varient'));
        } else {

            for ($i = 1; $i <= $varientcount; $i++) {
                $chkvarient = 'chkvarient' . $i;
                $dataentry = 'dataentry' . $i;
                $dataattb = 'dataattb' . $i;
                $varientvalue = 'varientvalue' . $i;
                if ($this->input->post($chkvarient) == "on") {
                    $qu = $this->assessment->update_varient_journal_data_entry_detail($this->input->post($dataentry), $this->input->post($dataattb), $this->input->post($varientvalue));
                }
                $id = $this->input->post($dataentry);
            }
            $session_data = $this->session->userdata('logged_in');
            $userid = $session_data['id'];
            $this->assessment->publish_journal_data_entry($id, $userid);

            //Email
            $emailres = $this->assessment->publish_journal_data_entry_email($id, $userid);
            foreach ($emailres as $rows):
                $datavalidateno = $rows->data_validate_no;
                $journalno = $rows->journal_no;
                $journalname = $rows->journalname;
                $dataentryname = $rows->dataentryname;
                $validatorname = $rows->validatorname;
                $validatoremail = $rows->validatoremail;
                $validatorid = $rows->validatorid;
            endforeach;

            /*$this->email->from('test@hummingsoft.com.my', 'MPXD');
            $this->email->to($validatoremail);
            $message="Dear ".$validatorname.", <br>".$journalname." data entry published by ".$dataentryname.".Now the journal is ready for validation";
            $this->email->subject($journalname.' data entry completed');
            $this->email->message($message);
            $this->email->send();*/

            $data = array('alert_date' => date("Y-m-d"), 'alert_user_id' => $validatorid, 'data_entry_no' => $id, 'alert_message' => 'Data Entry Published', 'alert_hide' => '0', 'email_send_option' => '1');

            $this->assessment->add_user_alert($data);
            $this->load->model('mailermodel');
            $this->mailermodel->insert_queue_published($validatorid, 'progressive', $id);
            //$this->swiftmailer->data_entry_published_progressive($validatoremail, $validatorname, $dataentryname, $journalname, $datavalidateno);

            $sess_array = array('message' => "Project Journal Data Entry Updated Successfully", "type" => 1);
            $this->session->set_userdata('message', $sess_array);
            echo json_encode(array('st' => 1, 'msg' => 'Success'));
        }
    }

    function publish()
    {
        $this->load->helper('journal_publish');
        /*call reminder update function*/
        $this->update();
        /*$reminders_controller = new Reminders();
        $reminders_controller->update();*/
    }

    function updateimgsequence()
    {
        $seqs = $this->input->post('seqs');
        $seqs = rtrim($seqs, ',');
        $eachseq = explode(',', $seqs);
        foreach ($eachseq as $s) {
            $t = explode(':', $s);
            $this->assessment->update_seq_journal_data_entry_picture($t[0], $t[1]);
        }
    }
    /*function to update reminders*/
    function update(){
        $this->reminder->update_reminder();
    }
}

?>