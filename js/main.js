$(document).ready(function(){
     $('.editMarks').hide();
     $("[id^=idv]").click(function () {
          var usn = $(this).val();
          $('.id1').val(usn);
     });

     $(".editBtn").click(function () {
          $('.marksTable').hide();
          $('.editMarks').show();
     });
});



