<?php
	
	class iceOptions {
	function getOptions() {
		$options = get_option('ice_options');
		if (!is_array($options)) {
			$options['description'] = '';
			$options['keywords'] = '';
			$options['opentongji'] = false;
			$options['tongjicode'] = '';
			$options['footertext'] = '';

			$options['openfavicon'] = false;
			$options['faviconurl'] = '';
			$options['openlogo'] = false;
			$options['logourl'] = '';
			$options['textlogo'] = false;

			$options['sharebar'] = true;
			$options['relatedpost'] = true;
			$options['fancybox'] = true;
			$options['closejquery'] = false;
			$options['sinajquery'] = true;
			$options['headcode'] = '';
			$options['bodycode'] = '';
			$options['csscode'] = '';

			update_option('ice_options', $options);
		}
		return $options;
	}
	/* -- 初始化 -- */
	function init() {
		if(isset($_POST['saveopts'])) {
			$options = iceOptions::getOptions();
	
			$options['description'] = stripslashes($_POST['description']);
			$options['keywords'] = stripslashes($_POST['keywords']);
			if ($_POST['opentongji']) { $options['opentongji'] = (bool)true; } else { $options['opentongji'] = (bool)false; }
			$options['tongjicode'] = stripslashes($_POST['tongjicode']);
			$options['footertext'] = stripslashes($_POST['footertext']);

			if ($_POST['openfavicon']) { $options['openfavicon'] = (bool)true; } else { $options['openfavicon'] = (bool)false; }
			$options['faviconurl'] = stripslashes($_POST['faviconurl']);
			if ($_POST['openlogo']) { $options['openlogo'] = (bool)true; } else { $options['openlogo'] = (bool)false; }
			$options['logourl'] = stripslashes($_POST['logourl']);
			if ($_POST['textlogo']) { $options['textlogo'] = (bool)true; } else { $options['textlogo'] = (bool)false; }

			if ($_POST['sharebar']) { $options['sharebar'] = (bool)true; } else { $options['sharebar'] = (bool)false; }
			if ($_POST['relatedpost']) { $options['relatedpost'] = (bool)true; } else { $options['relatedpost'] = (bool)false; }
			if ($_POST['fancybox']) { $options['fancybox'] = (bool)true; } else { $options['fancybox'] = (bool)false; }
			if ($_POST['closejquery']) { $options['closejquery'] = (bool)true; } else { $options['closejquery'] = (bool)false; }
			if ($_POST['sinajquery']) { $options['sinajquery'] = (bool)true; } else { $options['sinajquery'] = (bool)false; }
			$options['headcode'] = stripslashes($_POST['headcode']);
			$options['bodycode'] = stripslashes($_POST['bodycode']);
			$options['csscode'] = stripslashes($_POST['csscode']);
			
			update_option('ice_options', $options);
			echo "<div id='message' class='updated fade'><p>设置已保存</p></div>";
		} elseif (isset($_POST['resetopts'])) {
			$options = iceOptions::getOptions();

			$options['description'] = '';
			$options['keywords'] = '';
			$options['opentongji'] = false;
			$options['tongjicode'] = '';
			$options['footertext'] = '';

			$options['openfavicon'] = false;
			$options['faviconurl'] = '';
			$options['openlogo'] = false;
			$options['logourl'] = '';
			$options['textlogo'] = false;

			$options['sharebar'] = true;
			$options['relatedpost'] = true;
			$options['fancybox'] = true;
			$options['closejquery'] = false;
			$options['sinajquery'] = true;
			$options['headcode'] = '';
			$options['bodycode'] = '';
			$options['csscode'] = '';

			update_option('ice_options', $options);
			echo "<div id='message' class='updated fade'><p>设置已重置。</p></div>";
		} else { iceOptions::getOptions(); }
		
		add_theme_page("主题设置", "主题设置", 'edit_themes', basename(__FILE__), array('iceOptions', 'display'));
	}

	/* -- 标签页 -- */
	function display() {
		$options = iceOptions::getOptions();
?>

<style type="text/css">
#optpage {
	width: 785px;
	position: relative;
	z-index: 0
}

#header {
	margin: 0 0 20px 0;
}

