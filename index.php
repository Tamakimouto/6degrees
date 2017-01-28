<!doctype html>

<html lang="en">

    <head>
        <title>MyMDb</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Anthony Zheng">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="css/bacon.css">
        <link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/vue@2.1.10/dist/vue.js"></script>
        <script src="js/script.js"></script>
    </head>

    <body>

        <div class="container-fluid text-center" id="splash">
            <div class="heading text-center animated fadeInDown">
                <h1> {{ splashHead }} </h1>
                <p> {{ subsplash }} </p>
            </div>
            <div class="scrollButton animated fadeIn" @click="goToMain">
                <p> {{ btnMsg }} </p>
            </div>
        </div>

        <div class="container text-center" id="homeContent">
            <div class="row">
                <div class="col-xs-12">
                    <h2> {{ homeHead }} </h2>
                </div>
            </div>

            <div class="row forms">
                <div class="col-xs-12 col-sm-offset-3 col-sm-6">

                    <!--

                    <div class="row">
                        <div class="col-xs-offset-3 col-xs-6">
                            <img class="img-responsive img-circle" src="img/kevinbacon3.jpg">
                        </div>
                    </div>

                    -->

                    <ul class="nav nav-tabs">
                        <li class="active" id="1"><a data-toggle="tab" href="#1degree"> {{ tab1 }} </a></li>
                        <li id="1"><a data-toggle="tab" href="#2degree"> {{ tab2 }} </a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="1degree">
                            <p> {{ form1desc }} </p>
                            <form>
                                <input
                                class="text-center"
                                type="text"
                                v-model.trim="name"
                                @input="callAjax('php/1degree.php')"
                                @keypress="preventSubmission"
                                :placeholder="formprompt">
                            </form>
                        </div>
                        <div class="tab-pane fade in" id="2degree">
                            <p> {{ form2desc }} </p>
                            <form>
                                <input
                                class="text-center"
                                type="text"
                                v-model.trim="name"
                                @input="callAjax('php/2degree.php')"
                                @keypress="preventSubmission"
                                :placeholder="formprompt">
                            </form>
                        </div>
                    </div>

                    <div class="results">
                        <!-- Results displayed here -->
                        <div v-if="mode == 1">
                            <table class="table table-striped table-affix table-responsive">
                                <thead>
                                    <tr>
                                        <th class="col-xs-2">Actor Id</th>
                                        <th class="col-xs-2">First Name</th>
                                        <th class="col-xs-2">Last Name</th>
                                        <th class="col-xs-2">Movie ID</th>
                                        <th class="col-xs-2">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="row in result">
                                        <td class="col-xs-2"> {{ row.actorID }} </td>
                                        <td class="col-xs-2"> {{ row.firstName }} </td>
                                        <td class="col-xs-2"> {{ row.lastName }} </td>
                                        <td class="col-xs-2"> {{ row.movieID }} </td>
                                        <td class="col-xs-2"> {{ row.role }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </body>

</html>
