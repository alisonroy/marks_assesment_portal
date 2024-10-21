//getting auth details from localStorage
var username = localStorage.email;
var auth_token = localStorage.auth_token;
//console.log("Auth Token from Auth status: " + auth_token);

if (auth_token === "" || username === "") {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const pageName = urlParams.get("page");
  //console.log(pageName);

  window.location.replace(
    "https://xstackhub.azurewebsites.net/xstack-iam/index.html?redirect=" +
      pageName
  );
  //window.location.replace("index.html");
} else {
  $.ajax({
    type: "POST",
    url: "https://xstackhub.azurewebsites.net/xstack-iam/auth-status.php",
    datatype: "html",
    data: {
      username: username,
      auth_token: auth_token,
    },
    success: function (response) {
      var parsedResponse = JSON.parse(response);
      console.log(parsedResponse);
      if (parsedResponse != "false") {
        // hide sidebar profile shimmer
        document.getElementById(
          "sidebar-profile-shimmer-container"
        ).style.display = "none";

        document.getElementById("current-user-full-name-container").innerHTML =
          parsedResponse.full_name;

        localStorage.full_name = parsedResponse.full_name;

        // setting department
        if (parsedResponse.department === "dit") {
          localStorage.setItem("department_full", "Information Technology");
        }

        if (parsedResponse.department === "dcse") {
          localStorage.setItem("department_full", "Computer Science");
        }

        if (parsedResponse.department === "deee") {
          localStorage.setItem("department_full", "Electrical and Electronics");
        }

        if (parsedResponse.department === "dece") {
          localStorage.setItem(
            "department_full",
            "Electronics and Communication"
          );
        }

        if (parsedResponse.department === "dme") {
          localStorage.setItem("department_full", "Mechanical");
        }

        if (parsedResponse.department === "dsh") {
          localStorage.setItem("department_full", "Science & Humanities");
        }

        if (parsedResponse.department === "mgmt") {
          localStorage.setItem("department_full", "Management");
        }

        document.getElementById("current-user-department-container").innerHTML =
          localStorage.department_full;
        var unformatted_picture_url = parsedResponse.picture_url;
        var picture_url = unformatted_picture_url.replace(/\\/g, "");
        document
          .getElementById("current-user-profile-picture")
          .setAttribute("src", picture_url);
        // hide topbar profile picture loader
        document.getElementById("topbar-profile-picture-loader").style.display =
          "none";
        // show topbar profile picture
        document.getElementById("current-user-profile-picture").style.display =
          "block";

        // rendering left sidebar links
        if (
          parsedResponse["department"] == "mgmt" &&
          parsedResponse["user_type"] == "admin" &&
          parsedResponse["isManagement"] == 1
        ) {
          document.getElementById("mgmt-views").classList.remove("d-none");
        }
        if (parsedResponse["user_type"] === "hod") {
          document.getElementById("hod-views").classList.remove("d-none");
        }
        if (parsedResponse["isClassAdvisor"] == 1) {
          document
            .getElementById("class-advisor-views")
            .classList.remove("d-none");
        }

        localStorage.user_type = parsedResponse.user_type;

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
            var theory = document.getElementById("theorysub");
            theory.classList.remove("d-none");
            var practical = document.getElementById("practicalsub");
            practical.classList.remove("d-none");
            for (var i in parsedResponse1) {
              if (typeof parsedResponse1[i].semester !== "undefined") {
                var list = document.createElement("li");
                list.classList.add("nav-item");

                var anchor = document.createElement("a");
                anchor.classList.add("nav-link");

                anchor.href = "editmarks-page.php";
                anchor.id = parsedResponse1[i].subCode_dept_sem;
                var it = document.createElement("i");
                it.style.color = "#545454";
                if (
                  parsedResponse1[i].subject_type.split(" ")[0] == "Laboratory"
                ) {
                  it.classList.add("mdi", "mdi-flask-outline", "menu-icon");
                }
                if (
                  parsedResponse1[i].subject_type == "Regular" ||
                  parsedResponse1[i].subject_type == "Open Elective" ||
                  parsedResponse1[i].subject_type == "Professional Elective"
                ) {
                  it.classList.add(
                    "mdi",
                    "mdi-book-open-page-variant",
                    "menu-icon"
                  );
                }

                anchor.appendChild(it);

                var span = document.createElement("span");
                span.classList.add("menu-title");
                var textnode = document.createTextNode(
                  parsedResponse1[i].subject_code +
                    " " +
                    parsedResponse1[i].subject_abbr +
                    " ( " +
                    parsedResponse1[i].department +
                    " " +
                    parsedResponse1[i].semester +
                    " )"
                );

                span.appendChild(textnode);
                anchor.appendChild(span);
                list.appendChild(anchor);
                if (
                  parsedResponse1[i].subject_type.split(" ")[0] == "Laboratory"
                ) {
                  practical.appendChild(list);
                  document
                    .getElementById("practicalsubhead")
                    .classList.remove("d-none");
                }
                if (
                  parsedResponse1[i].subject_type == "Regular" ||
                  parsedResponse1[i].subject_type == "Open Elective" ||
                  parsedResponse1[i].subject_type == "Professional Elective"
                ) {
                  theory.appendChild(list);
                  document
                    .getElementById("theorysubhead")
                    .classList.remove("d-none");
                }
              }
            }
            var collapse = document.getElementById("collapse");
            for (var i in parsedResponse1) {
              if (typeof parsedResponse1[i].semester !== "undefined") {
                var list = document.createElement("li");
                list.classList.add("nav-item");
                var anchor = document.createElement("a");
                anchor.classList.add("nav-link");
                anchor.href = "addexam-page.php";
                anchor.id = parsedResponse1[i].subCode_dept_sem.toLowerCase();
                var it = document.createElement("i");
                it.style.color = "#545454";
                it.classList.add("mdi", "mdi-pen-plus", "menu-icon");
                anchor.appendChild(it);

                var span = document.createElement("span");
                span.classList.add("menu-title");
                var textnode = document.createTextNode(
                  parsedResponse1[i].subject_code +
                    " " +
                    parsedResponse1[i].subject_abbr +
                    " ( " +
                    parsedResponse1[i].department +
                    " " +
                    parsedResponse1[i].semester +
                    " )"
                );

                span.appendChild(textnode);
                anchor.appendChild(span);
                list.appendChild(anchor);
                collapse.appendChild(list);
              }
            }
            var elements = document
              .getElementById("collapse")
              .getElementsByTagName("a");
            for (var i in elements) {
              elements[i].onclick = function () {
                var table = "mm_";
                localStorage.setItem("subcode_dept_sem", this.id);
                localStorage.setItem("table", table.concat(this.id));
              };
            }
            var elements = document
              .getElementById("theorysub")
              .getElementsByTagName("a");
            for (var i in elements) {
              elements[i].onclick = function () {
                var table = "mm_";
                localStorage.setItem("subcode_dept_sem", this.id);
                localStorage.setItem(
                  "table",
                  table.concat(this.id.toLowerCase())
                );
              };
            }
            var elements = document
              .getElementById("practicalsub")
              .getElementsByTagName("a");
            for (var i in elements) {
              elements[i].onclick = function () {
                var table = "mm_";
                localStorage.setItem("subcode_dept_sem", this.id);
                localStorage.setItem(
                  "table",
                  table.concat(this.id.toLowerCase())
                );
              };
            }
            // hide shimmer
            document.getElementById("u_0_v_sidebar").classList.add("d-none");
            // show links
            document
              .getElementById("sidebar-links-container")
              .classList.remove("d-none");
          },
          error: function (error) {},
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
}
