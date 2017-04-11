@extends('layouts.admin') 
@section('heading', 'Roles') 
@section('contenido')
@permission('crear-rol')
<div class="models--actions">
    <a class="btn btn-labeled btn-primary" href="{{ route('entrust-gui::roles.create') }}"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('entrust-gui::button.create-role') }}</a>
</div>
@endpermission
<table class="table table-striped">
    <tr>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    @foreach($models as $model)
    @if($model->name=='control-total')
           @if(Auth::user()->hasrole('control-total'))
            <tr>
        <td>{{ $model->display_name }}</td>
        <td class="col-xs-3">
            <form action="{{ route('entrust-gui::roles.destroy', $model->id) }}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(Auth::user()->can('editar-rol'))
                <a class="btn btn-labeled btn-default" href="{{ route('entrust-gui::roles.edit', $model->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('entrust-gui::button.edit') }}</a>
                @endif
                @role('admin')
                <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('entrust-gui::button.delete') }}</button>
                @endrole
            </form>
        </td>
    </tr>
            @endif
        @else
            <tr>
        <td>{{ $model->display_name }}</td>
        <td class="col-xs-3">
            <form action="{{ route('entrust-gui::roles.destroy', $model->id) }}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(Auth::user()->can('editar-rol'))
                <a class="btn btn-labeled btn-default" href="{{ route('entrust-gui::roles.edit', $model->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('entrust-gui::button.edit') }}</a>
                @endif
                <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('entrust-gui::button.delete') }}</button>
            </form>
        </td>
    </tr>
        @endif  
    @endforeach
</table>
<div class="text-center">
    {!! $models->render() !!}
</div>
@endsection
