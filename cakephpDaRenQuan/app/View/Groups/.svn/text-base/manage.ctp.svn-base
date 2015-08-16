<?php
//$sourcestr 是要处理的字符串
//$cutlength 为截取的长度(即字数)
function cut_str($sourcestr, $cutlength, $addsymbol)
{
    $returnstr  = '';
    $i          = 0;
    $n          = 0;
    $sourcestr = strip_tags($sourcestr);
    $str_length = strlen($sourcestr);
    //字符串的字节数
    while (($n < $cutlength) and ($i <= $str_length)) {
        $temp_str = substr($sourcestr, $i, 1);
        $ascnum   = Ord($temp_str);
        //得到字符串中第$i位字符的ascii码
        if ($ascnum >= 224) //如果ASCII位高与224，
            {
            $returnstr = $returnstr . substr($sourcestr, $i, 3);
            //根据UTF-8编码规范，将3个连续的字符计为单个字符
            $i         = $i + 3;
            //实际Byte计为3
            $n++;
            //字串长度计1
        } elseif ($ascnum >= 192) //如果ASCII位高与192，
            {
            $returnstr = $returnstr . substr($sourcestr, $i, 2);
            //根据UTF-8编码规范，将2个连续的字符计为单个字符
            $i         = $i + 2;
            //实际Byte计为2
            $n++;
            //字串长度计1
        } elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
            {
            $returnstr = $returnstr . substr($sourcestr, $i, 1);
            $i         = $i + 1;
            //实际的Byte数仍计1个
            $n++;
            //但考虑整体美观，大写字母计成一个高位字符
        } else //其他情况下，包括小写字母和半角标点符号，
            {
            $returnstr = $returnstr . substr($sourcestr, $i, 1);
            $i         = $i + 1;
            //实际的Byte数计1个
            $n         = $n + 0.5;
            //小写字母和半角标点等与半个高位字符宽...
        }
    }
    if ($str_length > $cutlength && $addsymbol) {
        $returnstr = $returnstr . "...";
        //超过长度时在尾处加上省略号
    }
    return $returnstr;
    
}
?>

<script>
	hide_top_img();
</script>

<?php echo $this -> Html -> css('umeditorthemes/default/css/umeditor'); ?>
<?php echo $this -> Html -> script('umeditor.config'); ?>
<?php echo $this -> Html -> script('umeditor.min'); ?>
<?php echo $this -> Html -> script('lang/zh-cn/zh-cn'); ?>

