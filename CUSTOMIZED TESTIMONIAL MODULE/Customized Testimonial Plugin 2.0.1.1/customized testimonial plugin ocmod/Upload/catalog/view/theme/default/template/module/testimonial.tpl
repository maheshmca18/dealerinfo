<style type="text/css">   
    .box_testmonials {
        border-radius: 5px 5px 5px 5px;
        box-shadow: 0px 2px 2px;
    }
    .box_testmonials .box-heading{
        color:<?php echo ctype_xdigit($allstyles['headtextcolor'])?'#'.$allstyles['headtextcolor']:$allstyles['headtextcolor']; ?> !important;
        background:<?php echo ctype_xdigit($allstyles['headbgcolor'])?'#'.$allstyles['headbgcolor']:$allstyles['headbgcolor']; ?> !important; !important;
    }
    .box_testmonials .box-content{
        color:<?php echo ctype_xdigit($allstyles['textcolor'])?'#'.$allstyles['textcolor']:$allstyles['textcolor']; ?> !important;
        background-color:<?php echo ctype_xdigit($allstyles['bgcolor'])?'#'.$allstyles['bgcolor']:$allstyles['bgcolor']; ?> !important;
    }
	.box_testmonials .box-content #wrapper{
       
        height: <?php echo $allstyles['widgetheight']; ?>px !important;
    }
   .box_testmonials .box-content cite a{
        color:<?php echo ctype_xdigit($allstyles['nametextcolor'])?'#'.$allstyles['nametextcolor']:$allstyles['nametextcolor']; ?> !important;
    }
	.box_testmonials .box-content .showall{
        text-align : center !important;
    }
	.box_testmonials .box-content .showall .button{
        color : <?php echo ctype_xdigit($allstyles['viewalltextcolor'])?'#'.$allstyles['viewalltextcolor']:$allstyles['viewalltextcolor']; ?> !important;
		background : <?php echo ctype_xdigit($allstyles['viewallbgcolor'])?'#'.$allstyles['viewallbgcolor']:$allstyles['viewallbgcolor']; ?> !important;
    }
	
	.block-class
	{
	border-left:0px;
	}
        
    </style>
	
	<!-- JavaScript Test Zone -->
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		$(".box_testmonials").each(function(){
			$(this).find('blockquote').quovolver();
		//console.log(1);
		});
		//$('blockquote').quovolver();
		
	});
	</script>
<div class="box box_testmonials" id="<?php echo time().rand(100,10000);?>">
  <div class="box-heading"><?php echo $heading_title; ?>
	  <div class="box-content">
			<div id="wrapper">
				
			<div id="article">
			
			<?php foreach ($all_testimonial as $testimonial) { ?>
				<blockquote class="block-class">
					<p>
				  <?php echo $testimonial['data']; ?>
				  </p>
				  <cite>&ndash; <a href="<?php echo $testimonial['view']; ?>"><?php echo $testimonial['name']; ?></a><?php 
				   echo $testimonial['date_added']; ?></cite>
				</blockquote>
			  <?php } ?>
			</div> <!-- article -->	
				
			</div><!-- wrapper -->
		  <div class='showall'><a class='button btn-primary' href='<?php echo $showall; ?>' >View all</a></div>

	  </div>
  </div>		
</div>
    