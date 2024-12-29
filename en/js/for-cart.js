// this async function adds a default value for subTotal (little complex to read)
setTimeout(() => {
  // take the array of all items in cart
  let quantities = document.querySelectorAll('.item');
  
  // iterate them and navigate inside the input field of each one
  for(let i = 0; i < quantities.length; i++){
    let quantity = quantities[i].querySelector('.quantity .currentQuantity');

    // then use each one to update their respective subtotal
    updateSubTotal(
      quantity.value, 
      getPrice(quantity), 
      quantity);
  }
}, 100);

function updateQuantity(th) {
  let quantity = th.parentElement.querySelector(".currentQuantity");
  let value = quantity.value;

  // replaces all non-digits with empty string
  let digitsOnly = value.replace(/\D/g, "");

  // then checks if value of input has any
  digitsOnly === value && value !== ''
    ? null
    : quantity.value = 1;

  updateSubTotal(
    quantity.value, 
    getPrice(quantity),
    quantity
  )
}

function updateSubTotal(quantity, price, caller){
  let subTotal = (quantity * price).toFixed(2);

  caller
  .parentElement.parentElement.parentElement
  .querySelector('.total-price .price span')
  .innerHTML = subTotal;
}


function getPrice(caller){
  return (
    caller
    .parentElement.parentElement.parentElement
    .querySelector('.one-price .price span').innerHTML
  );
}