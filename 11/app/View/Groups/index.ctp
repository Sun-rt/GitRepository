<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			
			<div style="margin-top: 5px;">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="/">首页</a></li>
					<li class="active"><span>达人吧</span></li>
			    </ol>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					文章
		       	</div>			       	
	   			<div class="panel-body">
		   			<?php
						$count = count($groups);
						for ($i = 0; $i < $count; $i++) {
							$group = $groups[$i]['Group'];
							echo '<div style="width:100%; height:150px; border: 1px solid #eeeeee; margin-bottom: 10px;">';
							echo '<div style="float: left; margin-left:20px; margin-right:20px; margin-top:15px;">';
							echo '<img src="'.$group['portraiturl'].'" style="width: 120px; height: 120px;"></div>';
							echo '<div style="float: left; width:50%"><h4 style="width: 90%; height: 25px;">';
							echo '<a href="/groups/view/'.$group['id'].'">'.$group['name'].'</a>&nbsp;&nbsp;';
							echo '</h4>';
		// 							echo '简介：'.$group['info'].'<br />';
							echo '成员：'.$group['memberCount'].'<br />';
							echo '文章：'.$group['articleCount'].'</div>';
		 					echo '<a style="margin-top: 50px;margin-right: 50px; float: right;" class="btn btn-large btn-primary" href="/groups/view/'.$group['id'].'">进&nbsp;&nbsp;&nbsp;&nbsp;吧</a>';
							echo '</div>';
						}
					?>
	   			</div>
			</div>
			
		</div>
	</div>
</div>