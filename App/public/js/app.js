function confirmDesactiv()
{
   if(confirm("Êtes vous sur de vouloir supprimer ces lignes ?"))
     return true;
  
  return false;
}

function hidingform(){
  var x = $('.invisible1');
  var y = $('.invisible2');
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    y.style.display = "block";
    x.style.display = "none";
  }
}