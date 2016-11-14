<script>
    $(document).ready(function()
    {
//        $('#dag').DataTable();


        $('div.dataTables_filter input').attr('placeholder', 'Enter the text here');
        $(document).on("click", ".modaladd", function ()
        {
            var empty = "";
            $(".modal-body #dataattrgrpdesc").val( empty );
            $("#errorpiers").html( empty );
        });

        $('#addrecord').submit(function()
        {
            $.post($('#addrecord').attr('action'), $('#addrecord').serialize(), function( data )
            {
                if(data.st == 0)
                {
                    hideloader();
                    $('#errorpiers').html(data.msg);
                }
                else if(data.st == 1)
                {
                    location.href="<?php echo base_url(); ?><?php echo $cpagename; ?>";
                }

            }, 'json');
            return false;
        });
        $(document).on("click", ".modaldelete", function ()
        {
            if(confirm("Do you want to delete?"))
            {
                var pearid = $(this).attr("data-pearid");
                $.post( "<?php echo base_url(); ?><?php echo $cpagename; ?>/delete_pier",{pearid:pearid}, function( data ) {
                    location.reload();
                });
            }
        });

        $(document).on("click", ".modaledit", function ()
        {
            var pier_uid = $(this).data('pier_uid');
            var pier_position = $(this).data('pier_position');
            var pierid = $(this).data('pierid');
            var empty ="";
            $(".modal-body #pier1").val( pier_uid );
            $(".modal-body #pier_position1").val( pier_position );
            $(".modal-body #pierid").val( pierid );
            $("#erroruom").html( empty );
            $("#erroruomdesc").html( empty );
        });

        $('#updaterecord').submit(function()
        {
            $.post($('#updaterecord').attr('action'), $('#updaterecord').serialize(), function( data )
            {
                if(data.st == 0)
                {
                    hideloader();
                    $('#errorpier1').html(data.msg);
                    $('#errorpier_position1').html(data.msg1);
                }
                else if(data.st == 1)
                {
                    location.reload();
                }

            }, 'json');
            return false;
        });

        var oTable = $('#dag').dataTable({
           /* "order": [[ 0, "asc" ]],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false
            }]*/
        });
    });
</script>
<?php
$labelnames='';
foreach ($labels as $label):
    $labelnames .= ','.$label->sec_label_desc;
endforeach;
$labelnames=substr($labelnames,1);
$labelname=explode(",",$labelnames);
?>
<div id="after_header">
<div class="container">
    <!-- INPUT HERE-->
    <div class="page-header">
        <h1 id="nav"><?php echo $labelobject; ?></h1>
    </div>
    <div class="row">
        <div class="col-md-3">
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>home">Home</a></li>
                <li><?php echo $labelgroup; ?></li>
                <li class="active"><?php echo $labelobject; ?></li>
            </ul>
        </div>
    </div>
    <!--SEARCH-->
    <div class="form-group">
        <!--		<label for="search" class="col-sm-1 control-label">Search</label>-->
        <!--		<div class="col-sm-4">-->
        <!--			<input type="text" class="form-control" id="search" name="search" value="--><?php //echo $searchrecord; ?><!--" placeholder="Enter the text here">-->
        <!--		</div>-->
        <!--		<input type="button" class="btn btn-primary btn-sm" id="recordsearch" name="recordsearch" value="Search" />-->
        <!--		<a href="--><?php //echo base_url(); ?><!----><?php //echo $cpagename; ?><!--" class="btn btn-danger btn-sm">Clear</a>-->
        <button type="button" class="btn btn-success btn-sm pull-right modaladd" data-toggle="modal" data-target="#myModalAdd" <?php if($addperm==0) echo 'disabled="true"'; ?>>Add New</button>
    </div>
    <!-- -------------------------------------------- -->
    <!-- pop-up for Add -->
    <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New <?php echo $labelobject; ?></h4>
                </div>
                <form method=post id=addrecord action="<?php echo base_url(); ?><?php echo $cpagename; ?>/add/">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="select" class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                                <label id="errorpiers" class="text-danger"></label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="uom" class="col-sm-3 control-label"><?php echo $labelname[1]; ?><red>*</red></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="pieruid"  id="pieruid" placeholder="PIER UID" maxlength="40">
                                </div>
                            </div>
                        </div>
                       <!-- <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="uom" class="col-sm-3 control-label"><?php /*echo $labelname[2]; */?><red>*</red></label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="piertype" name="piertype">
                                        <?php
/*                                        foreach ($piertype as $piertype):
                                            */?>
                                            <option value="<?php /*echo $piertype->id; */?>"><?php /*echo $piertype->type; */?></option>
                                        <?php
