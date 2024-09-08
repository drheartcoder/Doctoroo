/*var unloaded = false;
$(window).on('beforeunload', unload);
$(window).on('unload', unload);
function unload(){
	if(!unloaded){
		$('body').css('cursor','wait');
		$.ajax({
			type: 'get',
			async: false,
			url: "{{url('/')}}/logout",
			success:function(){
				unloaded = true;
				//$('body').css('cursor','default');
			},
			timeout: 5000
		});
	}
}*/

/*window.addEventListener('beforeunload', function(event) {
  confirmExit();
}, false);
function confirmExit(){
   $.ajax({
			type: 'get',
			async: false,
			url: "{{url('/')}}/logout",
			success:function(result){
				alert('done');
			},
			timeout: 5000
		});
    return false;
}*/

