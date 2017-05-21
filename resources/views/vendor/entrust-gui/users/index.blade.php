@extends('layouts.admin') 
@section('heading', 'Usuarios') 
@section('contenido')
@permission('crear-usuario')
<div class="models--actions">
    <a class="btn btn-labeled btn-primary" href="{{ route('entrust-gui::users.create') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('entrust-gui::button.create-user') }}</a>
</div>
@endpermission
<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    @foreach($users as $user) @if(Auth::user()->id!=$user->id)
         @if(!Auth::user()->hasrole('control-total'))
            @if(count($role_user)!=0)
             @foreach($role_user as $rol) 
                 @if($rol->user_id!=$user->id) 
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="col-xs-3">
                                <form action="{{ route('entrust-gui::users.destroy', $user->id) }}" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> @permission('editar-usuario')
                                    <a class="btn btn-labeled btn-default" href="{{ route('entrust-gui::users.edit', $user->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('entrust-gui::button.edit') }}</a> @endpermission
                                    <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('entrust-gui::button.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endif 
             @endforeach
             @else
                 <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="col-xs-3">
                                <form action="{{ route('entrust-gui::users.destroy', $user->id) }}" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> @permission('editar-rol')
                                    <a class="btn btn-labeled btn-default" href="{{ route('entrust-gui::users.edit', $user->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('entrust-gui::button.edit') }}</a> @endpermission
                                    <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('entrust-gui::button.delete') }}</button>
                                </form>
                </tr>
                @endif
        @else
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td class="col-xs-3">
                <form action="{{ route('entrust-gui::users.destroy', $user->id) }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> @permission('editar-rol')
                    <a class="btn btn-labeled btn-default" href="{{ route('entrust-gui::users.edit', $user->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('entrust-gui::button.edit') }}</a> @endpermission
                    <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('entrust-gui::button.delete') }}</button>
                </form>
            </td>
        </tr>
        @endif
    @endif @endforeach
</table>
<div class="text-center">
    {!! $users->render() !!}
</div>
@endsection
