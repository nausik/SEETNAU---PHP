$(document).ready(function() {
	$('.send_message_b').click(function() {
		$("#to_name").text($(this).attr('data-name'););
});

	$(".list_title").click(function() {
		$(this).next(".list_body").slideToggle("fast");
		return false;
	});
});