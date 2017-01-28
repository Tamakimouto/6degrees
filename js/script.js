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
            mode: 1,
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
