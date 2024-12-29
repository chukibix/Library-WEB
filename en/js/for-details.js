const addFavorite = () =>{
  let svgg = document.querySelector('#form-fav svg path');

  if(svgg.getAttribute('stroke') == '#005257' && svgg.getAttribute('fill') == 'none'){
    svgg.setAttribute('stroke', 'black');
    svgg.setAttribute('fill', 'crimson');
    svgg.setAttribute('stroke-width', '1');
    document.querySelector("#form-fav label").innerHTML = "Remove from favorites ";
  }else{
    svgg.setAttribute('stroke', '#005257');
    svgg.setAttribute('fill', 'none');
    svgg.setAttribute('stroke-width', '1.5');
    document.querySelector("#form-fav label").innerHTML = "Add to favorites ";
  }
}


const giveLike = (th) => {
  // .like -> svg -> path
  let icon = th.querySelector("svg path"); 

  // parent of .like -> .dislike -> svg -> path
  let icon2 = th.parentElement.querySelector(".dislike svg path");

  // add the green effect or remove it
  if(icon.getAttribute('fill') == 'none' && icon.getAttribute('stroke-width') == 1.5){
    icon.setAttribute('fill', 'rgb(19, 204, 19)');
    icon.setAttribute('stroke-width', '1');  
    icon.setAttribute('stroke', 'black');  
  }else{
    icon.setAttribute('fill', 'none');
    icon.setAttribute('stroke-width', '1.5');
    icon.setAttribute('stroke', '#005257');  
  }

  // this removes the effect from dislike button when you click like
  icon2.setAttribute('fill', 'none');
  icon2.setAttribute('stroke-width', 1.5);
  icon2.setAttribute('stroke', '#005257');  
}

const giveDislike = (th) => {
  // .dislike -> svg -> path
  let icon = th.querySelector("svg path");

  // parent of .dislike -> .like -> svg -> path
  let icon2 = th.parentElement.querySelector(".like svg path"); 
  
  // add the green effect or remove it
  if(icon.getAttribute('fill') == 'none' && icon.getAttribute('stroke-width') == '1.5'){
    icon.setAttribute('fill', 'crimson');
    icon.setAttribute('stroke-width', '1');  
    icon.setAttribute('stroke', 'black');  
  }else{
    icon.setAttribute('fill', 'none');
    icon.setAttribute('stroke-width', '1.5');
    icon.setAttribute('stroke', '#005257');  
  }

  // this removes the effect from dislike button when you click like
  icon2.setAttribute('fill', 'none');
  icon2.setAttribute('stroke-width', '1.5');
  icon2.setAttribute('stroke', '#005257');  
}

