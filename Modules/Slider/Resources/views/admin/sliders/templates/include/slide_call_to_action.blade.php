<div class="slide-options call-to-action">
    <h4>{{ clean(trans("slider::sliders.slide.form.call_to_action")) }}</h4>
    <div class="row">
    <div class="form-group col-md-6 col-sm-12">
        
        <label class="col-md-12 col-sm-12 text-left pl-0" for="call-to-action-color">
            {{ clean(trans("slider::attributes.text_color")) }}
        </label>

        <div class="col-md-12 col-sm-12 pl-0">
            <input type="text"
                name="slides[<%- slideNumber %>][options][call_to_action][color]"
                class="form-control color-picker"
                id="call-to-action-color-<%- slideNumber %>"
                value="<%- slide.options.call_to_action.color %>"
            >
        </div>
    </div>
    <div class="form-group col-md-6 col-sm-12">
        
        <label class="col-md-12 col-sm-12 text-left pl-0" for="call-to-action-bgcolor">
            {{ clean(trans("slider::attributes.background_color")) }}
        </label>

        <div class="col-md-12 col-sm-12 pl-0">
            <input type="text"
                name="slides[<%- slideNumber %>][options][call_to_action][bgcolor]"
                class="form-control color-picker"
                id="call-to-action-bgcolor-<%- slideNumber %>"
                value="<%- slide.options.call_to_action.bgcolor %>"
            >
        </div>
    </div>
    
    <div class="form-group col-md-6 col-sm-12">
        
        <label class="col-md-12 col-sm-12 col-xs-12 text-left pl-0" for="call-to-action-delay">
            {{ clean(trans("slider::attributes.call_to_action_delay")) }}
        </label>

        <div class="col-md-12 col-sm-12 pl-0">
            <input type="text"
                name="slides[<%- slideNumber %>][options][call_to_action][delay]"
                class="form-control"
                id="call-to-action-delay-<%- slideNumber %>"
                placeholder="{{ clean(trans('slider::sliders.slide.form.1500ms')) }}"
                value="<%- slide.options.call_to_action.delay %>"
                step="0.01"
            >
        </div>
        
    </div>

    <div class="form-group col-md-6 col-sm-12">
        
        <label class="col-md-12 col-sm-12 text-left pl-0" for="call-to-action-effect">
            {{ clean(trans("slider::attributes.call_to_action_effect")) }}
        </label>

        <div class="col-md-12 col-sm-12 pl-0">
            <select name="slides[<%- slideNumber %>][options][call_to_action][effect]"
                class="form-control custom-select-black"
                id="call-to-action-effect-<%- slideNumber %>"
            >
                @foreach (trans('slider::sliders.effects') as $effect => $name)
                    <option value="{{ $effect }}" <%= slide.options.call_to_action.effect === '{{ $effect }}' ? 'selected' : '' %>>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
       
    </div>
    </div>
</div>
