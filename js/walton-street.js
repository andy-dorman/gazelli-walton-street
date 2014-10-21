;(function($, undefined){
	$(".fancybox").fancybox({
        fixed		: true,
        enableEscapeButton : true,
        overlayShow : true,
		fitToView	: false,
		autoSize	: false,
		closeClick	: true,
		closeBtn	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		scrolling	: 'yes',
		width 		: 450, 
		minWidth 	: 450,
		height 		: 500,
        padding		: 0,
		helpers : { 
			overlay: {
				css: {'background': 'rgba(0,0,0,0.8)'} // or your preferred hex color value
			} // overlay 
		} // helpers
    });

	function getForm(e) {
		e.preventDefault();
		e.stopPropagation();
		var name, wish;
		$.ajax({
			url: "/lib/walton-secret_form.php",
			type: "POST",
			success: function(data) {
			
				$.fancybox({
	                fixed		: true,
	                enableEscapeButton : true,
	                overlayShow : true,
	                content: data,
					fitToView	: true,
					autoSize	: true,
					closeClick	: false,
					closeBtn	: false,
					openEffect	: 'none',
					closeEffect	: 'none',
					scrolling	: 'yes',
	                padding		: 0,
	                afterClose	: function(){
		                $(window).trigger('fancyboxClosed');
		            },
	                helpers 	: { 
						overlay: {
							css: {'background': 'rgba(0,0,0,0.8)'} // or your preferred hex color value
						} // overlay 
					} // helpers
				});
				var options = {

	                target: '#walton-street_entry',
	                // target element(s) to be updated with server response 
	                beforeSubmit: validateGoal,
	                // pre-submit callback 
	                success: function (response) {
	                	if(response["duplicate_email"]) {
	                		var errors = $('<div/>').attr({
					            "id": "errors"
					        }).html('<ul><li>' + response["duplicate_email"] + '</li></ul>');

					        $("#walton-street_entry").append(errors);

					        var oklink = $('<a/>').attr({
					            "id": "oklink",
					            "href": "#ok"
					        }).text("OK");


					        $('#errors').append(oklink);
					        $("#oklink").click(function (e) {
					            e.preventDefault();
					            $("#errors").remove();
					        });

					        $.fancybox.resize();
	                	} else {
		                    $("#walton-street_entry").html($("<div/>").html(response["thanks"]));
		                    $('.key-panel').removeClass('new-goal');
		                    var firstPanel = $(".key-panel.lock-in").first().next().clone();
		                    var newGoal = $('<div class="new-goal key-panel col-sm-3 goal">
		                    	<h4>' + response['initials'] + '</h4>
		                    	<div>
				                <h4 class="text-uppercase text-center">My goal is to</h4>
				                <p class="text-center">' + response['goal'] + '</p>
				                </div></div>');
		                    $(window).off('fancyboxClosed');
		                    $(window).on('fancyboxClosed', function(){
		                    	// remove first blank panel
		                    	//
		                    	$(".key-panel:not(.lock-in):not(.goal)").first().remove();
		                    	// insert the firstPanel before the last lock-in
		                    	//
		                    	$(".key-panel.lock-in").last().before(firstPanel);
		                    	if($(".key-panel.lock-in").last().parent().children().size() > 4) {
		                    		var lastLockIn = $(".key-panel.lock-in").last().clone();
		                    		$(".key-panel.lock-in").last().parent().children().last().remove();
		                    		$(".key-panel").last().parent().children().first().before(lastLockIn);
		                    	}
			                    $(".key-panel.lock-in").first().next().replaceWith(newGoal);
		                    });
		                    $("#oklink").click(function (e) {
		                        e.preventDefault();
		                        $.fancybox.close();
		                    });
		                }
	                },
	                dataType: "json"
	            };

	            // bind form using 'ajaxForm' 
	            $('#key_form').ajaxForm(options);
	            countCharacters('#key_form textarea', 120);
	            var inactive = "inactive";
	            var active = "active";
	            var focused = "focused";
	            $("label").each(function () {
	                $(this).css("display", "none");
	            });
			}
		});
	}
	
	function countCharacters(obj, count) {
	    $(obj).keyup(function (e) {
	    	if(e.keyCode != 46 || e.keyCode != 8) {
		        if ($(obj).val().length > count) {
		        	alert("Your goal must be less than 120 characters long.")
		            e.preventDefault();
		        }
		    }
		    if($(obj).val().length > count) {
		    	$(obj).val($(obj).val().substring(0, count));
		    }
		    $('#character-count > span').html(' - ' + $(obj).val().length)
	    });
	}

	function validateGoal(formData, jqForm, options) {
	    var out = true;

	    for (var i = 0; i < formData.length; i++) {
	        if ((!formData[i].value && formData[i].name != "telephone") || (formData[i].value == $('label[for="' + formData[i].name + '"]').text() && formData[i].name != "telephone")) {
	            if (typeof out == "boolean") {
	                out = [];
	            }
	            if (formData[i].name == "name") {
	                name = formData[i].value;
	            }
	            if (formData[i].name == "wish") {
	                wish = formData[i].value;
	            }
	            formData[i].value == "";
	            out[out.length] = formData[i].name;
	        }
	        if(formData[i].value == $('label[for="' + formData[i].name + '"]').text() && formData[i].name == "telephone") {
		        formData[i].value = "";
	        }
	    }

	    if (typeof out != "boolean") {
	        var errors_out = "<h3>There is a problem with your entry</h3><p>You need to complete the following fields:\n<ul>\n";
	        for (var i = 0; i < out.length; i++) {
	        	var error = "";
		        switch(out[i])
				{
				case "name":
				  error = "Name";
				  break;
				default:
				  error = out[i].charAt(0).toUpperCase() + out[i].slice(1);
				}
	            errors_out += "<li>" + error + "</li>\n";
	        }
	        errors_out += "<ul>";
	        var errors = $('<div/>').attr({
	            "id": "errors"
	        }).html(errors_out);
	        $("#walton-street_entry").append(errors);

	        var oklink = $('<a/>').attr({
	            "id": "oklink",
	            "href": "#ok"
	        }).text("OK");


	        $('#errors').append(oklink);
	        $("#oklink").click(function (e) {
	            e.preventDefault();
	            $("#errors").remove();
	        });

	        $.fancybox.resize();
	        out = false;
	    }
	    return out;
	}

	$('.lock-in, #lock-in-link').bind('click', getForm);
	$('#goto-top').bind('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		$('html, body').animate({scrollTop: $("#top").offset().top}, 1000);
	});
})(jQuery)