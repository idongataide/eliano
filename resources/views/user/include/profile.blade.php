<div class="user-kyc">
        <form  action="#" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                    <div class="from-step">
                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">01</div>
                                <div class="from-step-head">
                                    <h4>Personal Details</h4>
                                    <p>Simple personal information, required for identification</p>
                                </div>
                            </div>
                            <div class="from-step-content">
                                <div class="note note-md note-info note-plane">
                                    
                                </div>
                                <div class="gaps-2x"></div>
                                <div class="row">
                                <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            @if(Auth::user()->roleid == 5)
                                            <label for="reg_no" class="input-item-label">Merchant Number</label>
                                            @else
                                            <label for="reg_no" class="input-item-label">Contributor's Number</label>
                                            @endif
                                            <input class="input-bordered" type="text" value="{{$data->reg_no}}" id="reg_no" name="reg_no" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">First Name</label>
                                            <input class="input-bordered" type="text" value="{{$data->fname}}" id="fname" name="fname" required>
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
                                            <label for="date-of-birth" class="input-item-label">Phone Number</label>
                                            <input class="input-bordered" type="text" value="{{$data->phonenumber}}" id="phonenumber" name="phonenumber" required>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Email</label>
                                            <input class="input-bordered" type="text" value="{{$data->email}}" id="email" name="email" required>
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
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="marital_status_id" class="input-item-label">Marital Status</label>
                                            <select class="country-select" name="marital_status_id" id="marital_status_id" required>
                                                <option value="">--select marital status--</option>

                                                @foreach($marital_status as $row)
                                                <option {{ ($row->id == $data->marital_status_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach

                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="marital_status_id" class="input-item-label">Lagal Status</label>
                                            <select class="country-select" name="legal_status_id" id="legal_status_id" required>
                                                <option value="">--select legal status--</option>

                                                @foreach($legal_status as $row)
                                                <option {{ ($row->id == $data->marital_status_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach

                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="nationality" class="input-item-label">Country</label>
                                            <select class="country-select" name="country" id="country" required>
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
                                    

                                    @if(Auth::user()->roleid == 4)
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="address-line-1" class="input-item-label">Location</label>
                                            <textarea class="input-bordered" name="location" id="location" required>{{$data->location}}</textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    @endif

                                    @if(Auth::user()->roleid == 5)
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="address-line-1" class="input-item-label">Village</label>
                                            <textarea class="input-bordered" name="village" id="village" required>{{$data->village}}</textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="address-line-1" class="input-item-label">Contact Address</label>
                                            <textarea class="input-bordered" name="address" id="address" required>{{$data->address}}</textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Type of Identification</label>
                                            <input class="input-bordered" type="text" value="{{$data->type_of_id}}" id="type_of_id" name="type_of_id">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Identification Number</label>
                                            <input class="input-bordered" type="text" value="{{$data->Identification_number}}" id="Identification_number" name="Identification_number">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Date Issued</label>
                                            <input class="input-bordered date-picker" type="text" value="{{$data->date_issued}}" id="date_issued" name="date_issued">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Expiry Date</label>
                                            <input class="input-bordered date-picker" type="text" value="{{$data->date_of_expiry}}" id="date_of_expiry" name="date_of_expiry">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Occupation, Profession or Business</label>
                                            <input class="input-bordered" type="text" value="{{$data->type_of_occupation}}" id="type_of_occupation" name="date_of_expiry">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Establishment/Employer/Business</label>
                                            <input class="input-bordered" type="text" value="{{$data->establishment}}" id="establishment" name="establishment">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="address-line-1" class="input-item-label">Business Address</label>
                                            <textarea class="input-bordered" name="business_address" id="business_address" required>{{$data->business_address}}</textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="address-line-1" class="input-item-label">Regulatory Status</label>
                                            <input class="input-bordered" type="text" value="{{$data->regulatory_status}}" id="regulatory_status" name="regulatory_status">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    @endif

                                </div><!-- .row -->
                            </div><!-- .from-step-content -->
                        </div><!-- .from-step-item -->
                        @if(Auth::user()->roleid == 5)                     
                                    
                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">02</div>
                                <div class="from-step-head">
                                    <h4>Bank Account Detials</h4>
                                    <p>Bank Details that you are going to receive funds</p>
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
                               <!-- <button type="submit" class="btn btn-lg btn-primary">Submit</button>-->
                                <div class="gaps-2x"></div><!-- 20px gap -->
                            </div><!-- .from-step-content -->

                        </div><!-- .from-step-item -->



                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">03</div>
                                <div class="from-step-head">
                                    <h4>NEXT OF KIN</h4>
                                    <p>your next of kin details</p>
                                </div>
                            </div>
                            <div class="from-step-content">
                                
                                <div class="gaps-2x"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Name</label>
                                            <input class="input-bordered" type="text" value="{{$data->kin_name}}" id="kin_name" name="kin_name">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Relationship</label>
                                            <input class="input-bordered" type="text" value="{{$data->kin_relationship}}" id="kin_relationship" name="kin_relationship">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Phone</label>
                                            <input class="input-bordered" type="text" value="{{$data->kin_phone}}" id="kin_phone" name="kin_phone">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Email</label>
                                            <input class="input-bordered" type="text" value="{{$data->kin_email}}" id="kin_email" name="kin_email">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="swalllet" class="input-item-label">Gender</label>
                                            <select class="input-bordered" name="kin_gender_id" id="kin_gender_id">
                                            <option value="">--select gender--</option>

                                            @foreach($gender as $row)
                                            <option {{ ($row->id == $data->kin_gender_id)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Date of Birth</label>
                                            <input class="input-bordered date-picker" type="text" value="{{$data->kin_dob}}" id="kin_dob" name="kin_dob">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Type of Identification</label>
                                            <input class="input-bordered" type="text" value="{{$data->kin_id_type}}" id="kin_id_type" name="kin_id_type">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Identification Number</label>
                                            <input class="input-bordered" type="text" value="{{$data->kin_id_number}}" id="kin_id_number" name="kin_id_number">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="address-line-1" class="input-item-label">Home Address</label>
                                            <textarea class="input-bordered" name="kin_home_address" id="kin_home_address">{{$data->kin_home_address}}</textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Occupation</label>
                                            <input class="input-bordered" type="text" value="{{$data->kin_occupation}}" id="kin_occupation" name="kin_occupation">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="address-line-1" class="input-item-label">Address</label>
                                            <textarea class="input-bordered" name="kin_occupation_address" id="kin_occupation_address">{{$data->kin_occupation_address}}</textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                </div><!-- .row -->     

                                <div class="gaps-2x"></div><!-- 20px gap -->
                               <!-- <button type="submit" class="btn btn-lg btn-primary">Submit</button>-->
                                <div class="gaps-2x"></div><!-- 20px gap -->
                            </div><!-- .from-step-content -->

                        </div><!-- .from-step-item -->





                        

                        <div class="from-step-item">
                            <div class="from-step-heading">
                                <div class="from-step-number">04</div>
                                <div class="from-step-head">
                                    <h4>GUARANTOR</h4>
                                    <p>your next of guarantor's detail</p>
                                </div>
                            </div>
                            <div class="from-step-content">
                                
                                <div class="gaps-2x"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Name</label>
                                            <input class="input-bordered" type="text" value="{{$data->gar_name}}" id="gar_name" name="gar_name">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Relationship</label>
                                            <input class="input-bordered" type="text" value="{{$data->gar_relationship}}" id="gar_relationship" name="gar_relationship">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="first-name" class="input-item-label">Phone</label>
                                            <input class="input-bordered" type="text" value="{{$data->gar_phone}}" id="gar_phone" name="gar_phone">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="swalllet" class="input-item-label">Gender</label>
                                            <select class="input-bordered" name="gar_gender" id="gar_gender">
                                            <option value="">--select gender--</option>

                                            @foreach($gender as $row)
                                            <option {{ ($row->id == $data->gar_gender)? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                            </select>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Type of Identification</label>
                                            <input class="input-bordered" type="text" value="{{$data->gar_id_type}}" id="gar_id_type" name="gar_id_type">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Identification Number</label>
                                            <input class="input-bordered" type="text" value="{{$data->gar_id_number}}" id="gar_id_number" name="gar_id_number">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Date Issued</label>
                                            <input class="input-bordered date-picker" type="text" value="{{$data->gar_date_issued}}" id="gar_date_issued" name="gar_date_issued">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Expiry Date</label>
                                            <input class="input-bordered date-picker" type="text" value="{{$data->gar_date_expiry}}" id="gar_date_expiry" name="gar_date_expiry">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->

                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Date Signed</label>
                                            <input class="input-bordered date-picker" type="text" value="{{$data->gar_date_signed}}" id="gar_date_signed" name="gar_date_signed">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-12">
                                        <div class="input-item input-with-label">
                                            <label for="address-line-1" class="input-item-label">Address</label>
                                            <textarea class="input-bordered" name="gar_address" id="gar_address">{{$data->gar_address}}</textarea>
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Occupation</label>
                                            <input class="input-bordered" type="text" value="{{$data->gar_occupation}}" id="gar_occupation" name="gar_occupation">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                    <div class="col-md-6">
                                        <div class="input-item input-with-label">
                                            <label for="date-of-birth" class="input-item-label">Position/Level</label>
                                            <input class="input-bordered" type="text" value="{{$data->gar_position}}" id="gar_position" name="gar_position">
                                        </div><!-- .input-item -->
                                    </div><!-- .col -->
                                </div><!-- .row -->     

                                <div class="gaps-2x"></div><!-- 20px gap -->
                               <!-- <button type="submit" class="btn btn-lg btn-primary">Submit</button>-->
                                <div class="gaps-2x"></div><!-- 20px gap -->
                            </div><!-- .from-step-content -->

                        </div><!-- .from-step-item -->

                        @endif


















                    </div><!-- .from-step -->
                </form>
            </div>

