<script>
	function change(id) {
     var pic = document.getElementById("preview"+id);
     var file = document.getElementById("f"+id);
     var ext=file.value.substring(file.value.lastIndexOf(".")+1).toLowerCase();
     // gif在IE浏览器暂时无法显示
     if(ext!='png'&&ext!='jpg'&&ext!='jpeg'){
         alert("文件必须为图片！"); return;
     }
     // IE浏览器
     if (document.all) {
 
         file.select();
         var reallocalpath = document.selection.createRange().text;
         var ie6 = /msie 6/i.test(navigator.userAgent);
         // IE6浏览器设置img的src为本地路径可以直接显示图片
         if (ie6) pic.src = reallocalpath;
         else {
             // 非IE6版本的IE由于安全问题直接设置img的src无法显示本地图片，但是可以通过滤镜来实现
             pic.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image',src=\"" + reallocalpath + "\")";
             // 设置img的src为base64编码的透明图片 取消显示浏览器默认图片
             pic.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
         }
     }else{
         html5Reader(file,id);
     }
     
    var carouseltext = document.getElementById("carouselurl"+id);
    carouseltext.value="changed";
    
    var a = document.getElementById("f"+id);
    a.name="pic["+(id - 1)+"]";
 }
 
 function html5Reader(file,id){
     var file = file.files[0];
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function(e){
         var pic = document.getElementById("preview"+id);
         pic.src=this.result;
     }
 }
</script>

<div class="container">
	<div class="span9">
		<div class="page-header">
			<h3>推荐文章轮播图管理</h3>
			<h4><small>推荐文章轮播图，共 3 张，最佳大小：200 像素 x 200 像素</small></h4>
		</div>
		
		<form action="" method="post" enctype="multipart/form-data">
		<div>
			<h4><small>第 1 张</small></h4>
			<input type="text" id="title" style="width: 300px;" name="data[0][text]" placeholder="请输入标题" value="<?php echo $recommendArticleCarousels[0]['text']; ?>"><br/>
			<input type="text" id="title" style="width: 300px;" name="data[0][link]" placeholder="请输入链接地址" value="<?php echo $recommendArticleCarousels[0]['link']; ?>"><br/>
			<img id="preview1" src="<?php echo $recommendArticleCarousels[0]['carouselurl']; ?>" style="width: 200px; height: 200px;">
			<br />
			<input id="f1" type="file" id="portraitdata" onchange="change(1)">
			<input id="carouselurl1" type="text" style="display: none;" name="data[0][carouselurl]" value="<?php echo $recommendArticleCarousels[0]['carouselurl']; ?>">
		</div>
		<hr />
		
		<div>
			<h4><small>第 2 张</small></h4>
			<input type="text" id="title" style="width: 300px;" name="data[1][text]" placeholder="请输入标题" value="<?php echo $recommendArticleCarousels[1]['text']; ?>"><br/>
			<input type="text" id="title" style="width: 300px;" name="data[1][link]" placeholder="请输入链接地址" value="<?php echo $recommendArticleCarousels[1]['link']; ?>"><br/>
			<img id="preview2" src="<?php echo $recommendArticleCarousels[1]['carouselurl']; ?>" style="width: 200px; height: 200px;">
			<br />
			<input id="f2" type="file" id="portraitdata" onchange="change(2)">
			<input id="carouselurl2" type="text" style="display: none;" name="data[1][carouselurl]" value="<?php echo $recommendArticleCarousels[1]['carouselurl']; ?>">
		</div>
		<hr />
		
		<div>
			<h4><small>第 3 张</small></h4>
			<input type="text" id="title" style="width: 300px;" name="data[2][text]" placeholder="请输入标题" value="<?php echo $recommendArticleCarousels[2]['text']; ?>"><br/>
			<input type="text" id="title" style="width: 300px;" name="data[2][link]" placeholder="请输入链接地址" value="<?php echo $recommendArticleCarousels[2]['link']; ?>"><br/>
			<img id="preview3" src="<?php echo $recommendArticleCarousels[2]['carouselurl']; ?>" style="width: 200px; height: 200px;">
			<br />
			<input id="f3" type="file" id="portraitdata" onchange="change(3)">
			<input id="carouselurl3" type="text" style="display: none;" name="data[2][carouselurl]" value="<?php echo $recommendArticleCarousels[2]['carouselurl']; ?>">
		</div>
		<hr />
		<br />
		<input type="submit" value="确认修改" class="btn btn-primary">
		</form>
	</div>
</div>