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

<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			
			<div style="margin-top: 5px;">
				<ol class="breadcrumb breadcrumb-arrow">
					<li><a href="/">首页</a></li>
					<li class="active"><span>全部活动</span></li>
			    </ol>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					全部活动
		       	</div>			       	
	   			<div class="panel-body">
		   			<ul class="media-list">
			   			<style >
					    .hr-for-event {
						    margin-top: 10px;
						    margin-bottom: 10px;
					    }    
					    </style>
			   			<?php foreach ($events as $event): ?>
			   			<li class="media" style="margin-top: 20px;">
					   		<div class="col-md-12" style="min-height: 200px;">
					            <div class="col-md-4">
						            <img src="<?php echo $event['Event']['eventimageurl'] ?>" style="width:200px; height:200px;"/>
						        </div>
					            <div class="col-md-8" style="margin-left: -60px;">
					                <a href="/events/view/<?php echo $event['Event']['id'] ?>">
					                    <?php echo $event['Event']['title'] ?>
					                </a>
					                &nbsp;&nbsp;
					                (&nbsp;来自&nbsp;<a href="/groups/view/<?php echo $event['Group']['id'] ?>" title=""><?php echo $event['Group']['name'] ?></a>&nbsp;)
					                <hr class="hr-for-event" />
						            <b>活动地点：</b>地点
						            <hr class="hr-for-event" />
						            <b>活动时间：</b><?php echo $event['Event']['begintime'] ?>&nbsp;&nbsp;至&nbsp;&nbsp;<?php echo $event['Event']['endtime'] ?>
						            <hr class="hr-for-event" />
						            <b>截止时间：</b><?php echo $event['Event']['applyendtime'] ?>
						            <hr class="hr-for-event" />
						            <b>活动评论：</b><?php echo $event['Event']['replycount'] ?>条
					            </div>
				            </div>
			   			</li>
			   			<hr class="hr-for-event" />
						<?php endforeach; ?>
					</ul>
					
					<div style="text-align: center;">
						<ul class="pagination">
							<?php
								echo $this->Paginator->first('第一页') . '  '; 
								echo $this->Paginator->prev('前一页'). '  '; 
								echo $this->Paginator->numbers(). '  '; 
								echo $this->Paginator->next('下一页'). '  '; 
								echo $this->Paginator->last('尾页'). '  ';
							?>
						</ul>
					</div>
	            </div>
	   		</div>
			
		</div>
	</div>
</div>