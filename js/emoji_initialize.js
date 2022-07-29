$(document).ready(function() {

   call_emojionearea('.client_chat');
//   $('textarea.broadcast_client_chat').siblings('div.broadcast_client_chat').hide();
});


function call_emojionearea(current_position)
{  
	/*console.log(localStorage.getItem('streamData'));
	if(localStorage.getItem('streamData') !=200)
	{
		$('.client_chat').prop('disabled', true);		
	}
	else
	{
		

	}*/


/*	$(current_position).emojioneArea({
		    saveEmojisAs:"shortname",
		    pickerPosition: "bottom",
		    tonesStyle: "bullet",
		    useInternalCDN: true,
		    events : {
		      keypress: function (editor, event1) 
		      {

		      	console.log(event1);
	    	  	current_type_area=editor ;      
	        	if (event1.keyCode == 13) 
	        	{  
	        		
	        		console.log('testt');
	        		if(editor.html() !=""){ 
	        			console.log("Reaching Emojoi Here");
	        			chat_user['type']='';	
	        			send_message(); 
	        		}        		
	        		event1.preventDefault();
	            }
		     
		      },
		    }
		  });
    */
  
  	
  
//  var parsedJson = JSON.parse(localStorage.getItem('eventData'));
//  if(parsedJson.streamInfo.sessionId == '[empty]')
//  {
////	  console.log(current_position);
//	  $('.emojionearea-editor').attr('contenteditable', "false");
//	  $('.emojionearea-button').hide();
//	  $('.chat_btn').prop('disabled', true);
//  }
//  else{
//	  $('.emojionearea-editor').attr('contenteditable', "true");
//	  $('.emojionearea-button').show();
//	  $('.chat_btn').prop('disabled', false);
//  }
}