<div class="user-kyc">
        <form  action="{{route('user.include.kyc') }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                    <div class="from-step">
                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">01</div>
                                <div class="from-step-head">
                                    <h4>Step 1 : Personal Details</h4>
                                    <p>Simple personal information, required for identification</p>
                                </div>
                            </div>
                            <div class="from-step-content">
                                <div class="note note-md note-info note-plane">
                                    <em class="fas fa-info-circle"></em> 
                                    <p>Please carefully fill out the form with your personal details. Your can’t edit these details once you submitted the form.</p>
                                </div>
                                <div class="gaps-2x"></div>
                                <div class="row">

                                <div class="col-md-12">
                                    <div class="nk-kycfm-upload-box">
                                        <div class="upload-zone">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="photo_img" id="photo_img">
                                                <label class="custom-file-label" for="customFile">Choose Passport Photograph</label>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="gaps-2x"></div>
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">First Name</label>
                                            <input class="input-bordered" type="text" value="{{$data->fname}}" id="fname" name="fname" requireds>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="last-name" class="input-item-label">Last Name</label>
                                            <input class="input-bordered" type="text" value="{{$data->lname}}" id="lname" name="lname" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Date of Birth</label>
                                            <input class="input-bordered date-picker" type="text" value="{{$data->dob}}" id="dob" name="dob" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="gender" class="input-item-label">Gender</label>
                                            <select class="country-select" name="gender_id" id="gender_id" required>
                                                <option value="">--select gender--</option>

                                                @foreach($gender as $row)
                                                <option {{ ($row->id == $data->gender)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach

                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="nationality" class="input-item-label">Country</label>
                                            <select class="country-select" name="country_id" id="country_id" required>
                                                <option value="">--select country--</option>

                                                @foreach($country as $row)
                                                <option {{ ($row->id == $data->country)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach

                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <input type="hidden" id="website" name="website" value="{{$basic->website}}">
                                            <label for="gender" class="input-item-label">State of Origin</label>
                                            <select class="country-select" name="state_id" id="state_id" required>
                                                <option value="">--select state of origin--</option>
                                                @foreach($state as $row)
                                                <option {{ ($row->id == $data->state)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="gender" class="input-item-label">City</label>
                                            <select class="country-select" name="city_id" id="city_id" required>
                                                <option value="">--select city--</option>
                                                @foreach($city as $row)
                                                <option {{ ($row->id == $data->city)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="address-line-1" class="input-item-label">Contact Address</label>
                                            <textarea class="input-bordered" name="address" id="address" required>{{$data->address}}</textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="last-name" class="input-item-label">Current Work</label>
                                            <input class="input-bordered" type="text" value="{{$data->current_work}}" id="current_work" name="current_work" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Current Salary</label>
                                            <input class="input-bordered" type="text" value="{{$data->current_salary}}" id="current_salary" name="current_salary" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                
                                </div><!-- .row -->
                            </div><!-- .from-step-content -->
                        </div><!-- .from-step-item -->
                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">02</div>
                                <div class="from-step-head">
                                    <h4>Step 2 : Identity Verification</h4>
                                    <p>Upload your documents to verify your identity.</p>
                                </div>
                            </div>
                            <div class="from-step-content">
                                <div class="note note-md note-info note-plane">
                                    <em class="fas fa-info-circle"></em> 
                                    <p>Please upload any of the following personal document.</p>
                                </div>
                                <div class="gaps-2x"></div>
                                <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#passport">
                                            <div class="nav-tabs-icon">
                                                <img src="{{ asset('front/images/icon-passport.png')}}" alt="icon">
                                                <img src="{{ asset('front/images/icon-passport-color.png')}}" alt="icon">
                                            </div>
                                            <span>Passport</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#national-card">
                                            <div class="nav-tabs-icon">
                                                <img src="{{ asset('front/images/icon-national-id.png')}}" alt="icon">
                                                <img src="{{ asset('front/images/icon-national-id-color.png')}}" alt="icon">
                                            </div>
                                            <span>National ID Card</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#driver-licence">
                                            <div class="nav-tabs-icon">
                                                <img src="{{ asset('front/images/icon-licence.png')}}" alt="icon">
                                                <img src="{{ asset('front/images/icon-licence-color.png')}}" alt="icon">
                                            </div>
                                            <span>Driver’s License</span>
                                        </a>
                                    </li>
                                </ul><!-- .nav-tabs-line -->
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="passport">
                                        <h5 class="kyc-upload-title">To avoid delays when verifying account, Please make sure bellow:</h5>
                                        <ul class="kyc-upload-list">
                                            <li>Chosen credential must not be expired.</li>
                                            <li>Document should be good condition and clearly visible.</li>
                                            <li>Make sure that there is no light glare on the card.</li>
                                        </ul>
                                        <div class="gaps-4x"></div>
                                        <span class="upload-title">Upload Here Your Passport</span>
                                        <div class="row align-items-center">
                                        <div class="col-sm-8">
                                            <div class="nk-kycfm-upload-box">
                                                <div class="upload-zone">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="passport_img" id="passport_img">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="kyc-upload-img">
                                                <img src="{{ asset('front/images/vector-passport.png')}}" alt="vector">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="gaps-1x"></div>
                                    </div>
                                    <div class="tab-pane fade" id="national-card">
                                        <h5 class="kyc-upload-title">To avoid delays when verifying account, Please make sure below:</h5>
                                        <ul class="kyc-upload-list">
                                            <li>Chosen credential must not be expired.</li>
                                            <li>Document should be good condition and clearly visible.</li>
                                            <li>Make sure that there is no light glare on the card.</li>
                                        </ul>
                                        <div class="gaps-4x"></div>
                                        <span class="upload-title">Upload Here Your National ID Front Side</span>
                                        <div class="row align-items-center">
                                            <div class="col-sm-8">
                                                <div class="nk-kycfm-upload-box">
                                                    <div class="upload-zone">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="national_id_front_img" id="national_id_front_img">
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kyc-upload-img">
                                                    <img src="{{ asset('front/images/vector-id-front.png') }}" alt="vector">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gaps-3x"></div>
                                        <span class="upload-title">Upload Here Your National ID Back Side</span>
                                        <div class="row align-items-center">
                                            <div class="col-sm-8">
                                                <div class="nk-kycfm-upload-box">
                                                    <div class="upload-zone">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="national_id_back_img" id="national_id_back_img">
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kyc-upload-img">
                                                    <img src="{{ asset('front/images/vector-id-back.png') }}" alt="vector">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gaps-1x"></div>
                                    </div>
                                    <div class="tab-pane fade" id="driver-licence">
                                        <h5 class="kyc-upload-title">To avoid delays when verifying account, Please make sure below:</h5>
                                        <ul class="kyc-upload-list">
                                            <li>Chosen credential must not be expired.</li>
                                            <li>Document should be good condition and clearly visible.</li>
                                            <li>Make sure that there is no light glare on the card.</li>
                                        </ul>
                                        <div class="gaps-4x"></div>
                                        <span class="upload-title">Upload Here Your Driving Licence Copy</span>
                                        <div class="row align-items-center">
                                            <div class="col-sm-8">
                                                <div class="nk-kycfm-upload-box">
                                                    <div class="upload-zone">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="licence_img" id="licence_img" title="Browse file">
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kyc-upload-img">
                                                    <img src="{{ asset('front/images/vector-licence.png') }}" alt="vector">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gaps-1x"></div>
                                    </div>
                                </div>
                                <div class="gaps-2x"></div>
                            </div><!-- .from-step-content -->
                        </div><!-- .from-step-item -->
                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">03</div>
                                <div class="from-step-head">
                                    <h4>Step 3 : Bank Account</h4>
                                    <p>Submit your Bank Details that you are going to receive funds</p>
                                </div>
                            </div>
                            <div class="from-step-content">
                                
                                <div class="gaps-2x"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="swalllet" class="input-item-label">Bank Name</label>
                                            <select class="input-bordered" name="bank_id" id="bank_id" required>
                                            <option value="">--select bank--</option>

                                            @foreach($bank as $row)
                                            <option {{ ($row->id == $data->bank_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Account Number</label>
                                            <input class="input-bordered" type="text" value="{{$data->account_no}}" id="account_no" name="account_no" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Account Name</label>
                                            <input class="input-bordered" type="text" value="{{$data->accountname}}" id="accountname" name="accountname" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Bvn</label>
                                            <input class="input-bordered" type="text" value="{{$data->bvn}}" id="bvn" name="bvn" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                                
                                <div class="gaps-2x"></div><!-- 20px gap -->
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                <div class="gaps-2x"></div><!-- 20px gap -->
                            </div><!-- .from-step-content -->
                        </div><!-- .from-step-item -->
                    </div><!-- .from-step -->
                </form>
            </div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    
  // country change
  $('#country_id').change(function(){

     // country id
     var id = $(this).val();
     var website = $('#website').val();
     // Empty the dropdown
     $('#state_id').find('option').not(':first').remove();
     // AJAX request 
     $.ajax({
       url: website+'/getState/'+id,
       type: 'get',
       dataType: 'json',
       success: function(response){
         var len = 0;
         if(response != null){
           len = response.length;
         }
         if(len > 0){
           // Read data and create <option >
           for(var i=0; i<len; i++){
             var id = response[i].id;
             var name = response[i].name;
             var option = "<option value='"+id+"'>"+name+"</option>"; 
             $("#state_id").append(option); 
           }
         }
       }
    });
  });

});
</script>


<script type="text/javascript">
$(document).ready(function(){
    
  // country change
  $('#state_id').change(function(){

     // country id
     var id = $(this).val();
     var website = $('#website').val();

     // Empty the dropdown
     $('#city_id').find('option').not(':first').remove();
     // AJAX request 
     $.ajax({
       url: website+'/getCity/'+id,
       type: 'get',
       dataType: 'json',
       success: function(response){
         var len = 0;
         if(response != null){
           len = response.length;
         }
         if(len > 0){
           // Read data and create <option >
           for(var i=0; i<len; i++){
             var id = response[i].id;
             var name = response[i].name;
             var option = "<option value='"+id+"'>"+name+"</option>"; 
             $("#city_id").append(option); 
           }
         }
       }
    });
  });

});
</script>