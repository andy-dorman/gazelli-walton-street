;(function($, undefined){
	$(".fancybox").fancybox({
		fitToView	: true,
		fixed		: true,
		autoDimensions	: true,
		closeClick	: false,
		closeBtn	: true,
		openEffect	: 'none',
		closeEffect	: 'none',
		scrolling	: 'no',
		centerOnScroll: true,
		showCloseButton:	true,
		helpers : { 
			overlay: {
				css: {'background': 'rgba(0,0,0,0.8)'} // or your preferred hex color value
			} // overlay 
		} // helpers
    });

	function getForm() {
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
					onCleanup: function () {
	                    if (!tag.attr("data-wish")) {
	                        tag.remove();
	                    }
	                },
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
	                    tag.attr({
	                        "data-wish": response["wish"],
	                        "data-name": response["name"]
	                    });
	                    $(".closefancybox").click(function (e) {
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
				case "fname":
				  error = "First name";
				  break;
				case "lname":
				  error = "Last name";
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
	        $("#wishingtree_entry").append(errors);

	        var oklink = $('<a/>').attr({
	            "id": "oklink",
	            "href": "#ok"
	        }).text("OK");


	        $('#errors').append(oklink);
	        $("#oklink").click(function (e) {
	            e.preventDefault();
	            $("#errors").remove();
	        });

	        $('#errors').css({
	            marginTop: "-" + ($('#errors').height() / 2) + "px"
	        })
	        $.fancybox.resize();
	        out = false;
	    }
	    return out;
	}

	$('.lock-in').bind('click', getForm);
})(jQuery)