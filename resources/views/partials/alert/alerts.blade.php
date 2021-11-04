<!--=====================================
    ALERTA CUANDO SE QUIERE ACCEDER  A LAS EMPRESAS DESDE UN CLINETE MIDDLEWARE
======================================-->
@if(\Illuminate\Support\Facades\Session::has('notIsset'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-body">
            {{\Illuminate\Support\Facades\Session::get('notIsset')}}
            {{ \App\Model\Customer::ForgetMessage('notIsset') }}
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
