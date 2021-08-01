<script type="text/html" id="slide-template">
    <div class="slide">
        <div class="slide-header clearfix">
            <span class="slide-drag pull-left">
                <i class="fas fa-arrows-alt"></i>
            </span>
            <span class="pull-left">{{ clean(trans('slider::sliders.slide.image_slide')) }}-<%- slideNumber+1 %></span>
            <button type="button" class="delete-slide btn pull-right"><i class="fa fa-times"></i></button>
        </div>

        <div class="slide-body">
            <input type="hidden" name="slides[<%- slideNumber %>][id]" value="<%- slide.id %>">

            <div class="slide-image" data-slide-number="<%- slideNumber %>">
                <% if (slide.files && slide.files.path) { %>
                    <img src="<%- slide.files.path %>">
                    <input type="hidden" name="slides[<%- slideNumber %>][files_id]" value="<%- slide.files.id %>">
                <% } else { %>
                    <i class="fas fa-camera-retro"></i>
                <% } %>
            </div>

            <div class="slide-tabs tab-wrapper">
                <ul class="nav nav-pills nav-secondary" id="slides-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="slides-<%- slideNumber %>-general-tab" data-toggle="pill" href="#slides-<%- slideNumber %>-general" role="tab" aria-controls="slides-<%- slideNumber %>-general" aria-selected="true">
                            {{ clean(trans('slider::sliders.slide.form.tabs.general')) }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="slides-<%- slideNumber %>-options-tab" data-toggle="pill" href="#slides-<%- slideNumber %>-options" role="tab" aria-controls="slides-<%- slideNumber %>-options" aria-selected="false">
                            {{ clean(trans('slider::sliders.slide.form.tabs.options')) }}
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content" id="slides-tabContent">
                    <div class="tab-pane fade show active" id="slides-<%- slideNumber %>-general" role="tabpanel" aria-labelledby="slides-<%- slideNumber %>-general-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 pl-0 pr-0">
                                <div class="form-group">
                                    <label for="slides-<%- slideNumber %>-caption-1">
                                        {{ clean(trans('slider::attributes.caption_1')) }}
                                    </label>

                                    <input type="text"
                                        name="slides[<%- slideNumber %>][caption_1]"
                                        class="form-control"
                                        id="slides-<%- slideNumber %>-caption-1"
                                        value="<%- slide.caption_1 %>"
                                    >
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 pl-0 pr-0">
                                <div class="form-group">
                                    <label for="slides-<%- slideNumber %>-caption-2">
                                        {{ clean(trans('slider::attributes.caption_2')) }}
                                    </label>

                                    <input type="text"
                                        name="slides[<%- slideNumber %>][caption_2]"
                                        class="form-control"
                                        id="slides-<%- slideNumber %>-caption-2"
                                        value="<%- slide.caption_2 %>"
                                    >
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 pl-0 pr-0">
                                <div class="form-group">
                                    <label for="slides-<%- slideNumber %>-caption-3">
                                        {{ clean(trans('slider::attributes.caption_3')) }}
                                    </label>

                                    <input type="text"
                                        name="slides[<%- slideNumber %>][caption_3]"
                                        class="form-control"
                                        id="slides-<%- slideNumber %>-caption-3"
                                        value="<%- slide.caption_3 %>"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 pl-0 pr-0">
                                <div class="form-group">
                                    <label for="slides[<%- slideNumber %>][call-to-action-text]">
                                        {{ clean(trans('slider::attributes.call_to_action_text')) }}
                                    </label>

                                    <input type="text"
                                        name="slides[<%- slideNumber %>][call_to_action_text]"
                                        class="form-control"
                                        id="slides[<%- slideNumber %>][call-to-action-text]"
                                        value="<%- slide.call_to_action_text %>"
                                    >
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 pl-0 pr-0">
                                <div class="form-group">
                                    <label for="slides-<%- slideNumber %>-call-to-action-url">
                                        {{ clean(trans('slider::attributes.call_to_action_url')) }}
                                    </label>

                                    <input type="text"
                                        name="slides[<%- slideNumber %>][call_to_action_url]"
                                        class="form-control"
                                        id="slides-<%- slideNumber %>-call-to-action-url"
                                        value="<%- slide.call_to_action_url %>"
                                    >
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 pl-0 pr-0">
                                <div class="form-group">
                                    <div class="checkbox custom-control custom-checkbox">
                                        <input type="hidden" name="slides[<%- slideNumber %>][open_in_new_window]" value="0">
                                        <input type="checkbox"
                                            name="slides[<%- slideNumber %>][open_in_new_window]"
                                            value="1"
                                            class="custom-control-input "
                                            id="slides-<%- slideNumber %>-open-in-new-window"
                                            <%= slide.open_in_new_window ? "checked" : "" %>
                                        >
                                        <label class="custom-control-label" for="slides-<%- slideNumber %>-open-in-new-window">
                                        {{ clean(trans('slider::attributes.open_in_new_window')) }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane fade" id="slides-<%- slideNumber %>-options" role="tabpanel" aria-labelledby="slides-<%- slideNumber %>-options-tab">
                        <select class="change-option-block custom-select-black pull-right form-control col-md-4">
                            <option value="caption-1" selected>{{ clean(trans('slider::sliders.slide.form.caption_1')) }}</option>
                            <option value="caption-2">{{ clean(trans('slider::sliders.slide.form.caption_2')) }}</option>
                            <option value="caption-3">{{ clean(trans('slider::sliders.slide.form.caption_3')) }}</option>
                            <option value="call-to-action">{{ clean(trans('slider::sliders.slide.form.call_to_action')) }}</option>
                        </select>

                        @include('slider::admin.sliders.templates.include.slide_caption', ['captionNumber' => 1])
                        @include('slider::admin.sliders.templates.include.slide_caption', ['captionNumber' => 2])
                        @include('slider::admin.sliders.templates.include.slide_caption', ['captionNumber' => 3])
                        @include('slider::admin.sliders.templates.include.slide_call_to_action')
                    </div>
										
                </div>
								
                
            </div>
        </div>
    </div>
</script>
