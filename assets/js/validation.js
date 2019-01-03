
		
 function regular_validation(){
	
	var name=document.getElementById('username').value;
    var email=document.getElementById('email').value;
	var telephone=document.getElementById('telephone').value;
	var subject=document.getElementById('subject').value;
	

	// checkin using regular expression 
	
	  
  var usercheck= /^[A-Za-z. ]{3,30}$/;
  var emailcheck= /^[A-Za-z_0-9]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/; 
  var phonecheck= /^[789][0-9]{9}$/;  
  var subjectcheck= /^[A-Za-z. ]{3,100}$/;


 // username section 	
	
   if(usercheck.test(name)){
		
	document.getElementById('nameerror').innerHTML="";
	}else{
        document.getElementById('nameerror').innerHTML="** username is invalid";
		
		return false;
	}
	

  //email section
	
  if(emailcheck.test(email)){
	    
	document.getElementById('emailerror').innerHTML="";
}else{
	document.getElementById('emailerror').innerHTML=" ** Email is invalid";
	return false;
}

  //password section 
	
	if(phonecheck.test(telephone)){
	    
	    document.getElementById('telephonerror').innerHTML="";
	}else{
        document.getElementById('telephonerror').innerHTML=" ** telephone number   is invalid";
		return false;
	}
	
   //conform password section
	
	
	// if(conpass.match(pass)){
	    
	//     document.getElementById('conpasserror').innerHTML="";
	// }else{
    //     document.getElementById('conpasserror').innerHTML=" ** password is doesn't match ";
		
    //     return false;
	// }

 //mobile section 
	
	if(subjectcheck.test(subject)){
	    
	    document.getElementById('subjecterror').innerHTML="";
	}else{
        document.getElementById('subjecterror').innerHTML=" ** mobile number  invalid";
		return false;
	}
	
 }
	
	
	
	