/*                                        endforeach;
                                        */?>
                                    </select>
                                </div>
                            </div>
                        </div>-->
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="uom" class="col-sm-3 control-label"><?php echo $labelname[3]; ?><red>*</red></label>
                                <div class="col-sm-6">
                                    <select class="form-control" id="pierposition" name="pierposition">
                                        <?php
                                        foreach ($pierposition as $pierpos):
                                            ?>
                                            <option value="<?php echo $pierpos->id; ?>"><?php echo $pierpos->pier_position; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <input type=submit value="Add New" class="btn btn-primary btn-sm" onclick="showloader();">
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- close pop-up-->
    <!-- pop-up for Edit -->
    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?php echo $labelobject; ?></h4>
                </div>
                <form method=post id=updaterecord action="<?php echo base_url(); ?><?php echo $cpagename; ?>/update_pier/">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="select" class="col-md-3 control-label"></label>
                                <div class="col-md-8">
                                    <label id="errorpier1" name="errorpier1" class="text-danger" ></label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="pier1" class="col-sm-3 control-label"><?php echo $labelname[1]; ?><red>*</red></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="pier1"  id="pier1" value="" maxlength="60">
                                    <input type="hidden" class="form-control" name="pierid"  id="pierid">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="select" class="col-md-3 control-label"></label>
                                <div class="col-md-8">
                                    <label id="errorpier_position1" name="errorpier_position1" class="text-danger"></label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label"><?php echo $labelname[3]; ?><red>*</red></label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="pier_position1" name="pier_position1">
                                        <?php
                                        foreach ($pierposition as $pierpos):
                                            ?>
                                            <option value="<?php echo $pierpos->id; ?>"><?php echo $pierpos->pier_position; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <input type=submit value="Save Changes" class="btn btn-primary btn-sm" onclick="showloader();">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- close pop-up-->
    <!-- <div class="row text-center text-danger"><?php echo $message; ?> </div> -->
    <div class="row text-center <?php echo $message_type == 1? "text-success" : "text-danger"; ?>"><?php echo $message; ?></div>
    <div>&nbsp;</div>
    <div class="row">
        <table class="table table-striped table-hover" id="dag">
            <thead>
            <tr>
                <th>No</th>
                <th><?php echo $labelname[0]; ?></th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sno=1;
            foreach ($records as $pier):
                ?>
                <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo html_escape($pier->p_uid); ?></td>
                    <td>
                        <?php
                        if($editperm==1)
                        {
                            ?>
                            <a href="#" data-toggle="modal" class="modaledit" data-target="#myModalEdit" data-pier_uid="<?php echo $pier->p_uid; ?>" data-pier_position="<?php echo $pier->pier_position_id; ?>" data-pierid="<?php echo $pier->id; ?>"><span class="glyphicon glyphicon-edit">&nbsp;</span></a>
                        <?php
                        }
                        else
                        {
                            echo '<span class="glyphicon glyphicon-edit">&nbsp;</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if($delperm==1)
                        {
                            ?>
                            <a href="#" data-toggle="modal" class="modaldelete" data-pearid="<?php echo html_escape($pier->id); ?>"><span class="glyphicon glyphicon-trash">&nbsp;</span></a>
                        <?php
                        }
                        else
                        {
                            echo '<span class="glyphicon glyphicon-edit">&nbsp;</span>';
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $sno=$sno+1;
            endforeach;
            if($totalrows==0)
            {
                echo '<tr><td class="row text-center text-danger" colspan="4"> No Record Found</td></tr></tbody></table>';
            }
            else
            {
            ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <!--		<div class="col-md-12">-->
        <!--			<div class="col-md-4">-->
        <!--				<ul class="pagination">-->
        <!--					--><?php //echo $this->pagination->create_links(); ?>
        <!--				</ul>-->
        <!--			</div>-->
        <!--			<div class="col-md-4 col-md-offset-1" >-->
        <!--      			<div class="form-group">-->
        <!--    				<label for="search" class="col-sm-2 control-label" style="padding-top: 15px; padding-bottom: 5px;">Show</label>-->
        <!--    				<div class="col-sm-3" style="padding-top: 15px; padding-bottom: 5px;">-->
        <!--    					<select class="form-control" id="recordselect" name="recordselect">-->
        <!--                  		</select>-->
        <!--                  	</div>-->
        <!--				</div>-->
        <!--			</div>-->
        <!--			--><?php
        //				 // Display the number of records in a page
        //				 $end=$mpage+$page-1;
        //				if($totalrows<$end) $end=$totalrows;
        //			?>
        <!--			<div class="col-md-3" style="padding-top: 22px;"> Showing --><?php //echo $page; ?><!-- to --><?php //echo $end; ?><!-- of --><?php //echo $totalrows; ?><!-- rows</div>-->
        <!--		</div>-->
        <?php }?>
    </div>
</div>
<script type="text/javascript">
    function showloader() {
        $('#after_header').loader('show');
    }

    function hideloader() {
        setTimeout(function(){$('#after_header').loader('hide')},200);
    }
   /* $.post("<?php echo $this->config->base_url().'index.php/'.$cpagename; ?>/validate?jid=<?php echo $details->journal_no; ?>", data).always(function(data){
        console.log(data);
        hideloader();
        disallow();
        location.href='<?php echo $this->config->base_url() ?>/index.php/journalvalidationnonp';
        if (typeof callback == "function") callback();
    });*/
</script>
</div>