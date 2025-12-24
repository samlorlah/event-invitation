@extends('layouts.app')

@section('content')
<div class="container">
    <div id="invite_button">
        <button type="button" id="btn_add_guest" class="btn btn-primary">Invite New Guest</button>
        {-- <a href="{{ route('viewUploadedPhotos') }}" class="btn btn-danger">View Uploaded Pictures</a> --}
        <button type="button" id="btn_back_to_guest" class="btn btn-primary d-none my-4">Back</button>
    </div>
    <div id="guest_table" class="mt-5">
        <div class="row">
            <div class="col-md-12">
                @php
                    $admitted = 0;
                    $remaining = 0;
                    $total = 0;

                    foreach ($guests as $guest) {
                        $admitted += $guest->counter;
                        $total += $guest->no_of_invite;
                    }

                    $remaining = $total - $admitted;
                @endphp
                <div class="d-flex justify-content-between">                     
                    <span>Total Admitted: <strong>{{ $admitted }}</strong></span> <br />
                    <span>Total Remaining: <strong>{{ $remaining }}</strong></span> <br /> <br />
                    <h5>Total Invites: <strong>{{ $total }}</strong></h5>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>LIST OF GUESTS</h4>
                        
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">FULL NAME</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">PHONE NUMBER</th>
                                {{-- <th scope="col">NO OF INVITES</th> --}}
                                <th scope="col">INVITATION STATUS</th>
                                <th scope="col">SCAN STATUS</th>
                                <th scope="col">ACTION</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($guests as $guest)
                                    <tr>
                                        <th>{{ $loop->index + 1 }}</th>
                                        <td>{{ $guest->full_name }}</td>
                                        <td>{{ $guest->email }}</td>
                                        <td>{{ $guest->phone_no }}</td>
                                        {{-- <td>{{ $guest->no_of_invite }}</td> --}}
                                        <td>@if($guest->invitation_sent == 0) <span class="text-danger"> Invitation Email Pending </span> @elseif($guest->invitation_sent == 1)<span class="text-success"> Invitation Email Sent </span> @endif</td>
                                        <td>@if($guest->counter < $guest->no_of_invite) <span class="text-success">Unscanned</span>  @elseif($guest->counter == $guest->no_of_invite) <span class="text-danger">Scanned</span> @endif</td>
                                        <td>@if($guest->counter < $guest->no_of_invite) <a href="{{ route('resendInvite', $guest->id) }}" class="btn btn-link">Resend Invite</a> <a href="#" onclick="deleteGuest({{ $guest->id }})" class="btn text-danger">Delete Invite</a> @endif</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="invite_form" class="d-none">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>Invite New Guest</h4></div>
                    <div class="card-body">
                        <h5 class="text-success" id="success_response"></h5>
                        <h5 class="text-error" style="color: #ff0000; padding: 10px 0" id="error_response"></h5>
                        <form action="">
                            <div class="form-group">
                                {{-- <label for="full_name">Full Name</label> --}}
                                <input type="text" class="form-control" id="full_name" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                {{-- <label for="email_address">Email address</label> --}}
                                <input type="email" class="form-control" id="email_address" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                {{-- <label for="phone_no">Phone Number</label> --}}
                                <input type="text" class="form-control" id="phone_no" placeholder="Phone Number">
                            </div>
                            <div class="row">
                                <div class="col-sm-8 offset-sm-2">
                                    <button type="button" id="btn_submit_guest" class="btn btn-block btn-primary">Submit</button>
                                </div>
                            </div>
                            <input type="hidden" id="base_url" value="{{ url('/') }}">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>Bulk Invitation</h4></div>
                    <div class="card-body">
                        <h5 class="text-success" id="success_response"></h5>
                        <h5 class="text-error" style="color: #ff0000; padding: 10px 0" id="error_response"></h5>
                        <form action="{{ route('bulkInvitation') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                {{-- <label for="full_name">Full Name</label> --}}
                                <input type="file" class="form-control" id="bulk_guest" name="bulk_guest">
                            </div>
                            <div class="row">
                                <div class="col-sm-8 offset-sm-2">
                                    <button type="submit" class="btn btn-block btn-primary">Upload</button>
                                </div>
                            </div>
                            <input type="hidden" id="base_url" value="{{ url('/') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection
@section('script')
    <script src="{{ asset('js/action.js') }}"></script>
@endsection 
