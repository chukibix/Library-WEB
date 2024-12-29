// for submitting in reset password
function validateNewPassword() {
  return PasswordSecurity() && checkpass();
}

// phone number check
function changepattern() {
  var select = document.getElementById("country");
  var pattern = "";
  //swith depend on counry
  switch (select.value) {
    case "France":
      pattern = "^0[1-9](\\d{2}){4}$";
      break;
    case "USA":
      pattern =
        "^\\(?([2-9][0-8][0-9])\\)?[-.\\s]?([2-9][0-9]{2})[-.\\s]?([0-9]{4})$";
      break;
    case "Lebanon":
      pattern = "^((03)|(81)|(70)|(71)|(76)|(78)|(79))\\d{6}$";
      break;
    default:
      pattern = "";
  }
  document.getElementById("phone").setAttribute("pattern", pattern);
}

//pass security
function PasswordSecurity() {
  var password = document.getElementById("pass").value;
  var hasUppercase = /[A-Z]/.test(password);
  var hasLowercase = /[a-z]/.test(password);
  var hasDigit = /[0-9]/.test(password);
  var isLengthValid = password.length >= 6;
  //return if true or fase
  if (hasUppercase && hasLowercase && hasDigit && isLengthValid) {
    return true;
  } else {
    alert(
      "Your password do not meet our requirement, you should have at least: 1 digit, 1 Uppercase and 1 lowercase letter and longer than 8 characters"
    );
    return false;
  }
}

//check pass confirmation
function checkpass() {
  var x = document.getElementById("pass").value;
  var z = document.getElementById("cpass").value;
  if (z === x) {
    return true;
  } else {
    alert(
      "Your password confirmation is false, they do not match!Check again."
    );
    return false;
  }
}