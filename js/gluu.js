(function($){
    //console.log("here");
    //alert("here"); // value

		if ($("#edit-enrollment-3").is(":checked"))
		{
			$("#edit-user-type").attr("disabled","disabled");
		}

    $("input[name=enrollment]").click(function(){
		var enrollement=$('input[name=enrollment]:checked', '#default-form').val();
		if (enrollement=='3')
		{
			$("#edit-user-type").attr("disabled","disabled");
		}
		if(enrollement=='1')
		{
			$("#edit-user-type").removeAttr("disabled","disabled");
		}
	});
  var $ctrl = $('<input/>').attr({ type: 'radio', name:'rad',id:'hideloginform'}).addClass("rad");
  var $ctrl1 = $('<input/>').attr({ type: 'radio', name:'rad',id:'showloginform'}).addClass("rad");
  var $loginsubmit=$('<input/>').attr({ type: 'button', name:'loginopenid'});
	$("#openid").append($ctrl);
  $("#base").append($ctrl1);
	$("#openid").css({"float":"left","padding":"3px"});
	$("#base").css({"float":"left","padding":"3px"});
	var root = window.location.protocol + "//" + window.location.host + "/";
  $("#loginsubmit").append('<a href='+root+'/gluu_sso/gluuslogin.php class="button button-primary button-large">Login by OpenID Provider </a>');
	$("#hideloginform").attr('checked', 'checked');
  $("div#block-loginblock .user-login-form").hide();

  $('#showloginform').click(function(){
    $("div#block-loginblock .user-login-form").show();
    $("#loginsubmit").hide();
  });
  $('#hideloginform').click(function(){
    $("div#block-loginblock .user-login-form").hide();
    $("#loginsubmit").show();

  });
	var loggedin=$( "body.user-logged-in" ).length;
	if(loggedin =='1')
	{
		$("div#block-loginblock").hide();
	}
})(jQuery);
