<!doctype html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<script src="https://kit.fontawesome.com/0466296eb5.js" crossorigin="anonymous"></script>

    <script>
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    </script>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>Blog</title>

</head>
<body>
	<div style="text-align: center;"><h1>GitBlog</h1></div>
	<div class="container">
	    @foreach($posts as $post)

            <div class="card mb-3" >
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->contribution->title}}</h5>
                            <p class="card-text">{!!Str::limit($post->contribution->body, 500)!!}</p>
                            <p class="card-text"><small class="text-muted">Contributor: {!!$post->contribution->user->name!!}</small></p>
                            <a href="{{'/primary/article/pull/details/'.$post->contribution->id}}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>

				<!--button type="button" class="btn btn-dark" onclick="location.href='{{ url('/pull/'.$post->post->id) }}'" >Pull</button-->
				<!--button type="button" class="btn btn-warning">Edit</button-->
        @endforeach
        <p>Do you want to pull  from original Article? Click <a href="{{url('/primary/pull/'. $id)}}">here</a></p>
		{{ $posts->links() }}
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
