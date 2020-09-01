<!doctype html>
<html lang="en">
<head>
    <!-- TinyMCE JavaScript -->
    <meta content="{{$token}}"/>
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
        ul.edit_tools {
            display: none;
            list-style: none;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, .5);
            border: solid 1px #000;
            position: absolute;
            background: #16181c;
            border-radius: 5px;
            padding: 0px 0px 0px 0px;
        }
        ul.edit_tools li {
            alignment: center;
            margin: 5px;
            padding: 5px 5px 5px 5px;
            cursor: pointer;
        }
        ul.tools {
            display: none;
            list-style: none;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, .5);
            border: solid 1px #000;
            position: absolute;
            background: #16181c;
            border-radius: 5px;
            padding: 0px 0px 0px 0px;
        }
        ul.tools li {
            align: center;
            display: inline-block;
            margin: 5px;
            padding: 5px 5px 5px 5px;
            cursor: pointer;
        }
        .divider {
            width: 5px;
            height: auto;
            display: inline-block;
        }
    </style>

</head>
<body>
<div style="text-align: center;"><h1>GitBlog</h1></div>
<div class="row mx-md-n1">
    <div class="col-md-2 center">
        <div class="position-fixed">
            <div class="card border-0">
                <div class="card-body">
                    <ul>
                        <li style="list-style-type: none;">
                            <div style="display:inline;">
                            <span>
                                <i class="fas fa-eye"></i>
                            </span>
                                <span id="views">
                            </span>
                            </div>
                        </li>
                        <li style="list-style-type: none;">
                            <div style="display:inline;">
                                <span>
                                        <i class="fas fa-layer-group" aria-hidden="true"></i>
                                </span>
                                <span id="pulls">
                                </span>
                            </div>
                        </li>
                        <li style="list-style-type: none;">
                            <div style="display:inline;">
                                <span>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </span>
                                <span id="edits">
                                </span>
                            </div>
                        </li>
                        <li style="list-style-type: none;">
                            <div style="display:inline;">
         					<span>
         					<i class="fas fa-thumbs-up" aria-hidden="true"></i>
         					</span>
                                <span id="votes">
         					</span>
                            </div>
                        </li>
                        <li style="list-style-type: none;">
                            <div style="display:inline;">
                                <span><i class="fa fa-book" aria-hidden="true"></i></span>
                                <span id="episodes">0</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-body">
                    <ul>
                        <li style="list-style-type: none;">
                            <button id="thumbs_up" type="button" class="btn btn-light" data-toggle="tooltip"
                                    data-placement="top" title="Like this post! ">
                            </button>
                        </li>
                        @if($post->user_id==\Illuminate\Support\Facades\Auth::id())
                            <li style="list-style-type: none;">
                                <button id="secure" type="button" class="btn btn-light " data-toggle="tooltip"
                                        data-placement="top" title="Lock this story">
                                </button>
                            </li>
                        @endif
                        <li style="list-style-type: none;">
                            <button type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top"
                                    title="Turn on notification for this story">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                            </button>
                        </li>
                        <li style="list-style-type: none;">
                            <button id="fork" onclick="window.location='{{ url('primary/pull/all/'. $post->id)}}'"
                                    class="btn btn-light" data-placement="top" data-toggle="tooltip"
                                    title="Pull to contribute your ideas" type="button">
                                <i class="fa fa-code-fork" aria-hidden="true"></i>
                            </button>

                        </li>
                        <li style="list-style-type: none;">
                            <button id="bookmark" type="button" class="btn btn-light" data-toggle="tooltip"
                                    data-placement="top" title="Save this story">

                            </button>
                        </li>
                        <li style="list-style-type: none;">
                            <button type="button" onclick="window.location='{{url('/addEpisode/'.$post->id)}}'"
                                    class="btn btn-light" data-toggle="tooltip" data-placement="top"
                                    title="Add a episode of this story">
                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <div id="story">
                            <p class="card-text">{!!$post->body!!}</p>
                            <ul class="tools">
                                <li><i class="fas fa-thumbs-up" id="upvote_line" style="color:white"></i></li>
                                <li><i class="fas fa-thumbs-down" id="downvote_line" style="color:white"></i></li>
                                <li><i id="edit_line" style="color:white" class="fas fa-edit"></i></li>
                                <li><i style="color:white" class="fas fa-comment-alt"></i></li>
                                <li><i style="color:white" class="fab fa-facebook-square"></i></li>
                            </ul>
                            <ul class="edit_tools">
                                <li><textarea id="edit_frame" class="form-control" rows="3"></textarea></li>
                                <li style="color:white;">Reference:</li>
                                <li><textarea id="edit_ref" class="form-control" rows="2"></textarea></li>
                                <li style="align:center;display: inline-block;">
                                    <button id="save_edit" type="button" class="btn btn-info">Submit</button>
                                    <button id="cancel_edit" type="button" class="btn btn-danger">Cancel</button>
                                </li>
                            </ul>
                        </div>
                        <p class="card-text"><small class="text-muted">Author: {!!$post->user->name!!}</small></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3" style="background: rgba(230,230,230,0.58)">
            <div class="card-body">
                <p>Comments</p>
                <form  onsubmit="addComment()">
                    @csrf
                    <textarea style="width: 100%;" id="comment_text"></textarea>
                    <button  style="margin: 10px; white-space: nowrap" type="submit" class="btn btn-primary">Submit</button>
                </form>
                <script>
                    let elementS;
                    let elementT;
                    let elem_a;
                    let cnt_reply;
                    let elem_b;
                </script>
                <div id="comment_section"></div>
            </div>
        </div>
    </div>
    <div class="col-md-2 center">
        <div>
            @if(count($episodes)>0)
            <div class="card border-1">
                <div class="card-body">
                    <b class="card-title">Episodes</b>
                    <ul>
                    @foreach($episodes as $episode)
                        <li onclick="window.location='{{ url('/post/details/'. $episode->episode_post->slug)}}'" style="list-style-type: none;cursor: pointer;"　>{{$episode->episode_post->title}}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<script type="text/javascript">
    var post_id ={{$post->id}};
    function getSelectionText() {
        var text = "";
        if (window.getSelection) {
            text = window.getSelection().toString();
        } else if (document.selection && document.selection.type != "Control") {
            text = document.selection.createRange().text;
        }
        return text;
    }
    let pageX;
    let pageY;
    let st, en;
    let selectedText;
    $(function () {
        $("#story").on('mouseup', function (e) {
            let thisText = $(this).html();
            let tmpText = getSelectionText();
            let start = thisText.indexOf(tmpText);
            let end = start + tmpText.length;
            if (start > 0 && end > 0) {
                console.log("start: " + start);
                console.log("end: " + end);
                st = start;
                en = end;
                selectedText = tmpText;
            }
            if (tmpText != '') {
                $('ul.tools').css({
                    'left': pageX - 200,
                    'top': pageY - 100
                }).fadeIn(200);

            } else {
                $('ul.tools').fadeOut(200);
            }

        });
        $("#story").on("mousedown", function (e) {
            pageX = e.pageX;
            pageY = e.pageY;
        });
    });
    $(document).on("mousedown", function (e) {
        $('ul.tools').fadeOut(200);
    });
    $("#edit_line").click(function (e) {
        e.preventDefault();
        $('ul.edit_tools').css({
            'left': pageX - 300,
            'top': pageY - 0
        }).fadeIn(200);
        console.log(selectedText);
        if (selectedText.length > 300) {
            $("#edit_frame").text("<b>Selected Text is too big to edit</b>");
        } else {

            $("#edit_frame").val(selectedText);
        }

    });
    $("#cancel_edit").click(function (e) {
        e.preventDefault();
        $('ul.edit_tools').fadeOut(200);
    });
    $("#save_edit").click(function (e) {
        e.preventDefault();
        var body = $("#edit_frame").val();
        var ref = $("#edit_ref").val();

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/post/info/edit",
            data: {
                start: st,
                end: en,
                post_id: post_id,
                body: body,
                ref: ref,
            },
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
            }
        });
        $('ul.edit_tools').fadeOut(200);
    });
    $("#upvote_line").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/post/info/vote",
            data: {
                start: st,
                end: en,
                vote: +1,
                post_id: post_id,
            },
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
            }
        });
    });
    $('#downvote_line').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/post/info/vote",
            data: {
                start: st,
                end: en,
                vote: -1,
                post_id: post_id,
            },
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
            }
        });
    });
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
                console.log(result);
                document.getElementById("views").innerHTML = result['view'];
                document.getElementById("pulls").innerHTML = result['pull'];
                document.getElementById("votes").innerHTML = result['vote'];
                document.getElementById("edits").innerHTML = result['edit'];
                if (result['secure']) {
                    $("#fork").prop("disabled", true);
                }
                updateAppearanceThumbsUp(result['vote_status']);
                updateAppearanceBookmark(result['save']);
                updateAppearanceSecure(result['secure']);

            },
            error: function (error) {
                console.log(error);
            }
        });
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/views/article",
            data: {
                post_id: post_id,
            },
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
            },
            error: function (result) {
                console.log(result);
            }
        });
        $.ajax({
            url: 'http://127.0.0.1:8000/api/get/comments/{{$post->id}}',
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
                updateAppearanceComment(result['comments']);
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
<script type="text/javascript">
    $("#thumbs_up").click(function (e) {
        e.preventDefault();

        let vote = getVoteStatus();

        changeVoteCounter(vote);
        let v = 0;
        if (vote) {
            v = -1;
        } else {
            v = 1;
        }
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/post/vote",
            data: {
                post_id: post_id,
                vote: v,

            },
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
            }
        });
    });
    function changeVoteCounter(vote) {
        let element = document.getElementById("votes");
        let number = element.innerHTML;
        let n = parseInt(number);
        if (vote) {
            n = n - 1;
            updateAppearanceThumbsUp(false);
        } else {
            n = n + 1;
            updateAppearanceThumbsUp(true);
        }
        element.innerHTML = n.toString();
    }
    function getVoteStatus() {
        let element = document.getElementById("thumbs_up").children[0];
        let class_name = element.getAttribute("class");
        if (class_name == "fas fa-thumbs-up") {
            return true;
        } else {
            return false;
        }
    }
    function updateAppearanceThumbsUp(resultElement) {
        let $element = document.getElementById("thumbs_up");
        $element.innerHTML = '';
        if (resultElement == true) {
            $element.innerHTML = ("<i class='fas fa-thumbs-up' area-hidden='true'></i>");
        } else {
            $element.innerHTML = ("<i class='far fa-thumbs-up' area-hidden='true'></i>");
        }
    }
