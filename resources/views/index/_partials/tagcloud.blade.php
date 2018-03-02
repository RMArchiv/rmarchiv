<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ trans('app.tag_cloud') }}
            </div>
            <div class="card-body">
                @php
                    $cloud = new \LithiumDev\TagCloud\TagCloud();
                @endphp

                @foreach(\App\Models\TagRelation::with('tag')->get() as $tag)
                    @php
                        $cloud->addTag([
                            'tag' => $tag->tag->title,
                            'url' => action('TaggingController@showGames', $tag->tag->id),
                            'id' => $tag->tag->id,
                        ])
                    @endphp
                @endforeach
                @php
                    $cloud->setHtmlizeTagFunction(function($tag, $size) {
                        $btnsize = '';
                        if($size <= 2){
                            $btnsize = 6;
                        }elseif($size <= 4){
                            $btnsize = 5;
                        }elseif($size <= 6){
                            $btnsize = 4;
                        }elseif($size <= 8){
                            $btnsize = 3;
                        }else{
                            $btnsize = 2;
                        }
                        $link = '<a href="'.$tag['url'].'"><p class="m-3 h'.$btnsize.'">'.$tag['tag'].'</p></a>';
                        return $link;
                        //return "<span  class='tag size{$size}'>{$link}</span> ";
                    });
                    $cloud->setLimit(25);
                @endphp
                {!!  $cloud->render() !!}
            </div>
            <div class="card-footer">
                <a href="{{ url('tags') }}">{{ trans('app.more') }}...</a>
            </div>
        </div>
    </div>
</div>