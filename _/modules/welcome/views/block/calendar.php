<div class="span6 "style="width:40%;">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet box blue" >
        <div class="portlet-title">
            <div class="caption"><i class="icon-reorder"></i><?php trans('calendar') ?></div>
        </div>
        <div class="portlet-body">
            <div class="scroller" data-height="650px" data-always-visible="1" data-rail-visible="1">
                <div class="span12 pd_top">
                    <ul class="timeline">
                    <?php
                        foreach($calendar['current'] as $key=>$value)
                        {
                            $meta_keyword = $value['meta_keyword'];
                            $arr_meta_keyword = explode('-', $meta_keyword);
                            $year = isset($arr_meta_keyword['0']) ? $arr_meta_keyword['0'] : "";
                            $quy = isset($arr_meta_keyword['1']) ? $arr_meta_keyword['1'] : "";
                            
                            $meta_description = $value['meta_description'];
                            $arr_meta_description = explode('-', $meta_description);
                            $color = isset($arr_meta_description['0']) ? $arr_meta_description['0'] : "red";
                            
                    ?>
                        <li class="timeline-<?php echo $color ?>">
                            <div class="timeline-time">
                                <span class="date"><?php echo $year ?></span>
                                <span class="time"><?php echo $quy ?></span>
                            </div>
                            <div class="timeline-icon"><i class="icon-trophy"></i></div>
                            <div class="timeline-body">
                                <h2 style="line-height: 30px; font-size: 20px;"><?php echo $value['title'] ?></h2>
                                <div class="timeline-content">
                                    <?php echo $value['description'] ?>
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="nav-link pull-right">
                                    Read more <i class="m-icon-swapright m-icon-white"></i>                              
                                    </a>  
                                </div>
                            </div>
                        </li>
                    <?php
                        }
                    ?>
                    <!--
                        <li class="timeline-yellow">
                            <div class="timeline-time">
                                <span class="date">2014</span>
                                <span class="time">Q1</span>
                            </div>
                            <div class="timeline-icon"><i class="icon-facetime-video"></i></div>
                            <div class="timeline-body">
                                <h2>Development and Contribution</h2>
                                <div class="timeline-content">
                                    Caulie dandelion maize lentil collard greens radish arugula sweet pepper water spinach kombu courgette lettuce. 
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="nav-link">
                                    Read more <i class="m-icon-swapright m-icon-white"></i>                              
                                    </a>                         
                                </div>
                            </div>
                        </li>
                        <li class="timeline-green">
                            <div class="timeline-time">
                                <span class="date">2014</span>
                                <span class="time">Q2</span>
                            </div>
                            <div class="timeline-icon"><i class="icon-comments"></i></div>
                            <div class="timeline-body">
                                <h2>Deployment, Tests and Training</h2>
                                <div class="timeline-content">
                                    Winter purslane courgette pumpkin quandong komatsuna fennel green bean cucumber watercress. 
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="nav-link">
                                    Read more <i class="m-icon-swapright m-icon-white"></i>                              
                                    </a>                        
                                </div>
                            </div>
                        </li>
                        <li class="timeline-blue">
                            <div class="timeline-time">
                                <span class="date">2014</span>
                                <span class="time">Q3</span>
                            </div>
                            <div class="timeline-icon"><i class="icon-music"></i></div>
                            <div class="timeline-body">
                                <h2>VN Virtual Derivatives Market goes LIVE</h2>
                                <div class="timeline-content">
                                    <div class="timeline-content">
                                   We can all play a winning game, and be ready for the Vietnam Derivatives Market start.
                                </div>
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="nav-link">
                                    Read more <i class="m-icon-swapright m-icon-white"></i>                              
                                    </a>                        
                                </div>
                            </div>
                        </li>
                    -->    
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END Portlet PORTLET-->
</div>