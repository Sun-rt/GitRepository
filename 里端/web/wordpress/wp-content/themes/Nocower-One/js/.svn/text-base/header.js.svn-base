    $.fn.postLike = function() {
    if ($(this).hasClass('done')) {
    return false;
    } else {
    $(this).addClass('done');
    var id = $(this).data("id"),
    action = $(this).data('action'),
    rateHolder = $(this).children('.count');
    var ajax_data = {
    action: "bigfa_like",
    um_id: id,
    um_action: action
    };
    $.post("/wordpress/wp-admin/admin-ajax.php", ajax_data,
    function(data) {
    $(rateHolder).html("["+data+"]");
    });
    return false;
    }
    };
    $(document).on("click", ".favorite",
    function() {
    $(this).postLike();
    });

 $.fn.postunLike = function() {
    if ($(this).hasClass('done')) {
    return false;
    } else {
    $(this).addClass('done');
    var id = $(this).data("id"),
    action = $(this).data('action'),
    rateHolder = $(this).children('.count');
    var ajax_data = {
    action: "bigfa_unlike",
    um_id: id,
    um_action: action
    };
    $.post("/wordpress/wp-admin/admin-ajax.php", ajax_data,
    function(data) {
    $(rateHolder).html("["+data+"]");
    });
    return false;
    }
    };
    $(document).on("click", ".unfavorite",
    function() {
    $(this).postunLike();
    });
 function toVaild(){
         var val = document.getElementById("searchtext").value;
         
         if(val == ""){
           
             return false;
         }
         
		var regu = "^[ ]+$";
		var re = new RegExp(regu);
		if(re.test(val))
		{
			
             return false;
		}
		return true;
     }
