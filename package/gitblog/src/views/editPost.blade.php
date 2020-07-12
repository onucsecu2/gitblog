<!doctype html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <script src="https://kit.fontawesome.com/0466296eb5.js" crossorigin="anonymous"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Blog</title>
    <style type="text/css">
        .divider {
            width: 5px;
            height: auto;
            display: inline-block;
        }
    </style>

</head>
<body>

<div style="text-align: center;"><h1>GitBlog</h1></div>
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <div id="story">
                            <p class="card-text">{!!$post->body!!}</p>
                        </div>
                        <p class="card-text"><small class="text-muted">Author: {!!$post->user->name!!}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="col-md-4">

    </div>
</div>
<!-- Optional JavaScript -->
<script type="text/javascript">
    var post_id ={{$post->id}};

    // 		console.log(post_id);
    function getSelectionText() {
        var text = "";
        if (window.getSelection) {
            text = window.getSelection().toString();
        } else if (document.selection && document.selection.type != "Control") {
            text = document.selection.createRange().text;
        }
        // console.log(text);
        return text;
    }

    var pageX;
    var pageY;
    var st, en;
    var selectedText;

</script>
<script type="text/javascript">

    $(document).ready(function () {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/get/info/{{$post->id}}',
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
                let html = $('#story').html();
                for(let i=0;i<result['edit_lists'].length;i++) {
                    let si = result['edit_lists'][i]['start'];
                    let ei = result['edit_lists'][i]['end'];
                    let bdy = result['edit_lists'][i]['body'];
                    
                    html = html.substring(0, si+(7*i)) + "<s>" + html.substring(si+(7*i));
                    html = html.substring(0, ei + 3+(7*i)) + "</s>" + html.substring(ei + 3+(7*i));
                }
                $("#story").html(html);

            },
            error: function (error) {
                console.log(error);
            }
        });
    });
    $("#see_edit").click(function (e) {
        e.preventDefault();

    });
</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- 	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
</body>
</html>
