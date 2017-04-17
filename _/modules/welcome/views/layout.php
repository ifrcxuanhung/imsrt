<!-- BEGIN PAGE CONTENT-->
<div class="col-md-12">
    <div class="alert alert-success display-hide">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
        <span></span>
    </div>
</div>
<div class="row">
<form id="form_tab" action ="" method="post">
	<div class="col-md-12 col-sm-12">
         <table class="table table-striped table-bordered table-hover table-special" id="layout">
               <thead>
                <tr role="row">
                    <th class="align-center" rowspan="3" style="background-color: darkred; color: white;"><?php echo trans('_type') ?>
                    </th>
                    <th class="align-center" colspan="8" style="background-color: darkblue; color: white;"><?php echo trans('_international') ?>
                    </th>
                    <th class="align-center" colspan="8" style="background-color: darkgoldenrod; color: white;"><?php echo trans('_vietnam') ?>
                    </th>
                </tr>
                <tr role="row" class="heading-blue-2">
                    <th class="align-center" rowspan="2"><?php echo trans('_reference') ?>
                    </th>
                    <th class="align-center header-blue" colspan="4" ><?php echo trans('_data') ?>
                    </th>
                    <th class="align-center" rowspan="2"><?php echo trans('_summary') ?>
                    </th>
                    <th class="align-center" rowspan="2"><?php echo trans('_stats') ?>
                    </th>
                     <th class="align-center" rowspan="2"><?php echo trans('_layout_other') ?>
                    </th>
                    <th class="align-center" rowspan="2"><?php echo trans('_reference') ?>
                    </th>
                    <th class="align-center header-blue" colspan="4" ><?php echo trans('_data') ?>
                    </th>
                    <th class="align-center" rowspan="2"><?php echo trans('_summary') ?>
                    </th>
                    <th class="align-center" rowspan="2"><?php echo trans('_stats') ?>
                    </th>
                    <th class="align-center" rowspan="2"><?php echo trans('_layout_other') ?>
                    </th>
                </tr>
                <tr role="row" class="heading-blue-2">
                    <th class="align-center"><?php echo trans('_day') ?></th>
                    <th class="align-center"><?php echo trans('_month') ?></th>
                    <th class="align-center"><?php echo trans('_quarter') ?></th>
                    <th class="align-center"><?php echo trans('_year') ?></th>
                    <th class="align-center"><?php echo trans('_day') ?></th>
                    <th class="align-center"><?php echo trans('_month') ?></th>
                    <th class="align-center"><?php echo trans('_quarter') ?></th>
                    <th class="align-center"><?php echo trans('_year') ?></th>
                </tr>
            </thead>
            <tbody style="font-size: 13px !important;"></tbody>
        </table>
       </div>
  </form>
 </div>
<style>
.align-center{
    text-align: center;
    vertical-align: middle !important;
}
table.table-special thead th {
    border-left-width: 1px;
    border-top-width: 1px;
}
</style>