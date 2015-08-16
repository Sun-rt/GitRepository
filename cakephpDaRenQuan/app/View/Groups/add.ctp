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
					<li class="active"><span>创建达人吧</span></li>
			    </ol>
			</div>
			
			<div>
				<h3 style="margin-top: 10px;">
		            <a>
		                创建达人吧
		            </a>
		        </h3>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="row" onsubmit="return validate_form(this)" method="post" action="/groups/add" enctype="multipart/form-data">
		   			<div class="row">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">达人吧属性</label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<div class="col-md-4 radio radio-primary">
					   			<label>
						   			<input type="radio" name="data[Group][type]" id="type" value="0" checked="checked">
						   			公开达人吧
						   			<span class="help-block" style="font-size: small">
						   				站内任何人员都可以看到
						   			</span>
					   			</label>
				   			</div>
					   		<div class="col-md-4 radio radio-primary">
					   			<label>
					   				<input type="radio" name="data[Group][type]" id="type" value="1">
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
				   			<div class="col-md-4 radio radio-primary">
					   			<label>
					   				<input type="radio" name="data[Group][intype]" id="intype" value="0" checked="checked">
					   				任何人都可以加入
					   			</label>
				   			</div>
					   		<div class="col-md-4 radio radio-primary">
					   			<label>
					   				<input type="radio" name="data[Group][intype]" id="intype" value="1">
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
				   			<input type="text" id="title" class="form-control common-control" name="data[Group][name]" placeholder="请输入达人吧名称">
				   			吧名称以后不能修改哦~
			   			</div>
		   			</div>
		   			
		   			<div class="row">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">达人吧信息<span>*</span></label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<textarea name="data[Group][info]" type="text/plain" id="myEditor" class="form-control common-control" style="height:360px;"></textarea>
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
							<img id="preview" style="width: 160px; height: 160px; max-width: 160px; max-height: 160px;" src="http://placehold.it/160x160" alt="placehold">
			   			</div>
		   			</div>
		   			
		   			<div class="row" style="margin-top: 15px;">
			   			<div class="col-md-3">
			   			</div>
			   			<div class="col-md-9">
			   			<input type="submit" name="submit" value="创建达人吧" class="btn btn-primary">
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