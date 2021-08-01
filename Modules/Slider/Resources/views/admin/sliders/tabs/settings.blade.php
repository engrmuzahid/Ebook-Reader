{{ Form::text('name', clean(trans('slider::attributes.name')), $errors, $slider, ['required' => true]) }}
{{ Form::checkbox('autoplay', clean(trans('slider::attributes.autoplay')), clean(trans('slider::sliders.form.enable_autoplay')), $errors, $slider, ['checked' => true]) }}

<div class="autoplay-speed-field {{ ($slider->autoplay ?? true) ? '' : 'hide' }}">
    {{ Form::number('autoplay_speed', clean(trans('slider::attributes.autoplay_speed')), $errors, $slider, ['placeholder' => clean(trans('slider::sliders.form.3000ms')), 'checked' => true]) }}
</div>

{{ Form::checkbox('arrows', clean(trans('slider::attributes.arrows')), clean(trans('slider::sliders.form.show_arrows')), $errors, $slider, ['checked' => true]) }}
    