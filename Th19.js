function search(){
    let query=document.getElementById("search").value;
    hideAllLi();
    query=query.toLowerCase();
    query=query.replace(/ /g, "-");
    if(query.substr(0,3)==="the" && query!="the"){
      query=query.substr(4,query.length);
    }
    var matches=[];
    if(query===""){
      searchResults(matches);
      hideSearchDiv();
    }
    else{
      displaySearchDiv();
      
      for(i=0; i<titleArray.length; i++){
        if(titleArray[i].toLowerCase().includes(query)){
          matches.push(titleArray[i]);
        }
      }
      searchResults(matches);
    }
}

function searchResults(matches){
  let query=document.getElementById("search").value;
  if(matches===undefined || matches.length==0 && query!=""){
      document.getElementById("noResult").style.display = "list-item";
      document.getElementById("noResult2").innerHTML = "<img src=\"vibe_icon.png\" alt=\"Vibe\" width=\"40\" height=\"40\">No Results for " + query;

  }
  let display=[];
    console.log(matches);
  //document.getElementById("resultslist").innerHTML=" ";
  for(i=0; i<matches.length; i++){
    display[i]=matches[i].replace(/-/g, " ");
    document.getElementById(matches[i].replace(/-/g, "")).style.display = "list-item";
  }
}

function call(e) {
    if (document.getElementById("search").value.length == 0) {
        if (e.keyCode == 32) {
            e.preventDefault();
        }
    }
}

function hideAllLi(){
  let li = document.querySelectorAll("li");

  for(let x =0; x<li.length; x++){
    li[x].style.display = "none";
  }
}


function displaySearchDiv(){
  document.querySelector("#searchResults").style.visibility = "visible"; 
  let search = document.querySelector(".divsearch");
  search.style.borderBottomRightRadius = "0px";
  search.style.borderBottomLeftRadius = "0px";
}

function hideSearchDiv(){
  document.querySelector("#searchResults").style.visibility = "hidden"; 
  let search = document.querySelector(".divsearch");
  search.style.borderBottomRightRadius = "10px";
  search.style.borderBottomLeftRadius = "10px";
}
