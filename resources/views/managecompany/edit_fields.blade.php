<div class="form-horizontal">

<div class="form-group">
    {!! Form::label('name', 'Company Name:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<!-- <div class="form-group">
    {!! Form::label('name_prefix', 'Company Prefix:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('name_prefix', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div> -->

<div class="form-group">
    {!! Form::label('city', 'City:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('city', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('phone', 'Phone Number:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('phone', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('email', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">Company Address:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Address']) !!}
    </div>
</div>


<div class="form-group">
{!! Form::label('admin_image', 'Admin Image:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/images/') .'/'. $company->site_image }}" alt="Image" width="100" height="100">
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Change Admin Image:</label>
    <div class="col-sm-8 col-xs-12">
        <input type="file" class="fileinput btn-primary" name="admin_image" id="admin_image" title="Browse file"/>
    </div>
</div>


<div class="form-group">
{!! Form::label('favicon', 'Favicon:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/images/') .'/'. $company->favicon }}" alt="Image" width="15" height="15">
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Change Favicon:</label>
    <div class="col-sm-8 col-xs-12">
        <input type="file" class="fileinput btn-primary" name="favicon" id="favicon" title="Browse file"/>
    </div>
</div>

<hr/>

<!-- <h3 style="text-align:center">VERIFICATION</h3>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="email_verification" id="email_verification" {{$basic->email_verification == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">Email Verification</label>
        </div>
    </div>
</div>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="bvn_verification" id="bvn_verification" {{$basic->bvn_verification == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">BVN Verification</label>
        </div>
    </div>
</div>


<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="phone_verification" id="phone_verification" {{$basic->phone_verification == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">Phone Verification</label>
        </div>
    </div>
</div>

<div class="form-group">
<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
    <div class="col-sm-3"></div>    
        <div class="col-sm-8">
            <input type="checkbox" class="custom-control-input" name="kyc_verification" id="kyc_verification" {{$basic->kyc_verification == "1" ? 'checked' : '' }}>
            <label class="custom-control-label" for="customSwitch3">KYC Verification</label>
        </div>
    </div>
</div> -->

<hr/>

<h3 style="text-align:center">SMS SETTINGS</h3>


<div class="form-group">
    {!! Form::label('sms_api', 'Api Token:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('sms_api', null, ['class' => 'form-control']) !!}
</div>
</div>


<div class="form-group">
    {!! Form::label('sms_sender', 'Sender ID:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('sms_sender', null, ['class' => 'form-control']) !!}
</div>
</div>


<hr/>


<h3 style="text-align:center">SOCIAL MEDIA SETTINGS</h3>

<hr/>
<div class="form-group">
    {!! Form::label('youtube', 'Youtube:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('youtube', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('instagram', 'Instagram:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('instagram', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('twitter', 'Twitter:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('twitter', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('facebook', 'Facebook:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('facebook', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('website', 'Website Address:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('website', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('contributor_code_prefix', 'Contributor Code Prefix:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('contributor_code_prefix', null, ['class' => 'form-control']) !!}
</div>
</div>

<div class="form-group">
    {!! Form::label('website', 'Merchant Code Prefix:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('merchant_code_prefix', null, ['class' => 'form-control']) !!}
</div>
</div>

<hr/>


<!-- <h3 style="text-align:center">PAYSTACK SETTINGS</h3> -->

<!-- <hr/>

<div class="form-group">
    {!! Form::label('email', 'Paystack Public Key:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('paystack_key', null, ['class' => 'form-control','required'=>'required']) !!}
</div>
</div>


<hr/> -->


<!-- <h3 style="text-align:center">CURRENCY SETTINGS</h3>

<hr/>

<div class="form-group">
    {!! Form::label('currency_sym', 'Currency Symbol:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
    {!! Form::text('currency_sym', null, ['class' => 'form-control']) !!}
</div>
</div>


<hr/> -->


<!-- <h3 style="text-align:center">PAGES SETTINGS</h3>

<hr/>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">Contact Page:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('contact_page', null, ['class' => 'form-control', 'placeholder' => 'Enter Contact Page']) !!}
    </div>
</div>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">FAQ Page:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('faq_page', null, ['class' => 'form-control', 'placeholder' => 'Enter FAQ Page']) !!}
    </div>
</div>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">About Page Page Title:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('about_page', null, ['class' => 'form-control', 'placeholder' => 'Enter about us page title']) !!}
    </div>
</div>

<div class="form-group">  
    <label for="remark" class="col-sm-3 control-label">About Us Page Description:</label>
    <div class="col-sm-8">       
        {!! Form::textarea('aboutus', null, ['class' => 'form-control', 'placeholder' => 'Enter about us page description']) !!}
    </div>
</div>
<div class="form-group">
{!! Form::label('favicon', 'About Us Image:',['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <img class="d-block mx-auto mb-3" src="{{ asset('/images/') .'/'. $company->aboutus_image }}" alt="Image" width="15" height="15">
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 col-xs-12 control-label">Change About Us Image:</label>
    <div class="col-sm-8 col-xs-12">
        <input type="file" class="fileinput btn-primary" name="aboutus_image" id="aboutus_image" title="Browse file"/>
    </div>
</div>
 -->







</br></br>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
    {!! Form::submit('Save Settings', ['class' => 'btn btn-success']) !!}
</div>
</div>

</div>