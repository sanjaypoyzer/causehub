function updateActionForm(){var e=document.getElementById("actiontype").value;e!="lobbyLord"?document.getElementById("lobbyLord").style.display="none":document.getElementById("lobbyLord").style.display="block";e!="lobbyMP"?document.getElementById("lobbyMP").style.display="none":document.getElementById("lobbyMP").style.display="block";e!="lobbyMedia"?document.getElementById("lobbyMedia").style.display="none":document.getElementById("lobbyMedia").style.display="block";e!="createPetition"?document.getElementById("createPetition").style.display="none":document.getElementById("createPetition").style.display="block";e!="hostEvent"?document.getElementById("hostEvent").style.display="none":document.getElementById("hostEvent").style.display="block"}function addKnowledge(){var e=!1;document.getElementById("fact").style.borderColor="#999";document.getElementById("sourceurl").style.borderColor="#999";document.getElementById("lobbylord_name").style.borderColor="#999";document.getElementById("lobbylord_address").style.borderColor="#999";document.getElementById("lobbylord_message").style.borderColor="#999";document.getElementById("lobbymp_name").style.borderColor="#999";document.getElementById("lobbymp_address").style.borderColor="#999";document.getElementById("lobbymp_message").style.borderColor="#999";document.getElementById("lobbymedia_name").style.borderColor="#999";document.getElementById("lobbymedia_address").style.borderColor="#999";document.getElementById("lobbymedia_message").style.borderColor="#999";document.getElementById("createpetition_name").style.borderColor="#999";document.getElementById("createpetition_description").style.borderColor="#999";document.getElementById("hostevent_name").style.borderColor="#999";document.getElementById("hostevent_url").style.borderColor="#999";if(document.getElementById("fact").value==""){alertify.log("No fact entered","error");document.getElementById("fact").style.borderColor="red";e=!0;return!1}if(document.getElementById("sourceurl").value==""){alertify.log("No source url entered","error");document.getElementById("sourceurl").style.borderColor="red";e=!0;return!1}if(document.getElementById("actiontype").value=="lobbyLord"){if(document.getElementById("lobbylord_name").value==""){alertify.log("No lord name entered","error");document.getElementById("lobbylord_name").style.borderColor="red";e=!0;return!1}if(document.getElementById("lobbylord_address").value==""){alertify.log("No lord email address entered","error");document.getElementById("lobbylord_address").style.borderColor="red";e=!0;return!1}if(document.getElementById("lobbylord_message").value==""){alertify.log("No message to the lord entered","error");document.getElementById("lobbylord_message").style.borderColor="red";e=!0;return!1}var t="lord",n="cid="+document.getElementById("causeid").value+"&fact="+document.getElementById("fact").value+"&sourceurl="+document.getElementById("sourceurl").value+"&actiontype="+document.getElementById("actiontype").value+"&lobbylordname="+document.getElementById("lobbylord_name").value+"&lobbylordaddress="+document.getElementById("lobbylord_address").value+"&lobbylordmessage="+document.getElementById("lobbylord_message").value}else if(document.getElementById("actiontype").value=="lobbyMP"){if(document.getElementById("lobbymp_name").value==""){alertify.log("No MP name entered","error");document.getElementById("lobbymp_name").style.borderColor="red";e=!0;return!1}if(document.getElementById("lobbymp_address").value==""){alertify.log("No MP email address entered","error");document.getElementById("lobbymp_address").style.borderColor="red";e=!0;return!1}if(document.getElementById("lobbymp_message").value==""){alertify.log("No message to the MP entered","error");document.getElementById("lobbymp_message").style.borderColor="red";e=!0;return!1}var t="mp",n="cid="+document.getElementById("causeid").value+"&fact="+document.getElementById("fact").value+"&sourceurl="+document.getElementById("sourceurl").value+"&actiontype="+document.getElementById("actiontype").value+"&lobbympname="+document.getElementById("lobbymp_name").value+"&lobbympaddress="+document.getElementById("lobbymp_address").value+"&lobbympmessage="+document.getElementById("lobbymp_message").value}else if(document.getElementById("actiontype").value=="lobbyMedia"){if(document.getElementById("lobbymedia_name").value==""){alertify.log("No Media outlet entered","error");document.getElementById("lobbymedia_name").style.borderColor="red";e=!0;return!1}if(document.getElementById("lobbymedia_address").value==""){alertify.log("No Media email address entered","error");document.getElementById("lobbymedia_address").style.borderColor="red";e=!0;return!1}if(document.getElementById("lobbymedia_message").value==""){alertify.log("No message to the Media entered","error");document.getElementById("lobbymedia_message").style.borderColor="red";e=!0;return!1}var t="media",n="cid="+document.getElementById("causeid").value+"&fact="+document.getElementById("fact").value+"&sourceurl="+document.getElementById("sourceurl").value+"&actiontype="+document.getElementById("actiontype").value+"&lobbymedianame="+document.getElementById("lobbymedia_name").value+"&lobbymediaaddress="+document.getElementById("lobbymedia_address").value+"&lobbymediamessage="+document.getElementById("lobbymedia_message").value}else if(document.getElementById("actiontype").value=="createPetition"){if(document.getElementById("createpetition_name").value==""){alertify.log("No petition name entered","error");document.getElementById("createpetition_name").style.borderColor="red";e=!0;return!1}if(document.getElementById("createpetition_description").value==""){alertify.log("No petition description entered","error");document.getElementById("createpetition_description").style.borderColor="red";e=!0;return!1}var n="cid="+document.getElementById("causeid").value+"&fact="+document.getElementById("fact").value+"&sourceurl="+document.getElementById("sourceurl").value+"&actiontype="+document.getElementById("actiontype").value+"&petitionname="+document.getElementById("createpetition_name").value+"&petitiondescription="+document.getElementById("createpetition_description").value}else if(document.getElementById("actiontype").value=="hostEvent"){if(document.getElementById("hostevent_name").value==""){alertify.log("No event name entered","error");document.getElementById("hostevent_name").style.borderColor="red";e=!0;return!1}if(document.getElementById("hostevent_url").value==""){alertify.log("No event url entered","error");document.getElementById("hostevent_url").style.borderColor="red";e=!0;return!1}var n="cid="+document.getElementById("causeid").value+"&fact="+document.getElementById("fact").value+"&sourceurl="+document.getElementById("sourceurl").value+"&actiontype="+document.getElementById("actiontype").value+"&eventname="+document.getElementById("hostevent_name").value+"&eventurl="+document.getElementById("hostevent_url").value}var r=document.getElementById("actiontype").value;$.ajax({type:"POST",url:"/scripts/processing/addknowledge.php",data:n,beforeSend:function(){if(r=="lobbyLord"||r=="lobbyMP"||r=="lobbyMedia"){document.getElementById("addknowledgebtn").disabled=!0;document.getElementById("fact").disabled=!0;document.getElementById("sourceurl").disabled=!0;document.getElementById("lobby"+t+"_name").disabled=!0;document.getElementById("lobby"+t+"_address").disabled=!0;document.getElementById("lobby"+t+"_message").disabled=!0;document.getElementById("addknowledgebtn").value="Processing"}else if(r=="createPetition"){document.getElementById("addknowledgebtn").disabled=!0;document.getElementById("fact").disabled=!0;document.getElementById("sourceurl").disabled=!0;document.getElementById("createpetition_name").disabled=!0;document.getElementById("createpetition_description").disabled=!0;document.getElementById("addknowledgebtn").value="Processing"}else if(r=="hostEvent"){document.getElementById("addknowledgebtn").disabled=!0;document.getElementById("fact").disabled=!0;document.getElementById("sourceurl").disabled=!0;document.getElementById("hostevent_name").disabled=!0;document.getElementById("hostevent_url").disabled=!0;document.getElementById("addknowledgebtn").value="Processing"}},error:function(){if(r=="lobbyLord"||r=="lobbyMP"||r=="lobbyMedia"){document.getElementById("addknowledgebtn").disabled=!1;document.getElementById("fact").disabled=!1;document.getElementById("sourceurl").disabled=!1;document.getElementById("lobby"+t+"_name").disabled=!1;document.getElementById("lobby"+t+"_address").disabled=!1;document.getElementById("lobby"+t+"_message").disabled=!1;document.getElementById("addknowledgebtn").value="Add"}else if(r=="createPetition"){document.getElementById("addknowledgebtn").disabled=!1;document.getElementById("fact").disabled=!1;document.getElementById("sourceurl").disabled=!1;document.getElementById("createpetition_name").disabled=!1;document.getElementById("createpetition_description").disabled=!1;document.getElementById("addknowledgebtn").value="Add"}else if(r=="hostEvent"){document.getElementById("addknowledgebtn").disabled=!1;document.getElementById("fact").disabled=!1;document.getElementById("sourceurl").disabled=!1;document.getElementById("hostevent_name").disabled=!1;document.getElementById("hostevent_url").disabled=!1;document.getElementById("addknowledgebtn").value="Add"}alertify.log("An error occured when attempting to proccess your request","error");return!1},success:function(e){var n=e.split(":");if(n[0]=="1"){document.getElementById("addknowledgebtn").value=n[2];window.location.href="/editcause/"+n[1]+"/"}else{document.getElementById("fact").disabled=!1;document.getElementById("sourceurl").disabled=!1;document.getElementById("lobby"+t+"_name").disabled=!1;document.getElementById("lobby"+t+"_address").disabled=!1;document.getElementById("lobby"+t+"_message").disabled=!1;document.getElementById("createpetition_name").disabled=!1;document.getElementById("createpetition_description").disabled=!1;document.getElementById("hostevent_name").disabled=!1;document.getElementById("hostevent_url").disabled=!1;document.getElementById("addknowledgebtn").disabled=!1;document.getElementById("addknowledgebtn").value=n[2];alertify.log(n[1],"error")}return!1}})};