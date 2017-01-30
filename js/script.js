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
            tab3: "#1 Genre",
            tab4: "#1 Actor",
            tab5: "Directors",
            mode: 1,
            form1desc: "Search for all films with both a given actor and Kevin Bacon.",
            form2desc: "All actors within 2 degrees of Kevin Bacon.",
            form3desc: "Here is the genre with the most amount of movies, has nothing to do with Kevin Bacon.",
            form4desc: "Search for the actor who has played in the most movies of a certain genre. Could be Kevin Bacon.",
            form5desc: "All actors who have also directed movies, is Kevin Bacon on the list?",
            formprompt: "Enter First and Last name",
            formprompt2: "Enter a Genre",
            name: "",
            genre: "",
            result: []
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
                } else
                    home.clearView();
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
                    success: function(res) { home.updateView(res); }
                });
            },
            preventSubmission: function(key) {
                if (key.which == 13 )
                    key.preventDefault();
            },
            autoCallAjax: function(md, filename) {
                console.log("calling" + filename);
                this.mode = md;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: filename,
                    success: function(res) { home.updateView(res); },
                    error: function(req, textStatus, err) {
                        console.log(textStatus + ": " + err);
                    }
                });
            },
            search2Genre: function() {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "php/2genre.php",
                    data: {
                        genre: this.genre
                    },
                    success: function(res) { home.updateView(res); }
                });
            },
            updateMode: function(md) {
                home.mode = md;
                home.result = [];
                home.result.pop(); /* <-- This triggers the view update - It's important */
            },
            updateView: function(res) {
                home.result = [];
                home.result.pop(); /* <-- This triggers the view update - It's important */
                res["data"].forEach(function(row) {
                    home.result.push(row);
                });
                console.log(home.result);
            },
            clearView: function() { home.result = []; home.result.pop(); }
        }
    });

});
