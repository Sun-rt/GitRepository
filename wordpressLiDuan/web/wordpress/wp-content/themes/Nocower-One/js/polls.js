jQuery(document).ready(function($) {

$(".wp-polls-ans").find("p").hide();


});
var polls_set;
function  submitPolls(){
	polls_set =[];
   var status = true;
   $(".wp-polls-form").each(function(){
   		var answer = $(this);
   		var poll_id = answer.find("input[name='poll_id']").val();
   		var poll_nonce = answer.find("input[name='wp-polls-nonce']").val();
   		var poll_multiple_ans = answer.find("input[name='poll_multiple_ans_"+poll_id+"']").val() | 0;
   		var poll ={};
   		poll.poll_id = poll_id;
   		poll.poll_nonce = poll_nonce;
   		//poll.poll_multiple_ans_count = poll_multiple_ans_count;
   		

		var ansfrom = answer.find(".wp-polls-ul");
		var poll_ans_id = "";
		ansfrom.find("input[type=radio] , input[type=checkbox] ").each(function(){
			var limitcount = parseInt(poll_multiple_ans);
			var count = 0 ;
			if ($(this).is(':checked') || $(this).is(':selected')){
				var ansid =  $(this).val();
				poll_ans_id = poll_ans_id ? poll_ans_id + "," + ansid : ansid;
				count++;
			}
			if(limitcount > 0 && count > limitcount){
				status = false;
			}
		});
		if(poll_ans_id==""){
			status = false;
		}
		poll.poll_ans_id = poll_ans_id;
 		polls_set.push(poll);

   });//.wp-polls-form
 
 	if(!status){

 		alert("您有选项没有填写，或多选超出了限定个数！")
 	}
 	else{
 		var ajaxdata = {
 			action: "polls",
 			view:"process",
 			polls_sets : polls_set
 		}
 		console.log(ajaxdata);
   $.ajax({type: 'POST', 
   		   xhrFields: {withCredentials: true}, 
   		   	url: pollsL10n.ajax_url, 
   		   	data: ajaxdata, 
   			cache: false, 
   		 	success:function(){
   		 		alert("您填写的调查问卷已经提交，感谢您的参与！");
   		 	}
		});
    }

	return status;
}