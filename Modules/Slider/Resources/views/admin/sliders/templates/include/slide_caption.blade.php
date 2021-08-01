<div class="slide-options caption-{{ $captionNumber }}">
    <h4>{{ clean(trans("slider::sliders.slide.form.caption_{$captionNumber}")) }}</h4>
    <div class="row"> 
    <div class="form-group col-md-6 col-sm-12">
       
            <label class="col-md-12 col-sm-12 col-xs-12 text-left pl-0" for="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-color">
                {{ clean(trans("slider::attributes.text_color")) }}
            </label>

            <div class="col-md-12 col-sm-12 col-xs-12 pl-0">
                <input type="text"
                    name="slides[<%- slideNumber %>][options][caption_{{ $captionNumber }}][color]"
                    class="form-control color-picker"
                    id="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-color"
                    placeholder=""
                    value="<%- slide.options.caption_{{ $captionNumber }}.color %>"
                >
            </div>
       
    </div>
    
    <div class="form-group col-md-6 col-sm-12">
       
            <label class="col-md-12 col-sm-12 col-xs-12 text-left pl-0" for="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-delay">
                {{ clean(trans("slider::attributes.delay")) }}
            </label>

            <div class="col-md-12 col-sm-12 col-xs-12 pl-0">
                <input type="number"
                    name="slides[<%- slideNumber %>][options][caption_{{ $captionNumber }}][delay]"
                    class="form-control"
                    id="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-delay"
                    placeholder="{{ clean(trans('slider::sliders.slide.form.1500ms')) }}"
                    value="<%- slide.options.caption_{{ $captionNumber }}.delay %>"
                    step="0.01"
                >
            </div>
       
    </div>

    <div class="form-group col-md-6 col-sm-12">
        
        <label class="col-md-12 col-sm-12 col-xs-12 text-left pl-0" for="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-effect">
            {{ clean(trans("slider::attributes.effect")) }}
        </label>

        <div class="col-md-12 col-sm-12 col-xs-12 pl-0">
            <select name="slides[<%- slideNumber %>][options][caption_{{ $captionNumber }}][effect]"
                class="form-control custom-select-black"
                id="slides-<%- slideNumber %>-caption-{{ $captionNumber }}-effect"
            >
                @foreach (trans('slider::sliders.effects') as $effect => $name)
                    <option value="{{ $effect }}" <%= slide.options.caption_{{ $captionNumber }}.effect === '{{ $effect }}' ? 'selected' : '' %>>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
       
    </div>
    </div>
</div>
