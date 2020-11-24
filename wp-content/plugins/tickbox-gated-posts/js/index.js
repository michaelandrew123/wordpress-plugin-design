jQuery(document).ready( function($){ 

    var ajaxUrl = $('#ajax-url').val();
    $('#unlock-btn').click(function(e){
        e.preventDefault();
        var unlockEmail = $("#myInput").val();
        var unlockBtn = $("#unlock-btn").val();
        var unlockPostsId = $("#unlock-posts-id").val();   
        $.ajax({
            url:  ajaxUrl,  
            type: 'POST',
            data:{ 
              id: unlockPostsId, 
              email: unlockEmail,
              unlockBtn: unlockBtn
            },
            success: function( data ){  
              console.log(data);
              var jsonParse = $.parseJSON(data);
              console.log(jsonParse[0].post_type);
            }
          }); 
    });   
  });