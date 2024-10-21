//getting auth details from localStorage
var username = localStorage.email;
var auth_token = localStorage.auth_token;

document.getElementById("adderror").style.display = "none";
document.getElementById("addsuccess").style.display = "none";
document.getElementById("addloader").style.display = "none";
document.getElementById("addexamloader").style.display = "block";
document.getElementById("add-exam-container").style.display = "none";

$(window).on("load", function () {
  document.getElementById("addexamloader").style.display = "none";
  document.getElementById("add-exam-container").style.display = "block";
});

$(document).ajaxStop(function () {
  $(document.getElementById(localStorage.subcode_dept_sem.toLowerCase()))
    .parent()
    .addClass("active");
});

$(function () {
  $("#sub-add").on("click", function (e) {
    document.getElementById("adderror").style.display = "none";
    document.getElementById("addsuccess").style.display = "none";
    document.getElementById("addloader").style.display = "block";
    var ename = document.getElementById("exam_name").value;
    ename = ename.trim().replace(/\s+/g, "-");
    var criteria = document.getElementById("criteria").value;
    criteria = criteria.trim().replace(/\s+/g, "-");
    var marks = document.getElementById("total_marks").value;
    marks = marks.replace(/\s+/g, "");
    var column = ename.concat("_", criteria, "_", marks);
    column = column.toLowerCase();
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "addexam.php",
      datatype: "html",
      data: {
        username: username,
        auth_token: auth_token,
        column: column,
        table: localStorage.table,
      },
      success: function (response) {
        if (parsedResponse != "false") {
          var parsedResponse = JSON.parse(response);
          if (parsedResponse == "success") {
            document.getElementById("addloader").style.display = "none";
            document.getElementById("addsuccess").style.display = "block";
          } else {
            document.getElementById("addloader").style.display = "none";
            document.getElementById("adderror").style.display = "block";
          }
        }
      },

      error: function (error) {},
    });
  });
});
