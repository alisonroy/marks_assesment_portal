//getting auth details from localStorage
var username = localStorage.email;
var auth_token = localStorage.auth_token;

document.getElementById("classpageloader").style.display = "block";
document.getElementById("reportscontainer").style.display = "none";
document.getElementById("advisorreportsloader").style.display = "none";
$.ajax({
  type: "POST",
  url: "staff-details.php",
  datatype: "html",
  data: {
    username: username,
    auth_token: auth_token,
  },
  success: function (response) {
    var parsedResponse = JSON.parse(response);
    console.log(parsedResponse);
    var tablesub = new Array();
    var exams = new Array();
    if (parsedResponse != "false") {
      if (parsedResponse["isClassAdvisor"] == 1) {
        document.getElementById("dept").classList.remove("d-none");
        document.getElementById("dept").value = localStorage.department_full;
        if (
          parsedResponse["semester"] == "1" ||
          parsedResponse["semester"] == "2"
        ) {
          document.getElementById("year").classList.remove("d-none");
          document.getElementById("year").value = "I";
        }
        if (
          parsedResponse["semester"] == "3" ||
          parsedResponse["semester"] == "4"
        ) {
          document.getElementById("year").classList.remove("d-none");
          document.getElementById("year").value = "II";
        }
        if (
          parsedResponse["semester"] == "5" ||
          parsedResponse["semester"] == "6"
        ) {
          document.getElementById("year").classList.remove("d-none");
          document.getElementById("year").value = "III";
        }
        if (
          parsedResponse["semester"] == "7" ||
          parsedResponse["semester"] == "8"
        ) {
          document.getElementById("year").classList.remove("d-none");
          document.getElementById("year").value = "IV";
        }
      }
      localStorage.user_type = parsedResponse.user_type;
      var dept = parsedResponse["department"];
      var sem = parsedResponse["semester"];
      $.ajax({
        type: "POST",
        url: "advisor-classview-drop.php",
        datatype: "html",
        data: {
          username: username,
          auth_token: auth_token,
          department: dept,
          semester: sem,
        },
        success: function (response) {
          var parsedSub = JSON.parse(response);
          console.log(parsedSub);
          if (parsedSub != "false") {
            var subject = document.getElementById("listofsub");
            subject.innerHTML = "";
            var option1 = document.createElement("option");
            var selTextNode = document.createTextNode("Select Subject");
            option1.disabled = "true";
            option1.selected = "true";
            option1.appendChild(selTextNode);
            var option2 = document.createElement("option");
            var allTextNode = document.createTextNode("All Subjects");
            option2.value = "all";
            option2.appendChild(allTextNode);
            subject.appendChild(option1);
            subject.appendChild(option2);
            tablesub.length = 0;
            for (var i in parsedSub) {
              if (typeof parsedSub[i].subject_code != "undefined") {
                tablesub.push(
                  "mm_".concat(
                    parsedSub[i].subject_code.toLowerCase(),
                    "_",
                    dept,
                    "_",
                    sem
                  )
                );
                var option = document.createElement("option");
                var subjectTextNode = document.createTextNode(
                  parsedSub[i].subject_name
                );
                option.value = parsedSub[i].subject_code.concat(
                  "_",
                  dept,
                  "_",
                  sem
                );
                option.appendChild(subjectTextNode);
                subject.appendChild(option);
              }
            }
            document.getElementById("classpageloader").style.display = "none";
            document.getElementById("reportscontainer").style.display = "block";
          }
        },
        error: function (e) {},
      });
      $(function () {
        $("#listofsub").on("change", function (e) {
          document.getElementById("advisorreportsloader").style.display =
            "block";
          console.log(tablesub);
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
                exams.length = 0;
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
                document.getElementById("advisorreportsloader").style.display =
                  "none";
              }
            },
            error: function (e) {},
          });
        });
      });
      $(function () {
        $("#class-view").on("click", function (e) {
          document.getElementById("advisorreportsloader").style.display =
            "block";
          if ($("#listofsub").val() == "all") {
            var tables = tablesub.concat();
          } else {
            var tables = ["mm_".concat($("#listofsub").val()).toLowerCase()];
          }
          if ($("#listofexam").val() == "all") {
            var examcon = exams.concat();
          } else {
            var examcon = [$("#listofexam").val()];
          }
          var exam = $("#listofexam").val();
          var report_type = $("#report-type").val();
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "advisor-classview.php",
            datatype: "html",
            data: {
              username: username,
              auth_token: auth_token,
              tables: tables,
              examcum: exam,
              examcon: examcon,
              type: report_type,
            },
            success: function (responsePath) {
              var parsedPath = JSON.parse(responsePath);
              if (parsedPath != "false") {
                document.getElementById("advisorreportsloader").style.display =
                  "none";
                document
                  .getElementById("advisor-Iframe")
                  .classList.remove("d-none");
                document
                  .getElementById("advisor-utilities")
                  .classList.remove("d-none");
                document
                  .getElementById("advisor-utilities")
                  .classList.add("d-flex");
                var fileName = parsedPath.replace(/\\/g, "/");
                var api =
                  "https://view.officeapps.live.com/op/embed.aspx?src=xstackhub.azurewebsites.net/xstack-marks-staff/";
                var filePath =
                  "https://xstackhub.azurewebsites.net/xstack-marks-staff/";
                var excelUrl = api.concat(fileName);
                var downloadUrl = filePath.concat(fileName);
                document.getElementById(
                  "advisor-report-download"
                ).href = downloadUrl.replace(/['"]+/g, "");
                document
                  .getElementById("advisor-Iframe")
                  .setAttribute("src", excelUrl.replace(/['"]+/g, ""));
              }
            },
            error: function (e) {},
          });
        });
      });
    }
  },

  error: function (error) {},
});
