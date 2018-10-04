@extends('templates.admin.master.layout')

@section('seo-title')
<title> 
    
    @if(!isset($page) || empty($page))
        Main menu (Level 0)
    @else
        Submenu for - {{ $page->title }}
    @endif
    
    {{ config('app.seo-separator') }} {{ config('app.name') }}
</title>
@endsection


@section('plugins-css')
<link href="/templates/admin/custom/jquery-ui.css" rel="stylesheet">
@endsection

@section('custom-css')

@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @if(!isset($page) || empty($page))
                Main menu (Level 0)
                <a href="{{ route('pages-create') }}" class="btn btn-sm btn-success pull-right">New page</a>
            @else
                Submenu for "{{ $page->title }}"
                <div class="btn-group pull-right">
                    <a href="{{ route('pages-create') }}?page_id={{ $page->id }}" class="btn btn-sm btn-success">New page</a>
                    <a href="{{ route('pages') }}" class="btn btn-sm btn-info">Main menu (Level 0)</a>
                </div>
            @endif
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

@include('templates.admin.partials.message')

<div id="message-wrapper">
    
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            
            @if(count($data) > 0)
            <table width="100%" class="table table-striped table-bordered table-hover" id='pages-table'>
                <thead>
                    <tr>
                        <th> # </th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    @foreach($data as $value)
                    <tr id="{{ $value->id }}">
                        <td class="text-center">{{ $value->priority + 1 }}</td>
                        <td><img src='{{ $value->getImage('s') }}'></td>
                        <td>{{ $value->title }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                @if($value->page_id == 0)
                                <a data-placement='top' data-original-title='Subpages' class="btn btn-xs btn-info" href='{{ route('pages', [ "page" => $value->id ]) }}'>Subpages ({{ count($value->pages) }})</a>
                                @endif

                                <a data-placement='top' data-original-title='Edit page' class="btn btn-xs btn-success" href='{{ route('pages-edit', [ "page" => $value->id ]) }}'>Edit</a>

                                @if($value->active == 1)
                                    <a data-button-title='Show' data-placement='top' data-original-title='show page {{ $value->title }}' class="btn btn-xs btn-warning" data-href='{{ route('pages-active', [ "page" => $value->id ]) }}' data-toggle="modal" data-target="#myModal">Show</a>
                                @else
                                    <a data-button-title='Hide' data-placement='top' data-original-title='hide page {{ $value->title }}' class="btn btn-xs btn-success" data-href='{{ route('pages-active', [ "page" => $value->id ]) }}' data-toggle="modal" data-target="#myModal">Hide</a>
                                @endif

                                <a data-button-title='Delete' data-placement='top' data-original-title='delete page {{ $value->title }}' data-href="{{ route('pages-delete', ["page" => $value->id]) }}" data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @else 
            <div class="alert alert-warning">
                
                @if(!isset($page) || empty($page))
                    There is no page for Main menu in database!!!
                    <a href="{{ route('pages-create') }}">Create new page</a>
                @else
                    There is no page for {{ $page->title }} in database!!!
                    <a href="{{ route('pages-create') }}?page_id={{ $page->id }}">Create new page</a>
                @endif
                
            </div>
            @endif
        </div>
        
            
            
        <form id="new-order-form" action="{{ route('pages-neworder') }}" method="post" style="margin-top:10px; margin-bottom: 10px;" class="text-right hide">
            {{ csrf_field() }}
            
            @if(!isset($page) || empty($page))
                <input type="hidden" name="page_id" value="0">
            @else
                <input type="hidden" name="page_id" value="{{$page->id}}">
            @endif
            
            
            <input type="hidden" value="" name="new-priority" id="new-priority">
            <button class="btn btn-success btn-sm">Save new order</button>
        </form>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete admin user</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-action btn-danger">Delete</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('plugins-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('custom-js')
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    
});

$('#myModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var originalTitle = button.data('original-title'); // Extract info from data-* attributes
    //var userId = button.data('userid');
    var href = button.data('href');
    var buttonTitle = button.data('button-title');
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text(originalTitle);
    modal.find('.modal-body').text('Are you sure that you want to ' + originalTitle + '?')
    //modal.find('.modal-footer .btn-danger').attr('href', '/users/delete/' + userId);
    modal.find('.modal-footer .btn-action').attr('href', href);
    modal.find('.modal-footer .btn-action').text(buttonTitle);
    
    //modal.find('.modal-footer .btn-action').addClass();
})



$('table').tooltip({
    selector: "[data-placement=top]",
    container: "body"
})



$( function() {
    $( "#sortable" ).sortable({
        update: function(event, ui){
            //alert($("#sortable").sortable('toArray'));
            $("#new-priority").val($("#sortable").sortable('toArray'));
            //$("#new-order-form").removeClass('hide');
            
            $.ajax({
                url: '{{ route('pages-neworder') }}',
                data : {
                    '_token' : $('#new-order-form [name=_token]').val(),
                    page_id: $('#new-order-form [name=page_id]').val(),
                    'new-priority' : $('#new-order-form [name=new-priority]').val()
                },
                dataType : 'html',
                type: 'POST'
            }).done(function(data){
                $("#message-wrapper").html(data);
            }).fail(function(jqxhr, status){
                alert('Greska');
            });
        }
    });
} );




</script>
@endsection