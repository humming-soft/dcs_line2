<script src="<?php echo base_url(); ?>ilyas/fancybox/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url(); ?>ilyas/multiupload.js"></script>
<script>var uploadUrl = '<?php echo base_url(); ?>journaldataentryadd/addimage/'</script>
<script>var uploadUrl2 = '<?php echo base_url(); ?>journaldataentryadd/replaceimage/'</script>
<script src="<?php echo base_url(); ?>ilyas/multiupload/custom.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>ilyas/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url(); ?>ilyas/css/multiupload.css" type="text/css" media="screen" />
<script src="<?php echo base_url(); ?>ilyas/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ilyas/dist/sweetalert.css">
<style>
    p.set-w {
        word-wrap: break-word;
        width: 425px;
        overflow: auto;
    }
</style>
<script>
var pcid;
var datenno;
var desc;
var j=0;
$(document).ready(function()
{
    $('#addRecord').submit(function(e)
    {
        if ($('input[name=optradio]:checked').val() == "Reject") {
            if (getcomments() == "") {
                alert("Please write at least 1 comment");
                e.preventDefault();
                return;
            }
        }
  /*      $.post($('#addRecord').attr('action'), $('#addRecord').serialize(), function( data )
        {
            if(data.st == 0)
            {
                $('#errordata').html(data.msg);
                $('#errordata1').html(data.msg1);
            }
            else if(data.st == 1)
            {
                hideloader();
                location.href="<?php echo base_url(); ?>journalvalidation";
            }

        }, 'json').always(function(d){console.log(d);});*/
        /*$.post($('#addRecord').attr('action'), $('#addRecord').serialize(), function( data ) {
            if(data.st == 0)
            {
                $('#errordata').html(data.msg);
                $('#errordata1').html(data.msg1);
            }
            else if(data.st == 1)
            {
                hideloader();
                location.href="<?php echo base_url(); ?>journalvalidation";
            }else{
                toastr.info('Are you the 6 fingered man?');
                location.href="<?php echo base_url(); ?>journalvalidation";

            }
        });return false;*/
        $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>Journalvalidationview/add/',
            data: $('form').serialize(),
            success: function () {
                swal({
                        title:"Success",
                        text: "Journal Validated sucessfully" ,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            location.href="<?php echo base_url(); ?>journalvalidation";
                        }
                    }
                );

            }

        });

        return false;
});

    $("#modaladd").click(function ()
    {
        var empty="";
        $(".modal-body #imagefile").val( empty );
        $(".modal-body #imagedesc").val( empty );
        $('#errorimage').html(empty);
        $('#errordesc').html(empty);
        $('#diverrormsg').html(empty);
        $('#imagePreview').attr("src","");

    });

    $('.image-description .text').on("click", function(){
        $(this).hide();
        $(this).parent().find(".edit").show();
        var i = $(this).parent().parent().find('#i_hidden').val();
        img_desc_edit_limit(i);
    });
    $('.image-description .cancel').on("click", function(){
        $(this).parent().hide();
        $(this).parent().parent().find('.text').show();
        desc = $(this).parent().parent().find('a').text();
        $(this).parent().find('textarea').val(desc);
        var i = $(this).parent().parent().find('#i_hidden').val();
        img_desc_edit_limit(i);

    });
    $('.image-description .save').on("click", function(){
        that = $(this);
        dataid = $(this).parent().parent().data('picid');
        datadesc = $(this).parent().find('textarea').val();
        if(datadesc.length > 1){
            $.post( "<?php echo base_url(); ?>journaldataentryadd/updateimagedesc",{picid:dataid,imagedesc1:datadesc}, function( data ){
                var status=data.st;
                if(status === 1){
                    that.parent().parent().find('a').text(datadesc);
                    that.parent().hide();
                    that.parent().parent().find('.text').show();
                }
            },'json').always(function(data){console.log(data);});
        }
        else{
            alert('Image Description is compulsory.');
        }
    });

    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index)
        {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    };

    $("#tableimage tbody").sortable({
        helper: fixHelperModified,
        stop: function(event,ui) {
            renumber_table('#tableimage');
        }
    }).disableSelection();

    $(document).on("click", ".modaledit", function () {
        pcid = $(this).attr('data-picid');
        datenno = $(this).attr('data-enno');
        desc = $(this).attr('data-desc');
        pic_seq_no = $(this).attr('data-pic-seq-no');
        document.getElementById('seq_no').value=pic_seq_no;
        var empty = "";
        $(".modal-body #picid").val($(this).data('picid'));
        $(".modal-body #imagedesc1").val($(this).data('desc'));
        $(".modal-body #divimg").html('<img src="' + $(this).data('img') + '" class="img-responsive" alt="" style="width: 200px; height: 137px;">');
        $('#errordesc1').html(empty);
        $('#diverrormsg').html(empty);

    });

    $("#upld").click(function () {
        if (document.getElementById("iddesc"+j).value.trim() == "") {
            document.getElementById("iddesc"+j).value = desc;
        }

        $.ajax({
            type: 'POST',
            url: uploadUrl2,
            data: {
                data_entry_pic_no: pcid,
                data_entry_no: datenno
            },
            async: false,
            cache: false,
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    alert('success');
                }
                else {
                    alert('failed');
                }
            },

            failure: function () {
                console.log(' Ajax Failure');
            },
            complete: function () {
                console.log("complete");
            }
        });


    });
});

