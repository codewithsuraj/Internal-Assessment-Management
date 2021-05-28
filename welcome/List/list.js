$(document).ready(function(){
     $("[id^=idv]").hide();
     $("[id^=ide]").hide();
     $("[id^=idh]").show();
     $(".deleteBtn").hide();
     $("#editBtn").click(function () {
          $("[id^=idv]").toggle();
          $("[id^=ide]").toggle();
          $("[id^=idh]").toggle();
          $(".deleteBtn").toggle();
     });
});