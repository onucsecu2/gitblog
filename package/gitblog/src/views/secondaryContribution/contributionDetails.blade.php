<!doctype html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<script src="https://kit.fontawesome.com/0466296eb5.js" crossorigin="anonymous"></script>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>Blog</title>
    <style>
        suggest {color: green;}
        remove {color: darkred;}
    </style>
</head>
<body>
	<div style="text-align: center;"><h1>GitBlog</h1></div>
	<div class="row">
		<div class="col-md-2 center" >
			<div class="position-fixed">
		    <div class="card border-0">
              <div class="card-body">
					<ul>

					<li style="list-style-type: none;"><i class="fas fa-thumbs-up">--</i></li>
         			<li style="list-style-type: none;"><i class="fas fa-eye">--</i></li>
         			<li style="list-style-type: none;"><i class="fa fa-pencil-square-o" aria-hidden="true">--</i></li>
         			<li style="list-style-type: none;"><i class="fa fa-book" aria-hidden="true">--</i></li>
         			</ul>

              </div>
            </div>
		    <div class="card border-0">
              <div class="card-body">
					<ul>
					<li style="list-style-type: none;">
						<button disabled   type="button" class="btn btn-light " data-toggle="tooltip" data-placement="top" title="Lock this story">
							<i class="fa fa-unlock" aria-hidden="true"></i>
						</button>
					</li>
         			<li  style="list-style-type: none;">
         				<button disabled type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Turn on notification for this story">
         				<i class="fa fa-bell" aria-hidden="true"></i>
         				</button>
         			</li>
         			<li style="list-style-type: none;">
                        <a href="{{ url('/secondary/pull/all/'. $post->id)}}" >
                            <button  type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Turn on notification for this story">
                                <i class="fa fa-code-fork" aria-hidden="true"></i>
                            </button>
                        </a>
         			</li>
         			<li style="list-style-type: none;">
         				<button disabled   type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Save this story">
         					<i class="fa fa-bookmark-o" aria-hidden="true"></i>
         				</button>
         			</li>
         			<li  style="list-style-type: none;">
         				<button disabled  type="button" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Add a episode of this story">
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
                        <p class="card-text">{!!$post->body!!}</p>
                        <p class="card-text"><small class="text-muted">Contributed by: {!!$post->user->name!!}</small></p>
                    </div>
        		</div>
      		</div>
    	</div>
    </div>
				<!--button type="button" class="btn btn-dark" onclick="location.href='{{ url('/secondary/pull/'.$post->id) }}'" >Pull</button-->
				<!--button type="button" class="btn btn-warning">Edit</button-->
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
