@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container">
        @auth
            <div class="row">
                <div class="col-8">
                    <div class="mb-3 d-flex justify-content-center">
                        <a href="{{ route('post.create') }}" class="btn btn-primary">{{ __('Добавить новую запись') }}</a>
                    </div>
                </div>
                <div class="col-4">

                </div>
            </div>
        @endauth
        <div class="row">
            <div class="col-12">
                <post-component
                        content="{{ $post->content }}"
                        title="{{ $post->title }}"
                >
                    <template v-slot:after-editor>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('post.index') }}" class="card-link">Назад</a>
                            </div>
                            <div class="d-flex justify-content-between">
                                {!! (new \App\Library\PluginManagers\ExternalAsset\ExternalAssetPluginManager())->renderInCustomSection('share_post_section') !!}
                            </div>
                        </div>
                    </template>
                </post-component>
            </div>
        </div>
    </div>
@endsection
