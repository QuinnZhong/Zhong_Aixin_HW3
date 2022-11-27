(() => {
    const { createApp } = Vue

  createApp({
    
  }).mount('#app')

})();



$(function() {
  
  $('#contactForm').submit(function(){
    
    var emailFilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,10})+$/;   
    var emailText = $(".email").val();
    if (emailFilter.test(emailText)) {
      $(".email").css({
        "color" : "#609D29"
      });
    }
    else {
      $(".email").css({
        "color" : "#CE3B46"
      });
    }
    
    var nameFilter = /^([a-zA-Z \t]{3,15})+$/;
    var nameText = $(".name").val();
    if (nameFilter.test(nameText)) {
      $(".name").css({
        "color" : "#609D29"
      });
    }
    else {
      $(".name").css({
        "color" : "#CE3B46"
      });
    }
    
    var messageText = $(".message").val().length;
    if (messageText > 50) {
      $(".message").css({
        "color" : "#609D29"
      });
    }
    else {
      $(".message").css({
        "color" : "#CE3B46"
      });
    }
    
    if ((!emailFilter.test(emailText)) || (!nameFilter.test(nameText)) || (messageText < 50)) {
      return false;
    }
    if ((emailFilter.test(emailText)) && (nameFilter.test(nameText)) && (messageText > 50)) {
      $("#contactForm").css("display", "none");
      $("#form").append("<h2>Message sent!</h2>");
      return false;
    }
  });       
});