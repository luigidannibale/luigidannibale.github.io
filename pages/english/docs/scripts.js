document.getElementById ("translate").addEventListener ("click", translate);    
window.addEventListener("resize",onResize);

function translate(){         
    window.location.href = "https://luigidannibale.github.io/" + window.location.hash;    
}
function onResize(){
    window.location.href = "https://luigidannibale.github.io/" + window.location.hash;  
}