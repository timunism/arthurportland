<x-app-layout>
<div id='application-chatbot-interface'>
  <div id="page" class="doodle-bg" style="background-image: url({{ url('storage/icons/bg.png') }})">
    <div id="chat">
      <span id="sendButton">
        <img src="{{ url('storage/icons/send.png') }}" alt="Send Message Button">
      </span>
    </div>
  </div>
  
  <!-- dialog file goes on-top -->
  <script src="{{ url('storage/scripts/chat-engine-dialog.js') }}"></script>
  <!-- dont re-arrange -->
  <script src="{{ url('storage/scripts/chat-engine.js') }}"></script>
  <script>
  // initialize by constructing a named function...
  // ...and add text processing plugin:
  num = 0;
  
  // if a save file exists
  if (localStorage.getItem('chat-persist-v1')){
    loadChat('chat-persist-v1');
  }
  
  var chatWindow = new Bubbles(document.getElementById("chat"), "chatWindow",
    /*
      Note: If you disable previewInput, with clickFunction enabled the program
            will force enable previewInput as well.
    */
    previewInput=true, // Previews possible or intented user input
    clickFunction=false, // Adds click functionality to bubble-buttons
   {
  
    // the one that we care about is inputCallbackFn()
    // this function returns an object with some data that we can process from user input
    // and understand the context of it
  
    // this is an example function that matches the text user typed to one of the answer bubbles
    inputCallbackFn: function(o) {
      // add error conversation block & recall it if no answer matched
      var miss = function() {
        chatWindow.talk(
          {
            "i-dont-get-it": {
              says: [
                "Sorry, I don't get it 😕. Pls repeat? Or you can just click below 👇"
              ],
              reply: o.convo[o.standingAnswer].reply
            }
          },
          "i-dont-get-it"
        )
      }
  
      // do this if answer found
      var match = function(key) {
        setTimeout(function() {
          chatWindow.talk(convo, key) // restart current convo from point found in the answer
        }, 600)
      }
  
      // sanitize text for search function
      var strip = function(text) {
        return text.replace(/[\s.,\/#!$%\^&\*;:{}=\-_'"`~()]/g, "")
      }
  
      // variables for keeping track of input & answer
      var found = false
      var input = "";
      var answer = "";
      var validation = "";
  
      // Start the question to response logic
      /*
      1. o is an object that contains the current input, the defined convo, and the value
        of the standingAnswer.
      2. The standingAnswer defines the entry point of the convo
      3. StepN represents the nth block of question-answer in the pair
      */
  
      // for Each nth block of question-answer, in the convo
      o.convo[o.standingAnswer].reply.forEach(function(stepN, i) {
        // set found to True
        found = true
        if (found != false) {
          // define input & answer (for mapping)
          validation = stepN.validation;
          input = iValidate(validation, o.input);
          answer = stepN.answer;
          
        }
      })
  
      if (input == null) {
        found = false;
      }
      
      //found ? match(found) : miss()
      if (found != false) {
        // store input as the value of the key, answer inside the output dictionary
        output[answer] = input;
        num += 1;
        // jump to the succeeding nth Step in the convo
        if(answer != 'end') {
          match(answer);
        }
        else {
          location.reload();
        }
      }
      else {
        var prevStep = jump2Step(answer, keyOnly=true);
        console.log(prevStep);
        match(prevStep);
      }
      // save
      savepoint('chat-persist-v1',JSON.stringify(output));
    }
  }) // done setting up chat-bubble
  
  // conversation object defined separately
  
  var convo = dialog;
  
  // pass JSON to your function and you're done!
  chatWindow.talk(convo)
  </script>
</div>
<div id="applybot-progression" class="hidden mt-6 bg-white dark:bg-gray-800 shadow dark:shadow-slate-900 shadow-slate-300 rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
  <span id='chat-engine-data-receiver'></span>
  <div class="flex items-center justify-between mb-4">
     <div class="flex-shrink-0">
        <span class="text-2xl sm:text-3xl leading-none font-bold dark:text-white text-gray-600">Application</span>
        <h3 class="text-base font-normal text-gray-500"></h3>
     </div>
     <div class="flex items-center justify-end flex-1 dark:text-red-500 text-red-500 text-base font-bold">
        <button id="deleteSaveButton" class="mt-3 cursor-pointer hover:scale-110 transition transition-100">Delete</button>
     </div>
  </div>
  <div id="main-chart">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words dark:bg-gray-700 bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto ps">
            <table class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-gray-700">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-gray-700 opacity-70">Details</th>
                  <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-gray-700 opacity-70">Data</th>
                  <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap"></th>
                </tr>
              </thead>
              <tbody class="border-t">
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Fullname</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="fullname" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60"/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60">editable</i>
                    </button>
                  </td>
                </tr>

                {{-- Surname --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Surname</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="surname" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60"/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60">editable</i>
                    </button>
                  </td>
                </tr>

                {{-- Gender --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Gender</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="gender" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" disabled/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60">locked</i>
                    </button>
                  </td>
                </tr>

                {{-- D.O.B --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">D.O.B</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="dob" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" disabled/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60">locked</i>
                    </button>
                  </td>
                </tr>

                {{-- Email --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Email</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="email" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" disabled/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60">editable</i>
                    </button>
                  </td>
                </tr>

                {{-- Cellphone 1 --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Cellphone 1</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="cellphone1" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" disabled/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60">editable</i>
                    </button>
                  </td>
                </tr>

                {{-- Postal Address --}}
                <tr class="text-gray-700">
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <div class="flex px-2">
                      <div class="my-auto">
                        <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Postal Address</h6>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <input id="postal-address" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" disabled/>
                  </td>
                  <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                    <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                      <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60">editable</i>
                    </button>
                  </td>
                </tr>

                  {{-- Physical Address --}}
                  <tr class="text-gray-700">
                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                      <div class="flex px-2">
                        <div class="my-auto">
                          <h6 class="mb-0 ml-2 text-sm leading-normal dark:text-white">Physical Address</h6>
                        </div>
                      </div>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                      <input id="physical-address" class="dark:bg-gray-800 rounded-md mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60" disabled/>
                    </td>
                    <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                      <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-gray-700">
                        <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60">editable</i>
                      </button>
                    </td>
                  </tr>
              </tbody>
            </table>
          <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
      </div>
    </div>
  </div>
</div>
</x-app-layout>