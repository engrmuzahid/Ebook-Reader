@extends('admin::layout')


@component('admin::include.page.header')
    @slot('title', clean(trans('translation::translations.translations')))
    <li class="nav-item">
        <a href="#">
            {{ clean(trans('translation::translations.translations')) }}
        </a>
    </li>
@endcomponent

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ clean(trans('translation::translations.translations')) }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover translations-table">
                            <thead>
                                <tr>
                                    <th>{{ clean(trans('translation::translations.table.key')) }}</th>

                                    @foreach (supported_locales() as $locale => $language)
                                        <th>{{ clean($language['name']) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($translations as $key => $translation)
                                
                                    <tr>
                                        <td>{{ clean($key) }}</td>
                                        @foreach (supported_locales() as $locale => $language)
                                            <td class="translation-td">
                                                <a href="#" class="translation editable-click {{ array_has($translation, $locale) ? '' : 'editable-empty' }}"
                                                    data-locale="{{ clean($locale) }}"
                                                    data-key="{{ clean($key) }}"
                                                >{{ clean(array_get($translation, $locale)) }}</a>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
