
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
form.addEventListener('submit', function(e) {
  e.preventDefault(); //prevents auto submit
  let allErrors = 0;
  allErrors+=checkPasswordsMatch(password, password2);
  allErrors+=checkRequired([password, password2]);
 
  allErrors+=checkLength(password, 8, 25);
 
  allErrors+=checkPassword(password);
  
  //If all requirements are successful, submit the form
  if (allErrors===0)
      form.submit();
});
