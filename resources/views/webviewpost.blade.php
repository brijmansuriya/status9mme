<label for="title">title</label>
<br>
<br>
{{ $post->title}}
<br>
<br>
<label for="image">image</label>
<br>
<br>

<img src="{{$post->image}}" alt="">
<br>
<br>
<label for="description">description</label>
<br>
<br>
{!! $post->description !!}
<br>
<br>
<label for="meta_description">meta_description</label>
<br>
<br>
{{$post->meta_description}}
<br>
<br>
<label for="url">url</label>
<br>
<br>
{{$post->url }}
<br>
<br>