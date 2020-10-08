@if(Session::has('comment_message'))

    <div class="alert alert-success col-sm-12">

        <p class="text-center">{{session('comment_message')}}</p>

    </div>




@endif