<div class="container-fluid" style="margin-top: 90px;">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="group-top-img" style="background-image: url(/app/webroot/img/km-top.jpg);">
				<div style="float: left; width: auto; margin-left: 30px;">
					<img class="group-top-portrait" src=<?php echo $group['Group']['portraiturl'];?> alt="placehold">
				</div>
				<div class="group-top-name">
					<h3>
						<?php echo $group['Group']['name']; ?>
					</h3>
				</div>
				<script>
				 	function ajaxJoin(){
			
					 	$.ajax({
						 	type: "POST",
					        url : "/groups/follow",
					        dataType : 'json',
					        data:
					        {
						        'groupId':'<?php echo $group['Group']['id']; ?>',
						        'groupName':'<?php echo $group['Group']['name']; ?>',
						        'portraitUrl':'<?php echo $group['Group']['portraiturl']; ?>',
					        },
					        success : function(data, textStatus) {
						        document.getElementById("follow-it").innerHTML = '<a href="#">已加入</a>';
					        },
					    });
			
				    }
				</script>
				<div id="follow-it" class="group-top-status">
					<?php 
						if($followed){
							echo '<a>已加入</a>';
		// 					echo '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" onclick="ajaxJoin();" >退出</a>';
						}
						else
						{
							echo '<a href="#" onclick="ajaxJoin();">加入</a>';
						}
						?>
								
				</div>
				<?php 
					if ($isManager)
					{
						echo '<div class="group-top-manager"><a href="/groups/manage/'.$group['Group']['id'].'" title="">管理达人吧</a></div>';
					}
				?>
			</div>
			
			<div class="group-top-menu">
				<a href="/groups/view/<?php echo $group['Group']['id']; ?>" class="group-top-submenu">
					<img src="/app/webroot/img/group-home.png" />
					<h6 style="margin-top: 5px;">首页</h6>
				</a>
				<a href="/groups/viewarticle/<?php echo $group['Group']['id']; ?>" class="group-top-submenu">
					<img src="/app/webroot/img/group-article.png" />
					<h6 style="margin-top: 5px;">文章</h6>
				</a>
				<a href="/groups/viewevent/<?php echo $group['Group']['id']; ?>" class="group-top-submenu">
					<img src="/app/webroot/img/group-event.png" />
					<h6 style="margin-top: 5px;">活动</h6>
				</a>
				<a href="/errors/error/3" class="group-top-submenu">
					<img src="/app/webroot/img/group-discuss.png" />
					<h6 style="margin-top: 5px;">讨论</h6>
				</a>
				<a href="/errors/error/3" class="group-top-submenu">
					<img src="/app/webroot/img/group-toupiao.png" />
					<h6 style="margin-top: 5px;">投票</h6>
				</a>
				<a href="/errors/error/3" class="group-top-submenu">
					<img src="/app/webroot/img/group-photo.png" />
					<h6 style="margin-top: 5px;">相册</h6>
				</a>
				<a href="/errors/error/3" class="group-top-submenu">
					<img src="/app/webroot/img/group-app.png" />
					<h6 style="margin-top: 5px;">管理应用</h6>
				</a>
			</div>
			
			<div style="margin-top: 5px;">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="/">首页</a></li>
					<li><a href="/groups/index">达人吧</a></li>
					<li class="active"><span><?php echo $group['Group']['name'];?></span></li>
			    </ol>
			</div>
	
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					吧管理
		       	</div>
		       	
	   			<div class="panel-body">
		   			<ul id="myTab1" class="nav nav-tabs nav-justified">
		                <li class="active"><a href="#barinfo" data-toggle="tab">本吧信息</a></li>
		                <li><a href="#members" data-toggle="tab">成员管理</a></li>
		                <li><a href="#articles" data-toggle="tab">文章管理</a></li>
		                <li><a href="#events" data-toggle="tab">活动管理</a></li>
		            </ul>
		            <div id="myTabContent" class="tab-content" style="height: auto;">
		                <div class="tab-pane fade active in" id="barinfo">
			                <div class="panel panel-primary" style="margin-bottom: 10px; padding-bottom: 10px;">
				                <div class="panel-heading">本吧信息</div>
				                <div class="panel-body">
				                <form class="row" onsubmit="return validate_form(this)" method="post" action="/groups/edit/<?php echo $group['Group']['id'] ?>" enctype="multipart/form-data" style="margin-top: 10px;">
					            <input type="text" id="title" style="display: none;" name="data[Group][id]" placeholder="请输入达人吧名称" value="<?php echo $group['Group']['id'] ?>">
					   			<div class="col-md-12">
					   			<div class="row">
						   			<div class="col-md-2" style="text-align: right;">
							   			<label for="name">达人吧属性</label>
						   			</div>
						   			<div class="col-md-1">
						   			</div>
						   			<div class="col-md-9">
							   			<?php 
								   			if ($group['Group']['type'] == '0')
								   			{
									   			$option_1 = '<input type="radio" name="data[Group][type]" id="type" value="0" checked="checked">';
									   			$option_2 = '<input type="radio" name="data[Group][type]" id="type" value="1">';
								   			}
								   			else 
								   			{
									   			$option_1 = '<input type="radio" name="data[Group][type]" id="type" value="0">';
									   			$option_2 = '<input type="radio" name="data[Group][type]" id="type" value="1" checked="checked">';
								   			}
							   			?>
							   			<div class="col-md-4 radio radio-primary">
								   			<label>	
									   			<?php echo $option_1; ?>
									   			公开达人吧
									   			<span class="help-block" style="font-size: small">
									   				站内任何人员都可以看到
									   			</span>
								   			</label>
							   			</div>
								   		<div class="col-md-4 radio radio-primary">
								   			<label>
								   				<?php echo $option_2; ?>
								   				私密达人吧
								   				<span class="help-block" style="font-size: small">
								   					只有接受组员邀请才能加入达人吧
								   				</span>
								   			</label>
										</div>
						   			</div>
					   			</div>
					   			
					   			<div class="row">
						   			<div class="col-md-2" style="text-align: right;">
							   			<label for="name">加入方式</label>
						   			</div>
						   			<div class="col-md-1">
						   			</div>
						   			<div class="col-md-9">
							   			<?php 
								   			if ($group['Group']['intype'] == '0')
								   			{
									   			$option_1 = '<input type="radio" name="data[Group][intype]" id="intype" value="0" checked="checked">';
									   			$option_2 = '<input type="radio" name="data[Group][intype]" id="intype" value="1">';
								   			}
								   			else 
								   			{
									   			$option_1 = '<input type="radio" name="data[Group][intype]" id="intype" value="0">';
									   			$option_2 = '<input type="radio" name="data[Group][intype]" id="intype" value="1" checked="checked">';
								   			}
							   			?>
							   			<div class="col-md-4 radio radio-primary">
								   			<label>
								   				<?php echo $option_1; ?>
								   				任何人都可以加入
								   			</label>
							   			</div>
								   		<div class="col-md-4 radio radio-primary">
								   			<label>
								   				<?php echo $option_2; ?>
								   				审核后方可加入
								   			</label>
										</div>
						   			</div>
					   			</div>
					   			
					   			<div class="row">
						   			<div class="col-md-2" style="text-align: right;">
							   			<label for="name">达人吧名称<span>*</span></label>
						   			</div>
						   			<div class="col-md-1">
						   			</div>
						   			<div class="col-md-9">
							   			<input type="text" id="title" class="form-control common-control" name="data[Group][name]" placeholder="请输入达人吧名称" value="<?php echo $group['Group']['name'] ?>" readonly>
						   			</div>
					   			</div>
					   			
					   			<div class="row" style="margin-top: 15px;">
						   			<div class="col-md-2" style="text-align: right;">
							   			<label for="name">达人吧信息<span>*</span></label>
						   			</div>
						   			<div class="col-md-1">
						   			</div>
						   			<div class="col-md-9">
							   			<textarea name="data[Group][info]" type="text/plain" id="myEditor" class="form-control common-control" style="height:360px;"><?php echo $group['Group']['info'] ?></textarea>
										<script>
											//实例化编辑器
											var editor = UM.getEditor('myEditor');
										</script>
						   			</div>
					   			</div>
					   			
					   			<div class="row" style="margin-top: 15px;">
						   			<div class="col-md-2" style="text-align: right;">
							   			<label for="name">达人吧logo</label>
						   			</div>
						   			<div class="col-md-1">
						   			</div>
						   			<div class="col-md-9">
							   			<?php echo $this -> Html -> script('imageupload'); ?>
										<input id="f" type="file" id="portraitdata" onchange="change()" name="portraitdata">
										<span class="help-block">最佳图片大小：160 x 160</span>
										<img id="preview" style="width: 160px; height: 160px;" src="<?php echo $group['Group']['portraiturl'] ?>" alt="placehold">
						   			</div>
					   			</div>
					   			
					   			<div class="row" style="margin-top: 15px;">
						   			<div class="col-md-3">
						   			</div>
						   			<div class="col-md-9">
						   			<input type="submit" name="submit" value="修改吧信息" class="btn btn-primary">
						   			</div>
					   			</div>
					   			</div>
								</form>
				                </div>
			                </div>
		                </div>
