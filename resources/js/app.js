// tw-elements chart initialization
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
      const fullname = document.getElementById('fullname');
      const surname = document.getElementById('surname');
      const gender = document.getElementById('gender');
      const dob = document.getElementById('dob');
      const email = document.getElementById('email');
      const cellphone1 = document.getElementById('cellphone1');
      const postalAddress = document.getElementById('postal-address');
      const physicalAddress = document.getElementById('physical-address');
      const place_of_application = document.getElementById('place_of_application');

      fullname.value = saveData['fullname'];
      surname.value = saveData['surname'];
      gender.value = saveData['gender'];
      dob.value = saveData['dob'];
      email.value = saveData['email'];
      cellphone1.value = saveData['cell_phone1'];
      postalAddress.value = saveData['postal_address'];
      physicalAddress.value = saveData['physical_address'];
      place_of_application.value = saveData['place_of_application']
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