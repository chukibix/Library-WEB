function copyTextAndSubmit(){
  document.getElementById('message').value = document.getElementById('text-message').value;
  document.getElementById('form').action = "https://formsubmit.co/teddy.khoury73@gmail.com";
  document.getElementById('submitEmail').style.visibility = "visible";
}
