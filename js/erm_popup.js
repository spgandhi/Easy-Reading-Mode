
jQuery(document).ready(function($){
	// Extract post content
	erm_the_content = $('.erm-content-wrapper').html();

	// Extract post title
	erm_the_title = $('.erm-title-wrapper').html();

	// Popup Content
	popup_content  = '<div class="erm-popup-wrapper mfp-hide" id="erm-popup-link"><div class="erm-popup">';
	popup_content += '<div class="erm-popup-title">' + erm_the_title + '</div>';
	popup_content += '<div class="erm-popup-content">' + erm_the_content + '</div>';
	popup_content += '</div></div>'; 

	$('body').append(popup_content);

	$('.erm-popup-btn').magnificPopup({
  		type:'inline',
  		overflowY: 'scroll',
  		closeBtnInside: 'true'
  		// midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
	});

});