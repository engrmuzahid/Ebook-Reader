@if($slider)
<div class="home-slider"
    data-autoplay="{{ $slider->autoplay }}"
    data-autoplay-speed="{{ $slider->autoplay_speed }}"
    data-arrows="{{ $slider->arrows }}"
>
    @foreach ($slider->slides as $slide)
        <div class="slide">
            <div class="slider-image" style="background-image: url({{ $slide->files->path }});"></div>

            <div class="display-table">
                <div class="display-table-cell">
                    <div class="col-md-9 col-md-offset-1 col-sm-10 col-sm-offset-1">
                        <div class="slider-content clearfix">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    @unless (is_null($slide->caption_1))
                                        <div class="caption caption-md"
                                            data-delay="{{ $slide->options['caption_1']['delay'] }}ms"
                                            data-effect="{{ $slide->options['caption_1']['effect'] }}"
                                            
                                            @unless (is_null($slide->options['caption_1']['color']))
                                                style="color:{{ $slide->options['caption_1']['color'] }}"
                                            @endunless
                                        >
                                            {{ $slide->caption_1 }}
                                        </div>
                                    @endunless

                                    @unless (is_null($slide->caption_2))
                                        <div class="caption caption-lg"
                                            data-delay="{{ $slide->options['caption_2']['delay'] }}ms"
                                            data-effect="{{ $slide->options['caption_2']['effect'] }}"
                                            @unless (is_null($slide->options['caption_2']['color']))
                                                style="color:{{ $slide->options['caption_2']['color'] }}"
                                            @endunless
                                        >
                                            {{ $slide->caption_2 }}
                                        </div>
                                    @endunless

                                    @unless (is_null($slide->caption_3))
                                        <div class="caption caption-sm"
                                            data-delay="{{ $slide->options['caption_3']['delay'] }}ms"
                                            data-effect="{{ $slide->options['caption_3']['effect'] }}"
                                            @unless (is_null($slide->options['caption_3']['color']))
                                                style="color:{{ $slide->options['caption_3']['color'] }}"
                                            @endunless
                                        >
                                            {{ $slide->caption_3 }}
                                        </div>
                                    @endunless

                                    @unless (is_null($slide->call_to_action_text))
                                        <a href="{{ $slide->call_to_action_url }}"
                                            class="btn-slider btn btn-primary animate"
                                            target="{{ $slide->options['call_to_action']['target'] ?? '_self' }}"
                                            data-delay="{{ $slide->options['call_to_action']['delay'] }}ms"
                                            data-effect="{{ $slide->options['call_to_action']['effect'] }}"
                                            style="
                                            @unless (is_null($slide->options['call_to_action']['color']))
                                            color:{{ $slide->options['call_to_action']['color'] }};
                                            @endunless
                                            @unless (is_null($slide->options['call_to_action']['bgcolor']))
                                            background:{{ $slide->options['call_to_action']['bgcolor'] }}
                                            @endunless
                                            "
                                        >
                                            {{ $slide->call_to_action_text }}
                                        </a>
                                    @endunless
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
