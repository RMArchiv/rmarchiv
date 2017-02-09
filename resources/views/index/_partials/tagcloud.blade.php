<div class='rmarchivtbl' id='rmarchivbox_tagcloud'>
    <h2><a href="{{ url('tags') }}">tag cloud</a></h2>
    <div class='content center'>
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
    <div class='foot'>
        :)
    </div>
</div>