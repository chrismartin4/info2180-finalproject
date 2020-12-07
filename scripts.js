function validation() {
    /*declaration of variables*/
    var fname = document.form.fname;
    var lname = document.form.lname;
    var pword = document.form.pword;
    var email = document.form.email;
    return validCheck();
    function validCheck() {
        nameValid();
        pwordValid();
        emailValid();
        if (nameValid() == true && pwordValid() == true && emailValid() == true) {
            return true;
        } else {
            return false;
        }
    }
    function nameValid() {
        var state = true;
        if (fname.value == "") {
            fname.style.border = " 3px solid red";
            state = false;
        } else {
            fname.style.border = "3px solid lightgreen";
            state = true;
        }
        if (lname.value == "") {
            lname.style.border = " 3px solid red";
            state = false;
        } else {
            lname.style.border = "3px solid lightgreen";
            state = true;
        }
        return state;
    }
    function emailValid() {
        var state = true;
        if (validEmail(email.value) == false || email.value == "") {
            email.style.border = " 3px solid red";
            state = false;
        } else {
            email.style.border = "3px solid lightgreen";
            state = true;
        }
        return state;
    }
    function pwordValid() {
        var state = true;
        if (alphaCheck(pword.value) == false || pword.value == "") {
            pword.style.border = " 3px solid red";
            state = false;
        } else {
            pword.style.border = "3px solid lightgreen";
            state = true;
        }
        return state;
    }
    function alphaCheck(str) {
        var comletter = /[a-z]/;
        var number = /[0-9]/;
        var capletter = /[A-Z]/;
        var valid = number.test(str) && comletter.test(str) && capletter.test(str);
        return valid;
    }
    function validEmail(str) {
        var email = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var valid = email.test(str);
        return valid;
    }
}

function logOut() {
    window.location.assign("logout.php")
}


function newUser() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("IssueSection").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "newuser.php", true);
    xhttp.send();
}

function newIssue() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("IssueSection").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "newissue.php", true);
    xhttp.send();
}

function home() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("IssueSection").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "home.php", true);
    xhttp.send();
}



function issueDetails(test) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("IssueSection").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "issuedetails.php?query=" + test, true);
    xhttp.send();
}

function markC() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("IssueSection").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "mark.php?query=CLOSED", true);
    xhttp.send();
}

function markP() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("IssueSection").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "mark.php?query=IN PROGRESS", true);
    xhttp.send();
}

function statusUpdated() {
    alert("Status has been updated successfully");
}

function filterAll() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("IssueSection").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "filters.php?query=all", true);
    xhttp.send();
}

function filterOpen() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("IssueSection").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "filters.php?query=open", true);
    xhttp.send();
}

function filterMyTickets() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("IssueSection").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "filters.php?query=mine", true);
    xhttp.send();
}