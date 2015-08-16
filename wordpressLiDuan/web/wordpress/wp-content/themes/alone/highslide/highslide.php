<?php
	//////////////START wp highslide picture code  /////////////
add_filter('the_content', 'hlHighSlide_replace', '99');

	add_action('wp_head', 'highslide_head');
	function highslide_head()
		{
		$hlHighslide_wp_url=get_bloginfo('template_url').'/';
		$defaults_javascript =  
		"<link href='{$hlHighslide_wp_url}highslide/highslide.css' rel='stylesheet' type='text/css' />";
	 echo $defaults_javascript;
		}
 
	add_action('wp_footer', 'highslide_footer');
    function highslide_footer()
    {
    $hlHighslide_wp_url=get_bloginfo('template_url').'/';
    $defaults_javascript =  
    "\n\t<script type='text/javascript' src='{$hlHighslide_wp_url}highslide/highslide.js'></script>
    <script type='text/javascript'>
	hs.showCredits = false;  
    hs.graphicsDir = '{$hlHighslide_wp_url}highslide/graphics/';
	hs.wrapperClassName = 'wide-border';
    hs.align = 'center';
        hs.transitions = ['expand', 'crossfade'];
        hs.fadeInOut = true;
        hs.dimmingOpacity = 0.3;
        if (hs.addSlideshow) hs.addSlideshow({
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: 'fit',
            overlayOptions: {
                opacity: .6,
                position: 'bottom center',
                hideOnMouseOut: true
            }
        });
        hs.lang={
    loadingText :     '图片加载中...',
    loadingTitle :    '正在加载图片',
        closeText :       '关闭',
    closeTitle :      '关闭 (Esc)',
        moveTitle :       '移动图片',
        moveText :        '移动',
        restoreTitle :    '点击可关闭或拖动',
        fullExpandTitle : '点击查看原图',
        fullExpandText :  '查看原图'
        };
        hs.registerOverlay({
    html: '<div class=\"closebutton\" onclick=\"return hs.close(this)\" title=\"Close\"></div>',
    position: 'top right',
    fade: 2 
        });
        hs.Expander.prototype.onMouseOut = function (sender) {
        sender.close();
        };
        hs.Expander.prototype.onAfterExpand = function (sender) {
        if (!sender.mouseIsOver) sender.close();
         }
         </script>";
 echo $defaults_javascript;
 }
 
//add onclick event 
function add_onclick_replace ($content)
{ 
$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
$replacement = '<a$1href=$2$3.$4$5 class="highslide"  onclick="return hs.expand(this)" $6>$7 </a>';
$content = preg_replace($pattern, $replacement, $content);
return $content;
}

function hlHighSlide_replace($content)
{
        global $post;
        $defaults = array();
        $defaults['quicktags'] = 'y';
        $defaults['alt'] = 'Enter ALT Tag Description';
        $defaults['title'] = 'Enter Caption Text';
        $defaults['thumbid'] = 'thumb1';
        $defaults['show_caption'] = 'y';
        $defaults['show_close'] = 'y';
        $content=add_onclick_replace($content);
        $HSVars = array("SRC", "ALT", "TITLE", "WIDTH", "HEIGHT","THUMBID");
        $HSVals = array($defaults['href'], $defaults['src'], $defaults['alt'], $defaults['title'], $defaults['thumbid']);
        preg_match_all ('!<img([^>]*)[ ]*[/]{1}>!i', $content, $matches);
        $HSStrings = $matches[0];
        $HSAttributes = $matches[1];
        for ($i = 0; $i < count($HSAttributes); $i++)
        { preg_match_all('!(src|alt|title|width|height|class)="([^"]*)"!i',$HSAttributes[$i],$matches);
          $HSSetVars = $HSSetVals = array();
          for ($j = 0; $j < count($matches[1]); $j++)
            { $HSSetVars[$j] = strtoupper($matches[1][$j]);
              $HSSetVals[$j] = $matches[2][$j];}
		}
        $HSClose = <<<EOT
                <a href="#" onclick="hs.close(this);return false;" class="highslide-close"  title="关闭">Close</a>  
EOT;
                $HSCaption = <<<EOT
                <div class='highslide-caption' id='caption-for-%THUMBID%'>
                {$HSPrvNextLinks}           
                {$HSClose}  
                <div style="clear:both">%TITLE%</div>
                </div>
EOT;
            $HSCode = <<<EOT
<img id="%THUMBID%" src="%SRC%" alt="%ALT%" title="%TITLE%" width="%WIDTH%"  height="%HEIGHT%" />{$HSCaption}
EOT;
          $content = str_replace($HSStrings[$i], $HSCode, $content);
        return $content;
    }
	
	
	
	/////////////////
?>