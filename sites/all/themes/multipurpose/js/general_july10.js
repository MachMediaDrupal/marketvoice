$(document).ready(function(){

$('#statusModal').modal('show'); 
setTimeout(function(){
    $('#statusModal').modal('hide')
}, 3000);

	 /* Check width on page load*/
                    if ( $(window).width() < 768) {
                     $('html').addClass('mobile');
                    }
                    else {}

                 $(window).resize(function() {
                    /*If browser resized, check width again */
                    if ($(window).width() < 768) {
                     $('html').addClass('mobile');
                    }
                    else {$('html').removeClass('mobile');}
                 });
               //BreadCrump:Active class:Animation
            $('#nav-icon').click(function(){
                $(this).toggleClass('open');
            });
			if ( $(window).width() < 1024) {
				//alert($("#msr").outerHeight());
           		var tabHeight=$("#msr").outerHeight()+75;
           		$(".widget-area-tab nav.tabination li:last-child").css( "top", tabHeight );
            }
			if ( $(window).width() == 1024) {
				$(".widget-area-tab nav.tabination li:last-child").css( "top", "541px" )
			}
			$(window).resize(function() {
                    /*If browser resized, check width again */
                    if ($(window).width() < 1024) {
						var tabHeight=$("#msr").outerHeight()+75;
						$(".widget-area-tab nav.tabination li:last-child").css( "top", tabHeight );
                    }
					});
});

$(document).ready(function(){
    
    $("#tabs li").click(function() { //  When user clicks on tab, this code will be executed
        $("#tabs li").removeClass('active'); //  First remove class "active" from currently active tab
        $(this).addClass("active"); //  Now add class "active" to the selected/clicked tab
        $(".tab_content").hide();  //  Hide all tab content
        var selected_tab = $(this).find("a").attr("href");//  Here we get the href value of the selected tab
        $(selected_tab).fadeIn(); //  Show the selected tab content

        return false;//  At the end, we add return false so that the click on the link is not executed
    }); 
    
    $('#attachmentDownload').click(function(){
        $.ajax({
	    url: $('#attachment1').val(), 
            success: download.bind(true, "text/html", $('#file1').val())
	});
    });
 
    //Customizing the seach block in header
    $('#clickSearch').click(function() {
        $('#clickSearch').hide();
        $('#searchClicked').show();
$('#edit-search-block-form--2').focus();

    });

    //Checking to see if user have read 3 articles and show login popup 
   /* if($.cookie("logincookie") == 4) { 

       $("#myModalLabel").html("Login/Register"); 
       $(".modal-body").html($("#MessagePopup").html());
       $('#myModal').modal('toggle');*/
        /*$("#myModalLabel").html("Register to marketvoice.org");
        $(".modal-body").html($("#registerPopup").html());*/
      /*  $('#registerdialog').click(function() { // 'this' is not a jQuery object, so it will use
         						// the default click() function
            this.click();
        }).click();*/
    //}

  /*if($.cookie("logincookie") >= 6  && $.cookie("subscribed")!= 1) { 
        $("#myModalLabel").html("Subscribe to marketvoice.org"); 
        $(".modattachmentDownloadal-body").html($("#subscribePopup").html());
        $(".close").hide();
        $('#subscribeBtn').click(function() { // 'this' is not a jQuery object, so it will use
         						// the default click() function
            this.click();
        }).click();
    }  */
 var url = $('#get-base-url').val();

 if($.cookie("logincookie") == 4  && !(document.getElementById('messages')))
    { 
     $('#register_first').click(function() { // 'this' is not a jQuery object, so it will use

    // the default click() function
 $('.modal-body').html('<div class="popup-logo"><img src="'+ url + '/sites/all/themes/multipurpose/images/popuphead.png"/></div><p>We are happy you are enjoying MarketVoice content.</p><p>You have read three of the five articles allowed without being registered.</p><p>Be sure to <a href="?q=user/register">Register</a> now to gain unlimited free access to content on this site.</p><p class="aln-right"><a href="?q=user">Already Registered?</a>  </p>');
        this.click();
        
    }).click(); 
  }
  if($.cookie("logincookie") > 5 && $.cookie("subscribed")!= 1 && !(document.getElementById('messages'))) {  
        /* $("#myModalLabel").html('<div class="popup-logo"><img src="'+ url + '/sites/all/themes/multipurpose/images/popuphead.png"/></div>'); */
 
$(".modal-header").addClass("modal-header");;
       $(".modal-body").html(
'<div class="popup-logo"><img src="'+ url + '/sites/all/themes/multipurpose/images/popuphead.png"/></div> <p>We are happy you are enjoying MarketVoice content.</p><p>You have reached your maximum five articles allowed without being registered.</p><p>For unlimited free access to content on this site, please register here.</p> '+ $("#subscribePopup").html());
        $(".close").hide();
        $('#subscribeBtn').click(function() { // 'this' is not a jQuery object, so it will use
         						// the default click() function
            this.click();
        
        }).click();
    }  
if($.cookie("logincookie") >= 5 && $.cookie("subscribed")== 1) { 
 $.cookie("logincookie", $.cookie("logincookie"), { expires : 30});
}
 
 $('#myModalFirstPage').on('hidden.bs.modal', function () {
    setCookieRegisterPopup();
});

});

