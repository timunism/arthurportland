// tw-elements chart initialization
import Swal from "sweetalert2";
import {
    Chart,
    initTE,
  } from "tw-elements";
  
initTE({ Chart });

// (Pass element id as argument)
function toggle(elementId) {
  const element = document.getElementById(elementId);
  element.classList.toggle('hidden');
}

// Global Click Event Listener
document.addEventListener('click', function(e) {
  // when user click(s) element of classlist x, toggle element of id y
  if (e.target && e.target.classList.contains('toggleSidebarHitBox')) {
      toggle('sidebar');
  }
});

try {
    // Completion Objserver
  const saveData = retrieveSave('chat-persist-v1');
  var completedApplication = 'false';
  var chat_engine_data_receiver = document.getElementById('chat-engine-data-receiver');

  // Application - Chatbot Completion Observer
  function isNotCompleted(){
    for (const key in saveData) {
        if (Object.hasOwnProperty.call(saveData, key)) {
            if (saveData[key] == null) {
                return true;
            }
        }
    }
  }

  if (isNotCompleted() == true) {
    console.log('incomplete conversation')
  }
  else if(saveData == null) {
    console.log('fresh conversation.')
  }
  else {
    console.log("completed conversation.")
    completedApplication = true;
  }

  if (completedApplication == true) {

    var chatbotInterface = document.getElementById('application-chatbot-interface');
    var applybot_progression = document.getElementById('applybot-progression');
    chatbotInterface.innerHTML = "";
    applybot_progression.classList.remove('hidden');

    importApplicantData();
  }

  function importApplicantData(){
    try{
      const gender = document.getElementById('gender');
      const phone = document.getElementById('phone');
      const postalAddress = document.getElementById('postal_address');
      const physicalAddress = document.getElementById('physical_address');
      const employer = document.getElementById('employer');
      const senior_school = document.getElementById('senior_school');
      const college = document.getElementById('school');
      const work = document.getElementById('work');
      const nok_phone = document.getElementById('nok_phone');
      const passport_number = document.getElementById('passport_number');
      const qualifications = document.getElementById('qualifications');

      gender.value = saveData['gender'];
      phone.value = saveData['phone'];
      postalAddress.value = saveData['postal_address'];
      physicalAddress.value = saveData['physical_address'];
      employer.value = saveData['employer'];
      senior_school.value = saveData['senior_school'];
      college.value = saveData['school'];
      work.value = saveData['work'];
      nok_phone.value = saveData['nok_phone'];
      passport_number.value = saveData['passport_number'];
      qualifications.value = saveData['passport_number'];
      console.log(employer.value);
    }
    catch(e) {
      console.log('chat-engine data-receiver not found')
    }
  }

  var deleteSaveButton = document.getElementById('deleteSaveButton');
  var deleteSaveModal = document.getElementById('deleteSaveModal');
  const deleteSaveYes= document.getElementById('deleteSaveModalYes');
  const deleteSaveCancel = document.getElementById('deleteSaveModalNo');

  deleteSaveButton.addEventListener('click', function(){
    deleteSaveModal.classList.toggle('hidden');
  })

  deleteSaveYes.addEventListener('click', deleteSave);
  deleteSaveCancel.addEventListener('click', function(){
    deleteSaveModal.classList.toggle('hidden');
  })

  function deleteSave(){
    localStorage.removeItem('chat-persist-v1');
    location.reload();
  }
} catch (error) {
  // do nothing
}

/* Alerts */

// Global JS alert function *uses sweetAlert2
// for fast notifications like when admitting or waitlisting applicants
async function triggerAlert(event) {
  let data = event.detail;
  Swal.fire({
    position: data.position,
    icon: data.type,
    title: data.title,
    footer: data.footer,
    showConfirmButton: false,
    timer: data.timer
  });
}