function renumber_table(tableID) {
    //update table no
    seqs = '';
    $(tableID + " tbody tr").each(function() {
        count = $(this).parent().children().index($(this)) + 1;
        $(this).find('.tableimgno').html(count);
        picid = $(this).data("rowid");
        seqs += picid + ':' + count + ',';
    });
    showloader();
    $.post( "<?php echo base_url(); ?><?php echo $cpagename; ?>/updateimgsequence",{seqs:seqs}, function() {}).done(function(){hideloader()});
}

function getcomments() {
    return $('input[type="text"][name^="comment"]').toArray().reduce(function(p, c, i, a){return p.value+c.value});
}
/*function to remove uploaded image. added by jane*/
function remove_img(url) {
    var data_entry_no = url.split('/')[1];
    var pict_file_name = url.split('/')[3];
    $.post("<?php echo base_url(); ?><?php echo $cpagename; ?>/removeimage", {
        data_entry_no: data_entry_no,
        pict_file_name: pict_file_name
    });
}
/*function to limit image description characters. added by jane*/
function img_desc_limit(j){
    var characters = 80;
    $("#counter"+j).show();
    var a = $("#i_hidden_upload").val();
    $("#iddesc"+j).keyup(function(){
        if($(this).val().length > characters){
            $(this).val($(this).val().substr(0, characters));
        }
        var remaining = characters -  $(this).val().length;
        //$(".char_class").text(remaining);
        $("#idchar"+j).text(remaining);
        if(remaining <= 10)
        {
            $("#counter"+j).css("color","red");
        }
        else
        {
            $("#counter"+j).css("color","black");
        }
    });
}

/*function to limit image description characters in edit description. added by jane*/
function img_desc_edit_limit(i){
    var characters = 80;
    $("#image_description"+i).keyup(function(){
        $("#counter_edit"+i).show();
        if($(this).val().length > characters){
            $(this).val($(this).val().substr(0, characters));
        }
        var remaining = characters -  $(this).val().length;
        $(".char_class_edit"+i).text(remaining);
        if(remaining <= 10)
        {
            $("#counter_edit"+i).css("color","red");
        }
        else
        {
            $("#counter_edit"+i).css("color","black");
        }
    });
}

/*function to check reject note on reject radio button click for image journal. added by jane*/
function checkImgComment(){
    var is_img = $('#is_image_val').val();
    if ($('input[name=optradio]:checked').val() == "Reject" && is_img == 1) {
        if ($("#comment").val() == "") {
            $('input[id="save"]').attr('disabled','disabled');
            e.preventDefault();
        } else {
            enablesubmit();
        }
    }
}

/*function to check reject note on reject radio button click. added by jane*/
function checkComment(){
    var is_img = $('#is_image_val').val();
    if ($('input[name=optradio]:checked').val() == "Reject" && is_img == 0) {
        var commentCount = document.getElementById("dataattbcount").value;
        var comments = new Array();
        for(i=0;i<=commentCount;i++){
            comments.push($("#comment"+i).val());
        }
        if(comments !="") {
            enablesubmit();
        } else {
            $('input[id="save"]').attr('disabled','disabled');
        }
    }
}