</script>
<script type="text/javascript">
    $("#bookmark").click(function (e) {
        e.preventDefault();

        let bookmark = getBookmarkStatus();

        updateAppearanceBookmark(!bookmark);
        let cmd = 0;
        if (bookmark) {
            cmd = -1;
        } else {
            cmd = 1;
        }
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/saved/article",
            data: {
                post_id: post_id,
                command: cmd,

            },
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
                console.log(result);
            },
            error: function (result) {
                console.log(result);
            }
        });
    });
    function getBookmarkStatus() {
        let element = document.getElementById("bookmark").children[0];
        let class_name = element.getAttribute("class");
        if (class_name == "fas fa-bookmark") {
            return true;
        } else {
            return false;
        }
    }
    function updateAppearanceBookmark(resultElement) {
        let $element = document.getElementById("bookmark");
        $element.innerHTML = '';
        if (resultElement == true) {
            $element.innerHTML = ("<i class='fas fa-bookmark' aria-hidden='true'></i>");
        } else {
            $element.innerHTML = ("<i class='fa fa-bookmark-o' aria-hidden='true'></i>");

        }
    }
</script>
<script type="text/javascript">

    $("#secure").click(function (e) {
        e.preventDefault();

        let secure = getSecureStatus();

        updateAppearanceSecure(!secure);
        let cmd = 0;
        if (secure) {
            cmd = -1;
        } else {
            cmd = 1;
        }
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/secure/article",
            data: {
                post_id: post_id,
                command: cmd,
            },
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
            },
            error: function (result) {
                console.log(result);
            }
        });
    });
    function getSecureStatus() {
        let element = document.getElementById("secure").children[0];
        let class_name = element.getAttribute("class");
        if (class_name == "fas fa-lock") {
            return true;
        } else {
            return false;
        }
    }
    function updateAppearanceSecure(resultElement) {

        let $element = document.getElementById("secure");
        $element.innerHTML = '';
        if (resultElement == true) {
            $element.innerHTML = ("<i class='fas fa-lock' aria-hidden='true'></i>");
        } else {
            $element.innerHTML = ("<i class='fas fa-lock-open' aria-hidden='true'></i>");
        }

    }
