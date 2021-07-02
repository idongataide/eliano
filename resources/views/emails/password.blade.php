<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ session('company')->name }}</title>
</head>
<body>
<div style="width:100%">
        <div style="width:50%; height:auto; margin:auto; padding-bottom:30px; background-color:rgb(255, 253, 244)">
                <div style="width:100%; margin:auto;margin-top: -20px">
                        <a href="{{ url('/') }}"><img src="{{ asset('main/images/banner.jpg') }}" style="width:100%;"   alt="logo"/></a> 
                     </div>
        <div style="margin:auto; padding:20px;  background-color:rgb(0, 0, 0);">
               
                <p style="font-family:'IBM Plex Sans',Arial,sans-serif;font-size:16px;color:#ffffff;text-align:center"> Hello  {{ session('user_name') }}!</p>
                <p style="font-family:'IBM Plex Sans',Arial,sans-serif;font-size:20px;line-height:1.25;color:#ffffff;font-weight:600;padding:0px;text-align:center">You are about to change your password.</p>
         </div>
         <div bgcolor="#ffffff" align="left" style="padding:30px">
                <p style="font-family:'IBM Plex Sans',Arial,sans-serif;color:#333333;font-size:14px;font-weight:400;line-height:1.5;margin:10px 0px 0px">if this request was not made by you please ignore.</p>
                <p style="font-family:'IBM Plex Sans',Arial,sans-serif;color:#333333;font-size:14px;font-weight:400;line-height:1.5;margin:18px 0px 0px">To get started, head to your RVP dashboard and upload your vehicles and documents, create order and make payment.
         </p>
         <div style="width:200px; margin:auto;padding:50px">
                {{ $message }}
                <a style="color:#ffffff;text-decoration:none;text-align:center;line-height:24px;display:inline-block;font-weight:500;font-family:'IBM Plex Sans',Arial,sans-serif;font-size:14px;border-radius:4px;overflow:visible;background-color:#f5591b;padding:5px 15px;border:2px solid rgb(248, 4, 4);" target="_blank" href="{{  url('user-password/reset/'.$message ) }}"><span>Reset Link</span></a>
         </div>
         <div style="width:200px; margin:auto;padding:50px">
         <a style="color:#ffffff;text-decoration:none;text-align:center;line-height:24px;display:inline-block;font-weight:500;font-family:'IBM Plex Sans',Arial,sans-serif;font-size:14px;border-radius:4px;overflow:visible;background-color:#f5591b;padding:5px 15px;border:2px solid rgb(248, 4, 4);" target="_blank" href="{{ route('dashboard.index') }}"><span>Dashbord</span></a>
        </div>
        <div bgcolor="#ffffff" align="left">
                <p style="font-family:'IBM Plex Sans',Arial,sans-serif;color:#333333;font-size:14px;font-weight:400;line-height:1.5;margin:10px 0px 0px">Need help? Please let us know.</p>
                <p style="font-family:'IBM Plex Sans',Arial,sans-serif;color:#333333;font-size:14px;font-weight:400;line-height:1.5;margin:5px 0px 0px">Thank you for choosing us!</p>
        
       </div>
       </div>
</div>
<p style="font-family:'IBM Plex Sans',Arial,sans-serif;color:#646464;font-size:7px;font-weight:500;line-height:16px;margin:0px 0px 5px;text-align:center">© Copyright 2021, Renew Your Papers | All rights reserved.</p>
</body>


</html>
