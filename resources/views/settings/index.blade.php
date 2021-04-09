@extends('layouts/main')
@section('title')
Settings
@endsection
@section('content')

<style>
.form-group1 {
	width:60%;
}
.calendar-day.is_sunday div {
    color: #9585bf !important;
}
table.table.table-responsive label,
table.table.table-responsive strong {
    color: black;
    font-weight: 600;
    line-height: 35px;
}
.calendar-day p {
    display: none;
}
.selectRd{
	width:40%;float:left;
}
table.calendar		{ border-left:1px solid #999 !important; }
tr.calendar-row	{  }
td.calendar-day	{ min-height:80px !important; font-size:14px !important; position:relative !important; } * html div.calendar-day { height:80px !important; }
td.calendar-day:hover	{ background:#eceff5; }
td.calendar-day-np	{ background:#eee !important; min-height:80px !important; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head { background:#9585BF !important; font-weight:bold !important; text-align:center !important; width:120px !important; padding:5px !important; border-bottom:1px solid #999 !important; border-top:1px solid #999 !important; border-right:1px solid #999 !important; color: #fff !important; }
div.day-number		{  padding:5px !important; color:#000 !important; font-weight:bold !important;text-align:center !important; cursor:pointer; }
/* shared */
td.calendar-day, td.calendar-day-np { width:120px !important; padding:5px !important; border-bottom:1px solid #999 !important; border-right:1px solid #999 !important; }

td.holiday_selected{
background: #D15B47 !important;
}
td.holiday_selected .day-number{
    color: #fff !important;
}
table td {
    border-top: 0 !important;
}

</style>  

<form method="post" action="{{ route('admin.update.settings') }}">
	@csrf
    <div class="page-header"><h1>Admin Email</h1></div>
    <table border="0" class="table" style="width:50%;">
    
        <tr>
            <td>
                <div class="form-group">
                    <input type="text" name="email[email]" value="{{ $email['email'] }}" class="form-control" placeholder="Email" required="">
                </div>
            </td>
        </tr>
    </table>
    
    <div class="page-header"><h1>Login Portal Credentials</h1></div>
    <table border="0" class="table" style="width:50%;">
    
        <tr>
            <td>
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-5">
                            <strong>Username: </strong><br />
                            <input type="text" name="login[username]" value="{{ ($portal_login) ? $portal_login['username'] : '' }}" class="form-control" placeholder="Username">
                        </div>
                        <div class="col-md-5">
                            <strong>Password: </strong><br />
                            <input type="text" name="login[password]" value="{{ ($portal_login) ? $portal_login['password'] :'' }}" class="form-control" placeholder="Password">
                        </div>
                        
                    </div>
                    
                    
                </div>
            </td>
        </tr>

    </table>

	<div class="page-header"><h1>Class Timings</h1></div>

	<table border="0" class="table" style="width:50%;">
    
    	<tr>
            <td>
            <div class="form-group">
                
                <strong>From: </strong><br />
                <select name="setting[from_time]" id="from_time" class="form-control selectRd">
                    <?php for($i=1;$i<=12;$i++) { ?>
                        <option value="<?php echo $i; ?>" <?php if($timing['from_time']==$i) echo 'selected'; ?>><?php echo ($i<10)?'0'.$i:$i; ?></option>
                    <?php } ?>
                </select>
                 <select name="setting[from_am]" id="from_am" class="form-control selectRd" style="margin-left:5px;">
                    <option value="am"  <?php if($timing['from_am']=='am') echo 'selected'; ?>>AM</option>
                    <option value="pm"  <?php if($timing['from_am']=='pm') echo 'selected'; ?>>PM</option>
                 </select>
            </div>   
            </td>
        
            <td>
            <div class="form-group">
                 <strong>To: </strong><br />
                <select name="setting[to_time]" id="to_time" class="form-control selectRd">
                    <?php for($i=1;$i<=12;$i++) { ?>
                        <option value="<?php echo $i; ?>" <?php if($timing['to_time']==$i) echo 'selected'; ?>><?php echo ($i<10)?'0'.$i:$i; ?></option>
                    <?php } ?>
                </select>&nbsp;&nbsp;
                 <select name="setting[to_am]" id="to_am" class="form-control selectRd" style="margin-left:5px;">
                    <option value="am"  <?php if($timing['to_am']=='am') echo 'selected'; ?>>AM</option>
                    <option value="pm"  <?php if($timing['to_am']=='pm') echo 'selected'; ?>>PM</option>
                 </select>
                
            </div>
            </td>
        </tr>
        
    </table>
    
    
    <div class="page-header"><h1>Holidays</h1></div>
    <table border="0" class="table table-responsive">
    	<tr>
            <?php for($i=0;$i<=3;$i++) {
				$nextMonth=strtotime('first day of +'.$i.' month'); 
			?>
            <td>
            	<strong> {{ date('M',$nextMonth)}} {{ date('Y',$nextMonth) }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="checkbox" class="selectAllChk" id="chkAll{{ $i }}">&nbsp;Select All</label>
			   {!! draw_calendar(date('m',$nextMonth), date('Y',$nextMonth),$settings['holidays'],$i) !!}
				
			</td>
            
            <?php } ?>
        </tr>
    </table>
    
     
    <input type="hidden" id="holidays" name="holidays" value="{{ $settings['holidays'] }}" />
    <input type="submit" value="Save" class="btn btn-lg btn-info" /><br /><br />
    </form>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/settings.js') }}"></script>
@endsection