#optwarp { background-color: #F5F5F5; background-image: -moz-linear-gradient(center top , #F9F9F9, #F5F5F5); border: 1px solid #DFDFDF; border-radius: 3px 3px 0 0; }
#optnav {
	float: left;
	position: relative;
	z-index: 9999;
	width: 160px;
}
#optnav li { margin-bottom: 0; cursor: pointer; }
#optnav ul li a {
	display: block;
	padding: 10px 10px 10px 15px;
	font-family: Georgia, Serif;
	font-size: 13px;
	text-decoration: none;
	color: #888;
	border-bottom: 1px solid #DFDFDF;
	box-shadow: 0 1px 0 #FFFFFF inset;
	-moz-box-shadow: 0 1px 0 #FFFFFF inset;
	-webkit-box-shadow: 0 1px 0 #FFFFFF inset;
	text-shadow: 0 1px 0 #FFFFFF;
}
#optnav ul li.currentnav a, #optnav ul li a:hover {
	color: #464646;
	background-color: #fff;
}
#optnav ul li:first-child a { border-radius: 3px 0 0 0; }

#optcont {
	float: left;
	min-height: 550px;
	width: 595px;
	margin-left: -1px;
	padding: 0 14px;
	font-family: "Lucida Grande", Sans-serif;
	background-color: #fff;
	border-left: 1px solid #DFDFDF;
	border-radius: 0 3px 0 0;
}

