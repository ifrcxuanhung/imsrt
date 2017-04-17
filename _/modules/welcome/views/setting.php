<!-- BEGIN PAGE HEADER-->
<div class="row-fluid">
	<div class="span12">
		<!-- Begin Logo_partners -->
            <?php echo $logo_partners;?>
        <!-- End Logo_partners -->   
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			<strong></strong> 
		</h3>
		
		<ul class="breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="<?php echo base_url() ?>"><?php trans('home') ?></a> 
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
        <?php echo $hightlights; ?>
	</div>
</div>
<div class="row-fluid">
    <div class="tabbable tabbable-custom tabbable-full-width">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_options">Options</a></li>
            <li><a data-toggle="tab" href="#tab_market">Market Marker Obligation</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab_options" class="tab-pane active">
                <div class="row-fluid">
                    <div class="span6">
                        <form class="form-horizontal" action="#">
                            <div class="control-group">
                                <label class="control-label">Market Maker</label>
                                <div class="controls">
                                    <select class="m-wrap">
                                        <option>VNX25PRVND</option>
                                        <option>PVN10PRVND</option>
                                        <option>VN30</option>
                                        <option>VNI</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row-fluid">
                <!-- BEGIN PAGE CONTENT-->
                    <!-- BEGIN CONTROLS -->   
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"><i class="icon-reorder"></i>Controls</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="row-fluid">
                                <div class="span6">
                                    <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label">Date</label>
                                            <div class="controls">
                                                <div class="input-append">
                                                    <input name="real_date" class="m-wrap m-ctrl-medium date-picker" readonly type="text" value="" />
                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Index</label>
                                            <div class="controls">
                                                <select class="span7 m-wrap" id="indexCode">
                                      
                                                    <option>VNX25PRVND</option>
                                                    <option>PVN10PRVND</option>
                                                    <option>VN30</option>
                                                    <option>VNI</option> 
                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Data</label>
                                            <div class="controls">
                                            <select class="span7 m-wrap">
                                    
                                                
                                                    <option>Datafeed</option>
                                                    <option>Historical</option>
                                                    <option>Simulated</option>
                               
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Level</label>
                                            <div class="controls">
                                                <input name="real_price" type="text" class="span7 m-wrap" value="3286,15" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Number of Contracts</label>
                                            <div class="controls">
                                                <input type="text" class="span7 m-wrap spinEdit" value="<?php echo count($setting_content); ?>" autocomplete="off"/>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM--> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN BORDERED TABLE PORTLET-->
                        <?php // print_r($setting_content); exit(); ?>
                        <div class="portlet box yellow">
                            <div class="portlet-title">
                                <div class="caption"><i class="icon-reorder"></i>Content</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                    <a href="javascript:;" class="reload"></a>
                                    <a href="javascript:;" class="remove"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%">Nr</th>
                                            <th width="12%">Type</th>
                                            <th width="12%">First Month</th>
                                            <th width="10%">Expiry date</th>
                                            <th width="10%">Expiry time</th>
                                            <th width="10%">Strike Interval</th>
                                            <th width="10%">Tick size</th>
                                            <th width="10%">Contract Size</th>
                                            <th>Month</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(is_array($setting_content)) {
                                            foreach($setting_content as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td>
                                                        <select class="selectpicker" style="width: 150px;" autocomplete="off">
                                                            <option <?php echo $value['type'] == 'M' ? 'selected="selected"' : ''; ?>>Monthly</option>
                                                            <option <?php echo $value['type'] == 'Q' ? 'selected="selected"' : ''; ?>>Quarterly</option>
                                                            <option <?php echo $value['type'] == 'S' ? 'selected="selected"' : ''; ?>>Semesterly</option>
                                                            <option <?php echo $value['type'] == 'Y' ? 'selected="selected"' : ''; ?>>Yearly</option>
                                                        </select>
                                                    </td>
                                                    <td >
                                                        <select class="selectpicker" style="width: 150px;" autocomplete="off">
                                                            <option <?php echo $value['mm'] == '1' ? 'selected="selected"' : ''; ?> value='1'>Janaury</option>
                                                            <option <?php echo $value['mm'] == '2' ? 'selected="selected"' : ''; ?> value='2'>February</option>
                                                            <option <?php echo $value['mm'] == '3' ? 'selected="selected"' : ''; ?> value='3'>March</option>
                                                            <option <?php echo $value['mm'] == '4' ? 'selected="selected"' : ''; ?> value='4'>April</option>
                                                            <option <?php echo $value['mm'] == '5' ? 'selected="selected"' : ''; ?> value='5'>May</option>
                                                            <option <?php echo $value['mm'] == '6' ? 'selected="selected"' : ''; ?> value='6'>June</option>
                                                            <option <?php echo $value['mm'] == '7' ? 'selected="selected"' : ''; ?> value='7'>July</option>
                                                            <option <?php echo $value['mm'] == '8' ? 'selected="selected"' : ''; ?> value='8'>August</option>
                                                            <option <?php echo $value['mm'] == '9' ? 'selected="selected"' : ''; ?> value='9'>September</option>
                                                            <option <?php echo $value['mm'] == '10' ? 'selected="selected"' : ''; ?> value='10'>October</option>
                                                            <option <?php echo $value['mm'] == '11' ? 'selected="selected"' : ''; ?> value='11'>November</option>
                                                            <option <?php echo $value['mm'] == '12' ? 'selected="selected"' : ''; ?> value='12'>December</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="selectpicker" style="width: 150px;" autocomplete="off">
                                                            <option>3rd Friday</option>
                                                            <option selected="selected">End of the month</option>
                                                        </select>
                                                    </td>
                                                    <td style="text-align: right;">15:00</td>
                                                    <td style="text-align: right;">
                                                        <select class="selectpicker" style="width: 100px;" autocomplete="off">
                                                            <option <?php echo $value['interval'] == 20 ? 'selected="selected"' : ''; ?>>20</option>
                                                            <option <?php echo $value['interval'] == 50 ? 'selected="selected"' : ''; ?>>50</option>
                                                            <option <?php echo $value['interval'] == 100 ? 'selected="selected"' : ''; ?>>100</option>
                                                        </select>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <select class="selectpicker" style="width: 100px;" autocomplete="off">
                                                            <option <?php echo $value['tick'] == 0.1 ? 'selected="selected"' : ''; ?>>0.10</option>
                                                            <option <?php echo $value['tick'] == 0.5 ? 'selected="selected"' : ''; ?>>0.50</option>
                                                            <option <?php echo $value['tick'] == 1.0 ? 'selected="selected"' : ''; ?>>1.00</option>
                                                        </select>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <input type="text" class="small spinEdit" value="<?php echo $value['nbcontract']; ?>" autocomplete="off"/>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            switch ($value['mm']) {
                                                                case '2':
                                                                    $month = 'February';
                                                                    break;
                                                                case '3':
                                                                    $month = 'March';
                                                                    break;
                                                                case '4':
                                                                    $month = 'April';
                                                                    break;
                                                                case '5':
                                                                    $month = 'May';
                                                                    break;
                                                                case '6':
                                                                    $month = 'June';
                                                                    break;
                                                                case '7':
                                                                    $month = 'July';
                                                                    break;
                                                                case '8':
                                                                    $month = 'August';
                                                                    break;
                                                                case '9':
                                                                    $month = 'September';
                                                                    break;
                                                                case '10':
                                                                    $month = 'October';
                                                                    break;
                                                                case '11':
                                                                    $month = 'November';
                                                                    break;
                                                                case '12':
                                                                    $month = 'December';
                                                                    break;
                                                                default:
                                                                    $month = 'Janaury';
                                                                    break;
                                                            }
                                                            echo $month." {$value['yyyy']}";
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!--tr>
                                            <td>1</td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option selected="selected">Monthly</option>
                                                    <option>Quarterly</option>
                                                    <option>Semesterly</option>
                                                    <option>Yearly</option>
                                                </select>
                                            </td>
                                            <td >
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option value='1'>Janaury</option>
                                                    <option value='2'>February</option>
                                                    <option value='3'>March</option>
                                                    <option value='4'>April</option>
                                                    <option value='5'>May</option>
                                                    <option value='6'>June</option>
                                                    <option value='7'>July</option>
                                                    <option value='8'>August</option>
                                                    <option value='9' selected="selected">September</option>
                                                    <option value='10'>October</option>
                                                    <option value='11'>November</option>
                                                    <option value='12'>December</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option selected="selected">3rd Friday</option>
                                                    <option>End of the month</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-append bootstrap-timepicker-component">
                                                    <input type="text" class="small time-picker" style="width: 50px;">
                                                    <span class="add-on" style="height: 20px;"><i class="icon-time"></i></span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>20</option>
                                                    <option selected="selected">50</option>
                                                    <option>100</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option selected="selected">0.10</option>
                                                    <option>0.50</option>
                                                    <option>1.00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="10" />
                                            </td>
                                            <td>September 2014</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option selected="selected">Monthly</option>
                                                    <option>Quarterly</option>
                                                    <option>Semesterly</option>
                                                    <option>Yearly</option>
                                                </select>
                                            </td>
                                            <td >
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option value='1'>Janaury</option>
                                                    <option value='2'>February</option>
                                                    <option value='3'>March</option>
                                                    <option value='4'>April</option>
                                                    <option value='5'>May</option>
                                                    <option value='6'>June</option>
                                                    <option value='7'>July</option>
                                                    <option value='8'>August</option>
                                                    <option value='9'>September</option>
                                                    <option value='10' selected="selected">October</option>
                                                    <option value='11'>November</option>
                                                    <option value='12'>December</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option selected="selected">3rd Friday</option>
                                                    <option>End of the month</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-append bootstrap-timepicker-component">
                                                    <input type="text" class="small time-picker" style="width: 50px;">
                                                    <span class="add-on" style="height: 20px;"><i class="icon-time"></i></span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option selected="selected">20</option>
                                                    <option>50</option>
                                                    <option>100</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option selected="selected">0.10</option>
                                                    <option>0.50</option>
                                                    <option>1.00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="10" />
                                            </td>
                                            <td>October 2014</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option selected="selected">Monthly</option>
                                                    <option>Quarterly</option>
                                                    <option>Semesterly</option>
                                                    <option>Yearly</option>
                                                </select>
                                            </td>
                                            <td >
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option selected="selected" value='1'>Janaury</option>
                                                    <option value='2'>February</option>
                                                    <option value='3'>March</option>
                                                    <option value='4'>April</option>
                                                    <option value='5'>May</option>
                                                    <option value='6'>June</option>
                                                    <option value='7'>July</option>
                                                    <option value='8'>August</option>
                                                    <option value='9'>September</option>
                                                    <option value='10'>October</option>
                                                    <option value='11' selected="selected">November</option>
                                                    <option value='12'>December</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option selected="selected">3rd Friday</option>
                                                    <option>End of the month</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-append bootstrap-timepicker-component">
                                                    <input type="text" class="small time-picker" style="width: 50px;">
                                                    <span class="add-on" style="height: 20px;"><i class="icon-time"></i></span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>20</option>
                                                    <option>50</option>
                                                    <option selected="selected">100</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option selected="selected">0.10</option>
                                                    <option>0.50</option>
                                                    <option>1.00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="10" />
                                            </td>
                                            <td>November 2014</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option>Monthly</option>
                                                    <option selected="selected">Quarterly</option>
                                                    <option>Semesterly</option>
                                                    <option>Yearly</option>
                                                </select>
                                            </td>
                                            <td >
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option value='1'>Janaury</option>
                                                    <option value='2'>February</option>
                                                    <option value='3'>March</option>
                                                    <option value='4'>April</option>
                                                    <option value='5'>May</option>
                                                    <option value='6'>June</option>
                                                    <option value='7'>July</option>
                                                    <option value='8'>August</option>
                                                    <option value='9'>September</option>
                                                    <option value='10'>October</option>
                                                    <option value='11'>November</option>
                                                    <option selected="selected" value='12'>December</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option selected="selected">3rd Friday</option>
                                                    <option>End of the month</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-append bootstrap-timepicker-component">
                                                    <input type="text" class="small time-picker" style="width: 50px;">
                                                    <span class="add-on" style="height: 20px;"><i class="icon-time"></i></span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>20</option>
                                                    <option>50</option>
                                                    <option selected="selected">100</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option selected="selected">0.10</option>
                                                    <option>0.50</option>
                                                    <option>1.00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="10" />
                                            </td>
                                            <td>December 2014</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option>Monthly</option>
                                                    <option selected="selected">Quarterly</option>
                                                    <option>Semesterly</option>
                                                    <option>Yearly</option>
                                                </select>
                                            </td>
                                            <td >
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option value='1'>Janaury</option>
                                                    <option value='2'>February</option>
                                                    <option value='3' selected="selected">March</option>
                                                    <option value='4'>April</option>
                                                    <option value='5'>May</option>
                                                    <option value='6'>June</option>
                                                    <option value='7'>July</option>
                                                    <option value='8'>August</option>
                                                    <option value='9'>September</option>
                                                    <option value='10'>October</option>
                                                    <option value='11'>November</option>
                                                    <option value='12'>December</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option selected="selected">3rd Friday</option>
                                                    <option>End of the month</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-append bootstrap-timepicker-component">
                                                    <input type="text" class="small time-picker" style="width: 50px;">
                                                    <span class="add-on" style="height: 20px;"><i class="icon-time"></i></span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option selected="selected">20</option>
                                                    <option>50</option>
                                                    <option>100</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option selected="selected">0.10</option>
                                                    <option>0.50</option>
                                                    <option>1.00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="10" />
                                            </td>
                                            <td>March 2015</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option>Monthly</option>
                                                    <option>Quarterly</option>
                                                    <option selected="selected">Semesterly</option>
                                                    <option>Yearly</option>
                                                </select>
                                            </td>
                                            <td >
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option value='1'>Janaury</option>
                                                    <option value='2'>February</option>
                                                    <option value='3'>March</option>
                                                    <option value='4'>April</option>
                                                    <option value='5'>May</option>
                                                    <option value='6'>June</option>
                                                    <option value='7'>July</option>
                                                    <option value='8'>August</option>
                                                    <option value='9'>September</option>
                                                    <option value='10'>October</option>
                                                    <option value='11'>November</option>
                                                    <option value='12' selected="selected">December</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 150px;">
                                                    <option>3rd Friday</option>
                                                    <option selected="selected">End of the month</option>
                                                </select>
                                            </td>
                                            <td>
                                                <div class="input-append bootstrap-timepicker-component">
                                                    <input type="text" class="small time-picker" style="width: 50px;">
                                                    <span class="add-on" style="height: 20px;"><i class="icon-time"></i></span>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>20</option>
                                                    <option selected="selected">50</option>
                                                    <option>100</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>0.10</option>
                                                    <option selected="selected">0.50</option>
                                                    <option>1.00</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="10" />
                                            </td>
                                            <td>December 2015</td>
                                        </tr-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BORDERED TABLE PORTLET-->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <form action="#" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                    <button type="submit" id="saveContentOption" class="btn green"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn red">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="tab_market" class="tab-pane">
                <div class="row-fluid">
                <!-- BEGIN PAGE CONTENT-->
                    <!-- BEGIN CONTROLS -->   
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"><i class="icon-reorder"></i>Controls</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                <a href="javascript:;" class="reload"></a>
                                <a href="javascript:;" class="remove"></a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="row-fluid">
                                <div class="span6">
                                    <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal">
                                        <div class="control-group">
                                            <label class="control-label">Date</label>
                                            <div class="controls">
                                                <div class="input-append">
                                                    <input name="real_date" class="m-wrap m-ctrl-medium date-picker" disabled type="text" value="" />
                                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Index</label>
                                            <div class="controls">
                                                <select class="span7 m-wrap" disabled>
                                                    <option>VNX25PRVND</option>
                                                    <option>PVN10PRVND</option>
                                                    <option>VN30</option>
                                                    <option>VNI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Data</label>
                                            <div class="controls">
                                                <select class="span7 m-wrap" disabled>
                                                    <option>Datafeed</option>
                                                    <option>Historical</option>
                                                    <option>Simulated</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Level</label>
                                            <div class="controls">
                                                <input name="real_price" type="text" class="span7 m-wrap" value="3286,15" disabled />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Number of Contracts</label>
                                            <div class="controls">
                                                <input type="text" class="span7 m-wrap" value="<?php echo count($setting_content); ?>" autocomplete="off" disabled />
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM--> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN BORDERED TABLE PORTLET-->
                        <div class="portlet box yellow">
                            <div class="portlet-title">
                                <div class="caption"><i class="icon-reorder"></i>Content</div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                                    <a href="javascript:;" class="reload"></a>
                                    <a href="javascript:;" class="remove"></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="10%">Nr</th>
                                            <th width="15%">Obligation</th>
                                            <th>Month</th>
                                            <th width="15%">Nb strikes IN/OUT</th>
                                            <th width="15%">Max spread (%)</th>
                                            <th width="15%">Minimum quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(is_array($setting_content)) {
                                            foreach($setting_content as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td style="text-align: center;">
                                                        <input type="checkbox" <?php echo $value['oblig'] == '1' ? 'checked="checked"' : ''; ?> autocomplete="off">
                                                    </td>
                                                    <td>
                                                        <?php
                                                            switch ($value['mm']) {
                                                                case '2':
                                                                    $month = 'February';
                                                                    break;
                                                                case '3':
                                                                    $month = 'March';
                                                                    break;
                                                                case '4':
                                                                    $month = 'April';
                                                                    break;
                                                                case '5':
                                                                    $month = 'May';
                                                                    break;
                                                                case '6':
                                                                    $month = 'June';
                                                                    break;
                                                                case '7':
                                                                    $month = 'July';
                                                                    break;
                                                                case '8':
                                                                    $month = 'August';
                                                                    break;
                                                                case '9':
                                                                    $month = 'September';
                                                                    break;
                                                                case '10':
                                                                    $month = 'October';
                                                                    break;
                                                                case '11':
                                                                    $month = 'November';
                                                                    break;
                                                                case '12':
                                                                    $month = 'December';
                                                                    break;
                                                                default:
                                                                    $month = 'Janaury';
                                                                    break;
                                                            }
                                                            echo $month." {$value['yyyy']}";
                                                        ?>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <input type="text" class="small spinEdit" value="<?php echo $value['nbstrikes']; ?>" autocomplete="off"/>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <input type="text" class="small spinEdit" value="<?php echo $value['maxspd']; ?>" autocomplete="off"/>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <input type="text" class="small spinEditStep100" value="<?php echo $value['minquant']; ?>" autocomplete="off"/>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!--tr>
                                            <td style="text-align: center;">
                                                <input type="checkbox" checked>
                                            </td>
                                            <td>1</td>
                                            <td>September 2014</td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="5" />
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option selected="selected">5%</option>
                                                    <option>10%</option>
                                                    <option>15%</option>
                                                    <option>20%</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEditStep100" value="100" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <input type="checkbox" checked>
                                            </td>
                                            <td>2</td>
                                            <td>October 2014</td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="4" />
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>5%</option>
                                                    <option>10%</option>
                                                    <option selected="selected">15%</option>
                                                    <option>20%</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEditStep100" value="100" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <input type="checkbox" checked>
                                            </td>
                                            <td>3</td>
                                            <td>November 2014</td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="3" />
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>5%</option>
                                                    <option>10%</option>
                                                    <option>15%</option>
                                                    <option selected="selected">20%</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEditStep100" value="100" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <input type="checkbox" checked>
                                            </td>
                                            <td>4</td>
                                            <td>December 2014</td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="2" />
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>5%</option>
                                                    <option>10%</option>
                                                    <option>15%</option>
                                                    <option selected="selected">20%</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEditStep100" value="100" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <input type="checkbox">
                                            </td>
                                            <td>5</td>
                                            <td>March 2015</td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="1" />
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>5%</option>
                                                    <option>10%</option>
                                                    <option>15%</option>
                                                    <option selected="selected">20%</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEditStep100" value="100" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">
                                                <input type="checkbox">
                                            </td>
                                            <td>6</td>
                                            <td>December 2015</td>
                                            <td>
                                                <input type="text" class="small spinEdit" value="1" />
                                            </td>
                                            <td>
                                                <select class="selectpicker" style="width: 100px;">
                                                    <option>5%</option>
                                                    <option>10%</option>
                                                    <option>15%</option>
                                                    <option selected="selected">20%</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="small spinEditStep100" value="100" />
                                            </td>
                                        </tr-->
                                    </tbody>
                                </table>

                                <!--form action="#" class="form-horizontal">
                                    <div class="form-actions">
                                        <button type="submit" class="btn green"><i class="icon-ok"></i> Save</button>
                                        <button type="button" class="btn red">Cancel</button>     
                                    </div>
                                </form-->
                            </div>
                        </div>
                        <!-- END BORDERED TABLE PORTLET-->
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <form action="#" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                    <button type="submit" class="btn green" id="saveContentMarket"><i class="icon-ok"></i> Save</button>
                                    <button type="button" class="btn red">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $feed_chat; ?>

