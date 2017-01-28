$(function() {

    var splash = new Vue({
        el: "#splash",
        data: {
            splashHead: "Two Degrees of Kevin Bacon",
            subsplash: "Looking for Kevin Bacon and Kevin Bacon related things?",
            btnMsg: "Search"
        },
        methods: {
            goToMain: function() {
                $("html, body").animate({
                    scrollTop: $("#homeContent").offset().top
                }, 700);
                $(".forms").addClass("animated").addClass("fadeIn");
            } // goToMain
        }
    });

    var home = new Vue({
        el: "#homeContent",
        data: {
            homeHead: "Two Degrees of Kevin Bacon",
            tab1: "1st Degree",
            tab2: "2nd Degree",
            form1desc: "Search for all films with both a given actor and Kevin Bacon.",
            form2desc: "Search for all films within 2 degrees with both a given actor and Kevin Bacon.",
            formprompt: "Enter First and Last name",
            name: "",
            result: ""
        },
        methods: {
            callAjax: function(filename) {
                if (this.name.split(" ").length == 2) {
                    var first = this.name.split(" ")[0];
                    var last = this.name.split(" ")[1];
                    home.ajax(first, last, filename);
                } else if (this.name.split(" ").length == 3) {
                    var first = this.name.split(" ")[0] + " " + this.name.split(" ")[1];
                    var last = this.name.split(" ")[2];
                    home.ajax(first, last, filename);
                } else {
                    $(".results").html("");
                }
            },
            ajax: function(fname, lname, filename) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: filename,
                    data: {
                        firstName: fname,
                        lastName: lname
                    },
                    success: function(res) {
                        if (res["from"] == "1degree" || res["from"] == "2degree") {
                            this.result = parseJSON(res["data"]);
                        /*
                            $(".results").html(
                                    "<table class='table table-striped table-responsive'>" +
                                    "<thead> <tr>" +
                                    "<th>Actor Id</th> <th>First Name</th> <th>Last Name</th> <th>Movie ID</th> <th>Role</th>" +
                                    "</tr> </thead>" +
                                    "<tbody>" +
                                    "<tr v-for='row in result'>" +
                                    "<td> {{ row.actorID }} </td>" +
                                    "<td> {{ row.firstName }} </td>" +
                                    "<td> {{ row.lastName }} </td>" +
                                    "<td> {{ row.movieID }} </td>" +
                                    "<td> {{ row.role }} </td>" +
                                    "</tr>" +
                                    "</tbody>" +
                                    "</table>"
                                    );
                         **/
                        }
                    }
                });
            },
            preventSubmission: function(key) {
                if (key.which == 13 )
                    key.preventDefault();
            }
        }
    });

});
