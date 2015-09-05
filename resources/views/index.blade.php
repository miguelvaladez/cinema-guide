<!DOCTYPE html>
<html>
    <head>
        <title>Cinema Guide</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    </head>
    <body>

        <div id="app" class="container">

            <h1>Cinema Guide</h1>

            <hr>

            <article id="cinema-list" v-repeat="cinema in cinemas" v-class="hidden: selectedCinema">
                <h3>@{{ cinema.name }}</h3>
                <a v-on="click: setCinema(cinema)" href="#">View Sessions</a>
                <hr>
            </article>

            <div v-class="hidden: selectedCinema">
                <button v-on="click: loadDataSet(prev_page_url)" class="btn btn-secondary" v-class="hidden: !prev_page_url">Previous</button>
                <button v-on="click: loadDataSet(next_page_url)" class="btn btn-primary pull-right">Next</button>
            </div>

            <div id="selected-cinema" v-if="selectedCinema">
                <h3>@{{ selectedCinema.name }}</h3>
                <label>Movies and Times: </label>
                <ul>
                    <li v-repeat="session in sessions">@{{ session.movie.title }} on @{{ session.session_time }}</li>
                </ul>
                <button v-on="click: unsetCinema" class="btn btn-primary">Go Back</button>
            </div>



        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
