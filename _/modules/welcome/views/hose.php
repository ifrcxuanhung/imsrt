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
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row-fluid">
	<div class="span12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>VNVDM Pricing</div>
				<div class="actions">
					<div class="btn-group">
						<a class="btn" href="#" data-toggle="dropdown">
							<?php trans('Columns'); ?>
							<i class="icon-angle-down"></i>
						</a>
						<div id="sample_3_column_toggler" class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
							<label><input type="checkbox" checked data-column="0">Nr</label>
							<label><input type="checkbox" checked data-column="1">C/P</label>
							<label><input type="checkbox" checked data-column="2">Expiry</label>
							<label><input type="checkbox" checked data-column="3">Strike</label>
							<label><input type="checkbox" checked data-column="4">Theo</label>
							<label><input type="checkbox" checked data-column="5">Implied</label>
                            <label><input type="checkbox" checked data-column="6">Qbid</label>
                            <label><input type="checkbox" checked data-column="7">Bid</label>
                            <label><input type="checkbox" checked data-column="8">Ask</label>
                            <label><input type="checkbox" checked data-column="9">Qask</label>
                            <label><input type="checkbox" checked data-column="10">Spread</label>
						</div>
					</div>
				</div>
			</div>
			<div class="portlet-body bg_cl_gray">
				<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
					<thead>
						<tr class="bg_dark">
							<th>Nr</th>
							<th>C/P</th>
							<th>Expiry</th>
							<th class="hidden-480">Strike</th>
							<th class="hidden-480">Theo</th>
							<th class="hidden-480">Implied</th>
                            <th class="hidden-480">Qbid</th>
							<th class="hidden-480">Bid</th>
							<th class="hidden-480">Ask</th>
                            <th class="hidden-480">Qask</th>
							<th class="hidden-480">Spread</th>
						</tr>
					</thead>
					<tbody>
						<tr id="1">
							<td>1</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2,450</td>
							<td class="hidden-480 text-align-right">115.37</td>
							<td class="hidden-480 text-align-right">19.89%</td>
                            <td class="hidden-480 text-align-right">103</td>
							<td class="hidden-480 text-align-right">113.93</td>
							<td class="hidden-480 text-align-right">116.82</td>
                            <td class="hidden-480 text-align-right">278</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="2">
							<td>2</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2475</td>
							<td class="hidden-480 text-align-right">92.58</td>
							<td class="hidden-480 text-align-right">19.89%</td>
                            <td class="hidden-480 text-align-right">183</td>
							<td class="hidden-480 text-align-right">91.43</td>
							<td class="hidden-480 text-align-right">93.74</td>
                            <td class="hidden-480 text-align-right">300</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="3">
							<td>3</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2500</td>
							<td class="hidden-480 text-align-right">71.50</td>
							<td class="hidden-480 text-align-right">19.90%</td>
                            <td class="hidden-480 text-align-right">168</td>
							<td class="hidden-480 text-align-right">70.61</td>
							<td class="hidden-480 text-align-right">72.40</td>
                            <td class="hidden-480 text-align-right">233</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="4">
							<td>4</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2525</td>
							<td class="hidden-480 text-align-right">52.81</td>
							<td class="hidden-480 text-align-right">19.90%</td>
                            <td class="hidden-480 text-align-right">125</td>
							<td class="hidden-480 text-align-right">52.15</td>
							<td class="hidden-480 text-align-right">53.47</td>
                            <td class="hidden-480 text-align-right">232</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="5">
							<td>5</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2550</td>
							<td class="hidden-480 text-align-right">37.07</td>
							<td class="hidden-480 text-align-right">19.91%</td>
                            <td class="hidden-480 text-align-right">123</td>
							<td class="hidden-480 text-align-right">36.60</td>
							<td class="hidden-480 text-align-right">37.53</td>
                            <td class="hidden-480 text-align-right">295</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="6">
							<td>6</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2575</td>
							<td class="hidden-480 text-align-right">24.59</td>
							<td class="hidden-480 text-align-right">20.00%</td>
                            <td class="hidden-480 text-align-right">160</td>
							<td class="hidden-480 text-align-right">24.29</td>
							<td class="hidden-480 text-align-right">24.90</td>
                            <td class="hidden-480 text-align-right">271</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="7">
							<td>7</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2600</td>
							<td class="hidden-480 text-align-right">15.35</td>
							<td class="hidden-480 text-align-right">20.07%</td>
                            <td class="hidden-480 text-align-right">111</td>
							<td class="hidden-480 text-align-right">15.16</td>
							<td class="hidden-480 text-align-right">15.54</td>
                            <td class="hidden-480 text-align-right">266</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="8">
							<td>8</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2625</td>
							<td class="hidden-480 text-align-right">8.89</td>
							<td class="hidden-480 text-align-right">20.19%</td>
                            <td class="hidden-480 text-align-right">139</td>
							<td class="hidden-480 text-align-right">8.87</td>
							<td class="hidden-480 text-align-right">9.09</td>
                            <td class="hidden-480 text-align-right">218</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="9">
							<td>9</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 text-align-right strike">2650</td>
							<td class="hidden-480 text-align-right">4.91</td>
							<td class="hidden-480 text-align-right">20.13%</td>
                            <td class="hidden-480 text-align-right">114</td>
							<td class="hidden-480 text-align-right">4.85</td>
							<td class="hidden-480 text-align-right">4.97</td>
                            <td class="hidden-480 text-align-right">218</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="10">
							<td>10</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2675</td>
							<td class="hidden-480 text-align-right">2.50</td>
							<td class="hidden-480 text-align-right">20.19%</td>
                            <td class="hidden-480 text-align-right">114</td>
							<td class="hidden-480 text-align-right">2.47</td>
							<td class="hidden-480 text-align-right">2.53</td>
                            <td class="hidden-480 text-align-right">238</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
						<tr id="11">
							<td>11</td>
							<td>C</td>
							<td>June 2014</td>
							<td class="hidden-480 strike text-align-right">2700</td>
							<td class="hidden-480 text-align-right">1.19</td>
							<td class="hidden-480 text-align-right">20.20%</td>
                            <td class="hidden-480 text-align-right">110</td>
							<td class="hidden-480 text-align-right">1.17</td>
							<td class="hidden-480 text-align-right">1.20</td>
                            <td class="hidden-480 text-align-right">253</td>
							<td class="hidden-480 text-align-right">2.50%</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<!-- END PAGE CONTENT-->