<div class="container">
	<div class="span9">
		<div class="page-header">
			<h3>推荐文章管理</h3>
			<h4><small>推荐文章，共 3 篇</small></h4>
		</div>
		
		<form action="" method="post" enctype="multipart/form-data">
		<div>
			<h4><small>第 1 篇</small></h4>
			<input type="text" id="title" style="width: 500px;" name="data[0][title]" placeholder="请输入标题" value="<?php echo $recommendArticleInfos[0]['title']; ?>"><br/>
			<input type="text" id="title" style="width: 500px;" name="data[0][link]" placeholder="请输入链接地址" value="<?php echo $recommendArticleInfos[0]['link']; ?>"><br/>
			<textarea name="data[0][easyintro]" type="text/plain" id="myEditor" style="width: 500px;height:150px;" placeholder="请输入文章摘要，约 100 字"><?php echo $recommendArticleInfos[0]['easyintro']; ?></textarea>
		</div>
		<hr />
		
		<div>
			<h4><small>第 2 篇</small></h4>
			<input type="text" id="title" style="width: 500px;" name="data[1][title]" placeholder="请输入标题" value="<?php echo $recommendArticleInfos[1]['title']; ?>"><br/>
			<input type="text" id="title" style="width: 500px;" name="data[1][link]" placeholder="请输入链接地址" value="<?php echo $recommendArticleInfos[1]['link']; ?>"><br/>
			<textarea name="data[1][easyintro]" type="text/plain" id="myEditor" style="width: 500px;height:150px;" placeholder="请输入文章摘要，约 100 字"><?php echo $recommendArticleInfos[1]['easyintro']; ?></textarea>
		</div>
		<hr />
		
		<div>
			<h4><small>第 3 篇</small></h4>
			<input type="text" id="title" style="width: 500px;" name="data[2][title]" placeholder="请输入标题" value="<?php echo $recommendArticleInfos[2]['title']; ?>"><br/>
			<input type="text" id="title" style="width: 500px;" name="data[2][link]" placeholder="请输入链接地址" value="<?php echo $recommendArticleInfos[2]['link']; ?>"><br/>
			<textarea name="data[2][easyintro]" type="text/plain" id="myEditor" style="width: 500px;height:150px;" placeholder="请输入文章摘要，约 100 字"><?php echo $recommendArticleInfos[2]['easyintro']; ?></textarea>
		</div>
		<hr />
		<br />
		<input type="submit" value="确认修改" class="btn btn-primary">
		</form>
	</div>
</div>