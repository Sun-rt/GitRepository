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
					<li class="active"><span>发表文章</span></li>
			    </ol>
			</div>
			
			<div>
				<h3 style="margin-top: 10px;">
		            <a>
		                发表文章
		            </a>
		        </h3>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="row" onsubmit="return validate_form(this)" method="post" action="/article/add" enctype="multipart/form-data">
					<textarea name="data[Article][groupid]" style="display: none;"><?php
echo $group['Group']['id'];?></textarea>
					<textarea name="data[Article][gName]" style="display: none;"><?php
echo $group['Group']['name'];?></textarea>
		   			<div class="row">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">标题<span>*</span></label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<input type="text" id="title" class="form-control common-control" name="data[Article][title]" placeholder="请输入标题">
			   			</div>
		   			</div>
		   			
		   			<div class="row">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">内容<span>*</span></label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<textarea name="data[Article][content]" type="text/plain" id="myEditor" class="form-control common-control" style="height:600px;width:700px;"></textarea>
							<script>
								//实例化编辑器
								var editor = UM.getEditor('myEditor');
							</script>
			   			</div>
		   			</div>
		   			
		   			<!-- 上传附件 -->
		   			<div class="row" style="margin-top: 10px;">
		   				<div class="col-md-3">
		   				</div>
		   				<div class="col-md-1" style="text-align: right;">
		   					<?php echo $this -> Html -> script('fileupload'); ?>
		   					<input type="file" id="userUploadFile" name="userUploadFile" onchange="checkFileStyle()">
		   				</div>							
  					</div>
  					
		   			<div class="row" style="margin-top: 10px;">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">来源</label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<div class="col-md-4 radio radio-primary">
					   			<label>
					   				<input type="radio" name="data[Article][source]" id="source" value="0" checked="checked">
					   				内部原创
					   			</label>
				   			</div>
					   		<div class="col-md-4 radio radio-primary">
					   			<label>
					   				<input type="radio" name="data[Article][source]" id="source" value="1">
					   				外部转帖
					   			</label>
							</div>
			   			</div>
		   			</div>
		   			<!--
		   			<div class="row" style="margin-top: 10px;">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">分类</label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<select class="form-control common-control" data-selecter-options='{"cover":"true"}' name="data[Article][categoryid]" style="width: 30%;">
							<?php foreach ($categories as $category): ?>
								<option value=<?php echo $category['ArticleCategory']['id'];?>>
								<?php echo $category['ArticleCategory']['name'];?>
								</option>
							<?php endforeach; ?>
							</select>
			   			</div>
		   			</div>
		   			-->
		   			<div class="row" style="margin-top: 10px;">
			   			<div class="col-md-2" style="text-align: right;">
				   			<label for="name">标签</label>
			   			</div>
			   			<div class="col-md-1">
			   			</div>
			   			<div class="col-md-9">
				   			<input type="text" id="title" name="data[Article][tags]" class="form-control common-control" placeholder="以逗号分隔，最多 5 个">
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
			   			<div class="col-md-3">
			   			</div>
			   			<div class="col-md-9">
				   			<input type="submit" name="submit" value="发布文章" class="btn btn-primary">			   			
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