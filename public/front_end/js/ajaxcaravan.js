$(document).ready(function(){
		var loct=$(location).attr('href');
		var res = loct.split("/");
		console.log(res);
		var a = res.indexOf("request_detail");
		console.log(a);
		if(a>=2){
			var sortby=$("#sortby").val();
			console.log(sortby);
			var pagestart=$("#pagestart").val();
			console.log(pagestart);
			var pageend=$("#pageend").val();
			console.log(pageend);
			var requestid=$("#requestid").val();
			console.log(requestid);
			if(typeof sortby!= "undefined"){ 

				$.ajax({
					url: "../../ajax/getallbidchunk",
					data: {requestid:requestid,sortby:sortby,pagestart:pagestart,pageend:pageend,_token: '{!! csrf_token() !!}'},
					type :"post",
					success: function( data ) {
						if(data){
							$(".bidlist").html(data);
						}
					}
				});
			}
		}else{
			
		}







		$('#shortoptions').change(function(){
			var shortoptions=$("#shortoptions").val();
			
			$("#sortby").val(shortoptions);
			$("#pagestart").val(0);
			$("#pageend").val(10);
			var sortby=$("#sortby").val();
			var pagestart=$("#pagestart").val();
			var pageend=$("#pageend").val();
			var requestid=$("#requestid").val();
			var nsd=$("#nsd").val();
				if(typeof sortby!= "undefined"){
					
					$.ajax({
						url: "../../ajax/getallbidchunk",
						data: {requestid:requestid,sortby:sortby,pagestart:pagestart,pageend:pageend,_token: '{!! csrf_token() !!}'},
						type :"post",
						success: function( data ) {
							if(data){
								var urlnew="../request_detail/"+nsd;
                        		$(location).attr('href',urlnew);
							}
						}
					});
				}
		});

		$('.oppomod').click(function(){
			alert("yes");
		});
});