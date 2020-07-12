<!doctype html>
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<script src="https://kit.fontawesome.com/0466296eb5.js" crossorigin="anonymous"></script>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>Blog</title>
	<style type="text/css">
	ul.edit_tools {
        display: none;
        list-style: none;
        box-shadow: 5px 5px 10px rgba(0,0,0,.5);
        border: solid 1px #000;
        position: absolute;
        background:#16181c;
        border-radius: 5px;
        padding:0px 0px 0px 0px;
    }
    ul.edit_tools li {
        align:center;

        margin: 5px;
        padding: 5px 5px 5px 5px;
        cursor: pointer;
    }
	ul.tools {
        display: none;
        list-style: none;
        box-shadow: 5px 5px 10px rgba(0,0,0,.5);
        border: solid 1px #000;
        position: absolute;
        background:#16181c;
        border-radius: 5px;
        padding:0px 0px 0px 0px;
    }
    ul.tools li {
        align:center;
        display: inline-block;
        margin: 5px;
        padding: 5px 5px 5px 5px;
        cursor: pointer;
    }
	.divider{
    width:5px;
    height:auto;
    display:inline-block;
    }
	</style>

</head>
<body>

	<center><h1>GitBlog</h1></center>
	<div class="row">
		<div class="col-md-2 center" >
			<div class="position-fixed">
		    <div class="card border-0">
              <div class="card-body">
					<ul>
					<li style="list-style-type: none;">
						<div style="display:inline;">
							<span>
								<Button><i class="fas fa-thumbs-up"></i></Button>
							</span>
							<span id="votes"></span>
						</div>
					</li>
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
                 				<a href="{{ url('/pull/all/'. $post->id)}}" style="text-decoration: none; color: inherit;">
                 					<i class="fa fa-code-fork" aria-hidden="true"></i>
                 				</a>
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
         			<li style="list-style-type: none;"><i class="fa fa-book" aria-hidden="true">--</i></li>
         			<li style="list-style-type: none;">
						<div style="display:inline;">
							<span id="see_edit">
								<Button><i class="fas fa-brain"></i></Button>
							</span>

						</div>
					</li>
         			</ul>

              </div>
            </div>
		    <div class="card border-0">
              <div class="card-body">
					<ul>
					<li style="list-style-type: none;">
						<button  type="button" class="btn btn-light " data-toggle="tooltip" data-placement="top" title="Lock this story">
							<i class="fa fa-unlock" aria-hidden="true"></i>
						</button>
					</li>
         			<li style="list-style-type: none;">
         				<button  type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Turn on notification for this story">
         				<i class="fa fa-bell" aria-hidden="true"></i>
         				</button>
         			</li>
         			<li style="list-style-type: none;">
         				<a href="{{ url('/pull/'. $post->id)}}" >
         				<button  type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Turn on notification for this story">
         				<i class="fa fa-code-fork" aria-hidden="true"></i>
         				</button>
         				</a>
         			</li>
         			<li style="list-style-type: none;">
         				<button  type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Save this story">
         					<i class="fa fa-bookmark-o" aria-hidden="true"></i>
         				</button>
         			</li>
         			<li style="list-style-type: none;">
         				<button  type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Add a episode of this story">
         					<i class="fa fa-plus-square" aria-hidden="true"></i>
         				</button>
         			</li>
         			</ul>

              </div>
            </div>
            </div>
		</div>
	<div class="col-md-8">

    	<div class="card mb-3" >
      		<div class="row no-gutters">
        		<div class="col-md-12">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <div id="story" >
                            <p  class="card-text">{!!$post->body!!}</p>
                            <ul class="tools">
                                <li><i id="upvote_line" style="color:white" class="fas fa-thumbs-up"></i></li>
                                <li><i id="downvote_line"style="color:white" class="fas fa-thumbs-down"></i></li>
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
    </div>
	</div>
	<!-- Optional JavaScript -->
	<script type="text/javascript">
		var post_id={{$post->id}};
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
		var st,en;
		var selectedText;
		$(function(){
		  $("#story").on('mouseup', function(e){
		    var thisText = $(this).html();
		    var tmpText = getSelectionText();
		    var start = thisText.indexOf(tmpText);
		    var end = start + tmpText.length;
		    if (start >0 && end > 0){
		        console.log("start: " + start);
		        console.log("end: " + end);
		        st=start;
		        en=end;
		        selectedText=tmpText;
		    }
	        if(tmpText != ''){
	            $('ul.tools').css({
	                'left': pageX - 200,
	                'top' : pageY - 100
	            }).fadeIn(200);

	        } else {
	            $('ul.tools').fadeOut(200);
	        }

		  });
		  $("#story").on("mousedown", function(e){
		        pageX = e.pageX;
		        pageY = e.pageY;
		    });
		});
		$(document).on("mousedown", function(e){
 			  $('ul.tools').fadeOut(200);
		});


		$("#edit_line").click(function(e) {
		    e.preventDefault();
            $('ul.edit_tools').css({
                'left': pageX - 300,
                'top' : pageY - 0
            }).fadeIn(200);
            console.log(selectedText);
            if(selectedText.length > 300){
            	$("#edit_frame").text("<b>Selected Text is too big to edit</b>");
            }else{

            	$("#edit_frame").val(selectedText);
            }

		});
		$("#cancel_edit").click(function(e) {
		    e.preventDefault();
		    $('ul.edit_tools').fadeOut(200);
		});
		$("#save_edit").click(function(e) {
		    e.preventDefault();
		    console.log("hehe");
		    var body=$( "#edit_frame" ).val();
		    var ref=$( "#edit_ref" ).val();

		    $.ajax({
		        type: "POST",
		        url: "http://127.0.0.1:8000/api/post/info/edit",
		        data: {
		            start: st,
		            end: en,
		            postId: post_id,
		            body:body,
		            ref:ref,
		        },
	    		headers: {
	     		    'Authorization': 'Bearer {{$token}}'
	     		},
		        success: function(result) {
		            console.log(result);
		        },
		        error: function(result) {
		            console.log(result);
		        }
		    });
		    $('ul.edit_tools').fadeOut(200);
		});
		$("#upvote_line").click(function(e) {
		    e.preventDefault();
		    $.ajax({
		        type: "POST",
		        url: "http://127.0.0.1:8000/api/post/info/vote",
		        data: {
		            start: st,
		            end: en,
		            vote:+1,
		            postId: post_id,
		        },
	    		headers: {
	     		    'Authorization': 'Bearer {{$token}}'
	     		},
		        success: function(result) {
		            console.log(result);
		        },
		        error: function(result) {
		            console.log(result);
		        }
		    });
		});
		$("#downvote_line").click(function(e) {
		    e.preventDefault();
		    $.ajax({
		        type: "POST",
		        url: "http://127.0.0.1:8000/api/post/info/vote",
		        data: {
		            start: st,
		            end: en,
		            vote:-1,
		            postId: post_id,
		        },
	    		headers: {
	     		    'Authorization': 'Bearer {{$token}}'
	     		},
		        success: function(result) {
		            console.log(result);
		        },
		        error: function(result) {
		            console.log(result);
		        }
		    });
		});

	</script>
	<script type="text/javascript">

		$(document).ready(function(){
    		$.ajax({
    		   url: 'http://127.0.0.1:8000/api/get/info/{{$post->id}}',
    		   type: 'GET',
    		   dataType: 'json',
    		   headers: {
    		      'Authorization': 'Bearer {{$token}}'
    		   },
    		   success: function (result) {
//     		       console.log(result);
    		       document.getElementById("views").innerHTML =result['view'];
    		       document.getElementById("pulls").innerHTML =result['pull'];
    		       document.getElementById("votes").innerHTML =result['vote'];
    		       document.getElementById("edits").innerHTML =result['edit'];
    		   },
    		   error: function (error) {
    			   console.log(error);
    		   }
    		});
	 });
	$("#see_edit").click(function(e) {
		    e.preventDefault();

	});
	</script>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- 	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
