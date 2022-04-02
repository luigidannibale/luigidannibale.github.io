document.getElementById ("translate").addEventListener ("click", translate);    

function translate(){                      
    if(window.location.pathname.startsWith("pages/english")){
        //to ita 
        window.location.href = "luigidannibale.github.io/" + window.location.hash
    }
    else{
        //to eng
        window.location.href = "luigidannibale.github.io/pages/english/" + window.location.hash
    }    
  }