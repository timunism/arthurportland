var dialog = {
    start: {
      says: ["Hi there", "Welcome to the Arthur Portland College Automated Application System. Kindly input your details as you're being asked.", "What is your Gender?"],
      reply: [
        {
          validation: "gender",
          question: "male or female",
          answer: "gender"
        },
      ]
    },
    gender: {
      says: ["What is your Postal Address?"],
      reply: [
        {
          validation: "none",
          question: "e.g. P.O Box 602172, Gaborone",
          answer: "postal_address"
        }
      ]
    },
    postal_address: {
      says: ["What is your physical address?"],
      reply: [
        {
          validation: "none",
          question: "e.g. Plot No. 2165, Bontleng, Gaborone",
          answer: "physical_address"
        }
      ]
    },
    physical_address: {
      says: ["What is your primary cell phone number?"],
      reply: [
        {
          validation: "phonenumber",
          question: "e.g. +267123456789",
          answer: "phone"
        }
      ]
    },
    phone: {
      says: ["What is the cell phone number of your Next of Kin"],
      reply: [
        {
          validation: "phonenumber",
          question: "e.g. +267133581078",
          answer: "nok_phone"
        }
      ]
    },
    nok_phone: {
      says: ["Employer"],
      reply: [
        {
          validation: "none",
          question: "N.B if not employed write N/A",
          answer: "employer"
        }
      ]
    },
    employer: {
      says: ["Nature of Work"],
      reply: [
        {
          validation: "none",
          question: "N.B if not employed write N/A",
          answer: "work"
        }
      ]
    },
    work: {
      says: ["Qualification(s)"],
      reply: [
        {
          validation: "none",
          question: "List of relevant Qualification(s) seperated by ;",
          answer: "qualifications"
        }
      ]
    },
    qualifications: {
      says: ["University/College"],
      reply: [
        {
          validation: "none",
          question: "N.B write N/A is none",
          answer: "school"
        }
      ]
    },
    school: {
      says: ["Senior School"],
      reply: [
        {
          validation: "none",
          question: "N.B write N/A is none",
          answer: "senior_school"
        }
      ]
    },
    senior_school: {
      says: ["By sending 'yes', you are agreeing to our <a href='#' class='bubble-link'>Terms&nbsp;of&nbsp;Service</a>. Do you wish to continue?"],
      reply: [
        {
          validation: "boolean",
          question: "Yes or No<br/><br/>Or click on Terms of Service to read more about them, before proceeding. Your progress wont be lost.",
          answer: "end"
        }
      ]
    },
    end: {
      says: ["Thank you for submitting your application. You'll now be redirected to another page for continuing the process."],
      reply: [
        {
          validation: "none",
          question: "Press Enter to Continue...",
          answer: "end"
        }
      ]
    },
  };
  
  var output = {
    "gender":NaN,
    "postal_address":NaN,
    "physical_address":NaN,
    "phone":NaN,
    "nok_phone":NaN,
    "employer":NaN,
    "work":NaN,
    "qualifications":NaN,
    "school":NaN,
    "senior_school":NaN,
    "end":NaN,
  };
  
  
  const endPoint = "end";
  
  