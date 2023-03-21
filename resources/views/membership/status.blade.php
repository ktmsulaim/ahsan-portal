@include('components.header', ['body_class' => 'website', 'title' => 'Apply for membership'])
<div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
    <div class="mdk-header__content">

        <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-dark  pr-0" id="navbar" data-primary>
            <div class="container-fluid p-0">

                <!-- Navbar Brand -->
                <a href="{{ route('welcome') }}" class="navbar-brand ">

                    <img src="{{ asset('img/icon.png') }}" alt="Ahsan Logo mini" width="35">

                    <span>Ahsan</span>
                </a>

            </div>
        </div>

    </div>
</div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header__title">Check status</div>
                    </div>
                    <div class="card-body card-form__body">
                        @if (!$checked)
                        <p>Enter your registered email to check your application status.</p>
                        <form action="{{ route('membership.getStatus') }}" method="post">
                            @csrf
                            <input type="hidden" name="checked" value="true">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Your email address" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        @endif

                        <div class="mt-4">
                            @if ($user)
                                <img src="{{ $user->photo() }}" alt="Member photo" class="img-fluid" width="130">
                                <h4 class="mb-1 mt-3">{{ $user->name }}</h4>
                                <p class="mb-1">{{ $user->email }}</p>
                                <p>
                                    <b>Status: </b> 
                                    @if ($user->status == 1)
                                        <span class="badge badge-success">Verified</span>
                                    @else
                                        <span class="badge badge-danger">Not verified</span>
                                    @endif
                                </p>
                            @elseif(@$checked)
                                <p class="text-danger">Sorry! no application was found</p>
                            @endif
                        </div>

                    </div>
                    @if ($checked)
                        <div class="card-footer">
                            <a href="{{ route('membership.status') }}" class="btn btn-secondary btn-sm">Check again</a>
                        </div>
                    @endif
                </div>
                <p>Not yet applied? <a href="{{ route('membership.apply') }}">Apply now</a></p>
            </div>
        </div>
    </div>

@include('components.footer')