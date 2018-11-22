@extends('template.master')
@section('title', 'Ubah Tag Proyek')

@section('css')
<style>
.col-form {
    margin: 0 auto;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

</style>
@endsection

@section('content')

    <div class="container">

        <div class="page-header">
            <h1 class="page-title mx-auto">
                Ubah Tag
            </h1>
        </div>

        <div class="col-4 col-form">

            <div class="card">
                <div class="card-body">
                <form method="POST" action="{{ route('update-project-tag', ['id' => $project->id]) }}">
                    <fieldset class="form-fieldset">
                        @csrf

                        <div class="form-group">
                            <label class="form-label" for="name">Tag <span class="form-required">*</span></label>
                            <input id="tags" class="form-control" type="text" name="tags" value="{{ $project->tags->implode('name', ',') }}" required>
                        </div>

                        <div class="d-flex">
                            <a href="{{ route('project-detail', ['id' => $project->id]) }}" class="btn btn-link">Batal</a>
                            <button class="btn btn-primary ml-auto">Simpan</button>
                        </div>
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    require(['jquery', 'selectize'], function($, selectize) {
        $(document).ready(function(){
            $('#tags').selectize({
                delimiter: ',',
                persist: false,
                create: function(input) {
                    return {
                        value: input,
                        text: input
                    }
                },
                valueField: 'value',
                labelField: 'value',
                searchField: ['value'],
                options: [

                    @foreach ($available_tags as $tag)
                        { value: '{{ $tag->name }}' },
                    @endforeach

                ],
            });
        });
    });
</script>
@endsection