// For Application Alerts
// 1. A dispatch is sent by the server ('application_alert', via livewire)
// 2. JS intercepts it, triggers an alert, and refreshs the page after the animation has finished
// 3. Page refresh is necessary to sync the frontend with the backend changes
// 4. Refresh triggers after ~1000 milliseconds (~the time it takes to finish an alert animation);
// however, that time might be different in production so increase timeout if the animation is cut short
window.addEventListener('application_alert', async(event)=>{
  await triggerAlert(event);
  setTimeout(() => {
    location.reload();
  }, 1000);
});

window.addEventListener('faculty_application_alert', (event)=>{
  let data = event.detail;
  Swal.fire({
    position: data.position,
    icon: data.type,
    title: data.title,
    footer: data.footer,
    showConfirmButton: true,
    timer: data.timer
  });
  setTimeout(() => {
    location.reload()
  }, 8000);
});

// FORM VALIDATIONS
const omang = document.getElementById('omang');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const fullname = document.getElementById('fullname');
const surname = document.getElementById('surname');

// omang validation
omang.addEventListener('blur', ()=>{
  if (omang.value.length < 9 || omang.value.length > 9) {
    omang.value = '';
    errorAlert('omang should be exactly 9 numbers', 'Omang')
  }
});

// email validation
email.addEventListener('blur', ()=>{
  email.value = isEmail(email.value);
});

// phone number validation
phone.addEventListener('blur', ()=>{
  isPhoneNumber(phone.value);
});

// fullname validation
fullname.addEventListener('blur', ()=>{
  let verifyName = isName(fullname.value);
  if (verifyName == 'not_name') {
    fullname.value = '';
  }
});

function isName(text) {
  text = text.trim();
  if (text.length < 2) {
    errorAlert('invalid length', 'Name');
    return 'not_name';
  }
  for (let i = 0; i < text.length; i++) {
    const char = text[i];
    // char is a number
    if (!char.includes(' ') && String(Number(char)) != 'NaN') {
      console.log('Char >>',String(Number(char)));
      errorAlert('invalid name', 'Name');
      return 'not_name'
    }
  }
}

function isEmail(email) {
  email = email.toLowerCase();
  if (email.includes('@')) {
    let validateEmail = email.split('@');
    console.log(validateEmail);
    if (validateEmail.length == 2) {
      if (!validateEmail[1].includes('.')){
        errorAlert('invalid domain format', 'Email');
        return '';
      }
      else {
        return email;
      }
    }
    else {
      errorAlert('invalid email format', 'Email');
      return '';
    }
  }
  else {
    errorAlert('no email provided', 'Email');
    return '';
  }
}

function isPhoneNumber(cell) {
  const phoneRegex = /^\+?\d{1,3}-?\d{3}-?\d{3}-?\d{4}$/; // Matches phone numbers with optional "+" symbol and optional hyphens

  if (phoneRegex.test(cell)) {
    console.log('Real Phone Number')
  } else {
    errorAlert('invalid phone number', 'Phone Number');
  }
}
// Countr of Origin Logic
const country_of_origin = document.getElementById('country_of_origin');
const passport_number_div = document.getElementById('passport_number_div');
const omang_div = document.getElementById('omang_div');

country_of_origin.addEventListener('blur', ()=>{
  if (country_of_origin.value.toLowerCase() == 'botswana') {
    passport_number_div.textContent = '';
    passport_number_div.classList.add('hidden');
    omang_div.classList.remove('hidden');
  }
  else if (country_of_origin.value.length < 1) {
    errorAlert('Provide the name of the country where you were born and registered.', 'Country of Origin')
  }
  else {
    passport_number_div.classList.remove('hidden');
    omang_div.textContent = '';
    omang_div.classList.add('hidden');
  }
});

function errorAlert(message, title) {
  Swal.fire({
    position: 'center',
    icon: 'error',
    title: `${title} Input Error`,
    footer: message,
    cancelButton: true,
    timer: false
  });
}

