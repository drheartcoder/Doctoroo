var unloaded = false;
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
}