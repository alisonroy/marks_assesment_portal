//getting auth details from localStorage
var username = localStorage.email;
var auth_token = localStorage.auth_token;

document.getElementById("editsuccess").style.display = "none";
document.getElementById("editerror").style.display = "none";
document.getElementById("editfielderror").style.display = "none";

$(function () {
  $("#add-marks").on("click", function (e) {
    document.getElementById("add-marks").innerHTML = `
    <div class="dot-opacity-loader-inside-button">
        <span></span>
        <span></span>
        <span></span>
    </div>`;
    document.getElementById("add-marks").setAttribute("disabled", "disabled");
    document.getElementById("editsuccess").style.display = "none";
    document.getElementById("editerror").style.display = "none";
    document.getElementById("editfielderror").style.display = "none";
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "editmarks.php",
      datatype: "html",
      data: {
        username: username,
        auth_token: auth_token,
        column: localStorage.column,
        table: localStorage.table,
      },
      success: function (response) {
        var parsedResponse = JSON.parse(response);
        if (parsedResponse != "false") {
          var flag = true;
          var markset = {};
          var maxmark = parseInt(localStorage.column.split("_")[2]);
          for (var i in parsedResponse) {
            if (typeof parsedResponse[i].register_no !== "undefined") {
              var mark = document.getElementById(parsedResponse[i].register_no);
              if (
                mark.value <= maxmark &&
                mark.value >= 0 &&
                Number.isInteger(parseInt(mark.value))
              ) {
                markset[parsedResponse[i].register_no] = mark.value;
                mark.style.border = "none";
              } else {
                mark.style.border = "1px solid red";
                flag = false;
              }
            }
          }
          if (flag) {
            $.ajax({
              type: "POST",
              url: "appendmarks.php",
              datatype: "html",
              data: {
                username: username,
                auth_token: auth_token,
                markset: markset,
                column: localStorage.column,
                table: localStorage.table,
              },
              success: function (response1) {
                var parsedResponse1 = JSON.parse(response1);
                if (parsedResponse1 != "false") {
                  if (parsedResponse1 == "success") {
                    document.getElementById("add-marks").innerHTML =
                      "Save Marks";
                    document
                      .getElementById("add-marks")
                      .removeAttribute("disabled", "disabled");
                    document.getElementById("editsuccess").style.display =
                      "block";
                  } else {
                    document.getElementById("add-marks").innerHTML =
                      "Save Marks";
                    document
                      .getElementById("add-marks")
                      .removeAttribute("disabled", "disabled");
                    document.getElementById("editerror").style.display =
                      "block";
                  }
                }
              },
              error: function (error) {},
            });
          } else {
            document.getElementById("add-marks").innerHTML = "Save Marks";
            document
              .getElementById("add-marks")
              .removeAttribute("disabled", "disabled");
            document.getElementById("editfielderror").style.display = "block";
          }
        }
      },

      error: function (error) {},
    });
  });
});
