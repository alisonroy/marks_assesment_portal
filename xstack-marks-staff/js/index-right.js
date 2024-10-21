//getting auth details from localStorage
var username = localStorage.email;
var auth_token = localStorage.auth_token;

document.getElementById("home-shimmer-cards-container").style.display = "block";
document.getElementById("home-info-cards-container").style.display = "none";
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
      var user_type = parsedResponse.user_type;
      var fullname = document.getElementById("account-info-full-name");
      var fullnameTextNode = document.createTextNode(parsedResponse.full_name);
      fullname.appendChild(fullnameTextNode);
      var user_name = document.getElementById("account-info-email");
      var usernameTextNode = document.createTextNode(username);
      var usertype = document.getElementById("account-info-access-level");
      if (user_type == "hod") {
        var usertypeTextNode = document.createTextNode("Head of Department");
      } else {
        var usertypeTextNode = document.createTextNode(
          user_type.charAt(0).toUpperCase() + user_type.substr(1).toLowerCase()
        );
      }

      if (
        parsedResponse["department"] == "mgmt" &&
        parsedResponse["user_type"] == "admin" &&
        parsedResponse["isManagement"] == 1
      ) {
        document.getElementById("mgmt-views-card").classList.remove("d-none");
      }
      if (parsedResponse["user_type"] === "hod") {
        document.getElementById("hod-views-card").classList.remove("d-none");
      }
      if (parsedResponse["isClassAdvisor"] == 1) {
        document
          .getElementById("class-advisor-views-card")
          .classList.remove("d-none");
      }
      user_name.appendChild(usernameTextNode);
      usertype.appendChild(usertypeTextNode);

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
            var addCard = document.getElementById("addexam-sub");
            for (var i in parsedResponse1) {
              if (typeof parsedResponse1[i].semester !== "undefined") {
                var parahead = document.createElement("p");
                parahead.classList.add("mb-0", "font-weight-bold");
                parahead.style.color = "#676767";
                var paraheadTextNode = document.createTextNode(
                  parsedResponse1[i].subject_name
                );
                parahead.appendChild(paraheadTextNode);
                addCard.appendChild(parahead);
                var para = document.createElement("p");
                para.style.color = "#676767";
                var anchor = document.createElement("a");
                anchor.classList.add("nav-link");
                anchor.href = "addexam-page.php";
                anchor.id = parsedResponse1[i].subCode_dept_sem.toLowerCase();
                var it = document.createElement("i");
                it.style.color = "#545454";
                it.classList.add("mdi", "mdi-pen-plus", "menu-icon");
                anchor.appendChild(it);

                var span = document.createElement("span");
                span.classList.add("ml-2", "menu-title");
                span.style.color = "#676767";
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
                para.appendChild(anchor);
                addCard.appendChild(para);
              }
            }
            var flag = false;
            var theoryCard = document.getElementById("theorysub-body");
            var practicalCard = document.getElementById("practicalsub-body");
            for (var i in parsedResponse1) {
              if (typeof parsedResponse1[i].semester !== "undefined") {
                var parahead = document.createElement("p");
                parahead.classList.add("mb-0", "font-weight-bold");
                parahead.style.color = "#676767";
                var paraheadTextNode = document.createTextNode(
                  parsedResponse1[i].subject_name
                );
                parahead.appendChild(paraheadTextNode);
                var para = document.createElement("p");
                para.style.color = "#676767";
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
                span.classList.add("ml-2", "menu-title");
                span.style.color = "#676767";
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
                para.appendChild(anchor);
                if (
                  parsedResponse1[i].subject_type.split(" ")[0] == "Laboratory"
                ) {
                  practicalCard.appendChild(parahead);
                  practicalCard.appendChild(para);
                  flag = true;
                }
                if (
                  parsedResponse1[i].subject_type == "Regular" ||
                  parsedResponse1[i].subject_type == "Open Elective" ||
                  parsedResponse1[i].subject_type == "Professional Elective"
                ) {
                  theoryCard.appendChild(parahead);
                  theoryCard.appendChild(para);
                }
              }
            }
            if (flag == false) {
              document.getElementById("no-prac-sub").classList.remove("d-none");
            }
            var elements = document
              .getElementById("addexam-sub")
              .getElementsByTagName("a");
            for (var i in elements) {
              elements[i].onclick = function () {
                var table = "mm_";
                localStorage.setItem("subcode_dept_sem", this.id);
                localStorage.setItem("table", table.concat(this.id));
              };
            }
            var elements = document
              .getElementById("theorysub-body")
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
              .getElementById("practicalsub-body")
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
            document.getElementById(
              "home-shimmer-cards-container"
            ).style.display = "none";
            // show links

            document.getElementById("home-info-cards-container").style.display =
              "block";
          }
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
