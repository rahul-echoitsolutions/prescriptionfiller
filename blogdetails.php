<?php
    session_start();
	include("includes/head.php");

	require("includes/lib/classes/a/blogs.php");
	require("includes/lib/classes/a/settings.php");
	require("includes/lib/classes/a/blogcategory.php");
	require("includes/lib/classes/a/blogComments.php");
	$blogcomments			= new blogComments();       
	$blocategory			= new blogcategory();
	$settings				= new settings();	
	$blogs					= new blogs();
	$blog_id				= $request->getvalue('request');
	
	if($blog_id>0)	$blogs->load($blog_id);
	
	if($blogs->blog_id==0) exit(); 
	
	
	$action = $request->postvalue('action');
    
	if($action=='save')
	{
		$blogcomments->name 		= $request->postvalue('name');
		$blogcomments->email 		= $request->postvalue('email');		
		$blogcomments->message 		= $request->postvalue('message');
		$blogcomments->blog_id   	= $blog_id;
		
		$success 			= 1;
		$blogcomments->save();
		
	}
	
  $options['blog_id']	= $blog_id; 
  $options['status']	= 1; 
  $commentlist 			= $blogcomments->getlist($options);
    
    
    include("includes/header.php");
?>



    <div class="page-banner">
      <div class="container">
           <div class="row">
          <div class="col-md-6">
            <h2>Blogs </h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="index.php">Home</a></li>
              <li><?php echo $blogs->blog_name; ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    
         <!-- Start Content -->
        <div id="content">
          <div class="container" style="margin-top:15px; margin-bottom:10px;">
            <div class="page-content">
              <div class="row">
                

                    
                    	<div class="col-md-8">
                        
                        
                        <div class="post">
                            	
                                <h2><a href="view-blog-<?php echo $blogs->blog_id; ?>.html"><?php echo cleanit($blogs->blog_name);?></a></h2>
                                <div class="post_info" style="border-top:1px dashed #CCC; border-bottom:1px dashed #CCC; margin-bottom:10px; height:27px;">
                                	<div style="width:60%; float:left;">On <span><?php 
                                    echo date('d-F-Y',strtotime( $blogs->created_date)); ?></span> / By <a href="javascript:;">Admin </a></div>
                                    <div style="float:right; width:40%;"><a href="javascript:;"><? echo $blogcomments->total; ?></a> Comments</div>                                    
                                	<div class="clear"></div>
                                </div>
                                
                                <p>
                                <?php if($blogs->main_image!='')  echo "<img src=\"images/blogs/large/{$blogs->main_image}\" style='float:right; margin:10px;'>";?>
                                <? echo nl2br($blogs->description); ?>
                                .</p> 
                                
                                
                            </div>
                            
                            
                            
                            <!-- Comments -->
                            <strong><? echo $blogcomments->total; ?> Comments</strong>
                            <div id="comments">
                            <? foreach($commentlist as $list) { ?>
                                <ol>
                                   <li>
                                       
                                        <div class="comment_right">
                                            <div class="comment_info">
                                                Posted by <a href="#"><? echo $list['name']; ?></a> <span>|</span> 
												<? echo date('d-F-Y',strtotime( $list['date'])) ?> 
                                              
                                            </div>
                                            <? echo $list['message']; ?>
                                        </div>                                                                           
                                        
                                   </li>                               
                                                                
                                </ol>
                                <? }?>
                                
                            </div>                        
                            <!-- //Comments -->
                            
                            <!-- Leave a Comment -->
                            
                            <form action="" method="post" style="margin-top:10px; background-color:#DDD; width:90%; padding:20px;">
                            <h4>Leave a comment</h4>
                            <?php if(!empty($success)) { ?><div id="success" class="success">Thank you - your message been sent</div><?php } ?>
                                
                                <div class="form-group">
                                    <div class="controls">
                                      <input id="name" type="text" placeholder="Name" name="name" required>
                                    </div>
                                </div>  
                                
                                
                                <div class="form-group">
                                    <div class="controls">
                                      <input id="email" type="email" placeholder="Email" name="email" required>
                                    </div>
                                </div>  
                                
                                
                                <div class="form-group">
                                    <div class="controls">
                                      <textarea name="message" id="message" required style="width:100%;" placeholder=""></textarea>
                                    </div>
                                </div>  
                                  
                                
                                <input type="submit" class="btn btn-success" value="Post Comment" />
                                <div class="clear"></div>
                                <input type="hidden" name="action" value="save" />
                            </form>
                            <!-- //Leave a Comment -->
                        
                                    
                        </div>
                        
                        
                    	<div class="col-md-4">
                        	<div class="sidebar">
                            	<div class="widget">
                                	<form class="form-search" method="post"  action="<?php echo HTTP_HOME_URL;?>blog">
                                        <input type="text" class="input-medium search-query" name="search" required>
                                        <button type="submit" class="btn dark_btn">Search</button>
                                     </form>
                                </div>
                                <div class="widget">
                                	<h2 class="title"><span>Blog Topic</span></h2>
                                	<ul class="links">
                                    <? 
									$options['sort_by']			= 'category_name';
									$options['sort_direction']	= 'ASC';
									$options['agent_id']		= '0';
									$options['status']			= 'active';
									$categorylist = $blocategory->getlist($options);
                                    if($categorylist!='empty') {
									foreach($categorylist as $catlist)
									{
									 ?>
                                    	<li><a href="blog-topic-<? echo $catlist['blogcategory_id']; ?>.html"><? echo $catlist['category_name']; ?></a></li> 
                                      <? } ?>
                                    </ul>    
                                   <? } ?> 
                                                                   
                                </div>
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
                                        	
                                            <div><a href="view-blog-<?php echo $list['blog_id']; ?>.html"> <? 
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