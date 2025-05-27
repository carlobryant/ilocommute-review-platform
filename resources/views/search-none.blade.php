@extends('search')

@section('window') 
@endsection

@section('results')
<div class="container mx-auto px-4 py-14" id="no-result" style="background-image: url('https://media2.giphy.com/media/v1.Y2lkPTc5MGI3NjExejNkMXFwajR1aDJmNDg4aWdzYXZyYWV1dWtuZXg0YmhtdnJvNG82bCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/gdQsQ3tzDYWxXxc0gd/giphy.gif'); background-position: right center; background-repeat: no-repeat; background-size: 300px 300px; opacity: 0;">
    <h2 class="text-7xl font-bold">No Tricycle Found.</h2>
    <h3 class="text-md mt-2">We're constantly updating our database with the latest information. Please check back soon for the most up-to-date content.</h3>
</div>
@endsection

@section('review')
<script>
     $(window).on('load', function(){
        $('#no-result').animate({opacity: 1}, 3000);
     });

</script> 
@endsection
