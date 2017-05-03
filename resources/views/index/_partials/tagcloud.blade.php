<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('index.tagcloud.title') }}
            </div>
            <div class="panel-body">
                @php
                    $cloud = new \LithiumDev\TagCloud\TagCloud();
                @endphp

                @foreach(\App\Models\TagRelation::with('tag')->get() as $tag)
                    @php
                        $cloud->addTag([
                            'tag' => $tag->tag->title,
                            'url' => action('TaggingController@showGames', $tag->tag->id),
                        ])
                    @endphp
                @endforeach
                @php
                    $cloud->setHtmlizeTagFunction(function($tag, $size) {
                        $link = '<a class="w'.$size.'" href="'.$tag['url'].'">'.$tag['tag'].'</a>';
                        return "<span class='jqcloud'>{$link}</span> ";
                        //return "<span  class='tag size{$size}'>{$link}</span> ";
                    });
                    $cloud->setLimit(30);
                @endphp
                {!!  $cloud->render() !!}
            </div>
            <div class="panel-footer">
                <a href="{{ url('tags') }}">{{ trans('index.shoutbox.more') }}</a>
            </div>
        </div>
    </div>
</div>