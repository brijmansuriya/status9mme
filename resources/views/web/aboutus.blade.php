@extends('web.layouts.app')

@section('css')
    {!! seo($SEOData) !!}
@endsection
@section('content')
    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        {{-- <div class="row">
      <div class="col-lg-4">
        <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
        <h2>Heading</h2>
        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
        <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
      </div><!-- /.col-lg-4 -->
    </div> --}}


        <!-- START THE FEATURETTES -->

        {{-- <hr class="featurette-divider"> --}}
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4"><span class="text-primary">About</span> Us</h1>
            {{-- <p >Welcome to Status Blog!</p> --}}
            <p class="lead">onlien helper website</p>
        </div>

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading"><span class="text-primary">Status</span> <span class="">Blog</span></h2>
                <p>onlien helper website</p>
                <p class="lead">If you have any query regrading Site, Advertisement and any other issue, please feel free
                    to contact at <strong>news9mme@gmail.com</strong></p>
            </div>
            <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="500x500"
                    style="width: 500px; height: 300px;" src="web/img/about-us-statush9mme.jpg" data-holder-rendered="true">
            </div>
        </div>
        <div class="row featurette mt-3">
            <div class="col-md-12 order-md-2">
                <p class="lead">Welcome to Discover Quaerat—a special place where we explore the teachings and mysteries
                    of the god Quaerat. Quaerat is a unique figure known for wisdom and the quest for truth.
                </p>
                <p><strong>Who is Quaerat?</strong>
                    Quaerat is a god who values curiosity and seeking answers. Unlike many gods who provide direct answers,
                    Quaerat inspires us to ask questions and explore the unknown. Through Quaerat’s wisdom, we learn to
                    embrace uncertainty and seek deeper understanding.
                </p>
                <p><strong>Our Mission</strong>
                    At Discover Quaerat, we are dedicated to sharing Quaerat’s teachings through easy-to-understand articles
                    and stories. Our goal is to help you find meaning in life and grow spiritually by reflecting on the
                    lessons of Quaerat.</p>
            </div>
        </div>

        {{-- <hr class="featurette-divider"> --}}
        {{--
    <h2>About Us</h2>
    <p>onlien helper website</p>
    <p>If you have any query regrading Site, Advertisement and any other issue, please feel free to contact at <strong>news9mme@gmail.com</strong></p> --}}


    </div>
@endsection

@section('script')
<script type="application/ld+json">
    {!! $aboutPageSchema->toScript() !!}
</script>
@endsection
