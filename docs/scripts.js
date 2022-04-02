document.getElementById ("translate").addEventListener ("click", translate);    

function translate(){         
    alert(window.location.pathname)             
    if(window.location.pathname.startsWith("pages/english")){
        alert("ciao")
        //to ita 
        window.location.href = "luigidannibale.github.io/" + window.location.hash
    }
    else{
        alert("hello")
        //to eng
        window.location.href = "luigidannibale.github.io/pages/english/" + window.location.hash
    }    
  }