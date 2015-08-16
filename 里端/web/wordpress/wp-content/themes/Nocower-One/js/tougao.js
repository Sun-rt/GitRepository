
	KindEditor.ready(function(K) {
		/*取色器*/
        var colorpicker;
		K('#colorpicker').bind('click', function(e) {
			e.stopPropagation();
			if (colorpicker) {
				colorpicker.remove();
				colorpicker = null;
				return;
			}
			var colorpickerPos = K('#colorpicker').pos();
			colorpicker = K.colorpicker({
				x : colorpickerPos.x,
				y : colorpickerPos.y + K('#colorpicker').height(),
				z : 19811214,
				selectedColor : 'default',
				noColor : '无颜色',
				click : function(color) {
			
					var imageView = K('#colorView');
          var colorcount = K('#colorView div').length;
          if(length <12){
              var warpimage = "<div class='col-md-1 coloritem' style='background-color:"+color+"'><div class='deletecolor'><a class='btn'><i class='glyphicon glyphicon-remove'></i></a></div></div>";
              imageView.append(warpimage);

              var colorvalue = K(".deletecolor a").css("color");
               if(colorvalue == color){
                console.log(RGBToHex(colorvalue));
                 K(".deletecolor a").find("i").css("color","red");
              }
              
              K(".deletecolor a").click(function(){
                K(this).parent().parent().remove();
              });
          }
					colorpicker.remove();
					colorpicker = null;
				}
			});
		});
		K(document).click(function() {
			if (colorpicker) {
				colorpicker.remove();
				colorpicker = null;
			}
		});
		/*上传图片*/
    	var editor = K.editor({
     		allowFileManager : true,
     		allowImageUpload :true
   		 });
    K('.selectImg').each(function(){
	var selectBtn = $(this);
	$(this).click(function() {
     editor.loadPlugin('image', function() {
      editor.plugin.imageDialog({
       showRemote : false,
       imageUrl : K('#tougao_content').val(),
       clickFn : function(url, title, width, height, border, align) {
      
        var img = "<img class=\"imgitem\" src=\""+url+"\" alt=\"\"></img>"//格式要一致
		var input = selectBtn.parent().prev();
		input.val("uploading");
       	var imageView = selectBtn.parent().next().find(".imageView");
       	var warpimage = "<div class='col-md-3'><span class='deleteimg'><a class='btn'><i class='glyphicon glyphicon-remove'></i></a></span>"+img +"</div>";
       	imageView.append(warpimage);

         K(".deleteimg a").click(function(){
                K(this).parent().parent().remove();
              });

		editor.hideDialog();
       }
      });
     });
    });
	
	});
   });			
/* 编辑器初始化代码 end */


function vailddata(){

var status = true;
    $(".noempty").each(function(){
    	var parent = $(this).parent();
    	var prev = parent.prev();
    	var prompt = prev.find("a").html() + "不能为空";
    	var value = $(this).val();
    	if(value.length== 0){
    		   	parent.parent().find(".prompt").html(prompt);
    		   	status =false;
    	}    	
    });

    $(".limitlength100").each(function(){

    	var parent = $(this).parent();
    	var prev = parent.prev();
    	var prompt = prev.find("a").html()+"的长度不能超过100个字符";
       	var value = $(this).val();
    	if(value.length > 100){
    		   	parent.next().html(prompt);
    		   	status =false;
    	}  
    });
    var colors;
    $(".coloritem").each(function(){
      var color = RGBToHex($(this).css("background-color"));
      colors = colors ? colors+ "," + color : color;
    });

    var imgs_anli="";
    $("#tougao_anli").find(".imgitem").each(function(){
      var url = $(this).attr('src');
      var img = "<img src=\""+url+"\" alt=\"\"></img>"//格式要一致
      imgs_anli =  imgs_anli ? imgs_anli+"<br/>" + img : img;

    });
	 var imgs_sheji="";
	 $("#tougao_sheji").find(".imgitem").each(function(){
      var url = $(this).attr('src');
      var img = "<img src=\""+url+"\" alt=\"\"></img>"//格式要一致
      imgs_sheji =  imgs_sheji ? imgs_sheji+"<br/>" + img : img;
    });
	
    $("input[name=tougao_tags]").val(colors);
	var content ="<h4>案例图</h4><hr><br>" + imgs_anli;
	    content+=imgs_sheji ?"<h4>设计图</h4><hr><br>" + imgs_sheji :"";
    $("input[name=tougao_content]").val(content);     

	return status;
}
function RGBToHex(rgb){ 
   var regexp = /[0-9]{0,3}/g;  
   var re = rgb.match(regexp);//利用正则表达式去掉多余的部分，将rgb中的数字提取
   var hexColor = "#"; var hex = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];  
   for (var i = 0; i < re.length; i++) {
        var r = null, c = re[i], l = c; 
        var hexAr = [];
        while (c > 16){  
              r = c % 16;  
              c = (c / 16) >> 0; 
              hexAr.push(hex[r]);  
         } hexAr.push(hex[c]);
         if(l < 16&&l != ""){        
             hexAr.push(0)
         }
       hexColor += hexAr.reverse().join(''); 
    }  
   //alert(hexColor)  
   return hexColor;  
} 

function  getStringLen(Str){     
        var   i,len,code;     
        if(Str==null || Str == "")   return   0;     
        len   =   Str.length;     
         
        return   len;     
    }    
      
function checkLen(value,length){  
      var len = getStringLen(value); 
        //提示当前输入的个数  
        $("#lblSummary"+length).html("还可以输入：<font color='red'>"+(length-len)+"字符</font>/汉字");  
        if(len>length){  
            flag = false;  
        }else{  
            flag = true;  
        }  
          
    } 