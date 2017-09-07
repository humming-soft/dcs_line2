<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class duplication_parapet extends CI_Controller
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
            "SB01-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SB01-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SB02-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SB02-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SB03-R-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SB03-R",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SB04-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SB04-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SB05-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SB05-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SB06-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SB06-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SB07-L-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SB07-L",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SB07-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SB07-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SB08-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SB08-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SB09-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SB09-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SB10-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SB10-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SB11-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SB11-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SB12-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SB12-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SB13-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SB13-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SB14-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SB14-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SB15-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SB15-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SB16-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SB16-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD01-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD01-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD02-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD02-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD03-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD03-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD04-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD04-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD05-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD05-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD06-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD06-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD07-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD07-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD08-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD08-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD09-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD09-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD10-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD10-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD11-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"DD11-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"DD12-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD12-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD13-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD13-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD14-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD14-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD15-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD15-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD16-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD16-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD17-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD17-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD18-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD18-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD19-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD19-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD20-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD20-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD21-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD21-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD22-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD22-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD23-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD23-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD24-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD24-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD25-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD25-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD26-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD26-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD27-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD27-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD28-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD28-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD29-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD29-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD30-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD30-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD31-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD31-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD32-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD32-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD33-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD33-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD34-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD34-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD35-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD35-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD36-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD36-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD37-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD37-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD38-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD38-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD39-R-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD39-R",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD40-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD40-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD41-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD41-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD42-L-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD42-L",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD42-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD42-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD43-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD43-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD44-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD44-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD45-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD45-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD46-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD46-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"DD47-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"DD47-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDW01-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW01-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDW02-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW02-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW03-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW03-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW04-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW04-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW05-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW05-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW06-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW06-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW07-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW07-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW08-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW08-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW09-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW09-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW10-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW10-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW11-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW11-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW12-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW12-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW13-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW13-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW14-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW14-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW15-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW15-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW16-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW16-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW17-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW17-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW18-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW18-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW19-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW19-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW20-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW20-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW21-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW21-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW22-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW22-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW23-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW23-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW24-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW24-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW25-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW25-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW26-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW26-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW27-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW27-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW28-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW28-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW29-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW29-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW30-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW30-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW31-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW31-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW32-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW32-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW33-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW33-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW34-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW34-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW35-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW35-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW36-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW36-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW37-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW37-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW38-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW38-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW39-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW39-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW40-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW40-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),
            "SDW41-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDW41-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE01-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE01-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE02-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE02-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE03-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE03-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE04-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE04-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE05-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE05-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE06-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE06-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE07-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE07-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE08-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE08-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE09-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE09-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE10-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE10-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE11-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE11-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE12-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE12-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE13-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE13-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE14-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE14-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE15-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE15-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE16-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE16-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE17-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE17-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE18-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE18-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE19-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE19-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE20-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE20-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE21-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE21-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE22-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE22-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE23-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE23-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE24-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE24-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE25-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE25-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            )
        );
        $V202 = array(
            "SDE26-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE26-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),  "SDE27-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE27-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "SDE28-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE28-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "SDE29-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE29-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "SDE30-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE30-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "SDE31-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE31-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "SDE32-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"SDE32-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"SDE33-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SDE33-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SDE34-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SDE34-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SDE35-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SDE35-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SDE36-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SDE36-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SDE37-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SDE37-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"SDE38-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"SDE38-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS01-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS01-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS02-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS02-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS03-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS03-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS04-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS04-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS05-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS05-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS06-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS06-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS07-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS07-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS08-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS08-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS09-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS09-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ), "KS10-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS10-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS11-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS11-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS12-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS12-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS13-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS13-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS14-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS14-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS15-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS15-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS16-R-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS16-R",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS17-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS17-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS18-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS18-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS19-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS19-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS20-L-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS20-L",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS20-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS20-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS21-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS21-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS22-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS22-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS23-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS23-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS24-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS24-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS25-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS25-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS26-R-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS26-R",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS27-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS27-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS28-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS28-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS29-L-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS29-L",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS29-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS29-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS30-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS30-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS31-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS31-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS32-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS32-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS33-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS33-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS34-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS34-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS35-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS35-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS36-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS36-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS37-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS37-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ), "KS38-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KS38-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KS39-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS39-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS40-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS40-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS41-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS41-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS42-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS42-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS43-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS43-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS44-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS44-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KS45-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KS45-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP01-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP01-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP02-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP02-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP03-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP03-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP04-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP04-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP05-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP05-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP06-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP06-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP07-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP07-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP08-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP08-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP09-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP09-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"MP10-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP10-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"
            ),
                "MP11-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP11-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP12-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP12-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP13-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP13-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP14-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP14-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP15-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP15-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP16-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP16-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP17-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP17-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP18-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP18-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP19-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP19-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP20-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP20-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP21-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP21-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP22-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP22-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP23-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP23-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP24-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP24-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP25-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP25-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP26-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP26-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),
            "MP27-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP27-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),
            "MP28-PARAPET" => array("type" => 3,
                "journal_defnition" => "",
                "span"=>"MP28-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1",
                "parapet-3" => "23,0,1,1"

            ),"MP29-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"MP29-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB01-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB01-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB02-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB02-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB03-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB03-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB04-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB04-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB05-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB05-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB06-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB06-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB07-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB07-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB08-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB08-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB09-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB09-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB10-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB10-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB11-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB11-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB12-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB12-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB13-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB13-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB14-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB14-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB15-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB15-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB16-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB16-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB17-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB17-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB18-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB18-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB19-PARAPET" => array("type" => 1,
                "journal_defnition" => "",
                "span"=>"KB19-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1"

            ),"KB20-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB20-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB21-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB21-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB22-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB22-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB23-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB23-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB24-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB24-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"KB25-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"KB25-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS01-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS01-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS02-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS02-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS03-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS03-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS04-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS04-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS05-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS05-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS06-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS06-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS07-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS07-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS08-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS08-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS09-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS09-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS10-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS10-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),"JS11-PARAPET" => array("type" => 2,
                "journal_defnition" => "",
                "span"=>"JS11-SPAN",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "parapet-1" => "21,0,1,1",
                "parapet-2" => "22,0,1,1"

            ),
        );
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
                            $datacategory = array('journal_no' => $journalid, 'journal_category_id' => 4, 'journal_name' => $name);
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
                                $para1 = explode(',', $prop['parapet-1']);
                                if ($x = 1) {
                                    $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $para1[0], 'start_value' => $para1[1], 'end_value' => $para1[2], 'frequency_max_value' => $para1[3], 'display_seq_no' => $x);
                                    $this->duplicationmodel->add_journal_detail($dataattbdata);
                                }
                                $spanvalue=$this->design->get_span_journal($prop['span']);
                                $parapetdata=array('journal_no'=>$journalid,'span_journal_no'=>$spanvalue);
                                $this->design->add_parapet_detail($parapetdata);
                                break;
                            case 2 :
                                $x = 1;
                                $para1 = explode(',', $prop['parapet-1']);
                                $para2 = explode(',', $prop['parapet-2']);
                                while ($x < 2) {
                                    if ($x = 1) {
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $para1[0], 'start_value' => $para1[1], 'end_value' => $para1[2], 'frequency_max_value' => $para1[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }if($x = 2){
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $para2[0], 'start_value' => $para2[1], 'end_value' => $para2[2], 'frequency_max_value' => $para2[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }
                                    $x++;
                                }
                                $spanvalue=$this->design->get_span_journal($prop['span']);
                                $parapetdata=array('journal_no'=>$journalid,'span_journal_no'=>$spanvalue);
                                $this->design->add_parapet_detail($parapetdata);
                                break;
                            case 3 : $x=1;
                                $para1 = explode(',', $prop['parapet-1']);
                                $para2 = explode(',', $prop['parapet-2']);
                                $para3 = explode(',', $prop['parapet-3']);
                                while($x < 3){
                                    if ($x = 1) {
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $para1[0], 'start_value' => $para1[1], 'end_value' => $para1[2], 'frequency_max_value' => $para1[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }if($x = 2){
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $para2[0], 'start_value' => $para2[1], 'end_value' => $para2[2], 'frequency_max_value' => $para2[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }if($x = 3){
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $para3[0], 'start_value' => $para3[1], 'end_value' => $para3[2], 'frequency_max_value' => $para3[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }
                                    $x++;
                                }
                                $spanvalue=$this->design->get_span_journal($prop['span']);
                                $parapetdata=array('journal_no'=>$journalid,'span_journal_no'=>$spanvalue);
                                $this->design->add_parapet_detail($parapetdata);
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
            echo "------".$i_count." Parapet Inserted------";
            echo "<br>";
            foreach ($span['Inserted'] as $pname) {
                echo $pname['SPAN_NAME'];
                echo "<br>";
            }
            echo "<br>";
            echo "------".$s_count." Parapet  Not-Inserted------";
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