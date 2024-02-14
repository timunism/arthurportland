/*

ChatEngine v1.0.0

Based on Bubbles.js:
  originally developed by => https://github.com/dmitrizzle
  and extensively modified by => https://github.com/timunism

*/
  // Adjust Casing (Capitalize every word in the text)
  const adjustCasing = {
    output: "",
    body: "",
    firstLetter: "",
    // runs a script to process texts of n words
    run(text){
        try {
            text = text.trim();
            const splitText = String(text).split(' ');
            if (splitText.length > 1) {
                // iterate through the words & process them
                splitText.forEach(word => {
                    if (word.length > 1) {
                        this.output += `${this.process(word)} `;
                    }
                });
    
                return this.output;
            }
            else {
                // run if sentence contains a single word
                var word = splitText[0];
                return this.process(word);
            }
        } catch (error) {
            return null;
        }
    },
    // process a single word
    process(word){
        try {
            // remove first letter from the word
            this.body = word.replace(word[0], "");
            // set it to uppercase
            this.firstLetter = word[0].toUpperCase();
            // concatenate it to the rest of the word
            this.body = this.firstLetter + this.body;
            // return the Capitalized word
            return this.body;
        } catch (error) {
            return null;
        }
    }
  };
  
// core function
function Bubbles(container, self, previewInput, clickFuntion, options) {
    // options
    // check index.html for details about clickFunction & previewInput
    if (clickFuntion == true) {
      // force previewInput to true as well
      previewInput = true;
    }
    options = typeof options !== "undefined" ? options : {}
    animationTime = options.animationTime || 200 // how long it takes to animate chat bubble, also set in CSS
    typeSpeed = options.typeSpeed || 5 // delay per character, to simulate the machine "typing"
    widerBy = options.widerBy || 2 // add a little extra width to bubbles to make sure they don't break
    sidePadding = options.sidePadding || 6 // padding on both sides of chat bubbles
    inputCallbackFn = options.inputCallbackFn || false // should we display an input field?
    responseCallbackFn = options.responseCallbackFn || false // is there a callback function for when a user clicks on a bubble button
  
    var standingAnswer = "start" // remember where to restart convo if interrupted
  
    var _convo = {} // local memory for conversation JSON object
    //--> NOTE that this object is only assigned once, per session and does not change for this
    // 		constructor name during open session.
  
    // set up the stage
    container.classList.add("bubble-container")
    var bubbleWrap = document.createElement("div")
    bubbleWrap.className = "bubble-wrap"
    container.appendChild(bubbleWrap)
  
    // install user input textfield
    this.typeInput = function(callbackFn) {
      var inputWrap = document.createElement("div")
      inputWrap.className = "input-wrap"
      var inputText = document.createElement("textarea")
      var sendButton = document.getElementById("sendButton");
      inputText.setAttribute("placeholder", "Ask me anything...")
      inputWrap.appendChild(inputText)
  
      // Send Message on Enter
      inputText.addEventListener("keypress", function(e) {
        // register user input
        if (e.key == 'Enter') {
          // simulate click-send button click
          sendButton.classList.toggle('click-animation');
          // send message
          sendMessage(e, inputText);
          // callback
          typeof callbackFn === "function"
          ? callbackFn({
              input: inputText.value,
              convo: _convo,
              standingAnswer: standingAnswer
            })
          : false
        inputText.value = ""
        }
      })
  
      // Send Message on click-send
      sendButton.addEventListener("click", function(e) {
        // register user input
        if ((inputText.value).length > 0) {
          sendButton.classList.toggle('click-animation');
          sendMessage(e, inputText);
          // callback
          typeof callbackFn === "function"
          ? callbackFn({
              input: inputText.value,
              convo: _convo,
              standingAnswer: standingAnswer
            })
          : false
        inputText.value = ""
        }
      })
      container.appendChild(inputWrap)
      bubbleWrap.style.paddingBottom = "100px"
      inputText.focus()
    }
    inputCallbackFn ? this.typeInput(inputCallbackFn) : false
  
    // init typing bubble
    var bubbleTyping = document.createElement("div")
    bubbleTyping.className = "bubble-typing imagine"
    for (dots = 0; dots < 3; dots++) {
      var dot = document.createElement("div")
      dot.className = "dot_" + dots + " dot"
      bubbleTyping.appendChild(dot)
    }
    bubbleWrap.appendChild(bubbleTyping)
  
    // accept JSON & create bubbles
    this.talk = function(convo, here) {
      // all further .talk() calls will append the conversation with additional blocks defined in convo parameter
      _convo = Object.assign(_convo, convo) // POLYFILL REQUIRED FOR OLDER BROWSERS
  
      this.reply(_convo[here])
      here ? (standingAnswer = here) : false
    }
  
    var iceBreaker = false // this variable holds answer to whether this is the initative bot interaction or not
    this.reply = function(turn) {
      iceBreaker = typeof turn === "undefined"
      turn = !iceBreaker ? turn : _convo.start
      questionsHTML = ""
      if (!turn) return
      if (turn.reply !== undefined) {
        turn.reply.reverse()
        for (var i = 0; i < turn.reply.length; i++) {
          ;(function(el, count) {
            if (clickFuntion && previewInput) {
              // Add Click functionality to previewed buttons
              questionsHTML +=
              '<span class="bubble-button" style="animation-delay: ' +
              animationTime / 2 * count +
              'ms" onClick="' +
              self +
              ".answer('" +
              el.answer +
              "', '" +
              el.question +
              "');this.classList.add('bubble-pick')\">" +
              el.question +
              "</span>"
            }
            else if (!clickFuntion && previewInput) {
              // Remove click functionality but preview input
              questionsHTML +=
              '<span id="dont-hover" class="bubble-button validate-'+el.validation+'" style="animation-delay: ' +
              animationTime / 2 * count +
              'ms"'+
              "this.classList.add('bubble-pick')\">" +
              el.question +
              "</span>"
            }
            else {
              // Dont preview input bubble & remove click functionality
            }
          })(turn.reply[i], i)
        }
      }
      orderBubbles(turn.says, function() {
        bubbleTyping.classList.remove("imagine")
        questionsHTML !== ""
          ? addBubble(questionsHTML, function() {}, "reply")
          : bubbleTyping.classList.add("imagine")
      })
    }
    // navigate "answers"
    this.answer = function(key, content) {
      var func = function(key, content) {
        typeof window[key] === "function" ? window[key](content) : false
      }
      _convo[key] !== undefined
        ? (this.reply(_convo[key]), (standingAnswer = key))
        : (typeof responseCallbackFn === 'function' ? responseCallbackFn({input: key,convo: _convo,standingAnswer: standingAnswer}, key) : func(key, content))
    }
  
    // api for typing bubble
    this.think = function() {
      bubbleTyping.classList.remove("imagine")
      this.stop = function() {
        bubbleTyping.classList.add("imagine")
      }
    }
  
    // "type" each message within the group
    var orderBubbles = function(q, callback) {
      var start = function() {
        setTimeout(function() {
          callback()
        }, animationTime)
      }
      var position = 0
      for (
        var nextCallback = position + q.length - 1;
        nextCallback >= position;
        nextCallback--
      ) {
        ;(function(callback, index) {
          start = function() {
            addBubble(q[index], callback)
          }
        })(start, nextCallback)
      }
      start()
    }
  
    // create a bubble
    var bubbleQueue = false
    var addBubble = function(say, posted, reply, live) {
      reply = typeof reply !== "undefined" ? reply : ""
      live = typeof live !== "undefined" ? live : true // bubbles that are not "live" are not animated and displayed differently
      var animationTime = live ? this.animationTime : 0
      var typeSpeed = live ? this.typeSpeed : 0
      // create bubble element
      var bubble = document.createElement("div")
      var bubbleContent = document.createElement("span")
      bubble.className = "bubble imagine " + (!live ? " history " : "") + reply
      bubbleContent.className = "bubble-content"
      bubbleContent.innerHTML = say
      bubble.appendChild(bubbleContent)
      bubbleWrap.insertBefore(bubble, bubbleTyping)
      // answer picker styles
      if (reply !== "") {
        var bubbleButtons = bubbleContent.querySelectorAll(".bubble-button")
        for (var z = 0; z < bubbleButtons.length; z++) {
          ;(function(el) {
            if (!el.parentNode.parentNode.classList.contains("reply-freeform"))
              el.style.width = el.offsetWidth - sidePadding * 2 + widerBy + "px"
          })(bubbleButtons[z])
        }
        bubble.addEventListener("click", function(e) {
          if(clickFuntion != false) {
            if (e.target.classList.contains('bubble-button')) {
              for (var i = 0; i < bubbleButtons.length; i++) {
                ;(function(el) {
                  el.style.width = 0 + "px"
                  el.classList.contains("bubble-pick") ? (el.style.width = "") : false
                  el.removeAttribute("onclick")
                })(bubbleButtons[i])
              }
              this.classList.add("bubble-picked")
            }
          }
        })
      }
      // time, size & animate
      wait = live ? animationTime * 2 : 0
      minTypingWait = live ? animationTime * 6 : 0
      if (say.length * typeSpeed > animationTime && reply == "") {
        wait += typeSpeed * say.length
        wait < minTypingWait ? (wait = minTypingWait) : false
        setTimeout(function() {
          bubbleTyping.classList.remove("imagine")
        }, animationTime)
      }
      live && setTimeout(function() {
        bubbleTyping.classList.add("imagine")
      }, wait - animationTime * 2)
      bubbleQueue = setTimeout(function() {
        bubble.classList.remove("imagine")
        var bubbleWidthCalc = bubbleContent.offsetWidth + widerBy + "px"
        bubble.style.width = reply == "" ? bubbleWidthCalc : ""
        bubble.style.width = say.includes("<img src=")
          ? "50%"
          : bubble.style.width
        bubble.classList.add("say")
        posted()
  
        // animate scrolling
        containerHeight = container.offsetHeight
        scrollDifference = bubbleWrap.scrollHeight - bubbleWrap.scrollTop
        scrollHop = scrollDifference / 200
        var scrollBubbles = function() {
          for (var i = 1; i <= scrollDifference / scrollHop; i++) {
            ;(function() {
              setTimeout(function() {
                bubbleWrap.scrollHeight - bubbleWrap.scrollTop > containerHeight
                  ? (bubbleWrap.scrollTop = bubbleWrap.scrollTop + scrollHop)
                  : false
              }, i * 5)
            })()
          }
        }
        setTimeout(scrollBubbles, animationTime / 2)
      }, wait + animationTime * 2)
    }
  
    function sendMessage (e, inputText) {
      console.log(inputText.value);
      e.preventDefault()
      typeof bubbleQueue !== false ? clearTimeout(bubbleQueue) : false // allow user to interrupt the bot
      var lastBubble = document.querySelectorAll(".bubble.say")
      lastBubble = lastBubble[lastBubble.length - 1]
    
      // retrieve validation information located inside the second span of the div
      var validation = lastBubble.lastChild;
      validation = validation.lastChild;
      // retrieve the classlist
      validation = validation.classList;
      // retrieve the validation class
      validation = validation[1]
      // split the validation class into classname & argument
      validation = validation.split('-');
      // retrieve argument (for Display purposes)
      validation = validation[1];
      
      // Pass that argument to iValidate()
      var validateValue = iValidate(validation, inputText.value)
      var validityClass = "";
      if (validateValue == null) {
        validateValue = 'invalid';
        validityClass = 'invalid-input';
      }
      else {
        validityClass = 'valid-input';
      }
    
      lastBubble.classList.contains("reply") &&
      !lastBubble.classList.contains("reply-freeform")
        ? lastBubble.classList.add("bubble-hidden")
        : false
      addBubble(
        `<span class="bubble-button bubble-pick ${validityClass}">` + validateValue + "</span>",
        function() {},
        "reply reply-freeform"
      )
    }
  }
  
  // ChatPersist
  // Write Output to local storage
  function savepoint(key, value){
    localStorage.setItem(key, value)
    console.log('saved')
  }
  
  // Retrieve Output from local Storage
  function retrieveSave(key) {
    var output = localStorage.getItem(key);
    return JSON.parse(output);
  }
  
  // Delete Save Data from local Storage
  function deleteSave(){
    localStorage.removeItem('chat-persist-v1');
    location.reload();
  }
  /*
    setEntryPoint:
  
    [sets the entry point of a specified nth step]
  */
  function setEntryPoint(targetName){
    // sets the starting point of the conversation to the retrieve step
    dialog.start = jump2Step(targetName);
  }
  
  // returns a specific step of a conversation - using a specified targetName as reference
  /*- Since the targetName defines the succeeding stepN, to
  match the targetName to the nth step with a purpose defined by
  the given targetName, the preceeding stepN has to be retrieved instead.
  
  Options:
    keyOnly => set to true, to retrieve only the key (String)
            => leave as-is to retrieve the target StepN (Object)
  */
  function jump2Step(targetName, keyOnly) {
  var newStep = "";
  var targetStep = "";
  
  for (const key in dialog) {
    if (Object.hasOwnProperty.call(dialog, key)) {
        if (key == targetName) {
            /* if the current key is equivalent to the targetName
                the targetStep is used in place of the key - to retrieve 
                the preceeding step of the targetName.
            */
            try {
                if (keyOnly == true) {
                    newStep = targetStep;
                }
                else {
                    newStep = dialog[targetStep];
                }
            }
            catch (e) {
                newStep = dialog[targetStep];
            }
            return newStep;
        }
        else {
            // if the key does not match the target name, assign the value of
            // the current key to the targetStep
            targetStep = key;
        }
    }
  }
  }
  
  // Initialize Chat from local storage
  function loadChat(key){
    output = retrieveSave(key);
    // Retrieve last entry that is not null
    var targetName = "";
    for (const key in output) {
        if (Object.hasOwnProperty.call(output, key)) {
            if (output[key] == null) {
                targetName = key;
                break
            }
        }
    }
    //console.log('Loaded Data:',output);
    setEntryPoint(targetName);
  }
  // ###############################################################################
  // Front end controls for deleting save data.

  
  // iValidate
  function iValidate(type, input){
    type = String(type).toLowerCase();
    var output = "";
    if (type == 'none') {
        return input;
    }
  
    // Validates names (removes symbols and capitalizes each word)
    if (type == 'name') {;
        if (verifyName(input) == true) {
            output = sanitize(input, lowercase=true);
            output = adjustCasing.run(output);
            return output;
        }
        else {
            return null;
        }
    }
  
    // Validates dates (verifies whether the provided date is in the format dd/mm/yyyy)
    if (type == 'date') {
        if(verifyDate(input) == true) {
            return input;
        }
        else {
            return null;
        }
    }
  
    // Validates emails
    if (type == 'email') {
        return validateEmail(input);
    }
  
    // validates gender
    if (type == 'gender') {
        input = sanitize(input, lowercase=true)
        if (input == 'male' || input == 'female') {
            return input;
        }
        else {
            return null;
        }
    }
  
    if (type == 'boolean') {
        input = sanitize(input, lowercase=true)
        if (input == 'yes' || input == 'no') {
            return input;
        }
    }
  
    // validates number
    if (type == 'number') {
        if (isNumber(input) == true) {
            return input;
        }
        else {
            return null;
        }
    }
  
    // validates phone number
    if (type == 'phonenumber') {
        if (isPhoneNumber(input) == true) {
            return input;
        }
        else {
            return null;
        }
    }
  }

  function sanitize(text, lowercase) {
    if (lowercase == true) {
        text = String(text).toLowerCase();
    }
    text = text.replaceAll(/['"&!-?;#:|/\\{}]/g, '');
    text = text.replaceAll('_','');
    
    return text;
  }
  
  function verifyDate(text){
    // Format of Date is dd/mm/yyyy
    text = text.split('/');
    if (text.length == 3) {
        if (text[0].length == 2 && // is day 2 values
            text[1].length == 2 && // is month 2 values
            text[2].length == 4) { // is year 4 values
  
            if (999 < Number(text[2])) // year has atleast 4 digits
                {
                // Day is between 1 - 31
                if (Number(text[0]) > 0 && Number(text[0]) < 32) {
                    // Month is between 1 - 12
                    if (Number(text[1]) > 0 && Number(text[1]) < 13) {
                        return true;
                    }
                }
            }
        }
    }
  }
  
  function validateEmail(text){
    text = text.split('@');
    var head,tail,tailSplit;
  
    if (text.length == 2) {
        try {
            head = text[0]
            tail = text[1];
  
            tailSplit = tail.split('.');
            if (tailSplit.length == 2 || tailSplit.length == 3) {
                if (head.length > 0){
                    head = head.toLowerCase();
                    return head+'@'+tail;
                }
                else {
                    console.log(['invalid username'])
                    return null;
                }
            }
            else {
                console.log(['invalid domain name'])
                return null
            }
        }
        catch (e) {
            console.log(e)
            return null
        }
    }
    else {
        console.log(['invalid email'])
        return null
    }
  }
  
  function verifyName(text) {
    var processed = false;
    for (let i = 0; i < text.length; i++) {
        var char = text[i];
        // check if its a number
        if (String(Number(char)) != 'NaN') {
            return false;
        }
        // check if its a symbol
        else {
            // sanitize char
            char = sanitize(char, lowercase=false);
            char = char.trim();
            // if the result does not match the original (assume it was a symbol)
            //console.log('new:',char,'original:',text[i]);
            if (char != text[i]) {
                return false;
            }
        }
        if (i == (text.length - 1)) {
            return true
        }    
    }
  }
  
  function isPhoneNumber(text) {
    const phoneRegex = /^\+?\d{1,3}-?\d{3}-?\d{3}-?\d{4}$/; // Matches phone numbers with optional "+" symbol and optional hyphens
  
    if (phoneRegex.test(text)) {
      return true;
    } else {
      return false;
    }
  }
  
  
  function isNumber(text) {
    return !isNaN(parseFloat(text)) && isFinite(text); // returns true or false
  }
