/*
<!--
  Website on Luigi D'annibale, developed by Luigi D'annibale, to advertise Luigi D'annibale.
  Version 1.0, first developed in March/2021
--> 
*/
document.getElementById ("translate").addEventListener ("click", translate);    
window.addEventListener("resize",onResize);

function translate(){             
    window.location.href = "https://luigidannibale.github.io/pages/english/" + window.location.hash;      
}
function onResize(){
    window.location.href = "https://luigidannibale.github.io/" + window.location.hash;  
}

