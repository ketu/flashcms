@extends('backend.layout')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="tabbable">
                <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                    @foreach ($configs as $group=> $config)
                        <li class="@if($loop->first) active @endif"><a href="#highlighted-justified-tab-{{$group}}" data-toggle="tab">{{$group}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($configs as $group=> $config)
                    <div class="tab-pane @if($loop->first) active @endif" id="highlighted-justified-tab-{{$group}}">
                        To use in tabs with equal widths add <code>.nav-justified .nav-tabs-highlight</code> {{$group}}.
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
