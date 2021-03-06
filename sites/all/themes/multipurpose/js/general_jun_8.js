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
    }).click();
  
}

