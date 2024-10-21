//getting auth details from localStorage
var username = localStorage.email;
var auth_token = localStorage.auth_token;

document.getElementById("final-upload-loader").style.display = "block";
document.getElementById("final-upload-container").style.display = "none";
document.getElementById("final-loader").style.display = "none";
document.getElementById("final-error").style.display = "none";
document.getElementById("marks-error").style.display = "none";
document.getElementById("marks-failed").style.display = "none";
document.getElementById("marks-success").style.display = "none";

$.ajax({
  type: "POST",
  url: "subjects.php",
  datatype: "html",
  data: {
    username: username,
    auth_token: auth_token,
  },
  success: function (response1) {
    var parsedResponse1 = JSON.parse(response1);
    console.log(parsedResponse1);
    if (parsedResponse1 != "false") {
      var subReport = document.getElementById("listofsub");
      var option = document.createElement("option");
      var selTextNode = document.createTextNode("Select Subject");
      option.disabled = "true";
      option.selected = "true";
      option.appendChild(selTextNode);
      subReport.appendChild(option);
      for (var i in parsedResponse1) {
        if (typeof parsedResponse1[i].semester !== "undefined") {
          var option = document.createElement("option");
          var subTextNode = document.createTextNode(
            parsedResponse1[i].subject_name
          );
          option.value = parsedResponse1[i].subCode_dept_sem.toLowerCase();
          option.appendChild(subTextNode);
          subReport.appendChild(option);
        }
      }
      document.getElementById("final-upload-loader").style.display = "none";
      document.getElementById("final-upload-container").style.display = "block";
    }
  },
  error: function (error) {},
});
var field = new Array();
var flag = 0;
$(function () {
  $("#listofsub").on("change", function (e) {
    document.getElementById("final-loader").style.display = "block";
    var tables = ["mm_".concat($("#listofsub").val()).toLowerCase()];
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "table-columns.php",
      datatype: "html",
      data: {
        username: username,
        auth_token: auth_token,
        table: tables,
      },
      success: function (responseExam) {
        var parsedExam = JSON.parse(responseExam);
        console.log(parsedExam);
        if (parsedExam != "false") {
          var exam = document.getElementById("listofexam");
          exam.innerHTML = "";
          var option = document.createElement("option");
          var selTextNode = document.createTextNode("Select Exam");
          option.disabled = "true";
          option.selected = "true";
          option.appendChild(selTextNode);
          exam.appendChild(option);
          var exams = new Array();
          field.length = 0;
          for (var i in parsedExam) {
            if (
              parsedExam[i] != "register_no" &&
              typeof parsedExam[i] !== "object"
            ) {
              field.push(parsedExam[i]);
              var examname = parsedExam[i]
                .split("_")[0]
                .toUpperCase()
                .replace("-", " ");
              if (exams.includes(examname)) {
              } else {
                exams.push(examname);
                var option = document.createElement("option");
                var examTextNode = document.createTextNode(examname);
                option.value = parsedExam[i].split("_")[0];
                option.appendChild(examTextNode);
                exam.appendChild(option);
              }
            }
          }
          document.getElementById("final-loader").style.display = "none";
        }
      },
      error: function (e) {},
    });
  });
});
$(function () {
  $("#listofcomp").on("change", function (e) {
    document.getElementById("final-loader").style.display = "block";
    var markfield = document.getElementById("marks");
    markfield.classList.add("disabledDiv");
    var selexam = document.getElementById("listofexam").value;
    var selcomp = document.getElementById("listofcomp").value;
    for (var i in field) {
      var splitfield = field[i].split("_");
      if (splitfield[1] == selcomp && splitfield[0] == selexam) {
        flag = 1;
        markfield.value = parseInt(splitfield[2]);
        break;
      }
    }
    if (flag == 0) {
      markfield.value = "";
      markfield.classList.remove("disabledDiv");
    }
    document.getElementById("final-loader").style.display = "none";
  });
});

