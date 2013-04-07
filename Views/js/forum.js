
	// ----------- forum controls -----------

	// reply dialog
$(document).ready(function(){

	$('.collapsePost').click(function(){
		$(this).parent().find('.response').slideToggle();
	});

	$('.collapsePost').click(function(){
			$(window).scrollTo($(this), 800);
			if ($(this).hasClass('dropped')){
				$(this).find('.triangle').html('&#xFF0B;');
				$(this).parent().find('.catDropdown').slideUp();
				$(this).removeClass('dropped');
			}else{
				$(this).addClass('dropped');
				$(this).find('.triangle').html('&#x25BE;');
				$(this).parent().find('.catDropdown').slideDown();
			}
		});

	$('.replyButt').click(function(){
		// perform the animation to slide down the relevant reply box
		var $replyDialog = $(this).parent().parent().find(".responseInput").first();
		// get the parent comment id from the hidden input 
		var $parent_id_val = $(this).parent().parent().parent().find(".commentID").val();
		// assign the parent's 
		var $comment_parent_val = $(this).parent().parent().parent().find(".parentID");
		// alert($parent_id_val);
		$comment_parent_val.val($parent_id_val);
		$replyDialog.slideToggle();
	});

	$('.clearButt').click(function(){
		var $clearDialog = $(this).parent().parent().find("textarea");
		$clearDialog.val("");
	});


	// open and close the new post dialog
	$('.newPost').click(function(){
		$('.newPostPop').show();
	});

	$('.closeButton').click(function(){
		$('.newPostPop').hide();
	});
	// end open and close new post dialog


});

	// ----------- end forum controls -----------