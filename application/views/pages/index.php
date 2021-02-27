    <div class="col-md-7 col-sm-7 border-bottom">
        <div class="row">
            <div class="middle-bar">
                <div class="m-bar-first">
            <div class="middle-bar-left">
                 <h2>Queries for You</h2>
            </div>
             <div class="middle-bar-right">
                  <a class="btn btn-info" href="<?=base_url('home/askquestion')?>">Ask Question</a>
                
            </div>
            </div>
            
            <div class="tab-top">
                <div class="tab-top-ul">
                    <ul class="list-inline">
                        <li><a href="#">Interesting</a></li>
                        <li><a href="#">Bountied</a></li>
                        <li><a href="#">Hot</a></li>
                        <li><a href="#">Week</a></li>
                        <li><a href="#">Month</a></li>
                    </ul>
                    
                </div>
                
            </div>
            
            <?php foreach($quetions as $row){ ?>
            

            <div class="col-md-4 col-sm-4 padd0">
                <div class="col-md-4 col-xs-4 padd5">
                    <div class="v-group">
                        <div class="v-group-first"><span><?=$row['vote']?></span></div>
                        <div class="v-group-second"><span>Vots</span></div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-4 padd5">
                    <div class="v-group">
                        <div class="v-group-first"><span class="dark-bg"><?=$row['answer']?></span></div>
                        <div class="v-group-second"><span class="dark-bg">answer</span></div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-4 padd5">
                    <div class="v-group">
                        <div class="v-group-first"><span ><?=$row['view']?></span></div>
                        <div class="v-group-second"><span>View</span></span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-8">
                <div class="common-methods col-md-9 col-sm-9">
                    <h3><?=$row['title']?></h3>
                    <div class="blue-label-outer">
                        <?php $query = $this->db->select('name')->from('skill as s')->join('tags as t', 't.skill_id = s.id', 'LEFT')
                        ->where(array('quetions_id' =>$row['id']))->get();
                        $tags = $query->result_array();
                        foreach($tags as $raw1) { ?><div class="blue-labels"><?=$raw1['name']?></div><?php } ?>
                    </div>
                </div>
                <div class="col-md-3 col-md-3 padd0">
                    <div class="about-time">
                        <p><span><?=$row['created_at']?></span><span class="blue"><a href="#"> <?=$row['name']?></a></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12"><hr/></div>
            <?php } ?>
        </div>
    </div>
</div>
    
    
    