<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-featured" data-toggle="tooltip"  title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
       </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">

    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-" class="form-horizontal">
            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-calender" data-toggle="tab"><?php echo $tab_calender; ?></a></li>
                <li><a href="#tab-mail" data-toggle="tab"><?php echo $tab_mail; ?></a></li>
                <li><a href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-calender">

                    <!---calender program here-->

                    <head>
                        <link href='view/birthday/fullcalendar.css' rel='stylesheet' />
                        <link href='view/birthday/fullcalendar.print.css' rel='stylesheet' media='print' />
                        <script src='view/birthday/fullcalendar.min.js'></script>
                        <script>

                            $(document).ready(function() {

                                $('#calendar').fullCalendar({

                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'month,agendaWeek,agendaDay'
                                    },
                                    editable: true,
                                   eventLimit: 4, // allow "more" link when too many events
                                    eventSources: [

                                         {
                                            url: 'index.php?route=sale/birthdaycalender/getBirthdaydate&token=<?php echo $token; ?>',
                                            type: 'POST',
                                            data: {      },
                                            error: function() {
                                                alert('there was an error while fetching events!');
                                            }

                                        }

                                         ]

                                });
                            });

                        </script>
                        <style>

                            body {
                                margin: 0px 0px;
                                padding: 0;
                                font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
                                font-size: 14px;
                            }

                            #calendar {
                                max-width: 900px;
                                margin: 0 auto;
                            }

                        </style>
                    </head>
                    <body>

                    <div id='calendar'></div>

                    </body>

                </div>
                <div class="tab-pane" id="tab-mail">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_subject; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="subject" value="<?php if($subject=='') { echo "Birthday Wishes"; } else { echo $subject; } ?>"  id="input-name" class="form-control" />
                            <?php if ($error_subject) { ?>
                            <div class="text-danger"><?php echo $error_subject; ?></div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-description"><?php echo $entry_message; ?></label>
                        <div class="col-sm-10">
                            <?php $placeholdertext="I hope you have a wonderful day and that the year ahead is filled with much love, many wonderful surprises and gives you lasting memories that you will cherish in all the days ahead. Happy Birthday."; ?>
                            <textarea name="message" class="summernote" cols="30" rows="10" ><?php if($message==''){ echo "Dear ##firstname ##lastname,<br><br> Wishing you the happiness of following your heart, the comfort of loving those you care for, and the peace of discovering your special place in this world. May these gifts be yours today and every day.<br><br>
Happy Birthday ##firstname ##lastname !!! <br><br>Regards,<br>".$shopownername; } else{ echo $message; } ?></textarea>
<div class="col-sm-10" style="color:red;"> Note : ##firstname ##lastname automatically replaces the customer Firstname and Lastname</div>
                            <?php if ($error_message) { ?>
                            <div class="text-danger"><?php echo $error_message; ?></div>
                            <?php } ?>
                        </div>

                    </div>

                </div>

                <div class="tab-pane" id="tab-setting">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_birthdayreminderstatus; ?></label>
                        <div class="col-sm-10">
                            <select name="birthstatus" id="input-status" class="form-control">
                                <?php if ($birthstatus) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_storestatus; ?></label>
                        <div class="col-sm-10">
                            <select name="ownerstatus" id="input-status" class="form-control">
                                <?php if ($ownerstatus) { ?>
                                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                <option value="1"><?php echo $text_enabled; ?></option>
                                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </form>
      </div>
    </div>
  </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
                toolbar: [

                    ['style', ['style']],
                    ['fontfamily', ['fontfamily']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['help', ['help']]
                ]
            });
      });
    </script>
</div>
<?php echo $footer; ?>

