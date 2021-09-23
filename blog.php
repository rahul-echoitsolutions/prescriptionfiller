<?php
    session_start();
	include("includes/head.php");
	require("includes/lib/classes/a/blogs.php");
	require("includes/lib/classes/a/settings.php");
	require("includes/lib/classes/a/blogcategory.php");
	require("includes/lib/classes/a/blogComments.php");
    
    
	$blogcomments			=   new blogComments();       
	$blocategory			=	new blogcategory();
	$settings				=	new settings();
	$blogs					=   new blogs();
	$options				=	array();
	$search 				= 	$request->postvalue('search');
    $page   				= 	($request->getvalue('page')=='')?1:$request->getvalue('page');
    $rows                   =   5;
    $section                =   '';
    

    $options['page']        =  $page;
    $options['agent_id']    =   0;
    
	
	if($search!='')
	$options['search']		=	$search;
	$options['agent_id']	=	0;
	$tag					=	str_replace("-",' ',$request->getvalue('tag'));
    $topic					=	$request->getvalue('topic');
    
    if($tag!='') {
	$options['tag']			=	$tag;
    $section               .=   "&tag=$tag";
    }
    
	if($topic!=''){
	$options['topic']		=	$topic;
	$blocategory->load($topic);
    $section               .=   "&topic=$topic";
	}
    
    
    $options['rows_per_page']   =   $rows;    	
	$options['live']		    =	1;
    

	$page_title				    =	"Blogs";
	$bloglist 			    	=	$blogs->getlist($options);
    
    $total_records		        =	$blogs->getTotalBlogsLive($options);
	$total_pages		        =	ceil($total_records/$rows);
    
    include("includes/header.php");
?>



  <?php
	/*  <div class="page-banner">
      <div class="container">
           <div class="row">
          <div class="col-md-6"   style="margin-top: 20px;">
            <h2>Blogs </h2>
          </div>
          <div class="col-md-6"   style="margin-top: 20px;">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li>Blog<? if($topic!='') echo '/'.$blocategory->category_name;?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    */
