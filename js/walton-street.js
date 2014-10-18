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
			url: "/lib/walton-street_form.php",
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
	                    $("#walton-street_entry").html($("<div/>").html(response["thanks"]));
	                    var firstPanel = $(".key-panel.lock-in").next();
	                    var newGoal = $('<div class="key-panel col-sm-3 goal">
	                    	<h4>' + response['initials'] + '</h4>
	                    	<div>
			                <h4 class="text-uppercase text-center">My goal is to</h4>
			                <p class="text-center">' + response['goal'] + '</p>
			                </div></div>');
	                    $(".key-panel:not(.goal):not(.lock-in)").first().replaceWith(firstPanel);
	                    firstPanel.replaceWith(newGoal);

	                    $("#oklink").click(function (e) {
	                        e.preventDefault();
	                        $.fancybox.close();
	                    });

	                    

	                },
	                dataType: "json"
	            };

	            // bind form using 'ajaxForm' 
	            $('#key_form').ajaxForm(options);
	            countCharacters('#key_form textarea', 250);
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
	    $(obj).keydown(function (event) {
	        if ($(obj).val().length >= count) {
	        	alert("Your goal must be less than 250 characters long.")
	            event.preventDefault();
	        }
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
})(jQuery)