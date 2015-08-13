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
 

if($.cookie("logincookie") == 4)
    { 
     $('#register_first').click(function() { // 'this' is not a jQuery object, so it will use
    // the default click() function
        this.click();
        
    }).click(); 
  }
  if($.cookie("logincookie") >= 5 && $.cookie("subscribed")!= 1) { 
        $("#myModalLabel").html("Subscribe to marketvoice.org"); 
        $(".modal-body").html($("#subscribePopup").html());
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
                    updateResult(".currentItem", this.owl.currentItem);
                    updateResult(".prevItem", this.prevItem);
                    updateResult(".visibleItems", this.owl.visibleItems);
                    updateResult(".dragDirection", this.owl.dragDirection);
                  }
                    
             

                     $(document).ready(function() {
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