<script>
 	function ajaxDel(row_btn){

	 	var i=row_btn.parentNode.parentNode.rowIndex;
	 	document.getElementById('tbl_member').deleteRow(i);
	 	
	 	$.ajax({
		 	type: "GET",
	        url : '/groups/deletemember/'+row_btn.id+'/'+<?php echo $group['Group']['id']; ?>,
	        dataType : 'json',
	        success : function(data, textStatus) {
		        alert('succ');
	        },
	    });

    }
    
    function ajaxMgr(row_btn){
	    // 设置管理员
		var oldText = document.getElementById('a_'+row_btn.id).innerHTML;
	    if (oldText == "设为管理员" )
	    {
			$.ajax({
			 	type: "GET",
		        url : '/groups/setMemberToAdmin/'+row_btn.id+'/'+<?php echo $group['Group']['id']; ?>,
		        dataType : 'json',
		        success : function(data, textStatus) {
			        alert('succ');
		        },
		    });
		    document.getElementById('a_'+row_btn.id).innerHTML = "取消管理员";
	    }
	    else
	    {
			$.ajax({
			 	type: "GET",
		        url : '/groups/setAdminToMember/'+row_btn.id+'/'+<?php echo $group['Group']['id']; ?>,
		        dataType : 'json',
		        success : function(data, textStatus) {
			        alert('succ');
		        },
		    });
		    document.getElementById('a_'+row_btn.id).innerHTML = "设为管理员";
	    }
	 	

    }
