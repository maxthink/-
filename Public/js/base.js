



$(document).ready(function(){
	
	/*����*/


	/*����*/
	$('.nav_item').mouseenter(function(){
		$(this).find('ul').hide();
		$(this).addClass('current');
		$(this).find('ul').slideDown(300);//���������л�ʱ�� 
	});
	$('.nav_item').mouseleave(function(){
		$(this).find('ul').hide();
		$(this).removeClass('current');
		$(this).find('ul').slideUp(300);
	});

	$('.sub_nav li').mouseenter(function(){
		$(this).addClass('hover');
	});
	$('.sub_nav li').mouseleave(function(){
		$(this).removeClass('hover');
	});
  
});