</script>
<script type="text/javascript">
    function addComment() {
        let text = document.getElementById('comment_text').value;

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/post/comment",
            data: {
                body: text,
                post_id: post_id,
            },
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {
               // console.log(result);
            },
            error: function (result) {
                console.log(result);
            }
        });
    }
    function showReplyBox(element,id) {

        let parent=element.parentElement;
        parent.innerHTML="<textarea style='width: 100%';></textarea>"+
                        "<button  style='margin: 10px; white-space: nowrap;' onclick='storeReply(this,"+id+")' type='submit' class='btn btn-primary'>Reply</button>";
    }
    function showReply(element,id) {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/get/reply/'+id,
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {

                updateAppearanceReplies(element,result,id);
            },
            error: function (error) {
                console.log(error);
            }
        });

    }
    function storeReply(element,comment_id){
        let text=element.previousSibling.value;
        if(text.length>0) {
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/comment/reply",
                data: {
                    body: text,
                    comment_id: comment_id,
                },
                headers: {
                    'Authorization': 'Bearer {{$token}}'
                },
                success: function (result) {
                    // console.log(result);
                },
                error: function (result) {
                    console.log(result);
                }
            });
        }
        element.previousSibling.value='';
        showReply(element,comment_id);
    }
    function updateAppearanceComment(elementResult){
        console.log(elementResult);
        let element=document.getElementById('comment_section');
        element.innerHTML=null;
        for(let i=0;i<elementResult['data'].length;i++) {

            let view_replies=' ';
            if(elementResult['data'][i]['replies']>0){
                if(elementResult['data'][i]['replies']>1){
                    view_replies="<a style='margin-left:25px;cursor:pointer;color:#1d68a7;' onclick='showReply(this,"+elementResult['data'][i]['comment_id']+")'  >View Replies</a>";
                }else{
                    view_replies="<a style='margin-left:25px;cursor:pointer;color:#1d68a7;'  onclick='showReply(this,"+elementResult['data'][i]['comment_id']+")' >View Reply</a>";
                }
            }
            element.innerHTML +=
                "<br>" +
                "<div>"+
                    "<div style='background: rgba(253,253,253,0.58)'>" +
                        "<div><b>" + elementResult['data'][i]['name'] + "</b></div>" +
                        "<div>" +
                            "<p class='card-text'>" + elementResult['data'][i]['body'] + "</p>"+
                        "</div>"+
                    "</div>"+
                    "<div id='comment_component' style='margin-top: 10px;'>"+
                        "<a style='cursor:pointer;color:#1d68a7;'  onclick='showReplyBox(this,"+elementResult['data'][i]['comment_id']+")'>Reply</a>"+
                        view_replies+
                    "</div>"+
                "</div>";
        }
        if(elementResult['next_page_url']!=null) {
            let next_load = document.createElement("a");
            next_load.setAttribute('id', "next_comment");
            next_load.setAttribute('onclick', 'loadMoreComments(\'' + elementResult['next_page_url'] + '\')');
            next_load.setAttribute('style', 'color:#1d68a7;cursor:pointer;');
            next_load.innerText = "Next";
            element.appendChild(next_load)
        }
        if(elementResult['prev_page_url']!=null) {
            let prev_load = document.createElement("a");
            prev_load.setAttribute('id', "prev_comment");
            prev_load.setAttribute('onclick', 'loadMoreComments(\'' + elementResult['prev_page_url'] + '\')');
            prev_load.setAttribute('style', 'color:#1d68a7;cursor:pointer;margin-left:15px;');
            prev_load.innerText = "Previous";
            element.appendChild(prev_load)
        }
    }
    function  loadMoreComments(urls) {
        $.ajax({
            url: urls,
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {

                updateAppearanceComment(result['comments']);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    function  loadMoreReplies(urls,id,element) {
        $.ajax({
            url: urls,
            type: 'GET',
            dataType: 'json',
            headers: {
                'Authorization': 'Bearer {{$token}}'
            },
            success: function (result) {

                updateAppearanceReplies(element,result,id);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    // <div style='background: rgba(253,253,253,0.58)'>
    //     <div>
    //         <b>name</b>
    //     </div>
    //     <div>
    //         <p class='card-text'> commentssaasdaf</p>
    //     </div>
    // </div>
    function updateAppearanceReplies(element,result,id){
        console.log(result);
        let parent=element.parentElement;
        parent.innerHTML='';
        parent.innerHTML="<textarea style='width: 100%';></textarea>"+
            "<button  style='margin: 10px; white-space: nowrap;' onclick='storeReply(this,"+id+")' type='submit' class='btn btn-primary'>Reply</button>";
        for(let i=0;i<result['replies']['data'].length;i++) {
            let divElem=document.createElement('div');
            divElem.setAttribute('style','background: rgba(253,253,253,0.58);margin-left:20px;');
            let nameDiv=document.createElement('div');
            let nameBold=document.createElement('b');
            nameBold.innerText=result['replies']['data'][i]['name'];
            nameDiv.appendChild(nameBold);
            let replyDiv=document.createElement('div')
            replyDiv.innerHTML="<p>"+result['replies']['data'][i]['body']+"</p>";
            divElem.appendChild(nameDiv);
            divElem.appendChild(replyDiv);
            parent.appendChild(divElem);
            if(result['replies']['next_page_url']!=null) {
                let next_load = document.createElement("a");
                next_load.setAttribute('id', "next_reply");
                next_load.setAttribute('onclick', 'loadMoreReplies(\'' + result['replies']['next_page_url']+ '\','+id+',this)');
                next_load.setAttribute('style', 'color:#1d68a7;cursor:pointer;margin-right:15px;');
                next_load.innerText = "View More Replies";
                parent.appendChild(next_load)
            }
            if(result['replies']['prev_page_url']!=null) {
                let prev_load = document.createElement("a");
                prev_load.setAttribute('id', "prev_reply");
                prev_load.setAttribute('onclick', 'loadMoreReplies(\'' + result['replies']['prev_page_url']+ '\','+id+',this)');
                prev_load.setAttribute('style', 'color:#1d68a7;cursor:pointer;');
                prev_load.innerText = "View Previous Replies";
                parent.appendChild(prev_load)
            }
        }
    }

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

