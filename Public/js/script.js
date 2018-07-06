function setSection(section){
	$('.navTitle').each(function(index){
		if(section==$(this).text()){
			$(this).addClass('activeSectionItem');
		}
	});
}
	  
// the function below gets called when jQuery is ready

$(
  function(){
	  var timeout=50;
	  var closetimer=0;
	  var closebrandstimer=0;
	  $('.navTitle').mouseenter(navOver).mouseleave(navOut);
	  function navOver(){
		  $(this).addClass('activeNavItem');
	  }
	  function navOut(){
		$(this).removeClass('activeNavItem');
	  }
 	  $(".navTitle").click(function(){
		  window.location=$(this).attr("id");
 	  });
	  
	  //All Roll Overs
	  $(".rollOverItem").click(function(){
		  window.location=$(this).attr("id");
 	  });
	   $('#aboutRollOver > div').mouseenter(rollOverOver).mouseleave(rollOverOut);
	   $('#brandsRollOver > div').mouseenter(rollOverOverBrands).mouseleave(rollOverOut);
	  function rollOverOver(){
		  cancelAboutRollOverClose();
		  $(this).addClass('activeRollOverItem');
	  }
	  function rollOverOut(){
		$(this).removeClass('activeRollOverItem');
	  }
	  
	  function rollOverOverBrands(){
		  cancelBrandsRollOver();
		  $(this).addClass('activeRollOverItem');
	  }

	  
	  
	  //About Roll Over
	  $('#aboutRollOver').css('visibility','visible');
      $('#aboutRollOver').hide();
	  $(".navTitle:eq(2)").mouseover(function(){
		 cancelAboutRollOverClose();
		 $('#aboutRollOver').fadeIn();

 	  });
	  $(".navTitle:eq(2)").mouseout(function(){
		 startCloseAboutTimer();
 	  });
	  $("#aboutRollOver").mouseout(function(){
		 startCloseAboutTimer();
 	  });
	  function startCloseAboutTimer(){
		  closetimer=window.setTimeout(closeAboutRollOver,timeout);
	  }
	  function cancelAboutRollOverClose(){
		  if(closetimer){
			  window.clearTimeout(closetimer);
     	  	  closetimer=null;
		  }
	  }
	  function closeAboutRollOver(){
		  $('#aboutRollOver').fadeOut();
	  }
	  
	  //Brands Roll Over
	  $('#brandsRollOver').css('visibility','visible');
      $('#brandsRollOver').hide();
	  $(".navTitle:eq(3)").mouseover(function(){
		 cancelBrandsRollOver();
		 $('#brandsRollOver').fadeIn();
 	  });
	  $(".navTitle:eq(3)").mouseout(function(){
		 startCloseBrandsTimer();
 	  });
	  $("#brandsRollOver").mouseout(function(){
		 startCloseBrandsTimer();
 	  });
	  function startCloseBrandsTimer(){
		  closebrandstimer=window.setTimeout(closeBrandsRollover,timeout);
	  }
	  function cancelBrandsRollOver(){
		  	$(".navTitle:eq(1)").addClass('activeNavItem');
			if(closebrandstimer){
			  window.clearTimeout(closebrandstimer);
     	  	  closebrandstimer=null;
		  }
	  }
	  function closeBrandsRollover(){
		  $(".navTitle:eq(1)").removeClass('activeNavItem');
		  $('#brandsRollOver').fadeOut();
	  }
	  
	  
	  //buttons
	  $('.blueBtn').mouseover(function(){
		 $(this).addClass('blueBtnActive');
 	  });
	  $('.blueBtn').mouseout(function(){
		  $(this).removeClass('blueBtnActive');
		 
 	  });
	 
});