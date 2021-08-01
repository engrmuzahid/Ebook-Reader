{{ Form::checkbox('cynoebook_category_tabs_section_enabled', trans('cynoebook::attributes.section_status'), trans('cynoebook::cynoebook.form.enable_category_tabs_section'), $errors, $settings) }}
{{ Form::text('translatable[cynoebook_category_tabs_section_title]', trans('cynoebook::attributes.section_title'), $errors, $settings) }}

<div class="media-picker-divider"></div>
<h4 class="section-title">{{ trans('cynoebook::cynoebook.form.tab_1') }}</h4>
{{ Form::text('translatable[cynoebook_category_tabs_section_tab_1_title]', trans('cynoebook::attributes.tab_title'), $errors, $settings) }}
{{ Form::select('cynoebook_category_tabs_section_tab_1_category', clean(trans('cynoebook::attributes.tab_category')), $errors, $categories, $settings, ['class' => 'select2','help'=>clean(trans('cynoebook::cynoebook.form.selected_category_ebook_are_displayed_in_this_tab'))]) }}
{{ Form::number('cynoebook_category_tabs_section_tab_1_total_ebooks', clean(trans('cynoebook::attributes.total_ebooks')), $errors, $settings, ['min' => 0,'max'=>20]) }}

<div class="media-picker-divider"></div>


<h4 class="section-title">{{ trans('cynoebook::cynoebook.form.tab_2') }}</h4>
{{ Form::text('translatable[cynoebook_category_tabs_section_tab_2_title]', trans('cynoebook::attributes.tab_title'), $errors, $settings) }}
{{ Form::select('cynoebook_category_tabs_section_tab_2_category', clean(trans('cynoebook::attributes.tab_category')), $errors, $categories, $settings, ['class' => 'select2','help'=>clean(trans('cynoebook::cynoebook.form.selected_category_ebook_are_displayed_in_this_tab'))]) }}
{{ Form::number('cynoebook_category_tabs_section_tab_2_total_ebooks', clean(trans('cynoebook::attributes.total_ebooks')), $errors, $settings, ['min' => 0,'max'=>20]) }}
    
<div class="media-picker-divider"></div>

<h4 class="section-title">{{ trans('cynoebook::cynoebook.form.tab_3') }}</h4>
{{ Form::text('translatable[cynoebook_category_tabs_section_tab_3_title]', trans('cynoebook::attributes.tab_title'), $errors, $settings) }}
{{ Form::select('cynoebook_category_tabs_section_tab_3_category', clean(trans('cynoebook::attributes.tab_category')), $errors, $categories, $settings, ['class' => 'select2','help'=>clean(trans('cynoebook::cynoebook.form.selected_category_ebook_are_displayed_in_this_tab'))]) }}
{{ Form::number('cynoebook_category_tabs_section_tab_3_total_ebooks', clean(trans('cynoebook::attributes.total_ebooks')), $errors, $settings, ['min' => 0,'max'=>20]) }}
    
<div class="media-picker-divider"></div>

<h4 class="section-title">{{ trans('cynoebook::cynoebook.form.tab_4') }}</h4>
{{ Form::text('translatable[cynoebook_category_tabs_section_tab_4_title]', trans('cynoebook::attributes.tab_title'), $errors, $settings) }}
{{ Form::select('cynoebook_category_tabs_section_tab_4_category', clean(trans('cynoebook::attributes.tab_category')), $errors, $categories, $settings, ['class' => 'select2','help'=>clean(trans('cynoebook::cynoebook.form.selected_category_ebook_are_displayed_in_this_tab'))]) }}
{{ Form::number('cynoebook_category_tabs_section_tab_4_total_ebooks', clean(trans('cynoebook::attributes.total_ebooks')), $errors, $settings, ['min' => 0,'max'=>20]) }}
    
<div class="media-picker-divider"></div>

<h4 class="section-title">{{ trans('cynoebook::cynoebook.form.tab_5') }}</h4>
{{ Form::text('translatable[cynoebook_category_tabs_section_tab_5_title]', trans('cynoebook::attributes.tab_title'), $errors, $settings) }}
{{ Form::select('cynoebook_category_tabs_section_tab_5_category', clean(trans('cynoebook::attributes.tab_category')), $errors, $categories, $settings, ['class' => 'select2','help'=>clean(trans('cynoebook::cynoebook.form.selected_category_ebook_are_displayed_in_this_tab'))]) }}
{{ Form::number('cynoebook_category_tabs_section_tab_5_total_ebooks', clean(trans('cynoebook::attributes.total_ebooks')), $errors, $settings, ['min' => 0,'max'=>20]) }}
