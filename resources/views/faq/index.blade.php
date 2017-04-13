@extends('layouts.app')
@section('pagetitle', trans('faq.index.title'))
@section('content')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>

    <div id='content'>
        @if(count($faq) <> 0)
        <div class='rmarchivtbl' id='rmarchivbox_faq'>
            <h2>{{ trans('faq.index.title') }}</h2>
            <div class='content' id='faq_toc'>
                @foreach($faq as $cats)
                <h3>{{ $cats[0]['cat'] }}</h3>

                <ul>
                    @foreach($cats as $f)
                    <li><a href='#chg{{ $f['id'] }}'>{{ $f['title'] }}</a></li>
                    @endforeach
                </ul>
                @endforeach
            </div>
            @foreach($faq as $cats)
            <h2>:: {{ $cats[0]['cat'] }}</h2>
            <dl class='faq'>
                @foreach($cats as $f)
                <dt id='chg{{ $f['id'] }}'>:: {{ $f['title'] }}</dt>
                <dd>
                    <p>
                        <div class="markdown">
                            {!! \App\Helpers\InlineBoxHelper::GameBox($f['desc_html']) !!}
                        </div>
                    </p>
                </dd>
                @endforeach
            </dl>
            @endforeach

        </div>
        @else
            <h2>{{ trans('faq.index.not_found') }}</h2>
        @endif
    </div>

    <script type="text/javascript">
        <!--
        document.observe("dom:loaded",function(){
            $("faq_toc").hide();
            $$(".faq > dd").invoke("hide");
            $$(".faq > dt").each(function(item){
                item.update( "[<a href='#" + item.id + "'>#</a>] " + item.innerHTML );
                item.setStyle({"cursor":"pointer"});
                item.observe("click",function(ev){
                    ev.findElement("dt").nextSiblings().first().toggle();
                    if (!ev.findElement("a"))
                        ev.stop();
                });
            });

            var e = $$("dt#" + location.hash);
            if (e.length) e.first().nextSiblings().first().show();
            var v = location.hash; location.hash = v; // force firefox
        });
        //-->
    </script>
@endsection