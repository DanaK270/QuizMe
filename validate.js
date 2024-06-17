const form = document.getElementById('form');
const nname = document.getElementById('name');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');

// Show input error message
function showError(input, message) {
  const formControl = input.parentElement;
  formControl.className = 'inputwrapper error';
  const small = formControl.querySelector('small');
  small.innerText = message;
}

// Show success outline
function showSuccess(input) {
  const formControl = input.parentElement;
  formControl.className = 'inputwrapper success';
}

// Check name is valid
function checkName(input) {
  let error = 0;
  const re = /^[a-zA-Z\s]{3,50}$/;
  if (re.test(input.value)) {
    showSuccess(input);
  } else {
    showError(input, 'Name is not valid');
    ++error;
  }
  return error;
}

// Check email is valid
function checkEmail(input) {
  let error = 0;
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (re.test(input.value.trim())) {
    showSuccess(input);
  } else {
    showError(input, 'Email is not valid');
    ++error;
  }
  return error;
}

// Check username is valid

function checkUN(input) {
  let error = 0;
  const re = /^[a-zA-Z0-9_]{3,20}$/;
  if (re.test(input.value.trim())) {
    showSuccess(input);
  } 
  else {
    showError(input, 'Username is not valid');
    ++error;
  }
  return error;
}

// Check password is valid
function checkPassword(input) {
    let error = 0;
    const re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#@%*-])[A-Za-z0-9_#@%*-]{8,20}$/;
    if (re.test(input.value.trim())) {
      showSuccess(input);
    } else {
      showError(input, 'Password is not valid');
      ++error;
    }
    return error;
  }

// Check required fields
function checkRequired(inputArr) {
  let error=0;
  inputArr.forEach(function(input) {
    if (input.value.trim() === '') {
      showError(input, `*Required`);
      ++error;
    } else {
      showSuccess(input);
    }
  });
  return error;
}

// Check input length
function checkLength(input, min, max) {
  let error=0;
  if (input.value.length < min) {
    showError(
      input,
      `${getFieldName(input)} must be at least ${min} characters`
    );
    ++error;
  } else if (input.value.length > max) {
    showError(
      input,
      `${getFieldName(input)} must be less than ${max} characters`
    );
    ++error;
  } else {
    showSuccess(input);
  }
  return error;
}

// Check passwords match
function checkPasswordsMatch(input1, input2) {
  let error = 0;
  if (input1.value !== input2.value) {
    showError(input2, 'Passwords do not match');
    ++error;
  }
  return error;
}

// Get fieldname
function getFieldName(input) {
  return input.id.charAt(0).toUpperCase() + input.id.slice(1);
}

// Event listeners
form.addEventListener('submit', function(e){
  e.preventDefault(); //prevents auto submit
  let allErrors = 0;
  allErrors+=checkRequired([nname, username, email, password, password2]);
  allErrors+=checkPasswordsMatch(password, password2);
  allErrors+=checkLength(nname, 3, 50);
  allErrors+=checkLength(username, 3, 20);
  allErrors+=checkLength(password, 8, 25);
  allErrors+=checkName(nname);
  allErrors+=checkEmail(email);
  allErrors+=checkUN(username);
  allErrors+=checkPassword(password);
  
  //If all requirements are successful, submit the form
  if (allErrors===0)
     form.submit();
});
