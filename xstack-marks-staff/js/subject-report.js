var username = localStorage.email;
var auth_token = localStorage.auth_token;

document.getElementById("subjectpageloader").style.display = "block";
document.getElementById("subreportscontainer").style.display = "none";
document.getElementById("subjectreportsloader").style.display = "none";

var tablesub = new Array();
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
      subReport.innerHTML = "";
      var option1 = document.createElement("option");
      var selTextNode = document.createTextNode("Select Subject");
      option1.disabled = "true";
      option1.selected = "true";
      option1.appendChild(selTextNode);
      var option2 = document.createElement("option");
      var allTextNode = document.createTextNode("All Subjects");
      option2.value = "all";
      option2.appendChild(allTextNode);
      subReport.appendChild(option1);
      subReport.appendChild(option2);
      tablesub.length = 0;
      for (var i in parsedResponse1) {
        if (typeof parsedResponse1[i].semester !== "undefined") {
          tablesub.push(
            "mm_".concat(parsedResponse1[i].subCode_dept_sem.toLowerCase())
          );
          var option = document.createElement("option");
          var subTextNode = document.createTextNode(
            parsedResponse1[i].subject_name
          );
          option.value = parsedResponse1[i].subCode_dept_sem.toLowerCase();
          option.appendChild(subTextNode);
          subReport.appendChild(option);
        }
      }
      document.getElementById("subjectpageloader").style.display = "none";
      document.getElementById("subreportscontainer").style.display = "block";
    }
  },
  error: function (error) {},
});

$(function () {
  $("#listofsub").on("change", function (e) {
    document.getElementById("subjectreportsloader").style.display = "block";
    if ($("#listofsub").val() == "all") {
      var tables = tablesub.concat();
    } else {
      var tables = ["mm_".concat($("#listofsub").val()).toLowerCase()];
    }
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
          var option1 = document.createElement("option");
          var selTextNode = document.createTextNode("Select Exam");
          option1.disabled = "true";
          option1.selected = "true";
          option1.appendChild(selTextNode);
          var option2 = document.createElement("option");
          var allTextNode = document.createTextNode("All Exams");
          option2.value = "all";
          option2.appendChild(allTextNode);
          exam.appendChild(option1);
          exam.appendChild(option2);
          var exams = new Array();
          for (var i in parsedExam) {
            if (
              parsedExam[i] != "register_no" &&
              typeof parsedExam[i] !== "object"
            ) {
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
          document.getElementById("subjectreportsloader").style.display =
            "none";
        }
      },
      error: function (e) {},
    });
  });
});

$(function () {
  $("#sub-view").on("click", function (e) {
    document.getElementById("subjectreportsloader").style.display = "block";
    if ($("#listofsub").val() == "all") {
      var tables = tablesub.concat();
    } else {
      var tables = ["mm_".concat($("#listofsub").val()).toLowerCase()];
    }
    var exam = $("#listofexam").val();
    var report_type = $("#report-type").val();
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "subject-report.php",
      datatype: "html",
      data: {
        username: username,
        auth_token: auth_token,
        tables: tables,
        exam: exam,
        type: report_type,
      },
      success: function (responsePath) {
        var parsedPath = JSON.parse(responsePath);
        if (parsedPath != "false") {
          document.getElementById("subjectreportsloader").style.display =
            "none";
          document.getElementById("subject-Iframe").classList.remove("d-none");
          document.getElementById("sub-utilities").classList.remove("d-none");
          document.getElementById("sub-utilities").classList.add("d-flex");
          var fileName = parsedPath.replace(/\\/g, "/");
          var api =
            "https://view.officeapps.live.com/op/embed.aspx?src=xstackhub.azurewebsites.net/xstack-marks-staff/";
          var filePath =
            "https://xstackhub.azurewebsites.net/xstack-marks-staff/";
          var excelUrl = api.concat(fileName);
          var downloadUrl = filePath.concat(fileName);
          document.getElementById(
            "sub-report-download"
          ).href = downloadUrl.replace(/['"]+/g, "");
          document
            .getElementById("subject-Iframe")
            .setAttribute("src", excelUrl.replace(/['"]+/g, ""));
        }
      },
      error: function (e) {},
    });
  });
});
