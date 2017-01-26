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
            }
        }
    });

    var home = new Vue({
        el: "#homeContent",
        data: {
            homeHead: "Two Degrees of Kevin Bacon",
            tab1: "1st Degree",
            tab2: "2nd Degree",
            form1desc: "Search for all films with both a given actor and Kevin Bacon.",
            form2desc: "Search for all films within 2 degrees with both a given actor and Kevin Bacon."
        }
    });

});
