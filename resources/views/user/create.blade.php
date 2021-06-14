@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebars.user-sidebar')
@endsection

@section('content')
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            {{session('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Basic Vertical form layout section start -->
    <section id="basic-vertical-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Invitaiton Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-vertical" method="POST" action="/invitation">
                            @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="fullname">Full Name <code>*</code></label>
                                                    <input type="text" id="fullname" class="form-control" name="full_name" placeholder="Full Name" value="{{old('full_name')}}" required>
                                                    @if($errors->has('full_name'))
                                                        <p><small class="text-danger">{{$errors->first('full_name')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="nickname">Nick Name <code>*</code></label>
                                                    <input type="text" id="nickname" class="form-control" name="nick_name" placeholder="Nickname" value="{{old('nick_name')}}" required>
                                                    @if($errors->has('nick_name'))
                                                        <p><small class="text-danger">{{$errors->first('nick_name')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="phone-number">No. Handphone (Active Whatsapp) <code>*</code></label>
                                                    <input type="text" id="phone-number" class="form-control" name="wa_number" placeholder="Phone Number" value="{{old('wa_number')}}" required>
                                                    @if($errors->has('wa_number'))
                                                        <p><small class="text-danger">{{$errors->first('wa_number')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="organization-name">Name of Organization <code>*</code></label>
                                                    <input type="text" id="organization-name" class="form-control" name="organization_name" placeholder="Organization Name" value="{{old('organization_name')}}" required>
                                                    @if($errors->has('organization_name'))
                                                        <p><small class="text-danger">{{$errors->first('organization_name')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="organization-type">Type of Organization <code>*</code></label>
                                                    <select class="form-select" id="organization-type" name="organization_type" required>
                                                        <option value="">Choose one</option>
                                                        <option {{old('organization_type' == 'personal' ? selected : '')}} value="personal">Personal</option>
                                                        <option {{old('organization_type' == 'company' ? selected : '')}} value="company">Company</option>
                                                        <option {{old('organization_type' == 'school' ? selected : '')}} value="school">School</option>
                                                        <option {{old('organization_type' == 'university' ? selected : '')}} value="university">University</option>
                                                        <option {{old('organization_type' == 'foundation' ? selected : '')}} value="foundation">Foundation</option>
                                                        <option {{old('organization_type' == 'wihara' ? selected : '')}} value="wihara">Wihara</option>
                                                        <option {{old('organization_type' == 'church' ? selected : '')}} value="church">Church</option>
                                                        <option {{old('organization_type' == 'mosque' ? selected : '')}} value="mosque">Mosque</option>
                                                        <option {{old('organization_type' == 'pura' ? selected : '')}} value="pura">Pura</option>
                                                    </select>
                                                    @if($errors->has('organization_type'))
                                                        <p><small class="text-danger">{{$errors->first('organization_type')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="invite-as">As What Mr/Mrs Inviting VOS <code>*</code></label>
                                                    <select id="invite-as" class="form-select" name="invite_vos_as" required>
                                                        <option value="">Choose One</option>
                                                        <option {{old('invite_vos_as' == 'main speaker' ? selected : '')}} value="main speaker">Main Speaker</option>
                                                        <option {{old('invite_vos_as' == 'panelist' ? selected : '')}} value="panelist">Panelist</option>
                                                        <option {{old('invite_vos_as' == 'interviewer' ? selected : '')}} value="interviewer">Interviewer</option>
                                                        <option {{old('invite_vos_as' == 'speaker' ? selected : '')}} value="speaker">Speaker</option>
                                                    </select>
                                                    @if($errors->has('invite_vos_as'))
                                                        <p><small class="text-danger">{{$errors->first('invite_vos_as')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="event-type">Type of Event <code>*</code></label>
                                                    <select class="form-select" id="event-type" name="event_type" required>
                                                        <option value="">Choose One</option>
                                                        <option {{old('event_type' == 'webinar' ? selected : '')}} value="webinar">Webinar</option>
                                                        <option {{old('event_type' == 'interview' ? selected : '')}} value="interview">Interview</option>
                                                        <option {{old('event_type' == 'talk show' ? selected : '')}} value="talk show">Talk Show</option>
                                                        <option {{old('event_type' == 'panel discussion' ? selected : '')}} value="panel discussion">Panel Discussion</option>
                                                        <option {{old('event_type' == 'ig live' ? selected : '')}} value="ig live">IG Live</option>
                                                        <option {{old('event_type' == 'club house room' ? selected : '')}} value="club house room">Club House Room</option>
                                                    </select>
                                                    @if($errors->has('event_type'))
                                                        <p><small class="text-danger">{{$errors->first('event_type')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="event-date">Date & Time of Event <code>*</code></label>
                                                    <input type="datetime-local" id="event-date" class="form-control" name="event_date" min="{{date('Y-m-d'.'\T'.'00:00')}}" required>
                                                    @if($errors->has('event_date'))
                                                        <p><small class="text-danger">{{$errors->first('event_date')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="event-date2">Date & Time of Event (Option 2)</label>
                                                    <input type="datetime-local" id="event-date2" class="form-control" name="event_date2" min="{{date('Y-m-d'.'\T'.'00:00')}}" required>
                                                    @if($errors->has('event_date2'))
                                                        <p><small class="text-danger">{{$errors->first('event_date2')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="event-duration">Duration of Event</label>
                                                    <input type="text" id="event-duration" class="form-control" name="event_duration" placeholder="Duration of event" value="{{old('event_duration')}}">
                                                    @if($errors->has('event_duration'))
                                                        <p><small class="text-danger">{{$errors->first('event_duration')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="event-place">Platform or Place Event Will be Held <code>*</code></label>
                                                    <input type="text" id="event-place" class="form-control" name="event_place" placeholder="Platform of Place" value="{{old('event_place')}}" required>
                                                    @if($errors->has('event_place'))
                                                        <p><small class="text-danger">{{$errors->first('event_place')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="event-detail">Detail Event Information <code>*</code></label>
                                                    <input type="text" id="event-detail" class="form-control" name="event_detail" placeholder="Fill with theme and goal of the event" value="{{old('event_detail')}}" required>
                                                    @if($errors->has('event_detail'))
                                                        <p><small class="text-danger">{{$errors->first('event_detail')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="participant">Who's Attending the Event <code>*</code></label>
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="participant1" class="form-check-input" name="participant[]" value="anak-anak">
                                                            <label for="participant1">Anak-Anak</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="participant2" class="form-check-input" name="participant[]" value="remaja">
                                                            <label for="participant2">Remaja</label>
                                                        </div>
                                                    </div><div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="participant3" class="form-check-input" name="participant[]" value="dewasa">
                                                            <label for="participant3">Dewasa</label>
                                                        </div>
                                                    </div><div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="participant4" class="form-check-input" name="participant[]" value="manula">
                                                            <label for="participant4">Manula</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" id="participant5" class="form-check-input" name="participant[]" value="berkebutuhan khusus">
                                                            <label for="participant5">Berkebutuhan Khusus</label>
                                                        </div>
                                                    </div>
                                                    @if($errors->has('participant'))
                                                        <p><small class="text-danger">{{$errors->first('participant')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="form-group">
                                                    <label for="additional-note">Any Note for VOS</label>
                                                    <input type="text" class="form-control" id="additional-note" name="additional_note" value="{{old('additional_note')}}">
                                                    @if($errors->has('additional_note'))
                                                        <p><small class="text-danger">{{$errors->first('additional_note')}}.</small></p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <h5>TnC</h5>
                                            <ol>
                                                <li>
                                                    Untuk Perusahaan atau Instansi yang ingin mengundang VOS membawakan materi maka akan dikenakan fee sebesar Rp. 30.000.000/3 jam;
                                                </li>
                                                <li>
                                                    Untuk Acara yg menjual tiket acaranya sebagai acara komersial, maka akan dikenakan fee.
                                                </li>
                                                <li>
                                                    Untuk Organisasi atau Yayasan yang ingin mengundang VOS tanpa menjual tiket, budget silahkan disesuaikan dengan budget organisasi atau bisa menyiapkan Pelakat fisik kenang"an cindera mata untuk VOS.
                                                </li>
                                            </ol>

                                            <p>
                                                Untuk Plakat dan Merchandise dapat dikirimkan ke alamat berikut PT Dreamaxtion Teknologi Internasional atas nama Victor Osman, One Pacific Place, 15th Floor, SCBD Jl. Jend. Sudirman No.Kav. 52-53, Senayan, Jakarta Selatan, DKI Jakarta 12190, INDONESIA
                                            </p>

                                            <p>For further Information please kindly Whatsapp on +62 85211888638 (Dita)</p>

                                            <p class="mb-1">Best Regards,</p>
                                            <p class="mb-1">Dita Kasih</p>
                                            <p>Secretary to CEO</p> <br>

                                            <div class="form-group">
                                                <div class="form-check">
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="tnc" class="form-check-input" name="tnc" required>
                                                        <label for="tnc">Saya setuju dan memahami TnC <code>*</code></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Vertical form layout section end -->
@endsection