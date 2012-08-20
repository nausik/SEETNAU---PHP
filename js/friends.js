$(document).ready(function() {
	$('.send_message_b').click(function() {
        var p = $(this).attr('data-name');
        $("#to_name").text(p);
    });

	$(".list_title").click(function() {
		$(this).next(".list_body").slideToggle("fast");
		return false;
	});
});