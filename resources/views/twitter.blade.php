<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>MyTweetz</title>
    <link rel="stylesheet" href="https://bootswatch.com/journal/bootstrap.min.css">
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">MyTweetz</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">
      <form class="well" action="{{route('post.tweet')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @if(count($errors) > 0)
          @foreach($errors->all() as $error)
            <div class="alert alert-danger">
              {{$error}}
            </div>
          @endforeach
        @endif

        <div class="form-group">
          <label>Tweet Text:</label>
          <input type="text" name="tweet" class="form-control">
        </div>

        <div class="form-group">
          <label>Upload Images:</label>
          <input type="file" name="images[]" multiple class="form-control">
        </div>

        <div class="form-group">
          <button class="btn btn-success">Create Tweet</button>
        </div>
      </form>

      @if(!empty($data))
        @foreach($data as $key => $tweet)
          <div class="well">
            <h3>{{$tweet['text']}}
              <i class="glyphicon glyphicon-heart"></i> {{$tweet['favorite_count']}}
              <i class="glyphicon glyphicon-repeat"></i> {{$tweet['retweet_count']}}
            </h3>
            @if(!empty($tweet['extended_entities']['media']))
              @foreach($tweet['extended_entities']['media'] as $i)
                <img src="{{$i['media_url_https']}}" style="width:100px;">
              @endforeach
            @endif
          </div>
        @endforeach
      @else
        <p>No Tweets Found...</p>
      @endif
    </div>
  </body>
</html>
