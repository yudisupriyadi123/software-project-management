@extends('template.master')
@section('title', 'Prospek')
@section('css')
<style>
.btn-as-text {
color: #495057;
border: none;
box-shadow: none;
background: transparent;
cursor: pointer;
}

.stepwizard {
display: table;
width: 100%;
position: relative;
margin-top: 40px;
}
.stepwizard p {
margin-top: 10px;
}
.stepwizard-row {
display: table-row;
}
.stepwizard-row:before {
top: 14px;
bottom: 0;
position: absolute;
content: " ";
width: 100%;
height: 1px;
background-color: #ccc;
z-order: 0;
}
.stepwizard-step {
display: table-cell;
text-align: center;
position: relative;
}
.stepwizard-step .btn.disabled {
opacity: 1 !important;
filter: alpha(opacity=100) !important;
}

.btn-circle {
width: 30px;
height: 30px;
text-align: center;
padding: 6px 0;
font-size: 12px;
line-height: 1.428571429;
border-radius: 15px;
}

.button-step .btn {
width: 140px;
display: inline-block;
}
.button-step .btn-as-text {
width: 60px;
}

.page-title { margin: auto }

.clearfix::after {
content: "";
clear: both;
display: table;
}
.clearfix .left, .clearfix .right {display: inline-block}
.clearfix .left {float: left}
.clearfix .right {float:right}

.check-circle-container {
    position: relative;
}
.check-circle {
    display: hidden;
    position: absolute;
    top: -7px;
    right: -3px;
    font-size: 17px;
    color: green;
    font-weight: bold;
    text-shadow: 0px 1px #fff;
}
</style>
@endsection

@section('content')
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-secondary btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-primary btn-circle disabled">2</a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-secondary btn-circle disabled">3</a>
            <p>Step 3</p>
        </div>
    </div>
</div>

<div class="container">

    <div class="page-header">
        <h1 class="page-title">
            Pilih Jenis Proyek
        </h1>
    </div>

    <!-- TODO: change to Platform (not type) and add tag -->

    <div class="row row-cards">
        <div class="col col-3 mx-auto">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <tbody>
                            @foreach ($project_types as $project_type)
                            <tr>
                                <td width="10%" class="text-center"><i class="{{ $project_type->icon }} text-muted"></i></td>
                                <td width="80%">{{ $project_type->name }}</td>
                                <td width="10%" class="text-center">
                                    <span class="check-circle-container">
                                        <a href="#" data-project-type-id="{{ $project_type->id }}" class="btn btn-outline-info btn-sm">Pilih</a>
                                        <i class="fe fe-check-circle check-circle"></i>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cards">
        <div class="col col-3 mx-auto">
            <a id="next_button" href="{{ url('project/new/step-3') . "?client_id=$client_id" }}" class="btn btn-primary">Berikutnya</a>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    window.scroll(0, 65.133 + 55.5 + 1);

    require(['jquery'], function($) {
        $(document).ready(function(){
            $(".check-circle").hide();
            $(".check-circle-container a").click(function(e){
                e.preventDefault();
                $(".check-circle").hide();
                $(this).closest(".check-circle-container").find(".check-circle").show();

                let project_type_id = $(this).data('project-type-id');
                $("#next_button").attr('href', $("#next_button").attr('href').replace(/&project_type_id=\d+/, ''));
                $("#next_button").attr('href', $("#next_button").attr('href') + '&project_type_id=' + project_type_id);
            });
        });
    });
</script>
@endsection
