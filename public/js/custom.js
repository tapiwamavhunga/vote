// Image 1
$(".newbtn1").bind("click", function () {
    $("#pic1").click();
  });
  
  function readURL1(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $("#blah1").attr("src", e.target.result); 
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  // Image 2
  $(".newbtn2").bind("click", function () {
    $("#pic2").click();
  });
  
  function readURL2(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $("#blah2").attr("src", e.target.result);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  // Image 3
  $(".newbtn3").bind("click", function () {
    $("#pic3").click();
  });
  
  function readURL3(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $("#blah3").attr("src", e.target.result);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  // Image 4
  $(".newbtn4").bind("click", function () {
    $("#pic4").click();
  });
  
  function readURL4(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $("#blah4").attr("src", e.target.result);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  // Image 5
  $(".newbtn5").bind("click", function () {
    $("#pic5").click();
  });
  
  function readURL5(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $("#blah5").attr("src", e.target.result);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  // Image 6
  $(".newbtn6").bind("click", function () {
    $("#pic6").click();
  });
  
  function readURL6(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $("#blah6").attr("src", e.target.result);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }