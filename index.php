<style>
    .watchlist{
        color:lightgrey;
    }
    .dropdown-menu a:hover{
        background-color:rgb(20,20,20) !important;
    }
    .dropdown-menu{
        color: lightgrey !important;
        border: 1px solid black !important;
        background-color:rgb(52, 58, 64)     !important;
    }
    #name{
        color:white;
    }
    body{
        background-color:rgb(52, 58, 64) !important;
    }
    ::-webkit-scrollbar {
        width: 12px;
        background: rgb(100, 100, 100);
    }

    ::-webkit-scrollbar-thumb {
        background: lightgrey;
        -webkit-border-radius: 1ex;
    }

    ::-webkit-scrollbar-corner {
        background: rgb(52, 58, 64);
    }
    .navbar {
        height: 80px; /* Set the desired height for the navbar */
        position: fixed !important;
        left:0px;
        right:0px;
    }

        /* Optional: Adjust padding for navbar items to align vertically */
    .height-prop {
        height:45px !important; /* Adjust as needed */
    }
    form{
        top:18px;
        right: 10px;
        position: absolute !important;
    }
    .custom-bg {
        background-color: rgb(20,20,20) !important;
    }
    .content{
        visibility:hidden;
    }
    #loading {
        height:40px;
        width:40px;
        visibility:hidden;
    }
    .modal-body {
        vertical-align:middle;
        color:white;
        display: flex;
        column-gap: 10px;
    }
    .modal-header{
        color:white;
    }
    .modal-content{
        border : 1px lightgrey solid !important;
        border-radius: 10px 10px !important;
        margin: auto !important;
        width:130% !important;
        left: 50%;
        transform: translate(-50%, 0%);
    }
    .modal-dialog{
        width:140% !important;
        position:fixed !important;
        top:50%;
        left: 50%;
        transform: translate(-50%, -50%);
        visibility:hidden;
    }
    h6{
        top:25px !important;
        position: absolute !important;
        right:10px;
    }
    h4{
        padding-right:120px;
    }
    .watchlist{
        padding-top:100px;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
        column-gap:0px;
    }
    img{
        height:281px;
        width:190px;
        border-radius: 10px 10px;
        cursor:pointer;
    }
    .movie{
        padding-top :10px;
        padding-bottom :10px;
        text-align: center;
    }
    .title{
        padding-top:5px;
        font-style: italic;
        font-weight:bold;
    }
    .glow{
        outline:4px solid !important;
    }
    .line{
        margin-bottom: 8px;
        padding-bottom:8px;
        border-bottom: solid lightgrey 1px;
    }
    .status{
        left: 15px !important;
        position: absolute;
    }
    .btnseen{
        display:none !important;
    }
    .dropdown, .reset{
        cursor:pointer;
        padding:5px 5px 5px 5px !important;
    }
    .navbar{
        position: fixed;
        z-index: 99999;
    }
</style>

<head>
    <script src="libs/jquery.js"></script>
    <script src="libs/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Watchlist</title>
</head>
<?php
    session_start();
    $_SESSION["url"] = "";
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<nav class="navbar navbar-expand-xl custom-bg">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle height-prop" type="button" id="status" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Watched status</button>
            <div class="dropdown-menu dropstatus" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item">Both</a>
                <a class="dropdown-item">Not watched</a>
                <a class="dropdown-item">Already watched</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle height-prop" type="button" id="order" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Order by</button>
            <div class="dropdown-menu droporder" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item">Movie rating</a>
                <a class="dropdown-item">Alphabetical order</a>
                <a class="dropdown-item">Year of release</a>
                <a class="dropdown-item">Length</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle height-prop" type="button" id="genre" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Type of movie</button>
            <div class="dropdown-menu dropgenre" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item">All</a>
                <a class="dropdown-item">Action</a>
                <a class="dropdown-item">Comedy</a>
                <a class="dropdown-item">Fantasy</a>
                <a class="dropdown-item">Romance</a>
                <a class="dropdown-item">Sci-Fi</a>
                <a class="dropdown-item">Western</a>
                <a class="dropdown-item">Drama</a>
                <a class="dropdown-item">Thriller</a>
                <a class="dropdown-item">Crime</a>
                <a class="dropdown-item">Mystery</a>
                <a class="dropdown-item">Adventure</a>
                <a class="dropdown-item">Biography</a>
                <a class="dropdown-item">Horror</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle height-prop" type="button" id="time" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Movie length</button>
            <div class="dropdown-menu droptime" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item">All</a>
                <a class="dropdown-item">&lt; 1h40</a>
                <a class="dropdown-item">1h40 - 2h00</a>
                <a class="dropdown-item">2h00 - 2h30</a>
                <a class="dropdown-item">2h30 &lt;</a>
            </div>
        </div>
        <div class="reset">
            <button class="btn btn-secondary my-2 my-sm-0 height-prop">Reset filters</button>
        </div>
    <form class="form-inline">
        <img id="loading" src="libs/spinner2.gif"/>&ensp;
        <input type="text" class="form-control mr-sm-2 height-prop custom-bg" placeholder="Search a movie" id="name" name="name"  aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0 height-prop">Search</button>
    </form>
    </div>