.optmain { display: none; } .optcurr { display: block; }
.opttitle { border-bottom: 1px solid #F2F2F2; font-size: 18px; font-weight: bold; padding: 20px 0 10px; }
.section, .item { padding: 12px 0; border-bottom: 1px solid #f2f2f2; }
.item .section { border: none; padding: 0; }
.section h3 { margin: 5px 0 10px; padding: 0; font-size: 1.05em; }
.section .controls { float: left; width: 345px; margin: 0 15px 0 0; }
.section .explain { float: left; width: 225px; padding: 0 10px 0 0; font-size: 11px; color: #999999; margin-bottom: 10px; line-height: 16px; }

.controls select { width: 340px; }
.controls textarea { width: 345px; }
input[type=text] { width: 340px; }

.section-checkbox .controls { width: 25px; margin-right: 0 }
.section-checkbox .explain { width: 540px }

.save_bar_top {
	background-color: #F1F1F1;
    background-image: -moz-linear-gradient(center top , #F9F9F9, #ECECEC);
	border-top: 1px solid #fff;
	border-right: 1px solid #dfdfdf;
	border-bottom: 1px solid #dfdfdf;
	border-left: 1px solid #dfdfdf;
	padding: 5px 10px 0px;
	height: 30px;
	text-align: right;
	-moz-border-radius-bottomright: 3px;
    -moz-border-radius-bottomleft: 3px;
    -webkit-border-bottom-right-radius: 3px;
    -webkit-border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
	border-bottom-left-radius: 3px;
}
.reset-button { float: left; }

html body .clear {
	background: none;
	border: 0;
	clear: both;
	display: block;
	float: none;
	font-size: 0;
	list-style: none;
	margin: 0;
	padding: 0;
	overflow: hidden;
	visibility: hidden;
	width: 0;
	height: 0;
}

</style>

<form action="#" method="post" enctype="multipart/form-data" name="deve_form" id="deve_form" />
<div class="wrap" id="optpage">
<div id="icon-options-general" class="icon32"><br></div>
<h2>主题设置</h2><br>


<div id="optwarp">
	<div id="optnav"><ul>
		<li class="currentnav" id="optnav-1"><a title="网站设置">网站设置</a></li>
		<li id="optnav-2"><a title="外观设置">外观设置</a></li>
		<li id="optnav-3"><a title="功能设置">功能设置</a></li>
		<li id="optnav-4"><a title="其他设置">其他设置</a></li>
	</ul></div>

	<div id="optcont">
		<div class="optcurr optmain" id="opt-1">
			<h2 class="opttitle">网站设置</h2>

	        <div class="section section-textarea ">
			<h3 class="heading">网站描述</h3>
			<div class="option">
			<div class="controls">
			<textarea class="tz-input" name="description" id="description" cols="8" rows="8"><?php echo($options['description']); ?></textarea>
			<br></div><div class="explain">用简洁的语言描述你的网站。<br>网站描述将会添加到head标签内，<br>该功能可以方便搜索引擎查找你的网站。</div>
			<div class="clear"> </div></div></div>

	        <div class="section section-textarea ">
			<h3 class="heading">网站关键词</h3>
			<div class="option">
			<div class="controls">
			<textarea class="tz-input" name="keywords" id="keywords" cols="8" rows="8"><?php echo($options['keywords']); ?></textarea>
			<br></div><div class="explain">网站关键词将会添加到head标签内，<br>该功能可以方便搜索引擎查找你的网站。<br>多个关键词之间请用英文半角逗号隔开。</div>
			<div class="clear"> </div></div></div>

			<div class="item">
			<div class="section section-checkbox ">
			<h3 class="heading">网站统计</h3>
			<div class="option">
			<div class="controls">
			<input type="checkbox" class="checkbox" name="opentongji" id="opentongji" value="checkbox" <?php if($options['opentongji']) echo "checked='checked'"; ?> ></div>
			<div class="explain">启用统计代码</div>
			<div class="clear"> </div></div></div>

	        <div class="section section-textarea ">
			<h3 class="heading">统计代码设置</h3>
			<div class="option">
			<div class="controls">
			<textarea class="tz-input" name="tongjicode" id="tongjicode" cols="8" rows="8"><?php echo($options['tongjicode']); ?></textarea>
			<br></div><div class="explain">输入统计代码。<br>为了美观，统计代码不会在页面上显示，但是统计功能仍然是存在的。</div>
			<div class="clear"> </div></div></div>
			</div>

	        <div class="section section-textarea ">
			<h3 class="heading">底部左侧文字</h3>
			<div class="option">
			<div class="controls">
			<textarea class="tz-input" name="footertext" id="footertext" cols="8" rows="8"><?php echo($options['footertext']); ?></textarea>
			<br></div><div class="explain">填写的文字将会显示在网站底部的左侧，<br>支持HTML代码。<br>如果不填写，则显示默认内容。</div>
			<div class="clear"> </div></div></div>
	    </div>


		<div class="optmain" id="opt-2">
			<h2 class="opttitle">外观设置</h2>

			<div class="item">
			<div class="section section-checkbox ">
			<h3 class="heading">Favicon图标</h3>
			<div class="option">
			<div class="controls">
			<input type="checkbox" class="checkbox" name="openfavicon" id="openfavicon" value="checkbox" <?php if($options['openfavicon']) echo "checked='checked'"; ?> ></div>
			<div class="explain">启用自定义Favicon</div>
			<div class="clear"> </div></div></div>

			<div class="section section-text ">
			<div class="option">
			<div class="controls">
			<input class="tz-input" name="faviconurl" id="faviconurl" type="text" value="<?php echo($options['faviconurl']); ?>"><br></div><div class="explain">输入你的Favicon图标地址，带http://</div>
			<div class="clear"> </div></div></div>
			</div>

			<div class="item">
			<div class="section section-checkbox ">
			<h3 class="heading">Logo设置</h3>
			<div class="option">
			<div class="controls">
			<input type="checkbox" class="checkbox" name="openlogo" id="openlogo" value="checkbox" <?php if($options['openlogo']) echo "checked='checked'"; ?> ></div>
			<div class="explain">自定义Logo图片地址</div>
			<div class="clear"> </div></div></div>

			<div class="section section-text ">
			<div class="option">
			<div class="controls">
			<input class="tz-input" name="logourl" id="logourl" type="text" value="<?php echo($options['logourl']); ?>"><br></div><div class="explain">输入你的Logo图片地址，带http://<br>图片的尺寸不要超过340px*55px的大小</div>
			<div class="clear"> </div></div></div>
			</div>

			<div class="section section-checkbox ">
			<h3 class="heading">站点标题</h3>
			<div class="option">
			<div class="controls">
			<input type="checkbox" class="checkbox" name="textlogo" id="textlogo" value="checkbox" <?php if($options['textlogo']) echo "checked='checked'"; ?> ></div>
			<div class="explain">用文字站点标题代替Logo图片</div>
			<div class="clear"> </div></div></div>
	    </div>


		<div class="optmain" id="opt-3">
			<h2 class="opttitle">功能设置</h2>

			<div class="section section-checkbox ">
			<h3 class="heading">文章分享栏</h3>
			<div class="option">
			<div class="controls">
			<input type="checkbox" class="checkbox" name="sharebar" id="sharebar" value="checkbox" <?php if($options['sharebar']) echo "checked='checked'"; ?> ></div>
			<div class="explain">开启主题自带的文章页面分享栏功能</div>
			<div class="clear"> </div></div></div>

			<div class="section section-checkbox ">
			<h3 class="heading">相关日志功能</h3>
			<div class="option">
			<div class="controls">
			<input type="checkbox" class="checkbox" name="relatedpost" id="relatedpost" value="checkbox" <?php if($options['relatedpost']) echo "checked='checked'"; ?> ></div>
			<div class="explain">开启主题自带的相关文章功能</div>
			<div class="clear"> </div></div></div>

			<div class="section section-checkbox ">
			<h3 class="heading">Fancybox看图插件</h3>
			<div class="option">
			<div class="controls">
			<input type="checkbox" class="checkbox" name="fancybox" id="fancybox" value="checkbox" <?php if($options['fancybox']) echo "checked='checked'"; ?> ></div>
			<div class="explain">开启主题自带的Fancybox看图插件</div>
			<div class="clear"> </div></div></div>

			<div class="section section-checkbox ">
			<h3 class="heading">强制关闭Wordpress自带的jQuery库</h3>
			<div class="option">
			<div class="controls">
			<input type="checkbox" class="checkbox" name="closejquery" id="closejquery" value="checkbox" <?php if($options['closejquery']) echo "checked='checked'"; ?> ></div>
			<div class="explain">如果你发现某些插件使用后导致一些jQuery特效显示不正常，请选上这个。</div>
			<div class="clear"> </div></div></div>

			<div class="section section-checkbox ">
			<h3 class="heading">调用新浪的在线jQuery库</h3>
			<div class="option">
			<div class="controls">
			<input type="checkbox" class="checkbox" name="sinajquery" id="sinajquery" value="checkbox" <?php if($options['sinajquery']) echo "checked='checked'"; ?> ></div>
			<div class="explain">开启这项可以减缓主机负担，节省流量（土豪们请无视）</div>
			<div class="clear"> </div></div></div>
	 	</div>



		<div class="optmain" id="opt-4">
			<h2 class="opttitle">其他设置</h2>

	        <div class="section section-textarea ">
			<h3 class="heading">向&lt;head&gt;标签内添加代码</h3>
			<div class="option">
			<div class="controls">
			<textarea class="tz-input" name="headcode" id="headcode" cols="8" rows="8"><?php echo($options['headcode']); ?></textarea>
			<br></div><div class="explain">输入你想要添加的头部信息。<br>如果你不了解这项设置的作用，请留空。</div>
			<div class="clear"> </div></div></div>

	        <div class="section section-textarea ">
			<h3 class="heading">向&lt;body&gt;标签中添加代码</h3>
			<div class="option">
			<div class="controls">
			<textarea class="tz-input" name="bodycode" id="bodycode" cols="8" rows="8"><?php echo($options['bodycode']); ?></textarea>
			<br></div><div class="explain">输入你想要添加的HTML信息。<br>如果你不了解这项设置的作用，请留空。</div>
			<div class="clear"> </div></div></div>

	        <div class="section section-textarea ">
			<h3 class="heading">自定义CSS</h3>
			<div class="option">
			<div class="controls">
			<textarea class="tz-input" name="csscode" id="csscode" cols="8" rows="8"><?php echo($options['csscode']); ?></textarea>
			<br></div><div class="explain">输入你想要添加的自定义CSS样式。<br>如果你不了解这项设置的作用，请留空。</div>
			<div class="clear"> </div></div></div>
	 	</div>
	    
	</div><div class="clear"></div>
</div>
<!-- 提交按钮 -->
<div class="save_bar_top">
	<img style="display:none" src="<?php bloginfo('template_directory'); ?>/admin/saving.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." id="optsaving">
	<input type="submit" name="saveopts" value="保存设置" class="button button-primary" id="optsubmit">

	<span class="submit-footer-reset">
	<input name="resetopts" type="submit" value="重置设置" class="button submit-button reset-button" onclick="return confirm('你确定要重置所有的设置吗？');">
	<input type="hidden" name="tz_save" value="reset">
	</span>
</div>

</div> <!-- wrap -->
</form><div class="clear"></div>

<script type="text/javascript">
var $=jQuery;
$('#optsubmit').click(function(){$('#optsaving').fadeIn(150);})
$('#optnav-1').click(function(){$('.optcurr').hide().removeClass('optcurr');$('#opt-1').fadeIn().addClass('optcurr');$('.currentnav').removeClass('currentnav');$(this).addClass('currentnav');});
$('#optnav-2').click(function(){$('.optcurr').hide().removeClass('optcurr');$('#opt-2').fadeIn().addClass('optcurr');$('.currentnav').removeClass('currentnav');$(this).addClass('currentnav');});
$('#optnav-3').click(function(){$('.optcurr').hide().removeClass('optcurr');$('#opt-3').fadeIn().addClass('optcurr');$('.currentnav').removeClass('currentnav');$(this).addClass('currentnav');});
$('#optnav-4').click(function(){$('.optcurr').hide().removeClass('optcurr');$('#opt-4').fadeIn().addClass('optcurr');$('.currentnav').removeClass('currentnav');$(this).addClass('currentnav');});
</script>
 
<?php
	}
}	
/**
 * 登记初始化方法
 */
add_action('admin_menu', array('iceOptions', 'init'));
?>