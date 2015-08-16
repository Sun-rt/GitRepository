<script>
	hide_top_img();
</script>

<style type="text/css">

.wrap{
	width:1000px;
	margin:0 auto;
}

.logo{
	width:430px;
	position:absolute;
	top:15%;
	left:30%;
}

p {
	color:gray;
	font-size:20px;
}

p a{
	color:#eee;
	font-size:13px;
	margin-left:5px;
	padding:5px;
	background:black;
	text-decoration:none;
	-webkit-border-radius:.3em;
	   -moz-border-radius:.3em;
	        border-radius:.3em;
}
p a:hover{
	color: #fff;
}

</style>
<div class="container" style="height: 550px;">
<div class="wrap">
    <div class="logo">
    <?php 
        echo '<img src="'.$errorInfo['errImgUrl'].'" alt="" style="margin: 0 auto;" />';
        echo '<h3>'.$errorInfo['errMainText'].'</h3>';
        echo '<p>'.$errorInfo['errSubText'].'</p>'
    ?>
    <p><a href="/">返回首页</a></p>
    </div>
</div>
</div>

<script>
	shouldHideFooter = true;
</script>