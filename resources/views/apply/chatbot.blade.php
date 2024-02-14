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
  <script src="{{ asset('ext/chat-engine-dialog.js') }}"></script>
  <!-- dont re-arrange -->
  <script src="{{ asset('ext/chat-engine.js') }}"></script>
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
  <div class="flex items-center justify-start text-purple-600 text-base font-bold">
    <a href="{{ route('apply.index') }}" class="mt-3 cursor-pointer hover:scale-110 transition transition-100">Back</a>
 </div>
  <span id='chat-engine-data-receiver'></span>
  <div class="flex items-center justify-between mt-2 mb-4">
     <div class="flex-shrink-0">
        <span class="text-2xl sm:text-3xl leading-none font-bold dark:text-white text-gray-600">Application</span>
        <h3 class="text-base font-normal text-gray-500">You can make changes to your entries before submitting</h3>
     </div>
     <div class="flex items-center justify-end flex-1 dark:text-red-500 text-red-500 text-base font-bold">
        <button id="deleteSaveButton" class="mt-3 cursor-pointer hover:scale-110 transition transition-100">Delete</button>
     </div>
  </div>
  <x-componable.application-form />
</div>
<x-scripts.application-form />
</x-app-layout>