</nav>

<div>
    <div class="watchlist bg-dark"></div>

    <div class="modal-dialog">
        <div class="modal-content custom-bg">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary status btnseen">Movie seen</button>
                <button type="button" class="btn btn-primary addbtn">Add to watchlist</button>
                <button type="button" class="btn btn-danger rembtn">Remove from watchlist</button>
                <button type="button" class="btn btn-success watch">Watch now</button>
                <button type="button" class="btn btn-secondary closebtn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="content"></div>

<script>
    var title;
    var date;
    var duration
    var grade;
    var picture;
    var genre;
    var director;
    var writer;
    var actors;
    var synopsis;
    var filter = {};

    get_watchlist();

    function display_modal(title, date, duration, grade, picture, genre, director, writer, actors, synopsis){
        $("h4").html(title);
        $(".modal-header").append("<h6>" + date + "&ensp;" + duration + "&ensp;" + grade + " &starf;</h6>");
        $(".modal-body").prepend(picture);
        $(".modal-body .data").append("<p class='line'>Genre : " + genre + "</p>");
        $(".modal-body .data").append("<p>Director(s) : " + director + "</p>");
        $(".modal-body .data").append("<p>Writer(s) : " + writer + "</p>");
        $(".modal-body .data").append("<p class='line'>Actor(s) : " + actors + "</p>");
        $(".modal-body .data").append("<p>Synopsis : " + synopsis + "</p>");
        $(".modal-dialog").css("visibility", "visible");
    }

    function clear_modal(){
        $("h4").html("");
        $(".modal-header h6").remove();
        $(".modal-body .data").html("");
        $(".modal-body img").remove();
        $(".status").addClass("btnseen");
    }    

    function get_movie2(url="") {
        if (!url){
            url = "https://www.imdb.com/" + $(".ipc-metadata-list-summary-item__t").attr('href');
        }
        $(".content").html("");
        $(document).ready(function(){
            if (url) {
                $.ajax({
                    type: "POST",
                    url: 'get_movie2.php',
                    data: {
                        url : url,
                    },
                    datatype:"json",
                    success: function(oRep){
                        $(".content").html(oRep);
                        
                        if ($('.sc-d8941411-1').length==0){
                            title = $(".hero__primary-text").html();
                        }
                        else{
                            title = $(".sc-d8941411-1").html().substring(16);
                        }
                        date = $(".sc-d8941411-2 .ipc-link").html();
                        grade = $(".sc-bde20123-1").html();
                        duration = $(".sc-d8941411-2 .ipc-inline-list__item:nth-child(3)").html();
                        duration = duration.replace(" ", "");
                        if (duration.split('h')[1].length==0){
                            duration = duration + "00m";
                        }
                        else {
                            if (duration.split('h')[1].length==2){
                                duration = duration.substring(0,duration.length-2) + "0" + duration.substring(duration.length-2);
                            }
                        }
                        genre_x = $(".ipc-chip-list__scroller").children("a").length;
                        genre = ""; 
                        for(var i=0;i<genre_x;i++){
                            genre += $(".ipc-chip-list__scroller span:eq("+i.toString()+")").html();
                            if (i+1<genre_x){genre += ", ";}
                        }
                        synopsis = $(".sc-466bb6c-1").html();
                        director_x = $(".ipc-metadata-list-item__content-container:eq(0) ul").children().length;
                        director = "";
                        for(var i=0;i<director_x;i++){
                            director += $(".ipc-metadata-list-item__content-container:eq(0) a:eq("+i.toString()+")").html();
                            if (i+1<director_x){director += ", ";}
                        }
                        writer_x = $(".ipc-metadata-list-item__content-container:eq(1) ul").children().length;
                        writer = "";
                        for(var i=0;i<writer_x;i++){
                            writer += $(".ipc-metadata-list-item__content-container:eq(1) a:eq("+i.toString()+")").html();
                            if (i+1<writer_x){writer += ", ";}
                        }
                        actors_x = $(".ipc-metadata-list-item__content-container:eq(2) ul").children().length;
                        actors = "";
                        for(var i=0;i<actors_x;i++){
                            actors += $(".ipc-metadata-list-item__content-container:eq(2) a:eq("+i.toString()+")").html();
                            if (i+1<actors_x){actors += ", ";}
                        }
                        picture = $(".ipc-media").html();
                        $(".content").html("");

                        $(".content").remove();
                        clear_modal();
                        $(".addbtn").css("display","block");
                        $(".rembtn").css("display","none");
                        display_modal(title, date, duration, grade, picture, genre, director, writer, actors, synopsis);
                        $("#loading").css("visibility", "hidden");

                    },
                    error: function(){
                        alert("Erreur !");
                    },	
                });
        }
        });
    }

    $('form').submit(false);
    $("form").submit(function(){
        if ($("#name").val()!="") {
            get_movie($("#name").val());
        }
    });

    function search(title){
        $("#loading").css("visibility", "visible");
            $.ajax({
                type: "POST",
                url: 'get_movie1.php',
                data: {
                    view : title,
                },
                datatype:"json",
                success: function(oRep){
                    $(".content").html(oRep);
                },
                error: function(){
                    alert("Erreur !");
                },
            });
    }

    $(".closebtn").on( "click", function() {
        $(".modal-dialog").css("visibility", "hidden");
    });

    $(".addbtn").on( "click", function() {
        picture = picture.replaceAll("'", "&apos;");
        title = title.replaceAll("'", "&apos;");
        director = director.replaceAll("'", "&apos;");
        writer = writer.replaceAll("'", "&apos;");
        actors = actors.replaceAll("'", "&apos;");
        synopsis = synopsis.replaceAll("'", "&apos;");
        console.log(synopsis);
        $.ajax({
            type: "POST",
            url: "data_bdd.php" + "/add",
            data: {
                title:title,
                date:date,
                duration:duration,
                grade:grade,
                genre:genre,
                picture:picture,
                director:director,
                writer:writer,
                actors:actors,
                synopsis:synopsis,
            },
            datatype: "json",
            success: function(oRep) {
                console.log(title + " has been added to the watchlist !");
                location.reload(true);
            },
            error: function() {
                alert("Erreur !");
            },	
        });
    });

    $(document).on('keydown', function(event) {
        if (event.key == "Escape") {
            $(".modal-dialog").css("visibility", "hidden");
        }
   });

    $(".rembtn").on("click", function(){
        title = title.replaceAll("'", "&apos;");
        $.ajax({
            type: "POST",
            url: "data_bdd.php" + "/remove",
            data:{
                title_name:title,
            },
            datatype:"json",
            success: function(oRep) {
                console.log(title + " has been removed from the watchlist !");
                location.reload(true);
            },
            error: function() {
                alert("Erreur !");
            },	
        });
    });

    $(".btnseen").on("click", function(){
        $.ajax({
            type: "POST",
            url: "data_bdd.php" + "/seen",
            data:{
                title_name:title,
            },
            success: function(oRep) {
                get_watchlist(filter);
                if ($(".status").html()=="Movie seen"){
                    $(".status").html("Movie not seen");
                }
                else{
                    $(".status").html("Movie seen");
                }
            },
            error: function() {
                alert("Erreur !");
            },
        });
    });

    $(".dropgenre a").on("click", function(rep){
        $("#genre").html(rep.currentTarget.innerHTML);
        filter["genre"]=(rep.currentTarget.innerHTML=="All"?"":rep.currentTarget.innerHTML);
        get_watchlist(filter);
    });

    $(".dropstatus a").on("click", function(rep){
        $("#status").html(rep.currentTarget.innerHTML);
        filter["status"]=(rep.currentTarget.innerHTML=="Already watched"?"1":(rep.currentTarget.innerHTML=="Both"?"0":"2"));
        get_watchlist(filter);
    });

    $(".droporder a").on("click", function(rep){
        $("#order").html(rep.currentTarget.innerHTML);
        filter["order"]=rep.currentTarget.innerHTML;
        get_watchlist(filter);
    });
    $(".droptime a").on("click", function(rep){
        $("#time").html(rep.currentTarget.innerHTML);
        switch(rep.currentTarget.innerHTML){
            case "&lt; 1h40":
                delete filter["low"];
                filter["high"]="1h40";
                console.log(filter);
            break;
            case "1h40 - 2h00":
                filter["low"]="1h40";
                filter["high"]="2h00";
                console.log(filter);
            break;
            case "2h00 - 2h30":
                filter["low"]="2h00";
                filter["high"]="2h30";
                console.log(filter);
            break;
            case "2h30 &lt;":
                filter["low"]="2h30";
                delete filter["high"];
                console.log(filter);
            break;
            case "All":
                delete filter["low"];
                delete filter["high"];
                console.log(filter);
            break;
        }
        get_watchlist(filter);
    });

    $(".reset").on("click", function(){
        location.reload();
    })    

    $(".watch").on("click", function(){
        window.location.href = "https://soap2dayx.to/filter?keyword=" + title;
    })

    function get_watchlist(data={}){
        $(".watchlist").empty();
        $.ajax({
            type: "POST",
            url: "data_bdd.php" + "/movies",
            data:data,
            datatype:"json",
            success: function(oRep) {
                data = JSON.parse(oRep);
                for(var i=data.movies.length-1; i>=0; i--) {
                    movie_name = data.movies[i].title;
                    picture = data.movies[i].picture;
                    $(".watchlist").append("<div class='movie'>" + picture + "<p class='title'>" + movie_name + "</p>" + "</div>")
                }   
                $("img").attr('draggable', false);
                $(".movie img").hover(function(rep){
                    $('.movie img[alt="' + rep.currentTarget.alt +'"]').addClass("glow");
                },
                function(rep){
                    $('.movie img[alt="' + rep.currentTarget.alt +'"]').removeClass("glow");
                });
                $(".movie img").on("click", function(rep){
                    title = $('.movie img[alt="' + rep.currentTarget.alt +'"]').parent().children()[1].innerHTML;
                    clear_modal();
                    get_movie(title);
                });
            },
            error: function() {
                alert("Erreur !");
            },	
        });
    }
    
    function get_movie(name){
        title = name.replaceAll("'", "&apos;");
        $(".rembtn").css("display","block");
        $(".addbtn").css("display","none");
        $.ajax({
            type: "POST",
            url: "data_bdd.php" + "/movies",
            data: {
                title_name:title,
            },
            datatype:"json",
            success: function(oRep) {
                data = JSON.parse(oRep);
                if (data.movies.length){
                    title = data.movies[0].title;
                    grade = data.movies[0].grade;
                    duration = data.movies[0].duration;
                    year_of_release = data.movies[0].year_of_release;
                    genre = data.movies[0].genre;
                    synopsis = data.movies[0].synopsis;
                    watched_status = data.movies[0].watched_status;
                    actors = data.movies[0].actors;
                    director = data.movies[0].director;
                    writer = data.movies[0].writer;
                    picture = data.movies[0].picture;
                    clear_modal();
                    if (watched_status=="1"){
                        $(".status").html("Movie not seen");
                    }
                    else{
                        $(".status").html("Movie seen");
                    }
                    $(".status").removeClass("btnseen");
                    display_modal(title, year_of_release, duration, grade, picture, genre, director, writer, actors, synopsis);
                }
                else{
                    search(title);
                }

            },
            error: function() {
                alert("Erreur !");
            },	
        });
    }

</script>