/*function to check either image reject note or gatekeeper comment is filled on reject radio button click, for combination journal.
 (image + data entry journal). added by jane*/
function eitherCommentCheck(){
    var is_img = $('#is_image_val').val();
    if ($('input[name=optradio]:checked').val() == "Reject" && is_img == 2) {
        var commentCount = document.getElementById("dataattbcount").value;
        var comments = new Array();
        for(i=0;i<=commentCount;i++){
            comments.push($("#comment"+i).val());
        }
        if((comments !="" && comments != "," )|| $("#comment").val() != "") {
            enablesubmit();
        } else {
            $('input[id="save"]').attr('disabled','disabled');
        }
    }
}

/*function to check reject note on comment box click. added by jane*/
function checkEmpty() {
    $("#comment").keyup(function(){
        if(($("#comment").val() == "") && ($('input[name=optradio]:checked').val() == "Reject")){
            $('input[id="save"]').attr('disabled','disabled');
        } else {
            enablesubmit();
        }
    });
}
</script>


<script id="template-upload" type="text/x-tmpl">
{% for (var i=0; i < o.files.length; i++) { j++; var file=o.files[i]; var fileId = file.name.replace('.','_')+'_'+file.size; %}

    <tr class="template-upload fade">
        <td style="width:10%">
            <span class="preview"></span>
        </td>
        <td style="width:40%">
			<textarea id="iddesc{%=j%}" name="imagedesc_{%=fileId%}" maxlength="80" class="description-textarea textarea-fill" form="addimage" rows="5" onclick="img_desc_limit('{%=j%}');"></textarea>
			<input type="hidden" id="i_hidden_upload" value="{%=j%}">
        <div id="counter{%=j%}" style="display:none">You have <strong class="char_class" id="idchar{%=j%}"> 80 </strong> characters remaining</div>
        </td>
        <td style="width:40%">
            <p class="name"><b>{%=file.name%}</b> - <span class="size">Processing...</span></p>
			<strong class="error text-danger"></strong>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
		
		<td style="width:10%;">
			{% if (!i) { %}
                <button class="btn btn-sm btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
		</td>
    </tr>

{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name set-w">
                {% if (!file.error) { %}
                    <span>{%=file.description%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } else { %}
				
			{% } %}
        </td>
        <td>
		<p>
			{% if (file.url) { %}<span class="label label-success">Success</span> {% } %}
            
		</p>
        </td>
        <td>
			<button class="btn btn-sm btn-warning remove" id="image_remove" onclick="remove_img('{%=file.url%}')">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Remove</span>
			</button>
            <!--{% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-sm btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %} -->
        </td>
    </tr>
{% } %}
</script>


<?php
foreach($details as $row):
    $week=$row->frequency_period;
    $jdate=$row->start_date;
    $jend=$row->end_date;
    $pname=$row->project_name;
    $jname=$row->journal_name;
    $level=$row->validate_level_no ;
    $publishdate=$row->publish_date;
    $publishname=$row->publishname;
    $dataentryno=$row->data_entry_no;
    $is_image=$row->is_image;
endforeach;
?>
<div class="container">
<div class="page-header">
    <h1 id="nav">Project Journal Data Validation</h1>
</div>
<!-- BUAT CODING DALAM WRAP-->
<!-- INPUT HERE-->
<div id="after_header">
<script type="text/javascript">
    /*function showloader() {
     $('#after_header').loader('show');
     }
     function hideloader() {
     setTimeout(function(){$('#after_header').loader('hide')},200);
     }*/
</script>
<div class="row" style="width: 70%; margin: auto;">
    <div class="col-xs-4" style="text-align: right; margin-bottom: 8px;"><b>Data Entry For</b></div>
    <div class="col-xs-8" style="color: blue; margin-bottom: 8px;">Week <?php echo $week; ?></div>
    <div class="col-xs-4" style="text-align: right; margin-bottom: 8px;"><b>Journal Date</b></div>
    <div class="col-xs-8" style="color: blue; margin-bottom: 8px;"><?php echo date("d-M-Y", strtotime($jdate)); ?>
        to <?php echo date("d-M-Y", strtotime($jend)); ?></div>
    <div class="col-xs-4" style="text-align: right; margin-bottom: 8px;"><b>Project Name</b></div>
    <div class="col-xs-8" style="color: blue; margin-bottom: 8px;"><?php echo $pname; ?></div>
    </br>
    <div class="col-xs-4" style="text-align: right; margin-bottom: 8px;"><b>Journal Name</b></div>
    <div class="col-xs-8" style="color: blue; margin-bottom: 8px;"><?php echo $jname; ?></div>
    </br>
    <div class="col-xs-4" style="text-align: right; margin-bottom: 8px;"><b>Level</b></div>
    <div class="col-xs-8" style="color: blue; margin-bottom: 8px;">Level <?php echo $level; ?></div>
    </br>
    <div class="col-xs-4" style="text-align: right; margin-bottom: 8px;"><b>Publish By</b></div>
    <div class="col-xs-8" style="color: blue; margin-bottom: 8px;"><?php echo $publishname; ?></div>
    </br>
    <div class="col-xs-4" style="text-align: right; margin-bottom: 8px;"><b>Publish On</b></div>
    <div class="col-xs-8" style="color: blue; margin-bottom: 8px;"><?php echo date("d-m-Y",strtotime($publishdate)); ?></div>
    </br>
    <?php
    if($validatorcount!=0)
    {
        ?>
        <div class="col-xs-4" style="text-align: right; margin-bottom: 8px;"><b>Other Validation By</b></div>
        <div class="col-xs-8" style="margin-bottom: 8px;">
            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>level</th>
                    <th>Publish Date</th>
                </tr>
                </thead>
                <thead>
                <?php
                foreach($validators as $validator):
                    echo '<tr>';
                    echo '<td>'.$validator->user_full_name.'</td>';
                    echo '<td>Level '.$validator->validate_level_no.'</td>';
                    echo '<td>Level '.date("d-m-Y",strtotime($validator->accept_date)).'</td>';
                    echo '</tr>';
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
    <?php
    }
    ?>
</div>
<form onmousemove="<?php echo $is_image == 2 ? 'eitherCommentCheck();' : 'checkTextField();' ?>" id="addRecord" method="POST" action="<?php echo base_url(); ?><?php echo $cpagename; ?>/add/">
<!-- ---------------------- -->
<fieldset style="<?php echo $is_image == 1 ? 'display: none;' : '' ?>">
    <legend>Data Attributes for Journal</legend>
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>No</th>
            <th>Description</th>
            <th>Previous Value</th>
            <!--<th>Start</th>
            <th>End</th>
            <th>Weekly Max</th>-->
            <th>New Value</th>
            <!--<th>Variance</th>-->

            <th>UOM</th>
            <th>Gatekeeper Comment<input type="hidden" id="validateid" name="validateid" value="<?php echo $validatorid; ?>" /><input type="hidden" id="validateid" name="validateid" value="<?php echo $validatorid; ?>" /><input type="hidden" id="dataentryid" name="dataentryid" value="<?php echo $dataentryno; ?>" /></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sno=1;
        $closeButton = true;
        foreach($dataentryattbs as $dataentryattb):
            if($dataentryattb->actual_value == 'Yes'){
                $actual_value = '1.00';
            } elseif ($dataentryattb->actual_value == 'No') {
                $actual_value = '0.00';
            } else {
                $actual_value = $dataentryattb->actual_value;
            }
            if (((float)$actual_value) != ((float)$dataentryattb->end_value)) $closeButton = false;
            echo "<tr>";
            echo '<td>'.$sno.'</td>';
            echo '<td>'.$dataentryattb->data_attb_label.'</td>';
            echo '<td>'.$dataentryattb->prev_actual_value.'</td>';
            //echo '<td>'.intval($dataentryattb->start_value).'</td>';
            //echo '<td>'.intval($dataentryattb->end_value).'</td>';
            //echo '<td>'.intval($dataentryattb->frequency_max_value).'</td>';
            echo '<td><input type="hidden" id="dataattbid'.$sno.'" name="dataattbid'.$sno.'" value="'.$dataentryattb->data_attb_id.'" />';
            echo $dataentryattb->actual_value;
            echo '</td>';
            //echo '<td>'.intval($dataentryattb->frequency_max_opt).'</td>';

            echo '<td>'.$dataentryattb->uom_name.'</td>';
            echo '<td><input type="text" id="comment'.$sno.'" name="comment'.$sno.'"   class="commentValue" onkeydown="enbRjct()" onkeyup="'.$is_image.' == 2 ? eitherCommentCheck(); : checkTextField();checkRbReject();"/></td>';
            echo "</tr>";
            $sno++;
        endforeach;
        ?>
        <input type="hidden" id="dataattbcount" name="dataattbcount" value="<?php echo $sno-1; ?>" />
        </tbody>
    </table>
</fieldset>
</br>
<!--        --><?php
//        echo'<pre>';
//        print_r($dataimages);
//        echo'</pre>';
//        ?>
    <?php if($is_image == 1 ){ ?>
    <fieldset>
        <legend>Picture Attachment</legend>
        <p style="text-align: right;">Upload picture &nbsp &nbsp &nbsp <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg2"><button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal" id="modaladd" name="modaladd">Upload</button></a></p>
       <?php } if(count($dataimages)!=0)
        {
        ?>
        <table class="table table-striped table-hover" style="margin-top: 30px;">
            <table class="table table-striped table-hover" id="tableimage">
                <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 20%;">Picture</th>
                    <th style="width: 40%;">Description</th>
                    <th style="width: 10%;">Action</th>
                    <th style="width: 25%;">Validator Comments</th>
                    <!--								<th style="width: 25%;">Validator Comments Area</th>-->
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach($dataimages as $dataimage):
                    $i++;
                    $pdo = "";
                    if(!empty($dataimage->pict_validate_comment)) {
                        $pdo = "PDO : ";
                    }
                    echo '<tr style="cursor:all-scroll;" data-rowid="'.$dataimage->data_entry_pict_no.'">';
                    echo '<td class="tableimgno">'.$dataimage->pict_seq_no.'</td>';
                    echo '<td><a title="'.$dataimage->pict_definition.'" class="fancybox" rel="group" href="'.base_url().$dataimage->pict_file_path.$dataimage->pict_file_name.'"><img src="'.base_url().$dataimage->pict_file_path.$dataimage->pict_file_name.'" class="img-responsive" alt="" style="width: 200px; height: 137px;"></a></td>';
                    echo '<td class="image-description" data-picid="'.$dataimage->data_entry_pict_no.'"> <a style="cursor: pointer" class="text">'.wordwrap($dataimage->pict_definition, 40, "<br />\n", true).'</a> <div class="edit" style="display:none;"><textarea name="image_description" id="image_description'.$i.'" class="form-control">'.$dataimage->pict_definition.'</textarea><input type="hidden" id="i_hidden" value="' . $i . '"><div id="counter_edit'.$i.'" style="display:none">You have <strong class="char_class_edit'.$i.'"> 80 </strong> characters remaining</div><input class="btn btn-primary btn-xs save" type="button" value="Save"/><input class="btn btn-xs btn-danger cancel" type="button" value="Cancel"/></div></td>';
                    echo '<td> <a href="'.base_url().$dataimage->pict_file_path.$dataimage->pict_file_name.'" download><span class="glyphicon glyphicon-download-alt" title="Download">&nbsp;</span></a><a href="#" data-toggle="modal" class="modaledit" data-target="#testmodal" data-picid="' . $dataimage->data_entry_pict_no . '" data-enno="' . $dataimage->data_entry_no . '" data-desc="' . $dataimage->pict_definition . '" data-pic-seq-no="' . $dataimage->pict_seq_no . '"><span class="glyphicon glyphicon-edit">&nbsp;</span></a><a class="modaldelete" href="#" data-toggle="modal" class="modaldelete" data-imgid="'.$dataimage->data_entry_pict_no.'" data-dataid="'.$dataimage->data_entry_no.'"><span class="glyphicon glyphicon-trash" title="Delete"></span></a></td>';
                    //echo '<td> <input name="pict-comment'.$dataimage->data_entry_pict_no.'" class="pict-comment" size="30" data-id="'. $dataimage->data_entry_pict_no .'" type="text" value= '.$dataimage->pict_validate_comment.' > </td>';
                    echo '<td><textarea name="pict-comment'.$dataimage->data_entry_pict_no.'" id="pict-comment'.$i.'" class="pict-comment" size="30" data-id="'. $dataimage->data_entry_pict_no .'" ></textarea><div id="divt'.$i.'"> '. $dataimage->pict_validate_comment .' </div></td>';
                    //echo '<td><textarea name="pict-comment'.$dataimage->data_entry_pict_no.'" class="pict-comment" size="30" data-id="'. $dataimage->data_entry_pict_no .'" >'.$dataimage->pict_validate_comment.'</textarea>  </td>';
                    echo '</tr>';
                endforeach;
                ?>
                <input type="hidden" id="valcount" name="valcount" value="<?php echo $i; ?>" />
                </tbody>
            </table>
    </fieldset>
    </br>
<?php
}
?>
<div class="row text-center text-danger" id="errordata"></div>
<div class="row text-center text-danger" id="errordata1"></div>
<div class="row text-center text-success"><?php echo $message; ?></div>
<fieldset>
    <legend>Validation</legend>
    <div class="row" style="width: 70%; margin: auto;">
        <div class="col-xs-2" style="margin-bottom: 8px;">
            <div class="radio">
                <label>
                    <input type="radio" id="optradio" name="optradio" value="Approve" onclick="enablesubmit();">Approve
                </label>
            </div>
        </div>

        <div class="col-xs-2" style="margin-bottom: 8px;">
            <div class="radio">
                <label>
                    <?php if($is_image == 1 || $is_image == 0) {?>
                        <input type="radio" id="optradio" name="optradio" value="Reject" onclick="<?php echo $is_image == 1 ? 'checkImgComment();' : 'checkTextField();checkComment();' ?>">Reject
                    <?php } elseif($is_image==2) {?>
                        <input type="radio" id="optradio" name="optradio" value="Reject" onclick="eitherCommentCheck();" >Reject
                    <?php } ?>
                </label>
            </div>
        </div>
        <?php if ($closeButton && ($is_image==0) || $approve_stop_status && $is_image) {?>
            <div class="col-xs-3" style="margin-bottom: 8px;">
                <div class="radio">
                    <label>
                        <input type="radio" id="optradio" name="optradio" value="Close" onclick="enablesubmit();">Approve & Stop Monitoring
                    </label>
                </div>
            </div>
        <?php  } if($is_image == 1 || $is_image == 2) : ?>
            <div class="col-xs-2" style="margin-bottom: 8px;">Reject notes</div>
            <div id="reject-note" class="col-xs-5" style="color: blue; margin-bottom: 40px;">
                <textarea class="form-control" rows="5" id="comment" name="comment" onclick="<?php echo $is_image == 1 ? 'checkEmpty();checkImgComment();' : 'eitherCommentCheck();' ?>"></textarea>
                <div>
                    <?php if(!empty($reject_note)){ echo $reject_note; }?>
                </div>
            </div>
        <?php else : ?>
            <input type="hidden" name="comment" id="comment" value=""/>
        <?php endif; ?>
        <!--div class="col-xs-5" style="font-size: 14px; color: blue; margin-bottom: 8px;">
						<select class="form-control">
							<option><?php echo $publishname; ?></option>
						</select>
					  </div-->
    </div>
    <input type="hidden" id="is_image_val" name="is_image_val" value="<?php echo $is_image; ?>"/>
    <!--div class="row" style="width: 70%; margin: auto;">
					  <div class="col-xs-5" style="margin-bottom: 8px;">
						
					  </div>
					  <?php echo $is_image == 1 ? '<input type="hidden" name="is_image" value="1"/>' : '' ?>
					  <input type="hidden" name="comment" id="comment" value="No validation note"/>
					  <div class="col-xs-2" style="margin-bottom: 8px;">Reject notes</div>
					  <div class="col-xs-5" style="color: blue; margin-bottom: 40px;">
						<textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
					  </div>
					</div-->
</fieldset>

<script type="text/javascript">
    function enbRjct(){
        var options = document.getElementsByName('optradio');
        for(i = 0; i < options.length; i++)
        {
            var opt = options[i];
            if(opt.value=="Reject")
                opt.checked="checked";
        }
    }
    function verifySave() {

        if ($('input[value="Approve"]:checked').length > 0){
            var msg = "Confirm Approve?";
        }
        if ($('input[value="Reject"]:checked').length > 0){
            var msg = "Confirm Reject?";
        }
        if ($('input[value="Close"]:checked').length > 0){
            var msg = "Confirm Approve & Stop Monitoring?";
        }

        var a = confirm(msg);
        var thisform = $("form#addRecord");
        if (a) {
            showloader(20000);
            thisform.submit();
            return true;
        } else {
            return false;
        }

    }/*
     function checkImageUpload(){

     alert('asdasd');imgLen = $('#imagefile').val().length;
     descLen = $('#imagedesc').val().length;

     if(imgLen === 0 || descLen === 0){
     alert("Image & Description are compulsory.");
     return false;
     }else{
     showloader();
     return true;
     }
     }*/
    function PreviewImage(){
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imagefile").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("imagePreview").src = oFREvent.target.result;
        }
    }
    $(function(){
        $(".fancybox").fancybox();
        $('.pict-comment, #comment').keyup(function(){
            checkPicComment();
            checkRbReject();
        });

        function checkPicCommentField(){
            if($('input[value=Reject]:checked').length > 0)
                checkPicComment();
        }

        function checkPicComment(){
            var charlen = 0;
            $('.pict-comment').each(function(){
                charlen += $(this).val().length;
            });

            if(charlen > 0)
                $('input[id="save"]').removeAttr('disabled');
            else
            {
                $('input[id="save"]').attr('disabled','disabled');
            }
        }
    });
    function disablesubmit(){
        if ($('input[value=Reject]:checked').length > 0) {
            $('input[id="save"]').attr('disabled','disabled');
        } else if ($('input[value=Reject]:checked').length = 0) {
            $('input[id="save"]').removeAttr('disabled');
        }
    }
    function enablesubmit(){
        $('input[id="save"]').removeAttr('disabled');
    }

    function checkTextField() {
        var is_img = $('#is_image_val').val();
        if ($('input[value=Reject]:checked').length > 0 && is_img == 0  ) {
            var commentCount = document.getElementById("dataattbcount").value;
            var combine_id  = [];
            var combine = [];
            var i = 1;
            while (i <= commentCount) {
                combine_id.push("comment"+i);
                combine.push("fromtext"+i);
                i++;
            }
            var arrCombineId = combine_id;
            var commentValue = "";
            var i;
            for (i = 0; i < arrCombineId.length; i++) {
                commentValue += document.getElementById(arrCombineId[i]).value;
            }
            if (commentValue == '') {
                $('input[id="save"]').attr('disabled','disabled');
            }else{
                $('input[id="save"]').removeAttr('disabled');
            }
        }
    }

    function checkRbReject(){
        $('input[value=Reject]').prop("checked", true);
        enablesubmit();
    }

    $(document).on("click", ".modaldelete", function ()
    {
        if(confirm("Do you want to delete the image?"))
        {
            var imgid = $(this).data('imgid');
            var dataid = $(this).data('dataid');
            $.post( "<?php echo base_url(); ?><?php echo $cpagename; ?>/deleteimage",{id:imgid,dataid:dataid}, function( data )
            {
                var imagevalue=data.imgval;
                var imagevalue1 = imagevalue.split(',777,');
                $("#tableimage").find("tr:gt(0)").remove();
                for (var i = 0; i < imagevalue1.length; i++)
                {
                    if(imagevalue1[i]!="")
                    {
                        var content='';
                        var imagevalue2 = imagevalue1[i].split(',');
                        content += '<tr>';
                        content += '<td>'+imagevalue2[0]+'</td>';
                        content += '<td> <img src="'+imagevalue2[1]+imagevalue2[2]+'" class="img-responsive" alt="" style="width: 200px; height: 137px;"> </td>';
                        content += '<td> '+imagevalue2[3]+' </td>';
                        content += '<td> <a href="#" data-toggle="modal" class="modaldelete" data-imgid="'+imagevalue2[4]+'" data-dataid="'+imagevalue2[5]+'"><span class="glyphicon glyphicon-trash">&nbsp;</span></a></td>';
                        content += '</tr>';
                        $("#tableimage").append(content);
                    }

                }
                location.reload();
                //$("#diverrormsg").html("Picture Attachment Deleted Successfully");

            }, 'json');
        }
    });
    /*function setTemp(){
     // alert("in");
     var cnt=document.getElementById("valcount").value;
     alert(cnt);
     for(var i=1;i<=cnt;i++){
     if(document.getElementById("pict-comment"+i).value=="") {
     alert("in");
     document.getElementById("pict-comment"+i).value=(document.getElementById("divt"+i).innerHTML).replace("PDO : ","");
     }
     }
     }*/
    /*done by jane. for filling validator comment text area*/
    function setTemp(){
        var cnt=document.getElementById("valcount").value;
        for(var i=0;i<cnt;i++){
            if(document.getElementById("pict-comment"+i).value=="") {
                document.getElementById("pict-comment"+i).value=(document.getElementById("divt"+i).innerHTML);
            }
        }
    }
</script>
<div class="row" style="width:70%; margin:auto">

</div>
<div class="form-group" style="">
    <input id="save" disabled type="button" class="btn btn-primary btn-sm" value="Save" onclick="<?php echo $is_image == 1 ? '' : 'checkTextField();' ?>verifySave();" onmouseover="setTemp();"/>
    <a href="<?php echo base_url(); ?>/journalvalidation" class="btn btn-danger btn-sm">Cancel</a>
</div>
</form>
</div>
<!-- Modal -->
<!-- upload picture modal-->
<div class="modal fade bs-example-modal-lg2" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Picture Attachment</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="addimage" enctype="multipart/form-data" onSubmit="return checkAndSendAllImages();">
                    <div class="modal-body">
                        <input type="hidden" id="dataentryno1" name="dataentryno1" value="<?php echo $dataentryno; ?>"/>

                        <div style="text-align:center">
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Add files...</span>
                                <input type="file" id="imagefile" name="files[]" multiple="multiple">
                            </span>
                            <button type="submit" class="btn btn-primary start">
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>Start upload</span>
                            </button>
                        </div>
                        <table role="presentation" class="table table-striped table-vertical-middle">
                            <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Description</th>
                                <th>Progress</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="files"></tbody>
                        </table>
                        <p style="font-size:12px"><span style="text-decoration:underline">Notes:</span><br/>
                            Allowed image types: png, jpg, gif<br/>
                            Maximum image size: 10MB
                        </p>
                        <!--
							<div class="form-group">
								<div class="col-xs-4" style="text-align: right;"></div>
								<div class="col-xs-5"><label id="errorimage" class="text-danger"></label></div>
							</div>
							<br>
							<div class="form-group">
								<div class="col-xs-4" style="text-align: right;"><label class="control-label"><?php echo $labelname[16]; ?> <red>*</red></label></div>
								<div class="col-xs-5">
									<!--<img src="" class="img-responsive" id="imagePreview" alt="" style="width: 200px; height: 137px;"/>-->
                        <!--<input type="file" id="imagefile" name="files" onchange="PreviewImage();"/>-
									
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-4" style="text-align: right;"></div>
								<div class="col-xs-5"><label id="errordesc" class="text-danger"></label></div>
							</div>
							<div class="form-group">
								<div class="col-xs-4" style="text-align: right;"><label class="control-label"><?php echo $labelname[17]; ?> <red>*</red></label></div>
								<div class="col-xs-5"><textarea maxlength="500" class="form-control" rows="3" id="imagedesc" name="imagedesc"></textarea></div>
							</div>
							<br><br><br><br><br><br><br><br><br><br><br><br>-->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="closebutton btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- -------------------- Start :  AGAILE ------------------------ -->
<div class="modal fade bs-example-modal-lg3" id="testmodal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Picture</h4>
            </div>
            <div class="modal-body">
                <form method=post id=updateimage enctype="multipart/form-data"
                      onSubmit="return checkAndSendAllImages();">

                    <div class="modal-body">
                        <input type="hidden" id="dataentryno1" name="dataentryno1" value="<?php echo $dataentryno; ?>"/>
                        <input type="hidden" id="seq_no" name="seq_no"/>
                        <div style="text-align:center">
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Add files...</span>
                                <input type="file" id="imagefile" name="file[]" multiple="multiple">
                            </span>
                            <button type="submit" class="btn btn-primary start" id="upld">
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>Start upload</span>
                            </button>
                        </div>
                        <table role="presentation" class="table table-striped table-vertical-middle">
                            <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Description</th>
                                <th>Progress</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="files"></tbody>
                        </table>
                        <p style="font-size:12px"><span style="text-decoration:underline">Notes:</span><br/>
                            Allowed image types: png, jpg, gif<br/>
                            Maximum image size: 10MB
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="closebutton btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- --------------------End ------------------------ -->
</div>