$(document).on("click", "#registerdial", function(event){
    $('#registerdialog').click(function() { // 'this' is not a jQuery object, so it will use
    // the default click() function
        this.click();
    }).click();
    $('#myModal').modal('hide');
    callLoginRegisterDialog();
    
});

$(document).on("click", "#logindial", function(event){
    $('#logindialog').click(function() { // 'this' is not a jQuery object, so it will use
    // the default click() function
        this.click();
    }).click();
    $('#myModal').modal('hide');
    callLoginRegisterDialog();
    
});

function callLoginRegisterDialog(){
    $('.popups-close').click(function (){ 
        $("#myModalLabel").html("Login/Register"); 
        $(".modal-body").html($("#MessagePopup").html());
        $('#myModal').modal('show')
    });
}
function jsfunction()
{
   $('#register_first').click(function() { // 'this' is not a jQuery object, so it will use
    // the default click() function
        this.click();
        setCookieRegisterPopup();
    }).click();
  
}

function setCookieRegisterPopup()
{ 
    var date = new Date();
    var minutes = 30;
    date.setTime(date.getTime() + (minutes * 60 * 1000));
    $.cookie("firstcookie", 1, { expires: date });
}


$(document).ready(function() {

 if($('#follow_twitter')){
$.ajax({
	url: "https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=FIAAmericas",
	dataType : 'jsonp',
	crossDomain : true
}).done(function(data) {
	$('#follow_twitter').html(data[0]['followers_count']);
});
}

$(".field-items img").each(function() {
     var str = this.alt;
  $('span.caption').css('height','auto !important');
    $('<style> span.caption:after{content:"'+str+'"}</style>').appendTo('head');
});

});

$(document).ready(function() {
		$('#mySlideToggler').click(function(){
			$('#mySlideContent').slideDown();
			$(this).toggleClass('slideSign');
			return false;
		});
        $('#ClickTOggle').click(function(){
            $('#mySlideContent').slideUp('fast');
            $('#mySlideToggler').toggleClass('slideSign');
        })
	});
   $(document).ready(function() {
$('#user-profile-form #edit-mail').attr('disabled','disabled');
             
                 var owl = $("#owl-demo"),
                    status = $("#owlStatus");
 
              $("#owl-demo").owlCarousel({
                items : 4,
                lazyLoad : true,
                navigation : true,
                afterAction : afterAction
              });
             
                   function updateResult(pos,value){
                    status.find(pos).find(".result").text(value);
                  }
                function afterAction(){
                    updateResult(".owlItems", this.owl.owlItems.length);
                    updateResult(".currentItem", this.owl.currentItem +1);
                    updateResult(".prevItem", this.prevItem);
                    updateResult(".visibleItems", this.owl.visibleItems);
                    updateResult(".dragDirection", this.owl.dragDirection);
                  }
                    
             

                     $(document).ready(function() {

$('.image-popup-no-margins').magnificPopup({
              type: 'image',
              closeOnContentClick: true,
              closeBtnInside: false,
              fixedContentPos: true,
              mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
              image: {
                verticalFit: true
              },
              zoom: {
                enabled: true,
                duration: 300 // don't foget to change the duration also in CSS
              }
        });
                             $('.owl-item').click(function(){

                            //Get the ID of the Article that is currently set to .selected-article
                            var previousarticle = "#article-";
                            previousarticle += $('article.selected-article').index();

                            //Get the ID of the Article that is needs to be displayed
                            var newarticle = "#article-";
                            newarticle += $(this).index();

                            //Toggle the classes of the articles
                            $(previousarticle).removeClass('selected-article')
                            $(newarticle).addClass('selected-article');

                             });


                     });

             
             
             
           
            });