$(function () {
  $("#final-upload-button").on("click", function (e) {
    document.getElementById("final-error").style.display = "none";
    document.getElementById("final-loader").style.display = "block";
    var table = "mm_".concat($("#listofsub").val());
    var exam = document.getElementById("listofexam").value;
    var marks = document.getElementById("marks").value;
    marks = marks.trim().replace(/\s+/g, "-");
    var column = exam.concat("_", $("#listofcomp").val(), "_", marks);
    localStorage.setItem("column", column);
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "addexam.php",
      datatype: "html",
      data: {
        username: username,
        auth_token: auth_token,
        column: column,
        table: table,
      },
      success: function (response) {
        var parsedResponse = JSON.parse(response);
        if (parsedResponse != "false") {
          if (parsedResponse == "failed" && flag == 0) {
            document.getElementById("final-loader").style.display = "none";
            document.getElementById("final-error").style.display = "block";
          }
          if (parsedResponse == "success" || flag == 0 || flag == 1) {
            var tablearea = document.getElementById("final-table");
            tablearea.classList.remove("d-none");
            tablearea.innerHTML = "";
            var form = document.createElement("form");
            var table = document.createElement("table");
            table.classList.add("table", "table-borderless");
            var rowhead = document.createElement("tr");
            var criHead = document.createElement("th");
            var criHeadTextNode = document.createTextNode("Criteria");
            var markHead = document.createElement("th");
            var markHeadTextNode = document.createTextNode("Marks");
            var checkHead = document.createElement("th");
            var check = document.createElement("input");
            check.classList.add("form-check-input", "ml-3", "mt-n2");
            check.id = "check-all";
            check.setAttribute("type", "checkbox");
            checkHead.appendChild(check);
            criHead.appendChild(criHeadTextNode);
            markHead.appendChild(markHeadTextNode);
            rowhead.appendChild(checkHead);
            rowhead.appendChild(criHead);
            rowhead.appendChild(markHead);
            table.appendChild(rowhead);
            for (var i in field) {
              if (
                field[i].split("_")[0] == exam &&
                field[i].split("_")[1] != "internal" &&
                field[i].split("_")[1] != "external"
              ) {
                var input = document.createElement("input");
                input.classList.add("form-check-input", "ml-3", "mt-n2");
                input.setAttribute("type", "checkbox");
                input.id = field[i];
                input.setAttribute("name", "criteria");
                var label = document.createElement("label");
                label.classList.add("form-weight-bold", "ml-n1");
                var labelTextNode = document.createTextNode(
                  field[i].split("_")[1].toUpperCase().replace("-", " ")
                );
                label.appendChild(labelTextNode);
                label.setAttribute("for", field[i]);
                var row = document.createElement("tr");
                var check = document.createElement("td");
                var cri_col = document.createElement("td");
                var mark = document.createElement("td");
                var markTextNode = document.createTextNode(
                  field[i].split("_")[2]
                );
                check.appendChild(input);
                cri_col.appendChild(label);
                mark.appendChild(markTextNode);
                row.appendChild(check);
                row.appendChild(cri_col);
                row.appendChild(mark);
                table.appendChild(row);
              }
            }
            form.appendChild(table);
            tablearea.appendChild(form);
            document.getElementById("final-card").classList.remove("d-none");
            var op = document.getElementById("operation-marks");
            op.classList.remove("d-none");
            op.classList.add("d-flex");
            var upload = document.getElementById("final-marks");
            upload.classList.remove("d-none");
            upload.classList.add("d-flex");
            document.getElementById("final-loader").style.display = "none";
            document.getElementById("final-loader").style.display = "none";
            $("#check-all").on("click", function () {
              var checkboxes = document.getElementsByName("criteria");
              if (this.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                  if (checkboxes[i].type == "checkbox") {
                    checkboxes[i].checked = true;
                  }
                }
              } else {
                for (var i = 0; i < checkboxes.length; i++) {
                  if (checkboxes[i].type == "checkbox") {
                    checkboxes[i].checked = false;
                  }
                }
              }
            });
          }
        }
      },
      error: function (e) {},
    });
  });
});
$(function () {
  $("#final-button").on("click", function (e) {
    document.getElementById("marks-error").style.display = "none";
    document.getElementById("marks-failed").style.display = "none";
    document.getElementById("marks-success").style.display = "none";
    document.getElementById(
      "final-button"
    ).innerHTML = `<div class="dot-opacity-loader-inside-button"><span></span><span></span><span></span></div>`;
    document
      .getElementById("final-button")
      .setAttribute("disabled", "disabled");
    var marks = document.getElementById("marks").value;
    marks = marks.trim();
    var choices = new Array();
    var chk_bx = document.getElementsByName("criteria");
    for (var i = 0; i < chk_bx.length; i++) {
      if (chk_bx[i].checked) {
        choices.push(chk_bx[i].id);
      }
    }
    var operation;
    var op = document.getElementsByName("operation");
    for (i = 0; i < op.length; i++) {
      if (op[i].checked) {
        operation = op[i].id;
      }
    }
    var sum = 0;
    for (var i in choices) {
      sum += parseInt(choices[i].split("_")[2]);
    }
    if (sum == parseInt(marks) || operation == "average") {
      var table = "mm_".concat($("#listofsub").val());
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "final-upload.php",
        datatype: "html",
        data: {
          username: username,
          auth_token: auth_token,
          column: choices,
          table: table,
          exam: localStorage.column,
          operation: operation,
          total: sum,
          totmark: marks,
        },
        success: function (result) {
          var parsedResult = JSON.parse(result);
          if (parsedResult != "false") {
            if (parsedResult == "success") {
              document.getElementById("marks-success").style.display = "block";
              document.getElementById("final-button").innerHTML =
                "Upload Marks";
              document
                .getElementById("final-button")
                .removeAttribute("disabled", "disabled");
            }
            if (parsedResult == "failed") {
              document.getElementById("marks-failed").style.display = "block";
              document.getElementById("final-button").innerHTML =
                "Upload Marks";
              document
                .getElementById("final-button")
                .removeAttribute("disabled", "disabled");
            }
          }
        },

        error: function (error) {},
      });
    } else {
      document.getElementById("marks-error").style.display = "block";
      document.getElementById("final-button").innerHTML = "Upload Marks";
      document
        .getElementById("final-button")
        .removeAttribute("disabled", "disabled");
    }
  });
});
