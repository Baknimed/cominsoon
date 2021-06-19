@extends('admin.layouts.template')
@section('main')
<div class="page-title">
    <div class="title_left">
        <h3>Subscribers</h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-md-3 form-group">

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <table class="table table-striped table-bordered golo-datatable">
                    <thead>
                        <tr>
                            <th width="3%">ID</th>
                            <th width="15%">Email</th>
                            <th width="15%">Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{formatDate($user->created_at, 'H:i d/m/Y')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script src="{{asset('admin/js/page_user.js')}}"></script>
@endpush