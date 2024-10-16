// Data di nascita
const birthDate = new Date("2002-12-16");
const today = new Date();

// Calcolo dell'età
let age = today.getFullYear() - birthDate.getFullYear();
const monthDifference = today.getMonth() - birthDate.getMonth();

// Se non è ancora il compleanno quest'anno, sottrai 1
if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
    age--;
}

// Mostra l'età nel <li> con id="age"
document.getElementById("age").textContent = age;
document.getElementById ("translate").addEventListener ("click", translate);    
sectionName = sessionStorage.getItem("currentSection");
if (sectionName != null) 
  showSection(sectionName);


function translate(){
  actual = window.location.pathname;
  sectionName = sessionStorage.getItem("currentSection");
  if (sectionName == null) 
    sectionName = "";

  if (actual.includes("eng-")){
    window.location.href = actual.replace("eng-","")+ "#" + sectionName;
  }
  else{
    window.location.href = actual.replace("index","eng-index") + "#" + sectionName;
  } 
}
function onResize(){
    window.location.href = "https://luigidannibale.github.io/" + window.location.pathname;  
}

function showSection(sectionId) {
  // Array of section IDs
  const sections =  ["welcome", "education", "contacts", "skills","projects"]
  
  // Hide all sections
  sections.forEach(el => {
      document.getElementById(el).classList.add('hidden');
  });
  
  // Show the selected section
  document.getElementById(sectionId).classList.remove('hidden');
  sessionStorage.setItem("currentSection",sectionId);
}

var metas = document.getElementsByTagName('meta'),
changeViewportContent = function(content) {
    for (var i = 0; i < metas.length; i++) {
        if (metas[i].name == "viewport") {
            metas[i].content = content;
        }
    }
},
initialize = function() {
    changeViewportContent("width=device-width, minimum-scale=1.0, maximum-scale=1.0");
},
gestureStart = function() {
    changeViewportContent("width=device-width, minimum-scale=0.25, maximum-scale=1.6");
},
gestureEnd = function() {
    initialize();
};


if (navigator.userAgent.match(/iPhone/i)) {
initialize();

document.addEventListener("touchstart", gestureStart, false);
document.addEventListener("touchend", gestureEnd, false);
}