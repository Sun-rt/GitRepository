function checkFileStyle() 
{
     var file = document.getElementById("userUploadFile");
     var ext=file.value.substring(file.value.lastIndexOf(".")+1).toLowerCase();
     if(ext!='txt')
     {
         alert("文件必须为txt格式！"); return;
     }   
 }