?>

    
         <!-- Start Content -->
        <div id="content">
          <div class="container" style="margin-top:15px; margin-bottom:10px;">
            <div class="page-content">
              <div class="row">
               

                    
                    	<div class="col-md-8 col-sm-12 top100">
                         <h2 style="margin-top:-4px;">Blog</h2><br /><br />
                         <?php if($bloglist!='empty') {?>
                         <?php foreach($bloglist as $list) {
							 $date = date('d-F-Y',strtotime( $list['created_date']));
							  ?>
                        	<div class="post">
                            	<h3 class="title">
                                    <span>
                                        <?php
/*	<a href="view-blog-<?php echo $list['blog_id']; ?>.html">  */
?>

                        <a href="jajavascript:void(0)"></a><?php echo cleanit($list['blog_name']); ?></a>
                                    </span></h3>
                           		
                                <div class="post_info" style="border-top:1px dashed #CCC; border-bottom:1px dashed #CCC; margin-bottom:10px; height:27px;">
                                	<div style="width:60%; float:left;">On <span><?php echo $date; ?></span> </div>
                                    <div style="float:right; width:40%;"><a href="#"><? echo $list['total']; ?></a> Comments</div>                                    
                                	<div class="clear"></div>
                                </div>
                                <p>
                                <?php if($list['thumb_image']!='')  echo "<img src=\"images/blogs/small/{$list['thumb_image']}\" style='float:left; 
                                margin:4px; padding:4px; padding-right:10px;'>";?>
                                <?php echo cleanit($list['short_desc']); ?>...</p>
                         
                              
                            
	 <a href="viewblog?blog_id=<?php echo $list['blog_id']; ?>" class="arrow_link">Read more</a>
    

                               
                            </div>
                            <div style="clear: both;"></div><br />
                            <?php } ?>
                            <?php } else echo "Nothing Found";?>
                            
                            <?php /*
                            <div class="pagination">
                            
                                <ul>
                                  <li><a href="#">&larr;</a></li>
                                  <li class="active"><a href="#">10</a></li>
                                  <li class="disabled"><a href="#">...</a></li>
                                  <li><a href="#">20</a></li>
                                  <li><a href="#">&rarr;</a></li>
                                </ul>
                            </div>
                            */ ?>
                            
                            
                            
                  <?php if($total_pages>1) { ?>
                  
            	    <!--------------------- Paging ------------------------------------------------------------------->
                
                   <span class="<?=($page==1)?'pageOn':'pageOff';?>" title="First page"><?php if($page!=1) {?>
                   <a class="pagination_link" href="?<?=$section;?>page=1">&lt;&lt;</a><?php } else echo '&lt;&lt;'; ?></span>
                   
                   <span class="<?=($page==1)?'pageOn':'pageOff';?>" title="Previous page" ><?php if($page>=2) {?>
                   <a class="pagination_link" href="?<?=$section;?>page=<?=$page-1;?>">&lt;</a><?php } else echo '&lt;';?></span>
                	
						<?php for($i=1; $i<=$total_pages; $i++) { ?>
                        
                   				<?php if($page==$i) { ?>
                                    		<span class="pageOn" ><?=$i;?></span>
								<? } else { ?>
                   							<span class="pageOff" ><a class = "pagination_link" href="?<?=$section;?>page=<?=$i;?>"><?=$i;?></a></span>
								<? } ?>
                                
                                
                   		<?php }	// end for loop?>
                   
                   
                  <span class="<?=($page==$total_pages)?'pageOn':'pageOff';?>" title="Next page" >
                  <?php if($page>$total_pages) { ?><a class = "pagination_link" href="<?=$seciont;?>?page=<?=$page+1;?>">&gt;</a><?php } else { ?>
                  &gt;<?php } ?>
                  </span>
                  
                  
                  <span class="<?=($page==$total_pages)?'pageOn':'pageOff';?>" title="Last page (<?=$total_pages;?>)" >
				  <? if($page!=$total_pages) { ?><a class = "pagination_link" href="?<?=$section;?>page=<?=$total_pages;?>">&gt;&gt;</a> <?php } else {?>
                  &gt;&gt; <?php } ?>
                  </span> 
                  
                  <span style = 'font-weight:800;'><?=$total_records;?> Posts Found</span>
                  
                <!-------------------------------- END OF PAGING  ------------------------------>  
                <?php } // if total_pages > 0?><br /><br />
                        </div>
                    	<div class="col-md-4 col-sm-12 top100">
                        	<div class="sidebar">
                            	<div class="widget">
                                	<form class="form-search" method="post">
                                        <input type="text" class="input-medium search-query" name="search" required>
                                        <button type="submit" class="btn dark_btn">Search</button>
                                     </form>
                                </div>
<?php
/*
	                                <div class="widget">
                                	<h2 class="title"><span>Blog Topic</span></h2>
                                	<ul class="links">
                                    <? 
									$options['sort_by']			= 'category_name';
									$options['sort_direction']	= 'ASC';
									$options['agent_id']		= '0';
									$options['status']			= 'active';
									$categorylist = $blocategory->getlist($options);
                                    if($categorylist != 'empty') { 
									foreach($categorylist as $catlist)
									{
									 ?>
                                    	<li><a href="blog-topic-<? echo $catlist['blogcategory_id']; ?>.html"><? echo $catlist['category_name']; ?></a></li> 
                                      <? } ?>
                                    </ul>    
                                    <? } ?>
                                                                   
                                </div>
                                */
?>
                                <div class="widget">
                                	<h2 class="title"><span>Recent Posts</span></h2>
                                    <ul class="recent_post">
                                    <?php 
									 $options1['rows_per_page']	= 3;
									 $options1['live']			= 1;
									 $option1['agent_id']		= 0;
									 $bloglist 					= $blogs->getlist($options1);
									  if($bloglist!='empty') {
									  foreach($bloglist as $list){
										 
									
									 ?>
                                	
                                    	<li>
                                        	<div><a href="viewblog?blog_id=<?php echo $list['blog_id']; ?>.html"> <? 
                                            echo $list['blog_name']; ?> </a></div>
                                            <span style="font-size:11px;"><? echo date('d F Y',strtotime( $list['created_date'])); ?></span>
                                        	<div class="clear"></div>
                                        </li>
                                        
                                     <?	} ?>
                                    </ul>
                                   <?	} ?> 
                                	
                                </div>
                            </div>                             
                        </div>                	
                </div>
            </div>
        </div>



<?php
	include("includes/footer.php");
?>