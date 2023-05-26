@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<div class="container mt-2">
    <div class="row">

            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('reviews.create') }}"> Create Review</a>
            </div>

    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @foreach ($reviews as $review)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $review->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product type:</strong>
                {{ $review->product_type }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Review:</strong>
                {{ $review->review }}
            </div>
        </div>
        <form action="{{ route('reviews.destroy',$review->id) }}" method="Post">
            <a class="btn btn-primary" href="{{ route('reviews.edit',$review->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <br>
        <hr style="margin-top:10px;">
        <br>
    </div>
        @endforeach
        {!! $reviews->links() !!}

</div>
</body>
</html>
@endsection