</script>
		                <div class="tab-pane fade" id="members">
			                <button type="button" class="btn btn-primary" style="margin-bottom: 20px;">
		                    <a href="/errors/error/3" style="color: white">
			                    <span class="glyphicon glyphicon-user"></span>
			                    邀请加入
		                    </a>
		                    </button>
			                <div class="panel panel-primary">
				              <div class="panel-heading">成员管理</div>
				              <table id="tbl_member" class="table">
				                <thead>
				                  <tr>
				                    <th style="width: 30%;">用户名</th>
				                    <th style="width: 20%;">类别</th>
				                    <th style="width: 20%;">加入时间</th>
				                    <th style="width: 30%;">操作</th>
				                  </tr>
				                </thead>
				                <tbody>
					                <?php 
					                    foreach ($members as $member){
						                    echo '<tr>';
						                    echo '<td>'.$member['name'].'</td>';
						                    echo '<td>'.$member['category'].'</td>';
						                    echo '<td>'.$member['indate'].'</td>';
						                    
						                    echo '<td>';
						                    if ($member['canBeDeleted']){
							                    echo '<button id="'.$member['id'].'" type="button" class="btn btn-danger" onclick="ajaxDel(this);">';
							                    echo '<a style="color: white">';
							                    echo '删除</a></button>&nbsp;';
						                    }
						                    if ($member['adminPower']){
								                if ($member['isAdmin']){
									                echo '<button id="'.$member['id'].'" type="button" class="btn btn-primary" ismanager="true" onclick="ajaxMgr(this);">';
									                echo '<a id="a_'.$member['id'].'"  style="color: white">';
									                echo '取消管理员</a></button>';
								                }else{
									                echo '<button id="'.$member['id'].'" type="button" class="btn btn-primary" ismanager="false" onclick="ajaxMgr(this);">';
									                echo '<a id="a_'.$member['id'].'" style="color: white">';
									                echo '设为管理员</a></button>';
								                }
							                }
							                echo "</td>";
							                echo '</tr>';
					                    }
				                    ?>	                  
				                </tbody>
				              </table>
				            </div>
		                </div>
		                <div class="tab-pane fade" id="articles">
			                <h4>
				                开发中
			                </h4>
		                </div>
		                <div class="tab-pane fade" id="events">
			                <h4>
				                开发中
			                </h4>
		                </div>
		            </div>
	            </div>
	   		</div>
	   		
		</div>
    </div>
</div>