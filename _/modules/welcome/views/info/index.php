<!-- BEGIN PAGE CONTENT INNER -->
<div class="page-content-inner">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart font-green"></i>
                        <span class="caption-subject font-green uppercase bold">Sales Summary</span>
                        <span class="caption-helper hide">weekly stats...</span>
                    </div>
                    <!--div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Today</label>
                            <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Week</label>
                            <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Month</label>
                        </div>
                    </div-->
                </div>
                <div class="portlet-body">
                    <table class="table sortable no-margin" pagination="false" footer="false" search="false" cellspacing="0" display_record="11" width="100%" height="100">
                        <thead>
                            <tr>
                                <th width="20%" scope="col" sType="string" bSortable="true"><?php trans('idx_ref'); ?><span class="column-sort"> <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a> <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a> </span></th>
                                <th width="20%" scope="col" sType="string" bSortable="true"><?php trans('detail'); ?><span class="column-sort"> <a href="#" title="<?php trans('sort_up'); ?>" class="sort-up"></a> <a href="#" title="<?php trans('sort_down'); ?>" class="sort-down"></a> </span> </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('idx_code'); ?></td>
                                    <td style="text-align: left; width: 20%;">
                                        <span><?php echo isset($ref[0]['idx_code']) ? $ref[0]['idx_code'] : ''; ?></span>
                                        
                                            <a class="btn btn-xs blue" id ="statistics_ref"><?php trans('bt_statistics'); ?></a> 
                                            <a class="btn btn-xs red"><?php trans('bt_history'); ?></a>                                            
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('currency'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo isset($ref[0]['idx_curr']) ? $ref[0]['idx_curr'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('base_value'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo isset($ref[0]['idx_base']) ? $ref[0]['idx_base'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('base_date'); ?></td>
                                    <td style="text-align: left; width: 20%;">
                                        <span><?php echo isset($ref[0]['idx_dtbase']) ? $ref[0]['idx_dtbase'] : ''; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('type'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo isset($ref[0]['idx_type']) ? $ref[0]['idx_type'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('mother_code'); ?></td>
                                    <td style="text-align: left; width: 20%;">
                                        <a href="<?php echo admin_url(); ?>idx_page/index/<?php echo isset($ref[0]['idx_mother']) ? $ref[0]['idx_mother'] : ''; ?>">
                                            <?php
                                            echo isset($ref[0]['idx_mother']) ? $ref[0]['idx_mother'] : '';
                                            ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('category'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo isset($ref[0]['idx_bbs']) ? $ref[0]['idx_bbs'] : ''; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('constituents'); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo isset($const) ? $const : ''; ?></td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans('linked_indexes'); ?></td>
                                    <td style="text-align: left; width: 20%;">
                                        <span><?php echo isset($linked) ? $linked : ''; ?></span>
                                        <a id="info" code='<?php echo isset($ref[0]['idx_mother']) ? $ref[0]['idx_mother'] : ''; ?>' class="btn btn-xs blue">
                                            <?php trans('bt_info'); ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; width: 5%;"><?php trans("calcul_types"); ?></td>
                                    <td style="text-align: left; width: 20%;"><?php echo isset($ref[0]['calcul_types']) ? $ref[0]['calcul_types'] : ""; ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart font-red"></i>
                        <span class="caption-subject font-red bold uppercase">Member Activity</span>
                        <span class="caption-helper">weekly stats...</span>
                    </div>
                    <!--div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent green btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Today</label>
                            <label class="btn btn-transparent green btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Week</label>
                            <label class="btn btn-transparent green btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Month</label>
                        </div>
                    </div-->
                </div>
                <div class="portlet-body">
                   <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_1">
                        <thead>
                            <tr>
                                <th class="all">First name</th>
                                <th class="min-phone-l">Last name</th>
                                <th class="min-tablet">Position</th>
                                <th class="none">Office</th>
                                <th class="none">Age</th>
                                <th class="none">Start date</th>
                                <th class="desktop">Salary</th>
                                <th class="none">Extn.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger</td>
                                <td>Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>5421</td>
                            </tr>
                            <tr>
                                <td>Garrett</td>
                                <td>Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>$170,750</td>
                                <td>8422</td>
                            </tr>
                            <tr>
                                <td>Ashton</td>
                                <td>Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>$86,000</td>
                                <td>1562</td>
                            </tr>
                            <tr>
                                <td>Cedric</td>
                                <td>Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                                <td>6224</td>
                            </tr>
                            <tr>
                                <td>Airi</td>
                                <td>Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>$162,700</td>
                                <td>5407</td>
                            </tr>
                            <tr>
                                <td>Brielle</td>
                                <td>Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>$372,000</td>
                                <td>4804</td>
                            </tr>
                            <tr>
                                <td>Herrod</td>
                                <td>Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012/08/06</td>
                                <td>$137,500</td>
                                <td>9608</td>
                            </tr>
                            <tr>
                                <td>Rhona</td>
                                <td>Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010/10/14</td>
                                <td>$327,900</td>
                                <td>6200</td>
                            </tr>
                            <tr>
                                <td>Colleen</td>
                                <td>Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009/09/15</td>
                                <td>$205,500</td>
                                <td>2360</td>
                            </tr>
                            <tr>
                                <td>Sonya</td>
                                <td>Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>23</td>
                                <td>2008/12/13</td>
                                <td>$103,600</td>
                                <td>1667</td>
                            </tr>
                            <tr>
                                <td>Jena</td>
                                <td>Gaines</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>30</td>
                                <td>2008/12/19</td>
                                <td>$90,560</td>
                                <td>3814</td>
                            </tr>
                            <tr>
                                <td>Quinn</td>
                                <td>Flynn</td>
                                <td>Support Lead</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2013/03/03</td>
                                <td>$342,000</td>
                                <td>9497</td>
                            </tr>
                            <tr>
                                <td>Charde</td>
                                <td>Marshall</td>
                                <td>Regional Director</td>
                                <td>San Francisco</td>
                                <td>36</td>
                                <td>2008/10/16</td>
                                <td>$470,600</td>
                                <td>6741</td>
                            </tr>
                            <tr>
                                <td>Haley</td>
                                <td>Kennedy</td>
                                <td>Senior Marketing Designer</td>
                                <td>London</td>
                                <td>43</td>
                                <td>2012/12/18</td>
                                <td>$313,500</td>
                                <td>3597</td>
                            </tr>
                            <tr>
                                <td>Tatyana</td>
                                <td>Fitzpatrick</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>19</td>
                                <td>2010/03/17</td>
                                <td>$385,750</td>
                                <td>1965</td>
                            </tr>
                            <tr>
                                <td>Michael</td>
                                <td>Silva</td>
                                <td>Marketing Designer</td>
                                <td>London</td>
                                <td>66</td>
                                <td>2012/11/27</td>
                                <td>$198,500</td>
                                <td>1581</td>
                            </tr>
                            <tr>
                                <td>Paul</td>
                                <td>Byrd</td>
                                <td>Chief Financial Officer (CFO)</td>
                                <td>New York</td>
                                <td>64</td>
                                <td>2010/06/09</td>
                                <td>$725,000</td>
                                <td>3059</td>
                            </tr>
                            <tr>
                                <td>Gloria</td>
                                <td>Little</td>
                                <td>Systems Administrator</td>
                                <td>New York</td>
                                <td>59</td>
                                <td>2009/04/10</td>
                                <td>$237,500</td>
                                <td>1721</td>
                            </tr>
                            <tr>
                                <td>Bradley</td>
                                <td>Greer</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>41</td>
                                <td>2012/10/13</td>
                                <td>$132,000</td>
                                <td>2558</td>
                            </tr>
                            <tr>
                                <td>Dai</td>
                                <td>Rios</td>
                                <td>Personnel Lead</td>
                                <td>Edinburgh</td>
                                <td>35</td>
                                <td>2012/09/26</td>
                                <td>$217,500</td>
                                <td>2290</td>
                            </tr>
                            <tr>
                                <td>Jenette</td>
                                <td>Caldwell</td>
                                <td>Development Lead</td>
                                <td>New York</td>
                                <td>30</td>
                                <td>2011/09/03</td>
                                <td>$345,000</td>
                                <td>1937</td>
                            </tr>
                            <tr>
                                <td>Yuri</td>
                                <td>Berry</td>
                                <td>Chief Marketing Officer (CMO)</td>
                                <td>New York</td>
                                <td>40</td>
                                <td>2009/06/25</td>
                                <td>$675,000</td>
                                <td>6154</td>
                            </tr>
                            <tr>
                                <td>Caesar</td>
                                <td>Vance</td>
                                <td>Pre-Sales Support</td>
                                <td>New York</td>
                                <td>21</td>
                                <td>2011/12/12</td>
                                <td>$106,450</td>
                                <td>8330</td>
                            </tr>
                            <tr>
                                <td>Doris</td>
                                <td>Wilder</td>
                                <td>Sales Assistant</td>
                                <td>Sidney</td>
                                <td>23</td>
                                <td>2010/09/20</td>
                                <td>$85,600</td>
                                <td>3023</td>
                            </tr>
                            <tr>
                                <td>Angelica</td>
                                <td>Ramos</td>
                                <td>Chief Executive Officer (CEO)</td>
                                <td>London</td>
                                <td>47</td>
                                <td>2009/10/09</td>
                                <td>$1,200,000</td>
                                <td>5797</td>
                            </tr>
                            <tr>
                                <td>Gavin</td>
                                <td>Joyce</td>
                                <td>Developer</td>
                                <td>Edinburgh</td>
                                <td>42</td>
                                <td>2010/12/22</td>
                                <td>$92,575</td>
                                <td>8822</td>
                            </tr>
                            <tr>
                                <td>Jennifer</td>
                                <td>Chang</td>
                                <td>Regional Director</td>
                                <td>Singapore</td>
                                <td>28</td>
                                <td>2010/11/14</td>
                                <td>$357,650</td>
                                <td>9239</td>
                            </tr>
                            <tr>
                                <td>Brenden</td>
                                <td>Wagner</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>28</td>
                                <td>2011/06/07</td>
                                <td>$206,850</td>
                                <td>1314</td>
                            </tr>
                            <tr>
                                <td>Fiona</td>
                                <td>Green</td>
                                <td>Chief Operating Officer (COO)</td>
                                <td>San Francisco</td>
                                <td>48</td>
                                <td>2010/03/11</td>
                                <td>$850,000</td>
                                <td>2947</td>
                            </tr>
                            <tr>
                                <td>Shou</td>
                                <td>Itou</td>
                                <td>Regional Marketing</td>
                                <td>Tokyo</td>
                                <td>20</td>
                                <td>2011/08/14</td>
                                <td>$163,000</td>
                                <td>8899</td>
                            </tr>
                            <tr>
                                <td>Michelle</td>
                                <td>House</td>
                                <td>Integration Specialist</td>
                                <td>Sidney</td>
                                <td>37</td>
                                <td>2011/06/02</td>
                                <td>$95,400</td>
                                <td>2769</td>
                            </tr>
                            <tr>
                                <td>Suki</td>
                                <td>Burks</td>
                                <td>Developer</td>
                                <td>London</td>
                                <td>53</td>
                                <td>2009/10/22</td>
                                <td>$114,500</td>
                                <td>6832</td>
                            </tr>
                            <tr>
                                <td>Prescott</td>
                                <td>Bartlett</td>
                                <td>Technical Author</td>
                                <td>London</td>
                                <td>27</td>
                                <td>2011/05/07</td>
                                <td>$145,000</td>
                                <td>3606</td>
                            </tr>
                            <tr>
                                <td>Gavin</td>
                                <td>Cortez</td>
                                <td>Team Leader</td>
                                <td>San Francisco</td>
                                <td>22</td>
                                <td>2008/10/26</td>
                                <td>$235,500</td>
                                <td>2860</td>
                            </tr>
                            <tr>
                                <td>Martena</td>
                                <td>Mccray</td>
                                <td>Post-Sales support</td>
                                <td>Edinburgh</td>
                                <td>46</td>
                                <td>2011/03/09</td>
                                <td>$324,050</td>
                                <td>8240</td>
                            </tr>
                            <tr>
                                <td>Unity</td>
                                <td>Butler</td>
                                <td>Marketing Designer</td>
                                <td>San Francisco</td>
                                <td>47</td>
                                <td>2009/12/09</td>
                                <td>$85,675</td>
                                <td>5384</td>
                            </tr>
                            <tr>
                                <td>Howard</td>
                                <td>Hatfield</td>
                                <td>Office Manager</td>
                                <td>San Francisco</td>
                                <td>51</td>
                                <td>2008/12/16</td>
                                <td>$164,500</td>
                                <td>7031</td>
                            </tr>
                            <tr>
                                <td>Hope</td>
                                <td>Fuentes</td>
                                <td>Secretary</td>
                                <td>San Francisco</td>
                                <td>41</td>
                                <td>2010/02/12</td>
                                <td>$109,850</td>
                                <td>6318</td>
                            </tr>
                            <tr>
                                <td>Vivian</td>
                                <td>Harrell</td>
                                <td>Financial Controller</td>
                                <td>San Francisco</td>
                                <td>62</td>
                                <td>2009/02/14</td>
                                <td>$452,500</td>
                                <td>9422</td>
                            </tr>
                            <tr>
                                <td>Timothy</td>
                                <td>Mooney</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>37</td>
                                <td>2008/12/11</td>
                                <td>$136,200</td>
                                <td>7580</td>
                            </tr>
                            <tr>
                                <td>Jackson</td>
                                <td>Bradshaw</td>
                                <td>Director</td>
                                <td>New York</td>
                                <td>65</td>
                                <td>2008/09/26</td>
                                <td>$645,750</td>
                                <td>1042</td>
                            </tr>
                            <tr>
                                <td>Olivia</td>
                                <td>Liang</td>
                                <td>Support Engineer</td>
                                <td>Singapore</td>
                                <td>64</td>
                                <td>2011/02/03</td>
                                <td>$234,500</td>
                                <td>2120</td>
                            </tr>
                            <tr>
                                <td>Bruno</td>
                                <td>Nash</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>38</td>
                                <td>2011/05/03</td>
                                <td>$163,500</td>
                                <td>6222</td>
                            </tr>
                            <tr>
                                <td>Sakura</td>
                                <td>Yamamoto</td>
                                <td>Support Engineer</td>
                                <td>Tokyo</td>
                                <td>37</td>
                                <td>2009/08/19</td>
                                <td>$139,575</td>
                                <td>9383</td>
                            </tr>
                            <tr>
                                <td>Thor</td>
                                <td>Walton</td>
                                <td>Developer</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2013/08/11</td>
                                <td>$98,540</td>
                                <td>8327</td>
                            </tr>
                            <tr>
                                <td>Finn</td>
                                <td>Camacho</td>
                                <td>Support Engineer</td>
                                <td>San Francisco</td>
                                <td>47</td>
                                <td>2009/07/07</td>
                                <td>$87,500</td>
                                <td>2927</td>
                            </tr>
                            <tr>
                                <td>Serge</td>
                                <td>Baldwin</td>
                                <td>Data Coordinator</td>
                                <td>Singapore</td>
                                <td>64</td>
                                <td>2012/04/09</td>
                                <td>$138,575</td>
                                <td>8352</td>
                            </tr>
                            <tr>
                                <td>Zenaida</td>
                                <td>Frank</td>
                                <td>Software Engineer</td>
                                <td>New York</td>
                                <td>63</td>
                                <td>2010/01/04</td>
                                <td>$125,250</td>
                                <td>7439</td>
                            </tr>
                            <tr>
                                <td>Zorita</td>
                                <td>Serrano</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>56</td>
                                <td>2012/06/01</td>
                                <td>$115,000</td>
                                <td>4389</td>
                            </tr>
                            <tr>
                                <td>Jennifer</td>
                                <td>Acosta</td>
                                <td>Junior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>43</td>
                                <td>2013/02/01</td>
                                <td>$75,650</td>
                                <td>3431</td>
                            </tr>
                            <tr>
                                <td>Cara</td>
                                <td>Stevens</td>
                                <td>Sales Assistant</td>
                                <td>New York</td>
                                <td>46</td>
                                <td>2011/12/06</td>
                                <td>$145,600</td>
                                <td>3990</td>
                            </tr>
                            <tr>
                                <td>Hermione</td>
                                <td>Butler</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>47</td>
                                <td>2011/03/21</td>
                                <td>$356,250</td>
                                <td>1016</td>
                            </tr>
                            <tr>
                                <td>Lael</td>
                                <td>Greer</td>
                                <td>Systems Administrator</td>
                                <td>London</td>
                                <td>21</td>
                                <td>2009/02/27</td>
                                <td>$103,500</td>
                                <td>6733</td>
                            </tr>
                            <tr>
                                <td>Jonas</td>
                                <td>Alexander</td>
                                <td>Developer</td>
                                <td>San Francisco</td>
                                <td>30</td>
                                <td>2010/07/14</td>
                                <td>$86,500</td>
                                <td>8196</td>
                            </tr>
                            <tr>
                                <td>Shad</td>
                                <td>Decker</td>
                                <td>Regional Director</td>
                                <td>Edinburgh</td>
                                <td>51</td>
                                <td>2008/11/13</td>
                                <td>$183,000</td>
                                <td>6373</td>
                            </tr>
                            <tr>
                                <td>Michael</td>
                                <td>Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                                <td>29</td>
                                <td>2011/06/27</td>
                                <td>$183,000</td>
                                <td>5384</td>
                            </tr>
                            <tr>
                                <td>Donna</td>
                                <td>Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011/01/25</td>
                                <td>$112,000</td>
                                <td>4226</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet light tasks-widget ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-share font-green-haze hide"></i>
                        <span class="caption-subject font-green bold uppercase">Indexes Composition</span>
                        <!--span class="caption-helper"></span-->
                    </div>
                    <!--div class="actions">
                        <div class="btn-group">
                            <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> More
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;"> All Project </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:;"> AirAsia </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Cruise </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> HSBC </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="javascript:;"> Pending
                                        <span class="badge badge-danger"> 4 </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Completed
                                        <span class="badge badge-success"> 12 </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Overdue
                                        <span class="badge badge-warning"> 9 </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div-->
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_5">
                        <thead>
                            <tr>
                            <?php
        						$colWidth = 0;
        						$colNoWidth = 0;
        						$sumWidth = 0;
        						$sum = 0;
        						foreach ($header_composition as $item) {
        							if(is_numeric($item['width']) && ($item['width'] >=0)) {
        								$colWidth ++;
        								$sumWidth += $item['width'];
        							}
        							else {
        								$colNoWidth ++;
        							}
        							$sum ++;
        						}
        						$divWidth = $colWidth/$sum*90;
        						$divNoWidth = $colNoWidth / $sum * 90;
                                $i=0;
        						//echo "<pre>";print_r($headers);exit;
        						foreach ($header_composition as $item) {
        						  $i++;
        						  	/*switch($item['align']) {*/
        							switch('L') {
        								case 'L':
        									$align = ' class="align-left '.($item['hide_mobile'] == '1' ? 'hidden-sm hidden-xs' : '') .'" ';;
        									break;
        								case 'R':
        									$align = ' class="align-right '.($item['hide_mobile'] == '1' ? 'hidden-sm hidden-xs' : '') .'" ';;
        									break;
        								default:
        									$align = ' class="align-center '.($item['hide_mobile'] == '1' ? 'hidden-sm hidden-xs' : '') .'" ';;
        									break;
        							}
        							$width = (is_numeric($item['width']) && ($item['width'] >=0)) ? ($item['width'] / $sumWidth * $divWidth) : (1/$colNoWidth * $divNoWidth);
        							echo "<th width='".$width."%'" .$align. ($item["hide_mobile"] == '1' ? "data-hide='hidden-sm hidden-xs'" : "") ."><b data-toggle='tooltip' data-placement='". ($i < 3 ? "right" : "top") ."' title='".(isset($item["tips_en"]) ? strip_tags($item["tips_en"]): '' )."'><font color='#666'>".$item['title']."</font></b></th>";
        						}
        						?>
            						<!--th class="align-center" width="10%"><font color="#fff"><?php trans('Action') ?></font></th-->
                                <!--th class="all"><?php trans('code_stk'); ?></th>
                                <th class="all"><?php trans('stk_name'); ?></th>
                                <th class="min-phone-l"><?php trans('shares'); ?></th>
                                <th class="min-tablet"><?php trans('capp'); ?></th>
                                <th class="none"><?php trans('float'); ?></th>
                                <th class="none"><?php trans('price'); ?></th>
                                <th class="none"><?php trans('market_cap'); ?></th>
                                <th class="desktop"><?php trans('stk_dcap_idx'); ?></th>
                                <th class="none"><?php trans('wgt'); ?></th-->
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                              //  print_r($composition);
                              //  print_r($header_composition);exit;
                                if (is_array($composition)) {
                                    $temp = "";
                                    foreach ($composition as $item) {
                                    ?>
                                    <tr>
                                        <?php foreach($header_composition as $value){ ?>
                                        <td  class="with-tip" title="<?php echo $item[$value['field']]; ?>" style="text-align: left; vertical-align: middle;"><?php echo $item[$value['field']]; ?></td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                        
                                    }
                                }
                                ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <!-- BEGIN REGIONAL STATS PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-share font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Regional Stats</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_4">
                        <thead>
                            <tr>
                                <th class="all">First name</th>
                                <th class="min-phone-l">Last name</th>
                                <th class="min-tablet">Position</th>
                                <th class="none">Office</th>
                                <th class="none">Age</th>
                                <th class="none">Start date</th>
                                <th class="desktop">Salary</th>
                                <th class="none">Extn.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger</td>
                                <td>Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>5421</td>
                            </tr>
                            <tr>
                                <td>Garrett</td>
                                <td>Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>$170,750</td>
                                <td>8422</td>
                            </tr>
                            <tr>
                                <td>Ashton</td>
                                <td>Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>$86,000</td>
                                <td>1562</td>
                            </tr>
                            <tr>
                                <td>Cedric</td>
                                <td>Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                                <td>6224</td>
                            </tr>
                            <tr>
                                <td>Airi</td>
                                <td>Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>$162,700</td>
                                <td>5407</td>
                            </tr>
                            <tr>
                                <td>Brielle</td>
                                <td>Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>$372,000</td>
                                <td>4804</td>
                            </tr>
                            <tr>
                                <td>Herrod</td>
                                <td>Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012/08/06</td>
                                <td>$137,500</td>
                                <td>9608</td>
                            </tr>
                            <tr>
                                <td>Rhona</td>
                                <td>Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010/10/14</td>
                                <td>$327,900</td>
                                <td>6200</td>
                            </tr>
                            <tr>
                                <td>Colleen</td>
                                <td>Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009/09/15</td>
                                <td>$205,500</td>
                                <td>2360</td>
                            </tr>
                            <tr>
                                <td>Sonya</td>
                                <td>Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>23</td>
                                <td>2008/12/13</td>
                                <td>$103,600</td>
                                <td>1667</td>
                            </tr>
                            <tr>
                                <td>Jena</td>
                                <td>Gaines</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>30</td>
                                <td>2008/12/19</td>
                                <td>$90,560</td>
                                <td>3814</td>
                            </tr>
                            <tr>
                                <td>Quinn</td>
                                <td>Flynn</td>
                                <td>Support Lead</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2013/03/03</td>
                                <td>$342,000</td>
                                <td>9497</td>
                            </tr>
                            <tr>
                                <td>Charde</td>
                                <td>Marshall</td>
                                <td>Regional Director</td>
                                <td>San Francisco</td>
                                <td>36</td>
                                <td>2008/10/16</td>
                                <td>$470,600</td>
                                <td>6741</td>
                            </tr>
                            <tr>
                                <td>Haley</td>
                                <td>Kennedy</td>
                                <td>Senior Marketing Designer</td>
                                <td>London</td>
                                <td>43</td>
                                <td>2012/12/18</td>
                                <td>$313,500</td>
                                <td>3597</td>
                            </tr>
                            <tr>
                                <td>Tatyana</td>
                                <td>Fitzpatrick</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>19</td>
                                <td>2010/03/17</td>
                                <td>$385,750</td>
                                <td>1965</td>
                            </tr>
                            <tr>
                                <td>Michael</td>
                                <td>Silva</td>
                                <td>Marketing Designer</td>
                                <td>London</td>
                                <td>66</td>
                                <td>2012/11/27</td>
                                <td>$198,500</td>
                                <td>1581</td>
                            </tr>
                            <tr>
                                <td>Paul</td>
                                <td>Byrd</td>
                                <td>Chief Financial Officer (CFO)</td>
                                <td>New York</td>
                                <td>64</td>
                                <td>2010/06/09</td>
                                <td>$725,000</td>
                                <td>3059</td>
                            </tr>
                            <tr>
                                <td>Gloria</td>
                                <td>Little</td>
                                <td>Systems Administrator</td>
                                <td>New York</td>
                                <td>59</td>
                                <td>2009/04/10</td>
                                <td>$237,500</td>
                                <td>1721</td>
                            </tr>
                            <tr>
                                <td>Bradley</td>
                                <td>Greer</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>41</td>
                                <td>2012/10/13</td>
                                <td>$132,000</td>
                                <td>2558</td>
                            </tr>
                            <tr>
                                <td>Dai</td>
                                <td>Rios</td>
                                <td>Personnel Lead</td>
                                <td>Edinburgh</td>
                                <td>35</td>
                                <td>2012/09/26</td>
                                <td>$217,500</td>
                                <td>2290</td>
                            </tr>
                            <tr>
                                <td>Jenette</td>
                                <td>Caldwell</td>
                                <td>Development Lead</td>
                                <td>New York</td>
                                <td>30</td>
                                <td>2011/09/03</td>
                                <td>$345,000</td>
                                <td>1937</td>
                            </tr>
                            <tr>
                                <td>Yuri</td>
                                <td>Berry</td>
                                <td>Chief Marketing Officer (CMO)</td>
                                <td>New York</td>
                                <td>40</td>
                                <td>2009/06/25</td>
                                <td>$675,000</td>
                                <td>6154</td>
                            </tr>
                            <tr>
                                <td>Caesar</td>
                                <td>Vance</td>
                                <td>Pre-Sales Support</td>
                                <td>New York</td>
                                <td>21</td>
                                <td>2011/12/12</td>
                                <td>$106,450</td>
                                <td>8330</td>
                            </tr>
                            <tr>
                                <td>Doris</td>
                                <td>Wilder</td>
                                <td>Sales Assistant</td>
                                <td>Sidney</td>
                                <td>23</td>
                                <td>2010/09/20</td>
                                <td>$85,600</td>
                                <td>3023</td>
                            </tr>
                            <tr>
                                <td>Angelica</td>
                                <td>Ramos</td>
                                <td>Chief Executive Officer (CEO)</td>
                                <td>London</td>
                                <td>47</td>
                                <td>2009/10/09</td>
                                <td>$1,200,000</td>
                                <td>5797</td>
                            </tr>
                            <tr>
                                <td>Gavin</td>
                                <td>Joyce</td>
                                <td>Developer</td>
                                <td>Edinburgh</td>
                                <td>42</td>
                                <td>2010/12/22</td>
                                <td>$92,575</td>
                                <td>8822</td>
                            </tr>
                            <tr>
                                <td>Jennifer</td>
                                <td>Chang</td>
                                <td>Regional Director</td>
                                <td>Singapore</td>
                                <td>28</td>
                                <td>2010/11/14</td>
                                <td>$357,650</td>
                                <td>9239</td>
                            </tr>
                            <tr>
                                <td>Brenden</td>
                                <td>Wagner</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>28</td>
                                <td>2011/06/07</td>
                                <td>$206,850</td>
                                <td>1314</td>
                            </tr>
                            <tr>
                                <td>Fiona</td>
                                <td>Green</td>
                                <td>Chief Operating Officer (COO)</td>
                                <td>San Francisco</td>
                                <td>48</td>
                                <td>2010/03/11</td>
                                <td>$850,000</td>
                                <td>2947</td>
                            </tr>
                            <tr>
                                <td>Shou</td>
                                <td>Itou</td>
                                <td>Regional Marketing</td>
                                <td>Tokyo</td>
                                <td>20</td>
                                <td>2011/08/14</td>
                                <td>$163,000</td>
                                <td>8899</td>
                            </tr>
                            <tr>
                                <td>Michelle</td>
                                <td>House</td>
                                <td>Integration Specialist</td>
                                <td>Sidney</td>
                                <td>37</td>
                                <td>2011/06/02</td>
                                <td>$95,400</td>
                                <td>2769</td>
                            </tr>
                            <tr>
                                <td>Suki</td>
                                <td>Burks</td>
                                <td>Developer</td>
                                <td>London</td>
                                <td>53</td>
                                <td>2009/10/22</td>
                                <td>$114,500</td>
                                <td>6832</td>
                            </tr>
                            <tr>
                                <td>Prescott</td>
                                <td>Bartlett</td>
                                <td>Technical Author</td>
                                <td>London</td>
                                <td>27</td>
                                <td>2011/05/07</td>
                                <td>$145,000</td>
                                <td>3606</td>
                            </tr>
                            <tr>
                                <td>Gavin</td>
                                <td>Cortez</td>
                                <td>Team Leader</td>
                                <td>San Francisco</td>
                                <td>22</td>
                                <td>2008/10/26</td>
                                <td>$235,500</td>
                                <td>2860</td>
                            </tr>
                            <tr>
                                <td>Martena</td>
                                <td>Mccray</td>
                                <td>Post-Sales support</td>
                                <td>Edinburgh</td>
                                <td>46</td>
                                <td>2011/03/09</td>
                                <td>$324,050</td>
                                <td>8240</td>
                            </tr>
                            <tr>
                                <td>Unity</td>
                                <td>Butler</td>
                                <td>Marketing Designer</td>
                                <td>San Francisco</td>
                                <td>47</td>
                                <td>2009/12/09</td>
                                <td>$85,675</td>
                                <td>5384</td>
                            </tr>
                            <tr>
                                <td>Howard</td>
                                <td>Hatfield</td>
                                <td>Office Manager</td>
                                <td>San Francisco</td>
                                <td>51</td>
                                <td>2008/12/16</td>
                                <td>$164,500</td>
                                <td>7031</td>
                            </tr>
                            <tr>
                                <td>Hope</td>
                                <td>Fuentes</td>
                                <td>Secretary</td>
                                <td>San Francisco</td>
                                <td>41</td>
                                <td>2010/02/12</td>
                                <td>$109,850</td>
                                <td>6318</td>
                            </tr>
                            <tr>
                                <td>Vivian</td>
                                <td>Harrell</td>
                                <td>Financial Controller</td>
                                <td>San Francisco</td>
                                <td>62</td>
                                <td>2009/02/14</td>
                                <td>$452,500</td>
                                <td>9422</td>
                            </tr>
                            <tr>
                                <td>Timothy</td>
                                <td>Mooney</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>37</td>
                                <td>2008/12/11</td>
                                <td>$136,200</td>
                                <td>7580</td>
                            </tr>
                            <tr>
                                <td>Jackson</td>
                                <td>Bradshaw</td>
                                <td>Director</td>
                                <td>New York</td>
                                <td>65</td>
                                <td>2008/09/26</td>
                                <td>$645,750</td>
                                <td>1042</td>
                            </tr>
                            <tr>
                                <td>Olivia</td>
                                <td>Liang</td>
                                <td>Support Engineer</td>
                                <td>Singapore</td>
                                <td>64</td>
                                <td>2011/02/03</td>
                                <td>$234,500</td>
                                <td>2120</td>
                            </tr>
                            <tr>
                                <td>Bruno</td>
                                <td>Nash</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>38</td>
                                <td>2011/05/03</td>
                                <td>$163,500</td>
                                <td>6222</td>
                            </tr>
                            <tr>
                                <td>Sakura</td>
                                <td>Yamamoto</td>
                                <td>Support Engineer</td>
                                <td>Tokyo</td>
                                <td>37</td>
                                <td>2009/08/19</td>
                                <td>$139,575</td>
                                <td>9383</td>
                            </tr>
                            <tr>
                                <td>Thor</td>
                                <td>Walton</td>
                                <td>Developer</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2013/08/11</td>
                                <td>$98,540</td>
                                <td>8327</td>
                            </tr>
                            <tr>
                                <td>Finn</td>
                                <td>Camacho</td>
                                <td>Support Engineer</td>
                                <td>San Francisco</td>
                                <td>47</td>
                                <td>2009/07/07</td>
                                <td>$87,500</td>
                                <td>2927</td>
                            </tr>
                            <tr>
                                <td>Serge</td>
                                <td>Baldwin</td>
                                <td>Data Coordinator</td>
                                <td>Singapore</td>
                                <td>64</td>
                                <td>2012/04/09</td>
                                <td>$138,575</td>
                                <td>8352</td>
                            </tr>
                            <tr>
                                <td>Zenaida</td>
                                <td>Frank</td>
                                <td>Software Engineer</td>
                                <td>New York</td>
                                <td>63</td>
                                <td>2010/01/04</td>
                                <td>$125,250</td>
                                <td>7439</td>
                            </tr>
                            <tr>
                                <td>Zorita</td>
                                <td>Serrano</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>56</td>
                                <td>2012/06/01</td>
                                <td>$115,000</td>
                                <td>4389</td>
                            </tr>
                            <tr>
                                <td>Jennifer</td>
                                <td>Acosta</td>
                                <td>Junior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>43</td>
                                <td>2013/02/01</td>
                                <td>$75,650</td>
                                <td>3431</td>
                            </tr>
                            <tr>
                                <td>Cara</td>
                                <td>Stevens</td>
                                <td>Sales Assistant</td>
                                <td>New York</td>
                                <td>46</td>
                                <td>2011/12/06</td>
                                <td>$145,600</td>
                                <td>3990</td>
                            </tr>
                            <tr>
                                <td>Hermione</td>
                                <td>Butler</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>47</td>
                                <td>2011/03/21</td>
                                <td>$356,250</td>
                                <td>1016</td>
                            </tr>
                            <tr>
                                <td>Lael</td>
                                <td>Greer</td>
                                <td>Systems Administrator</td>
                                <td>London</td>
                                <td>21</td>
                                <td>2009/02/27</td>
                                <td>$103,500</td>
                                <td>6733</td>
                            </tr>
                            <tr>
                                <td>Jonas</td>
                                <td>Alexander</td>
                                <td>Developer</td>
                                <td>San Francisco</td>
                                <td>30</td>
                                <td>2010/07/14</td>
                                <td>$86,500</td>
                                <td>8196</td>
                            </tr>
                            <tr>
                                <td>Shad</td>
                                <td>Decker</td>
                                <td>Regional Director</td>
                                <td>Edinburgh</td>
                                <td>51</td>
                                <td>2008/11/13</td>
                                <td>$183,000</td>
                                <td>6373</td>
                            </tr>
                            <tr>
                                <td>Michael</td>
                                <td>Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                                <td>29</td>
                                <td>2011/06/27</td>
                                <td>$183,000</td>
                                <td>5384</td>
                            </tr>
                            <tr>
                                <td>Donna</td>
                                <td>Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011/01/25</td>
                                <td>$112,000</td>
                                <td>4226</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END REGIONAL STATS PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-globe font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Feeds</span>
                    </div>
                    <!--ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" class="active" data-toggle="tab"> System </a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab"> Activities </a>
                        </li>
                    </ul-->
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_3">
                        <thead>
                            <tr>
                                <th class="all">First name</th>
                                <th class="min-phone-l">Last name</th>
                                <th class="min-tablet">Position</th>
                                <th class="none">Office</th>
                                <th class="none">Age</th>
                                <th class="none">Start date</th>
                                <th class="desktop">Salary</th>
                                <th class="none">Extn.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger</td>
                                <td>Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>5421</td>
                            </tr>
                            <tr>
                                <td>Garrett</td>
                                <td>Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>63</td>
                                <td>2011/07/25</td>
                                <td>$170,750</td>
                                <td>8422</td>
                            </tr>
                            <tr>
                                <td>Ashton</td>
                                <td>Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td>66</td>
                                <td>2009/01/12</td>
                                <td>$86,000</td>
                                <td>1562</td>
                            </tr>
                            <tr>
                                <td>Cedric</td>
                                <td>Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                                <td>6224</td>
                            </tr>
                            <tr>
                                <td>Airi</td>
                                <td>Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td>33</td>
                                <td>2008/11/28</td>
                                <td>$162,700</td>
                                <td>5407</td>
                            </tr>
                            <tr>
                                <td>Brielle</td>
                                <td>Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2012/12/02</td>
                                <td>$372,000</td>
                                <td>4804</td>
                            </tr>
                            <tr>
                                <td>Herrod</td>
                                <td>Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td>59</td>
                                <td>2012/08/06</td>
                                <td>$137,500</td>
                                <td>9608</td>
                            </tr>
                            <tr>
                                <td>Rhona</td>
                                <td>Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td>55</td>
                                <td>2010/10/14</td>
                                <td>$327,900</td>
                                <td>6200</td>
                            </tr>
                            <tr>
                                <td>Colleen</td>
                                <td>Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td>39</td>
                                <td>2009/09/15</td>
                                <td>$205,500</td>
                                <td>2360</td>
                            </tr>
                            <tr>
                                <td>Sonya</td>
                                <td>Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td>23</td>
                                <td>2008/12/13</td>
                                <td>$103,600</td>
                                <td>1667</td>
                            </tr>
                            <tr>
                                <td>Jena</td>
                                <td>Gaines</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>30</td>
                                <td>2008/12/19</td>
                                <td>$90,560</td>
                                <td>3814</td>
                            </tr>
                            <tr>
                                <td>Quinn</td>
                                <td>Flynn</td>
                                <td>Support Lead</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2013/03/03</td>
                                <td>$342,000</td>
                                <td>9497</td>
                            </tr>
                            <tr>
                                <td>Charde</td>
                                <td>Marshall</td>
                                <td>Regional Director</td>
                                <td>San Francisco</td>
                                <td>36</td>
                                <td>2008/10/16</td>
                                <td>$470,600</td>
                                <td>6741</td>
                            </tr>
                            <tr>
                                <td>Haley</td>
                                <td>Kennedy</td>
                                <td>Senior Marketing Designer</td>
                                <td>London</td>
                                <td>43</td>
                                <td>2012/12/18</td>
                                <td>$313,500</td>
                                <td>3597</td>
                            </tr>
                            <tr>
                                <td>Tatyana</td>
                                <td>Fitzpatrick</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>19</td>
                                <td>2010/03/17</td>
                                <td>$385,750</td>
                                <td>1965</td>
                            </tr>
                            <tr>
                                <td>Michael</td>
                                <td>Silva</td>
                                <td>Marketing Designer</td>
                                <td>London</td>
                                <td>66</td>
                                <td>2012/11/27</td>
                                <td>$198,500</td>
                                <td>1581</td>
                            </tr>
                            <tr>
                                <td>Paul</td>
                                <td>Byrd</td>
                                <td>Chief Financial Officer (CFO)</td>
                                <td>New York</td>
                                <td>64</td>
                                <td>2010/06/09</td>
                                <td>$725,000</td>
                                <td>3059</td>
                            </tr>
                            <tr>
                                <td>Gloria</td>
                                <td>Little</td>
                                <td>Systems Administrator</td>
                                <td>New York</td>
                                <td>59</td>
                                <td>2009/04/10</td>
                                <td>$237,500</td>
                                <td>1721</td>
                            </tr>
                            <tr>
                                <td>Bradley</td>
                                <td>Greer</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>41</td>
                                <td>2012/10/13</td>
                                <td>$132,000</td>
                                <td>2558</td>
                            </tr>
                            <tr>
                                <td>Dai</td>
                                <td>Rios</td>
                                <td>Personnel Lead</td>
                                <td>Edinburgh</td>
                                <td>35</td>
                                <td>2012/09/26</td>
                                <td>$217,500</td>
                                <td>2290</td>
                            </tr>
                            <tr>
                                <td>Jenette</td>
                                <td>Caldwell</td>
                                <td>Development Lead</td>
                                <td>New York</td>
                                <td>30</td>
                                <td>2011/09/03</td>
                                <td>$345,000</td>
                                <td>1937</td>
                            </tr>
                            <tr>
                                <td>Yuri</td>
                                <td>Berry</td>
                                <td>Chief Marketing Officer (CMO)</td>
                                <td>New York</td>
                                <td>40</td>
                                <td>2009/06/25</td>
                                <td>$675,000</td>
                                <td>6154</td>
                            </tr>
                            <tr>
                                <td>Caesar</td>
                                <td>Vance</td>
                                <td>Pre-Sales Support</td>
                                <td>New York</td>
                                <td>21</td>
                                <td>2011/12/12</td>
                                <td>$106,450</td>
                                <td>8330</td>
                            </tr>
                            <tr>
                                <td>Doris</td>
                                <td>Wilder</td>
                                <td>Sales Assistant</td>
                                <td>Sidney</td>
                                <td>23</td>
                                <td>2010/09/20</td>
                                <td>$85,600</td>
                                <td>3023</td>
                            </tr>
                            <tr>
                                <td>Angelica</td>
                                <td>Ramos</td>
                                <td>Chief Executive Officer (CEO)</td>
                                <td>London</td>
                                <td>47</td>
                                <td>2009/10/09</td>
                                <td>$1,200,000</td>
                                <td>5797</td>
                            </tr>
                            <tr>
                                <td>Gavin</td>
                                <td>Joyce</td>
                                <td>Developer</td>
                                <td>Edinburgh</td>
                                <td>42</td>
                                <td>2010/12/22</td>
                                <td>$92,575</td>
                                <td>8822</td>
                            </tr>
                            <tr>
                                <td>Jennifer</td>
                                <td>Chang</td>
                                <td>Regional Director</td>
                                <td>Singapore</td>
                                <td>28</td>
                                <td>2010/11/14</td>
                                <td>$357,650</td>
                                <td>9239</td>
                            </tr>
                            <tr>
                                <td>Brenden</td>
                                <td>Wagner</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>28</td>
                                <td>2011/06/07</td>
                                <td>$206,850</td>
                                <td>1314</td>
                            </tr>
                            <tr>
                                <td>Fiona</td>
                                <td>Green</td>
                                <td>Chief Operating Officer (COO)</td>
                                <td>San Francisco</td>
                                <td>48</td>
                                <td>2010/03/11</td>
                                <td>$850,000</td>
                                <td>2947</td>
                            </tr>
                            <tr>
                                <td>Shou</td>
                                <td>Itou</td>
                                <td>Regional Marketing</td>
                                <td>Tokyo</td>
                                <td>20</td>
                                <td>2011/08/14</td>
                                <td>$163,000</td>
                                <td>8899</td>
                            </tr>
                            <tr>
                                <td>Michelle</td>
                                <td>House</td>
                                <td>Integration Specialist</td>
                                <td>Sidney</td>
                                <td>37</td>
                                <td>2011/06/02</td>
                                <td>$95,400</td>
                                <td>2769</td>
                            </tr>
                            <tr>
                                <td>Suki</td>
                                <td>Burks</td>
                                <td>Developer</td>
                                <td>London</td>
                                <td>53</td>
                                <td>2009/10/22</td>
                                <td>$114,500</td>
                                <td>6832</td>
                            </tr>
                            <tr>
                                <td>Prescott</td>
                                <td>Bartlett</td>
                                <td>Technical Author</td>
                                <td>London</td>
                                <td>27</td>
                                <td>2011/05/07</td>
                                <td>$145,000</td>
                                <td>3606</td>
                            </tr>
                            <tr>
                                <td>Gavin</td>
                                <td>Cortez</td>
                                <td>Team Leader</td>
                                <td>San Francisco</td>
                                <td>22</td>
                                <td>2008/10/26</td>
                                <td>$235,500</td>
                                <td>2860</td>
                            </tr>
                            <tr>
                                <td>Martena</td>
                                <td>Mccray</td>
                                <td>Post-Sales support</td>
                                <td>Edinburgh</td>
                                <td>46</td>
                                <td>2011/03/09</td>
                                <td>$324,050</td>
                                <td>8240</td>
                            </tr>
                            <tr>
                                <td>Unity</td>
                                <td>Butler</td>
                                <td>Marketing Designer</td>
                                <td>San Francisco</td>
                                <td>47</td>
                                <td>2009/12/09</td>
                                <td>$85,675</td>
                                <td>5384</td>
                            </tr>
                            <tr>
                                <td>Howard</td>
                                <td>Hatfield</td>
                                <td>Office Manager</td>
                                <td>San Francisco</td>
                                <td>51</td>
                                <td>2008/12/16</td>
                                <td>$164,500</td>
                                <td>7031</td>
                            </tr>
                            <tr>
                                <td>Hope</td>
                                <td>Fuentes</td>
                                <td>Secretary</td>
                                <td>San Francisco</td>
                                <td>41</td>
                                <td>2010/02/12</td>
                                <td>$109,850</td>
                                <td>6318</td>
                            </tr>
                            <tr>
                                <td>Vivian</td>
                                <td>Harrell</td>
                                <td>Financial Controller</td>
                                <td>San Francisco</td>
                                <td>62</td>
                                <td>2009/02/14</td>
                                <td>$452,500</td>
                                <td>9422</td>
                            </tr>
                            <tr>
                                <td>Timothy</td>
                                <td>Mooney</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td>37</td>
                                <td>2008/12/11</td>
                                <td>$136,200</td>
                                <td>7580</td>
                            </tr>
                            <tr>
                                <td>Jackson</td>
                                <td>Bradshaw</td>
                                <td>Director</td>
                                <td>New York</td>
                                <td>65</td>
                                <td>2008/09/26</td>
                                <td>$645,750</td>
                                <td>1042</td>
                            </tr>
                            <tr>
                                <td>Olivia</td>
                                <td>Liang</td>
                                <td>Support Engineer</td>
                                <td>Singapore</td>
                                <td>64</td>
                                <td>2011/02/03</td>
                                <td>$234,500</td>
                                <td>2120</td>
                            </tr>
                            <tr>
                                <td>Bruno</td>
                                <td>Nash</td>
                                <td>Software Engineer</td>
                                <td>London</td>
                                <td>38</td>
                                <td>2011/05/03</td>
                                <td>$163,500</td>
                                <td>6222</td>
                            </tr>
                            <tr>
                                <td>Sakura</td>
                                <td>Yamamoto</td>
                                <td>Support Engineer</td>
                                <td>Tokyo</td>
                                <td>37</td>
                                <td>2009/08/19</td>
                                <td>$139,575</td>
                                <td>9383</td>
                            </tr>
                            <tr>
                                <td>Thor</td>
                                <td>Walton</td>
                                <td>Developer</td>
                                <td>New York</td>
                                <td>61</td>
                                <td>2013/08/11</td>
                                <td>$98,540</td>
                                <td>8327</td>
                            </tr>
                            <tr>
                                <td>Finn</td>
                                <td>Camacho</td>
                                <td>Support Engineer</td>
                                <td>San Francisco</td>
                                <td>47</td>
                                <td>2009/07/07</td>
                                <td>$87,500</td>
                                <td>2927</td>
                            </tr>
                            <tr>
                                <td>Serge</td>
                                <td>Baldwin</td>
                                <td>Data Coordinator</td>
                                <td>Singapore</td>
                                <td>64</td>
                                <td>2012/04/09</td>
                                <td>$138,575</td>
                                <td>8352</td>
                            </tr>
                            <tr>
                                <td>Zenaida</td>
                                <td>Frank</td>
                                <td>Software Engineer</td>
                                <td>New York</td>
                                <td>63</td>
                                <td>2010/01/04</td>
                                <td>$125,250</td>
                                <td>7439</td>
                            </tr>
                            <tr>
                                <td>Zorita</td>
                                <td>Serrano</td>
                                <td>Software Engineer</td>
                                <td>San Francisco</td>
                                <td>56</td>
                                <td>2012/06/01</td>
                                <td>$115,000</td>
                                <td>4389</td>
                            </tr>
                            <tr>
                                <td>Jennifer</td>
                                <td>Acosta</td>
                                <td>Junior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>43</td>
                                <td>2013/02/01</td>
                                <td>$75,650</td>
                                <td>3431</td>
                            </tr>
                            <tr>
                                <td>Cara</td>
                                <td>Stevens</td>
                                <td>Sales Assistant</td>
                                <td>New York</td>
                                <td>46</td>
                                <td>2011/12/06</td>
                                <td>$145,600</td>
                                <td>3990</td>
                            </tr>
                            <tr>
                                <td>Hermione</td>
                                <td>Butler</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td>47</td>
                                <td>2011/03/21</td>
                                <td>$356,250</td>
                                <td>1016</td>
                            </tr>
                            <tr>
                                <td>Lael</td>
                                <td>Greer</td>
                                <td>Systems Administrator</td>
                                <td>London</td>
                                <td>21</td>
                                <td>2009/02/27</td>
                                <td>$103,500</td>
                                <td>6733</td>
                            </tr>
                            <tr>
                                <td>Jonas</td>
                                <td>Alexander</td>
                                <td>Developer</td>
                                <td>San Francisco</td>
                                <td>30</td>
                                <td>2010/07/14</td>
                                <td>$86,500</td>
                                <td>8196</td>
                            </tr>
                            <tr>
                                <td>Shad</td>
                                <td>Decker</td>
                                <td>Regional Director</td>
                                <td>Edinburgh</td>
                                <td>51</td>
                                <td>2008/11/13</td>
                                <td>$183,000</td>
                                <td>6373</td>
                            </tr>
                            <tr>
                                <td>Michael</td>
                                <td>Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                                <td>29</td>
                                <td>2011/06/27</td>
                                <td>$183,000</td>
                                <td>5384</td>
                            </tr>
                            <tr>
                                <td>Donna</td>
                                <td>Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>27</td>
                                <td>2011/01/25</td>
                                <td>$112,000</td>
                                <td>4226</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT INNER -->