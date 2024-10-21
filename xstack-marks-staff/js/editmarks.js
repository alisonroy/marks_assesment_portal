//getting auth details from localStorage
var username = localStorage.email;
var auth_token = localStorage.auth_token;

document.getElementById("editpageloader").style.display = "block";
document.getElementById("editmarkscontainer").style.display = "none";
document.getElementById("editloader").style.display = "none";

$(document).ajaxStop(function () {
  $(document.getElementById(localStorage.subcode_dept_sem))
    .parent()
    .addClass("active");
});

$.ajax({
  type: "POST",
  url: "table-columns.php",
  datatype: "html",
  data: {
    username: username,
    auth_token: auth_token,
    table: [localStorage.table],
  },
  success: function (response) {
    var parsedResponse = JSON.parse(response);
    console.log(parsedResponse);
    if (parsedResponse != "false") {
      var exam = document.getElementById("listofexams");
      exam.innerHTML = "";
      var option = document.createElement("option");
      var selTextNode = document.createTextNode("Select Exam");
      option.disabled = "true";
      option.selected = "true";
      option.appendChild(selTextNode);
      exam.appendChild(option);
      var exams = new Array();
      for (var i in parsedResponse) {
        if (
          parsedResponse[i] != "register_no" &&
          typeof parsedResponse[i] !== "object"
        ) {
          var examname = parsedResponse[i]
            .split("_")[0]
            .toUpperCase()
            .replace("-", " ");
          if (exams.includes(examname)) {
          } else {
            exams.push(examname);
            var option = document.createElement("option");
            var examTextNode = document.createTextNode(examname);
            option.value = parsedResponse[i].split("_")[0];
            option.appendChild(examTextNode);
            exam.appendChild(option);
          }
        }
      }
      document.getElementById("editpageloader").style.display = "none";
      document.getElementById("editmarkscontainer").style.display = "block";
      $(function () {
        $("#listofexams").on("change", function (e) {
          document.getElementById("editloader").style.display = "block";
          var criteria = document.getElementById("listofcri");
          criteria.classList.add("disabledDiv");
          criteria.innerHTML = "";
          var option = document.createElement("option");
          var selTextNode = document.createTextNode("Select Criteria");
          option.disabled = "true";
          option.selected = "true";
          option.appendChild(selTextNode);
          criteria.appendChild(option);
          for (var i in parsedResponse) {
            if (
              parsedResponse[i] != "register_no" &&
              typeof parsedResponse[i] !== "object"
            ) {
              var examval = parsedResponse[i].split("_");
              if (this.value == examval[0]) {
                var option = document.createElement("option");
                var crit = parsedResponse[i]
                  .split("_")[1]
                  .toUpperCase()
                  .replace("-", " ")
                  .concat(" (", parsedResponse[i].split("_")[2], ") ");
                var criTextNode = document.createTextNode(crit);
                option.value = parsedResponse[i]
                  .split("_")[1]
                  .concat("_", parsedResponse[i].split("_")[2]);
                option.appendChild(criTextNode);
                criteria.appendChild(option);
              }
            }
          }
          criteria.classList.remove("disabledDiv");
          document.getElementById("editloader").style.display = "none";
        });
      });
      localStorage.user_type = parsedResponse.user_type;
      $(function () {
        $("#sub-edit").on("click", function (e) {
          document.getElementById("editsuccess").style.display = "none";
          document.getElementById("editerror").style.display = "none";
          document.getElementById("editfielderror").style.display = "none";
          e.preventDefault();
          document.getElementById("editloader").style.display = "block";
          var exam = $("#listofexams").val();
          var criteria = $("#listofcri").val();
          localStorage.setItem("column", exam.concat("_", criteria));
          $.ajax({
            type: "POST",
            url: "editmarks.php",
            datatype: "html",
            data: {
              username: username,
              auth_token: auth_token,
              table: localStorage.table,
              column: localStorage.column,
            },
            success: function (marks) {
              var parsedMarks = JSON.parse(marks);
              console.log(parsedResponse);
              parsedMarks.sort(function (a, b) {
                return a.register_no < b.register_no
                  ? -1
                  : a.register_no > b.register_no
                  ? 1
                  : 0;
              });

              if (parsedMarks != "false") {
                var tablearea = document.getElementById("editmark-table");
                tablearea.classList.remove("d-none");
                tablearea.innerHTML = "";
                var form = document.createElement("form");
                var table = document.createElement("table");
                table.classList.add("table", "table-borderless", "table-sm");
                var rowhead = document.createElement("tr");
                var nameHead = document.createElement("th");
                var nameHeadTextNode = document.createTextNode("Full Name");
                var regnoHead = document.createElement("th");
                var regnoHeadTextNode = document.createTextNode(
                  "Register Number"
                );
                var marktotHead = document.createElement("th");
                var marktotHeadTextNode = document.createTextNode(
                  "Marks ".concat(
                    "(",
                    parseInt(localStorage.column.split("_")[2]),
                    ")"
                  )
                );
                marktotHead.appendChild(marktotHeadTextNode);
                regnoHead.appendChild(regnoHeadTextNode);
                nameHead.appendChild(nameHeadTextNode);
                rowhead.appendChild(regnoHead);
                rowhead.appendChild(nameHead);
                rowhead.appendChild(marktotHead);
                table.appendChild(rowhead);
                for (var i in parsedMarks) {
                  if (typeof parsedMarks[i].full_name !== "undefined") {
                    var div = document.createElement("div");
                    div.classList.add("form-group", "font-weight-bold");
                    var input = document.createElement("input");
                    input.classList.add("form-control", "mb-n3", "mt-1");
                    input.type = "text";
                    var sub1 = document.createElement("td");
                    input.value = parsedMarks[i][localStorage.column];
                    input.id = parsedMarks[i].register_no;
                    div.appendChild(input);
                    sub1.appendChild(div);
                    var row = document.createElement("tr");
                    row.classList.add("my-n2");
                    var fullName = document.createElement("td");
                    var fullNameTextNode = document.createTextNode(
                      parsedMarks[i].full_name
                    );
                    var regno = document.createElement("td");
                    var regnoTextNode = document.createTextNode(
                      parsedMarks[i].register_no
                    );
                    fullName.appendChild(fullNameTextNode);
                    regno.appendChild(regnoTextNode);
                    row.appendChild(regno);
                    row.appendChild(fullName);
                    row.appendChild(sub1);
                    table.appendChild(row);
                  }
                }
                form.appendChild(table);
                tablearea.appendChild(form);
                document
                  .getElementById("editmark-card")
                  .classList.remove("d-none");
                var save = document.getElementById("save-marks");
                save.classList.remove("d-none");
                save.classList.add("d-flex");
                document.getElementById("editloader").style.display = "none";
              }
            },
            error: function (e) {},
          });
        });
      });
    } else {
      // clear the auth_token
      localStorage.clear();
      // redirect to index page
      var path = window.location.pathname;
      var pageName = path.split("/").pop();
      console.log(pageName);
      window.location.replace("index.html?redirect=" + pageName);
    }
  },

  error: function (error) {},
});
