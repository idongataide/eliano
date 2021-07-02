<li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
    <a href="{!! url('admin/dashboard') !!}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
</li>

<li class="treeview">
    <a href="#">
    <i class="fa fa-folder"></i>
    <span>Contributions</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    
    </span>
    </a>
        <ul class="treeview-menu">
            <li class="{{ Request::is('contributions*') ? 'active' : '' }}">
                <a href="{!! route('contributions.index') !!}"><i class="fa fa-bars"></i><span>Manage</span></a>
            </li>
            <li class="{{ Request::is('contributions*') ? 'active' : '' }}">
                <a href="{!! route('contributions.ledger') !!}"><i class="fa fa-bars"></i><span>Ledger</span></a>
            </li>
        </ul>
    </li>  

<li class="treeview">
    <a href="#">
        <i class="fa fa-folder"></i>
        <span>Loans</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
<ul class="treeview-menu">
<li class="{{ Request::is('admin.loan*') ? 'active' : '' }}">
    <a href="{!! route('admin.loan.loan') !!}"><i class="fa fa-bars"></i><span>View All Loans</span></a>
</li>
<li class="{{ Request::is('admin.loan*') ? 'active' : '' }}">
    <a href="{!! route('admin.loan.pendingapproval') !!}"><i class="fa fa-bars"></i><span>Approval</span>
    <span class="pull-right-container">
        <span class="label label-warning pull-right">{{\App\Models\loan::where('status','pending')->count() }}</span>
    </span>
</a>
</li>
<li class="{{ Request::is('admin.loan*') ? 'active' : '' }}">
    <a href="{!! route('admin.loan.awaitingdisburstment') !!}"><i class="fa fa-bars"></i><span>Disburstment</span>
    <span class="pull-right-container">
        <span class="label label-success pull-right">{{\App\Models\Loan::where('status','approved')->count() }}</span>
    </span>
</a>
</li>
<li class="{{ Request::is('managecharge*') ? 'active' : '' }}">
    <a href="{!! route('managecharge.index') !!}"><i class="fa fa-bars"></i><span>Manage Charges</span></a>
</li>
<li class="{{ Request::is('manageloanproduct*') ? 'active' : '' }}">
    <a href="{!! route('manageloanproduct.index') !!}"><i class="fa fa-bars"></i><span>Loan Products</span></a>
</li>

<!-- <li class="{{ Request::is('managebonustype*') ? 'active' : '' }}">
    <a href="{!! route('managebonustype.index') !!}"><i class="fa fa-bars"></i><span>Bonus Types</span></a>
</li> -->
</ul>
</li>

<li class="{{ Request::is('admin.loan.repayment*') ? 'active' : '' }}">
    <a href="{!! route('admin.loan.repayment') !!}"><i class="fa fa-bars"></i><span>Manage Repayment</span>
    <span class="pull-right-container">
        <span class="label label-warning pull-right">{{\App\Models\userpayment::where('status','pending')->count() }}</span>
    </span>
</a>
</li>


<li class="treeview">
    <a href="#">
    <i class="fa fa-folder"></i>
    <span>Manage Users</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    
    </span>
    </a>

        <ul class="treeview-menu">
            
            <li class="{{ Request::is('contributor*') ? 'active' : '' }}">
                <a href="{!! route('contributor.index') !!}"><i class="fa fa-user"></i><span>Contributors</span></a>
            </li>

            <li class="{{ Request::is('merchant*') ? 'active' : '' }}">
                <a href="{!! route('merchant.index') !!}"><i class="fa fa-user"></i><span>Merchants</span></a>
            </li>

            <li class="{{ Request::is('adminusers*') ? 'active' : '' }}">
                <a href="{!! route('adminusers.index') !!}"><i class="fa fa-user"></i><span>Users</span></a>
            </li>
            
            <li class="{{ Request::is('priviledge*') ? 'active' : '' }}">
                <a href="{!! route('priviledge.index') !!}"><i class="fa fa-user"></i><span>Priviledges</span></a>
            </li>
        </ul>
    </li>   
    <li class="treeview">
    <a href="#">
    <i class="fa fa-folder"></i>
    <span>Manage Setups</span>
    <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
    
    </span>
    </a>
<ul class="treeview-menu">

<li class="{{ Request::is('managebank*') ? 'active' : '' }}">
    <a href="{!! route('managebank.index') !!}"><i class="fa fa-bars"></i><span>Bank</span></a>
</li>
<li class="{{ Request::is('manageplan*') ? 'active' : '' }}">
    <a href="{!! route('manageplan.index') !!}"><i class="fa fa-bars"></i><span>Contribution Plan</span></a>
</li>
<li class="{{ Request::is('country*') ? 'active' : '' }}">
    <a href="{!! route('country.index') !!}"><i class="fa fa-bars"></i><span>Country</span></a>
</li>
<li class="{{ Request::is('managestate*') ? 'active' : '' }}">
    <a href="{!! route('managestate.index') !!}"><i class="fa fa-bars"></i><span>State</span></a>
</li>
<li class="{{ Request::is('managecity*') ? 'active' : '' }}">
    <a href="{!! route('managecity.index') !!}"><i class="fa fa-bars"></i><span>City</span></a>
</li>

<!-- <li class="{{ Request::is('managecontactus*') ? 'active' : '' }}">
    <a href="{!! route('managecontactus.index') !!}"><i class="fa fa-bars"></i><span>Contact us</span></a>
</li> -->
<!-- <li class="{{ Request::is('securityquestion*') ? 'active' : '' }}">
    <a href="{!! route('securityquestion.index') !!}"><i class="fa fa-bars"></i><span>Security Questions</span></a>
</li> -->
<!-- <li class="{{ Request::is('faq*') ? 'active' : '' }}">
    <a href="{!! route('faq.index') !!}"><i class="fa fa-bars"></i><span>FAQs</span></a>
</li> -->
<li class="{{ Request::is('managecompany*') ? 'active' : '' }}">
    <a href="{!! route('managecompany.edit',[1]) !!}"><i class="fa fa-bars"></i><span>Basic Settings</span></a>
</li>
</ul>
</li>
<li class="{{ Request::is('logout*') ? 'active' : '' }}">
    <a href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>
      <span>Sign out</span> </a>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
</li>