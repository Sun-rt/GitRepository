<script>
	hide_top_img();
</script>

<style>
	.common-control {
		width: 75%;
		margin-top: 5px;
		margin-bottom: 10px;
	}			   			
</style>

<?php echo $this -> Html -> css('umeditorthemes/default/css/umeditor'); ?>
<?php echo $this -> Html -> script('umeditor.config'); ?>
<?php echo $this -> Html -> script('umeditor.min'); ?>
<?php echo $this -> Html -> script('lang/zh-cn/zh-cn'); ?>

<div class="container-fluid" style="margin-top: 50px;">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			
			<div style="margin-top: 5px;">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="/">首页</a></li>
					<li><a href="/groups/index">达人吧</a></li>
					<li><a href="/groups/view/<?php echo $group['Group']['id']; ?>"><?php echo $group['Group']['name']; ?></a></li>
					<li class="active"><span>创建活动</span></li>
			    </ol>
			</div>
			
			<div>
				<h3 style="margin-top: 10px;">
		            <a>
		                创建活动
		            </a>
		        </h3>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="row" onsubmit="return validate_form(this)" method="post" action="/events/add" enctype="multipart/form-data">
					<textarea name="data[Event][groupid]" style="display: none;">
						<?php echo $group['Group']['id']; ?>
					</textarea>
		   			<div class="row">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">名称<span>*</span></label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<input type="text" id="title" class="form-control common-control" name="data[Event][title]" placeholder="请输入活动名称">
			   			</div>
		   			</div>
		   			
		   			<div class="row">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">开始时间<span>*</span></label> 
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<div class="input-group date form_datetime col-md-5" data-date-format="yyyy-MM-dd HH:mm:ss" data-link-field="dtp_input1">
					   			<input class="form-control" size="16" type="text" value="" name="data[Event][begintime]" readonly>
					   			<span class="input-group-addon">
					   			<span class="glyphicon glyphicon-th"></span>
					   			</span>
					   			<input type="hidden" id="dtp_input1" value="" />
					   		</div>
			   			</div>
		   			</div>
		   			
		   			<div class="row" style="margin-top: 10px;">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">结束时间<span>*</span></label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<div class="input-group date form_datetime col-md-5" data-date-format="yyyy-MM-dd HH:mm:ss" data-link-field="dtp_input1">
					   			<input class="form-control" size="16" type="text" value="" name="data[Event][endtime]" readonly>
					   			<span class="input-group-addon">
					   			<span class="glyphicon glyphicon-th"></span>
					   			</span>
					   			<input type="hidden" id="dtp_input2" value="" />
					   		</div>
					   		*结束时间必须大于开始时间
			   			</div>
		   			</div>
		   			
		   			<div class="row" style="margin-top: 10px;">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">报名截至时间<span>*</span></label> 
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<div class="input-group date form_datetime col-md-5" data-date-format="yyyy-MM-dd HH:mm:ss" data-link-field="dtp_input1">
					   			<input class="form-control" size="16" type="text" value="" name="data[Event][applyendtime]" readonly>
					   			<span class="input-group-addon">
					   			<span class="glyphicon glyphicon-th"></span>
					   			</span>
					   			<input type="hidden" id="dtp_input3" value="" />
					   		</div>
					   		*截止时间必须小于活动开始时间
			   			</div>
			   			
		   			</div>
		   			
		   			<div class="row">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">地点</label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<input type="text" id="title" class="form-control common-control" name="data[Event][location]" placeholder="请输入地点">
			   			</div>
		   			</div>
		   			
		   			<div class="row" style="margin-top: 10px;">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">详情<span>*</span></label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<textarea name="data[Event][content]" type="text/plain" id="myEditor" class="form-control common-control" style="height:600px;width:700px;"></textarea>
							<script>
								//实例化编辑器
								var editor = UM.getEditor('myEditor');
							</script>
			   			</div>
		   			</div>
		   			
		   			<div class="row" style="margin-top: 10px;">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">类型</label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<select class="form-control common-control" data-selecter-options='{"cover":"true"}' name="data[Event][categoryid]" style="width: 30%;">
							<?php foreach ($categories as $category): ?>
								<option value=<?php echo $category['EventCategory']['id'];?>>
								<?php echo $category['EventCategory']['name'];?>
								</option>
							<?php endforeach; ?>
							</select>
			   			</div>
		   			</div>
		   			
		   			<div class="row" style="margin-top: 10px;">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">所属达人吧</label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<?php echo $group['Group']['name']; ?>
			   			</div>
		   			</div>
		   			
		   			<div class="row" style="margin-top: 15px;">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">活动缩略图</label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<?php echo $this -> Html -> script('imageupload'); ?>
							<input id="f" type="file" id="portraitdata" onchange="change()" name="portraitdata">
							<span class="help-block">最佳图片大小：160 x 160</span>
							<img id="preview" style="width: 160px; height: 160px;" src="http://placehold.it/160x160" alt="placehold">
			   			</div>
		   			</div>
		   			
		   			<div class="row" style="margin-top: 15px;">
			   			<div class="col-md-3">
			   			</div>
			   			<div class="col-md-9">
				   			<input type="submit" name="submit" value="发布活动" class="btn btn-primary">			   			
			   			</div>
		   			</div>
					</form>
	            </div>
	   		</div>
			
		</div>
        
	</div>
</div>

<script type="text/javascript">
    function validate_form(thisform) {
        with (thisform) {
        	var groupnameDiv = document.getElementById('articletitle');
        	var groupname = document.getElementById('title');
            if (validate_required(groupname) == false) {
                groupnameDiv.setAttribute("class", "form-group has-error"); 
                return false;
            }
            
            var groupinfoDiv = document.getElementById('articleinfo');
            if (editor.hasContents() == false) {
                groupinfoDiv.setAttribute("class", "form-group has-error"); 
                return false;
            }
        }
    }
</script>

<?php echo $this -> Html -> css('bootstrap-datetimepicker.min'); ?>
<?php echo $this -> Html -> script('bootstrap-datetimepicker.min'); ?>
<?php echo $this -> Html -> script('locales/bootstrap-datetimepicker.zh-CN'); ?>

<script type="text/javascript">
	$(".form_datetime").datetimepicker({
		format: 'yyyy-mm-dd hh:ii',
		weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
	});
</script>