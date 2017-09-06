<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class duplication_span extends CI_Controller
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
                "SB03-R" => array("type" => 4,
                "journal_defnition" => "",
                "left_pier"=>"SB03",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Right_Span" => "16,0,5,5"
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
                "Left_Span" => "15,0,17,17",
                "Right_Span" => "16,0,17,17"

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
                "Left_Span" => "15,0,17,17",
                "Right_Span" => "16,0,17,17"

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
                "Left_Span" => "15,0,12,12",
                "Right_Span" => "16,0,13,13"

            ), "SB07-L" => array("type" => 5,
                "journal_defnition" => "",
                "left_pier"=>"SB07",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "16,0,4,4"

            ), "SB07-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SB07",
                "right_pier"=>"SB08",
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
                "left_pier"=>"SB08",
                "right_pier"=>"SB09",
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
                "left_pier"=>"SB09",
                "right_pier"=>"SB10",
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
                "left_pier"=>"SB10",
                "right_pier"=>"SB11",
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
                "left_pier"=>"SB11",
                "right_pier"=>"SB12",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SB12-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SB12",
                "right_pier"=>"SB13",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SB13-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SB13",
                "right_pier"=>"SB14",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SB14-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SB14",
                "right_pier"=>"SB15",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SB15-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SB15",
                "right_pier"=>"SB16",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SB16-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SB16",
                "right_pier"=>"DD01",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD01-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD01",
                "right_pier"=>"DD02",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD02-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD02",
                "right_pier"=>"DD03",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD03-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD03",
                "right_pier"=>"DD04",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD04-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD04",
                "right_pier"=>"DD05",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD05-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD05",
                "right_pier"=>"DD06",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD06-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD06",
                "right_pier"=>"DD07",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD07-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD07",
                "right_pier"=>"DD08",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD08-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD08",
                "right_pier"=>"DD09",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD09-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD09",
                "right_pier"=>"DD10",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD10-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD10",
                "right_pier"=>"DD11",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD11-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"DD11",
                "right_pier"=>"DD12",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"DD12-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD12",
                "right_pier"=>"DD13",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD13-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD13",
                "right_pier"=>"DD14",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD14-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD14",
                "right_pier"=>"DD15",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD15-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD15",
                "right_pier"=>"DD16",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD16-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD16",
                "right_pier"=>"DD17",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD17-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD17",
                "right_pier"=>"DD18",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD18-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD18",
                "right_pier"=>"DD19",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD19-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD19",
                "right_pier"=>"DD20",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD20-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD20",
                "right_pier"=>"DD21",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD21-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD21",
                "right_pier"=>"DD22",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD22-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD22",
                "right_pier"=>"DD23",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD23-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD23",
                "right_pier"=>"DD24",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD24-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD24",
                "right_pier"=>"DD25",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD25-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD25",
                "right_pier"=>"DD26",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD26-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD26",
                "right_pier"=>"DD27",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD27-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD27",
                "right_pier"=>"DD28",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD28-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD28",
                "right_pier"=>"DD29",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD29-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD29",
                "right_pier"=>"DD30",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD30-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD30",
                "right_pier"=>"DD31",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD31-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD31",
                "right_pier"=>"DD32",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD32-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD32",
                "right_pier"=>"DD33",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD33-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD33",
                "right_pier"=>"DD34",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD34-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD34",
                "right_pier"=>"DD35",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD35-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD35",
                "right_pier"=>"DD36",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD36-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD36",
                "right_pier"=>"DD37",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD37-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD37",
                "right_pier"=>"DD38",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),
            "DD38-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD38",
                "right_pier"=>"DD39",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD39-R" => array("type" => 4,
                "journal_defnition" => "",
                "left_pier"=>"DD39",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Right_Span" => "16,0,6,6"

            ),"DD40-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"DD40",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,15,15",
                "Right_Span" => "16,0,15,15"
            ),"DD41-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"SB05",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,15,15",
                "Right_Span" => "16,0,15,15"
            ),"DD42-L" => array("type" => 5,
                "journal_defnition" => "",
                "left_pier"=>"DD42",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "16,0,5,5"
            ),"DD42-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD42",
                "right_pier"=>"DD43",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD43-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD43",
                "right_pier"=>"DD44",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD44-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD44",
                "right_pier"=>"DD45",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD45-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD45",
                "right_pier"=>"DD46",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD46-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD46",
                "right_pier"=>"DD47",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD47-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD47",
                "right_pier"=>"DD48",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"DD48-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"DD48",
                "right_pier"=>"SDW01",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW01-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW01",
                "right_pier"=>"SDW02",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW02-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW02",
                "right_pier"=>"SDW03",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW03-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW03",
                "right_pier"=>"SDW04",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW04-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW04",
                "right_pier"=>"SDW05",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW05-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW05",
                "right_pier"=>"SDW06",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW06-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW06",
                "right_pier"=>"SDW07",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW07-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW07",
                "right_pier"=>"SDW08",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW08-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW08",
                "right_pier"=>"SDW09",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW09-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW09",
                "right_pier"=>"SDW10",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW10-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW10",
                "right_pier"=>"SDW11",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW11-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW11",
                "right_pier"=>"SDW12",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW12-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW12",
                "right_pier"=>"SDW13",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW13-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW13",
                "right_pier"=>"SDW14",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW14-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW14",
                "right_pier"=>"SDW15",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW15-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW15",
                "right_pier"=>"SDW16",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW16-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW16",
                "right_pier"=>"SDW17",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW17-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW17",
                "right_pier"=>"SDW18",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW18-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW18",
                "right_pier"=>"SDW19",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW19-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW19",
                "right_pier"=>"SDW20",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW20-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW20",
                "right_pier"=>"SDW21",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW21-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW21",
                "right_pier"=>"SDW22",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW22-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW22",
                "right_pier"=>"SDW23",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW23-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW23",
                "right_pier"=>"SDW24",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW24-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW24",
                "right_pier"=>"SDW25",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW25-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW25",
                "right_pier"=>"SDW26",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW26-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW26",
                "right_pier"=>"SDW27",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW27-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW27",
                "right_pier"=>"SDW28",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW28-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW28",
                "right_pier"=>"SDW29",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW29-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW29",
                "right_pier"=>"SDW30",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW30-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW30",
                "right_pier"=>"SDW31",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW31-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW31",
                "right_pier"=>"SDW32",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW32-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW32",
                "right_pier"=>"SDW33",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW33-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW33",
                "right_pier"=>"SDW34",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW34-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW34",
                "right_pier"=>"SDW35",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDW35-R" => array("type" => 4,
                "journal_defnition" => "",
                "left_pier"=>"SDW35",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Right_Span" => "16,0,5,5"

            ),"SDW36-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"SDW36",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,13,13",
                "Right_Span" => "16,0,13,13"
            ),"SDW37-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"SDW37",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,13,13",
                "Right_Span" => "16,0,13,13"
            ),"SDW38-L" => array("type" => 5,
                "journal_defnition" => "",
                "left_pier"=>"SDW38",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "16,0,5,5"
            ),"SDW38-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDW38",
                "right_pier"=>"SDW39",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

    ),"SDW39-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDW39",
        "right_pier"=>"SDW40",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDW40-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDW40",
        "right_pier"=>"SDW41",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDW41-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDW41",
        "right_pier"=>"SDE01",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE01-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE01",
        "right_pier"=>"SDE02",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE02-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE02",
        "right_pier"=>"SDE03",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE03-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE03",
        "right_pier"=>"SDE04",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE04-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE04",
        "right_pier"=>"SDE05",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE05-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE05",
        "right_pier"=>"SDE06",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE06-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE06",
        "right_pier"=>"SDE07",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE07-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE07",
        "right_pier"=>"SDE08",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE08-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE08",
        "right_pier"=>"SDE09",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE09-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE09",
        "right_pier"=>"SDE10",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE10-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE10",
        "right_pier"=>"SDE11",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE11-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE11",
        "right_pier"=>"SDE12",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE12-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE12",
        "right_pier"=>"SDE13",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE13-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE13",
        "right_pier"=>"SDE14",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE14-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE14",
        "right_pier"=>"SDE15",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE15-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE15",
        "right_pier"=>"SDE16",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE16-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE16",
        "right_pier"=>"SDE17",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE17-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE17",
        "right_pier"=>"SDE18",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE18-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE18",
        "right_pier"=>"SDE19",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE19-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE19",
        "right_pier"=>"SDE20",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE20-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE20",
        "right_pier"=>"SDE21",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE21-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE21",
        "right_pier"=>"SDE22",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

    ),  "SDE22-SPAN" => array("type" => 1,
        "journal_defnition" => "",
        "left_pier"=>"SDE22",
        "right_pier"=>"SDE23",
        "user_id" => 1,
        "start_date" => $start_date,
        "end_date" => null,
        "frequency_no" => 1,
        "journal_property" => "",
        "is_image" => 0,
        "album_name" => "",
        "Span-1" => "18,0,1,1"

             ),"SDE24-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDE24",
                "right_pier"=>"SDE25",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDE25-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDE25",
                "right_pier"=>"SDE26",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            )
            );
        $V202 = array(
            "SDE26-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDE26",
                "right_pier"=>"SDE27",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDE27-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDE27",
                "right_pier"=>"SDE28",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDE28-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDE28",
                "right_pier"=>"SDE29",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDE29-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDE29",
                "right_pier"=>"SDE30",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDE30-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDE30",
                "right_pier"=>"SDE31",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDE31-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDE31",
                "right_pier"=>"SDE32",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDE32-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"SDE32",
                "right_pier"=>"SDE33",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"SDE33-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SDE33",
                "right_pier"=>"SDE34",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SDE34-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SDE34",
                "right_pier"=>"SDE35",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SDE35-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SDE35",
                "right_pier"=>"SDE36",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SDE36-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SDE36",
                "right_pier"=>"SDE37",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SDE37-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SDE37",
                "right_pier"=>"SDE38",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"SDE38-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"SDE38",
                "right_pier"=>"KS01",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS01-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS01",
                "right_pier"=>"KS02",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS02-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS02",
                "right_pier"=>"KS03",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS03-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS03",
                "right_pier"=>"KS04",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS04-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS04",
                "right_pier"=>"KS05",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS05-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS05",
                "right_pier"=>"KS06",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS06-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS06",
                "right_pier"=>"KS07",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS07-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS07",
                "right_pier"=>"KS08",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS08-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS08",
                "right_pier"=>"KS09",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS09-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS09",
                "right_pier"=>"KS10",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS10-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS10",
                "right_pier"=>"KS11",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS11-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS11",
                "right_pier"=>"KS12",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS12-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS12",
                "right_pier"=>"KS13",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS13-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS13",
                "right_pier"=>"KS14",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS14-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS14",
                "right_pier"=>"KS15",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS15-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS15",
                "right_pier"=>"KS16",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS16-R" => array("type" => 4,
                "journal_defnition" => "",
                "left_pier"=>"KS16",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Right_Span" => "16,0,4,4"

            ),"KS17-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"KS17",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,7,7",
                "Right_Span" => "16,0,8,8"
            ),"KS18-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"KS18",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,7,7",
                "Right_Span" => "16,0,8,8"
            ),"KS19-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"KS19",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,7,7",
                "Right_Span" => "16,0,8,8"

            ),"KS20-L" => array("type" => 5,
                "journal_defnition" => "",
                "left_pier"=>"KS20",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "16,0,5,5"
            ),"KS20-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS20",
                "right_pier"=>"KS21",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS21-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS21",
                "right_pier"=>"KS22",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS22-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS22",
                "right_pier"=>"KS23",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS23-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS23",
                "right_pier"=>"KS24",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS24-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS24",
                "right_pier"=>"KS25",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS25-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS25",
                "right_pier"=>"KS26",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS26-R" => array("type" => 4,
                "journal_defnition" => "",
                "left_pier"=>"KS26",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Right_Span" => "16,0,7,7"

            ),"KS27-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"KS27",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,14,14",
                "Right_Span" => "16,0,15,15"
            ),"KS28-SPAN" => array("type" => 6,
                "journal_defnition" => "",
                "left_pier"=>"KS28",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "15,0,14,14",
                "Right_Span" => "16,0,15,15"
            ),"KS29-L" => array("type" => 5,
                "journal_defnition" => "",
                "left_pier"=>"KS29",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Left_Span" => "16,0,5,5"
            ),"KS29-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS29",
                "right_pier"=>"KS30",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS30-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS30",
                "right_pier"=>"KS31",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS31-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS31",
                "right_pier"=>"KS32",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS32-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS32",
                "right_pier"=>"KS33",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS33-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS33",
                "right_pier"=>"KS34",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS34-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS34",
                "right_pier"=>"KS35",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS35-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS35",
                "right_pier"=>"KS36",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS36-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS36",
                "right_pier"=>"KS37",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS37-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS37",
                "right_pier"=>"KS38",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS38-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KS38",
                "right_pier"=>"KS39",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KS39-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS39",
                "right_pier"=>"KS40",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS40-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS40",
                "right_pier"=>"KS41",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS41-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS41",
                "right_pier"=>"KS42",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS42-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS42",
                "right_pier"=>"KS43",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS43-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS43",
                "right_pier"=>"KS44",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS44-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS44",
                "right_pier"=>"KS45",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KS45-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KS45",
                "right_pier"=>"MP01",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP01-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP01",
                "right_pier"=>"MP02",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP02-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP02",
                "right_pier"=>"MP03",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP03-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP03",
                "right_pier"=>"MP04",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP04-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP04",
                "right_pier"=>"MP05",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP05-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP05",
                "right_pier"=>"MP06",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP06-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP06",
                "right_pier"=>"MP07",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP07-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP07",
                "right_pier"=>"MP08",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP08-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP08",
                "right_pier"=>"MP09",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP09-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP09",
                "right_pier"=>"MP10",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP10-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP10",
                "right_pier"=>"MP11",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"MP11-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP11",
                "right_pier"=>"MP12",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),"MP12-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP12",
                "right_pier"=>"MP13",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP13-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP13",
                "right_pier"=>"MP14",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP14-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP14",
                "right_pier"=>"MP15",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP15-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP15",
                "right_pier"=>"MP16",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP16-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP16",
                "right_pier"=>"MP17",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP17-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP17",
                "right_pier"=>"MP18",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP18-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP18",
                "right_pier"=>"MP19",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP19-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP19",
                "right_pier"=>"MP20",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP20-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP20",
                "right_pier"=>"MP21",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP21-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP21",
                "right_pier"=>"MP22",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP22-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP22",
                "right_pier"=>"MP23",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP23-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP23",
                "right_pier"=>"MP24",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP24-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP24",
                "right_pier"=>"MP25",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP25-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP25",
                "right_pier"=>"MP26",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP26-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP26",
                "right_pier"=>"MP27",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),
            "MP28-SPAN" => array("type" => 3,
                "journal_defnition" => "",
                "left_pier"=>"MP28",
                "right_pier"=>"MP29",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1",
                "Span-3"=> "20,0,1,1"

            ),"MP29-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"MP29",
                "right_pier"=>"KB01",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB01-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB01",
                "right_pier"=>"KB02",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB02-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB02",
                "right_pier"=>"KB03",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB03-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB03",
                "right_pier"=>"KB04",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB04-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB04",
                "right_pier"=>"KB05",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB05-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB05",
                "right_pier"=>"KB06",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB06-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB06",
                "right_pier"=>"KB07",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB07-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB07",
                "right_pier"=>"KB08",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB08-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB08",
                "right_pier"=>"KB09",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB09-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB09",
                "right_pier"=>"KB10",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB10-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KB10",
                "right_pier"=>"KB11",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KB11-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KB11",
                "right_pier"=>"KB12",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KB12-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KB12",
                "right_pier"=>"KB13",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KB13-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KB13",
                "right_pier"=>"KB14",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KB14-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KB14",
                "right_pier"=>"KB15",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KB15-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KB15",
                "right_pier"=>"KB16",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KB16-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KB16",
                "right_pier"=>"KB17",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KB17-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KB17",
                "right_pier"=>"KB19",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KB19-SPAN" => array("type" => 1,
                "journal_defnition" => "",
                "left_pier"=>"KB19",
                "right_pier"=>"KB20",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1"

            ),"KB20-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB20",
                "right_pier"=>"KB21",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB21-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB21",
                "right_pier"=>"KB22",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB22-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB22",
                "right_pier"=>"KB23",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB23-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB23",
                "right_pier"=>"KB24",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB24-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB24",
                "right_pier"=>"KB25",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"KB25-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"KB25",
                "right_pier"=>"JS01",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS01-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS01",
                "right_pier"=>"JS02",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS02-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS02",
                "right_pier"=>"JS03",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS03-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS03",
                "right_pier"=>"JS04",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS04-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS04",
                "right_pier"=>"JS05",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS05-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS05",
                "right_pier"=>"JS06",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS06-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS06",
                "right_pier"=>"JS07",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS07-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS07",
                "right_pier"=>"JS08",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS08-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS08",
                "right_pier"=>"JS09",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS09-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS09",
                "right_pier"=>"JS10",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS10-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS10",
                "right_pier"=>"JS11",
                "user_id" => 1,
                "start_date" => $start_date,
                "end_date" => null,
                "frequency_no" => 1,
                "journal_property" => "",
                "is_image" => 0,
                "album_name" => "",
                "Span-1" => "18,0,1,1",
                "Span-2"=> "19,0,1,1"

            ),"JS11-SPAN" => array("type" => 2,
                "journal_defnition" => "",
                "left_pier"=>"JS11",
                "right_pier"=>"JS12",
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
                            $datacategory = array('journal_no' => $journalid, 'journal_category_id' => 1, 'journal_name' => $name);
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
                                $Right_Span = explode(',', $prop['Right_Span']);

                                    if ($x = 1) {
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $Right_Span[0], 'start_value' => $Right_Span[1], 'end_value' => $Right_Span[2], 'frequency_max_value' => $Right_Span[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }
                                $left_pier_id=$this->design->get_pierid($prop['left_pier']);
                                $spandata=array('journal_id'=>$journalid,'pier_id_one'=>$left_pier_id,'pier_id_two'=>0,'span_type'=>1,'span_count'=>0);
                                $this->design->add_span_detail($spandata);
                                break;
                            case 5 :$x=1;
                                $Left_Span = explode(',', $prop['Left_Span']);

                                    if ($x = 1) {
                                        $dataattbdata = array('journal_no' => $journalid, 'data_attb_id' => $Left_Span[0], 'start_value' => $Left_Span[1], 'end_value' => $Left_Span[2], 'frequency_max_value' => $Left_Span[3], 'display_seq_no' => $x);
                                        $this->duplicationmodel->add_journal_detail($dataattbdata);
                                    }
                                $left_pier_id=$this->design->get_pierid($prop['left_pier']);

                                $spandata=array('journal_id'=>$journalid,'pier_id_one'=>$left_pier_id,'pier_id_two'=>0,'span_type'=>1,'span_count'=>0);
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
                                        $spandata=array('journal_id'=>$journalid,'pier_id_one'=>$left_pier_id,'pier_id_two'=>0,'span_type'=>1,'span_count'=>0);
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