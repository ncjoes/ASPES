<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/2/2016
 * Time:    6:53 PM
 **/
?>
@extends('layouts.admin')
@section('extra_heads')
    <style type="text/css">
        #search-form .row, input#search {
            margin-bottom: auto !important;
        }

        .section {
            padding-bottom: 0 !important;
        }

        #list-box tr {
            cursor: pointer;
        }

        h5.preview-title {
            font-size: 1.5em;
            color: white;
        }

        #preview-box h6 {
            font-size: 1.1em;
        }

        #r2 .pinned {
            position: fixed !important;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: #fff;
            border-bottom: 1px solid lightblue;
            box-shadow: 0 2px 4px 2px rgba(0, 0, 0, 0.4);
            padding: 0.5em;
        }

        #sidebar.pinned {
            position: fixed !important;
            padding-top: 100px !important;
            width: inherit !important;
            right: auto !important;
        }

        #sidebar.pin-top, #sidebar.pin-bottom {
            position: relative;
        }
    </style>
@endsection
@section('content')
    <div class="container section">
        <div class="white tiny-padding z-depth-0 margin-btm-1em">
            <div class="row">
                <div class="col s10 m11">
                    <h1 class="page-title"><i class="material-icons left">list</i>Manage Exercises</h1>
                </div>
                <div class="col s2 m1">
                    <p class="center-align">
                        <button class="btn"><i class="material-icons small">add</i></button>
                    </p>
                </div>
            </div>
            <div class="row" id="r2">
                <div class="col s12">
                    <form onsubmit="return false;" id="search-form">
                        <div class="row">
                            <div class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix small left">search</i>
                                        <input type="text" id="search" class="autocomplete">
                                        <label for="search">Search</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="white tiny-padding z-depth-0" id="data-area">
            <div class="row">
                <div class="col s12 l8">
                    <table id="data-table" class="bordered highlight responsive-table shrink margin-btm-1em">
                        <thead>
                        <tr>
                            <th data-field="sn">SN</th>
                            <th data-field="title">Title</th>
                            <th data-field="start">Start</th>
                            <th data-field="stop">Stop</th>
                        </tr>
                        </thead>
                        <tbody id="list-box">
                        <tr id="tmp">
                            <td colspan="4">
                                <div class="progress">
                                    <div class="indeterminate"></div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 l4">
                    <div class="sh-30vh mh-40vh lh-50vh light-blue lighten-2 tiny-padding z-depth-half" id="sidebar">
                        <div class="row">
                            <div class="col s12" id="preview-box">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="exercise-editor" class="modal modal-fixed-footer">
        <form>
            {{csrf_field()}}
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 no-padding">
                        <ul class="tabs">
                            <li class="tab col s2"><a href="#tab-description" class="active">Description</a></li>
                            <li class="tab col s2"><a href="#tab-factors">Factors</a></li>
                            <li class="tab col s2"><a href="#tab-comments">Comments</a></li>
                            <li class="tab col s2"><a href="#tab-evaluators">Evaluators</a></li>
                            <li class="tab col s2"><a href="#tab-subjects">Subjects</a></li>
                            <li class="tab col s2 blue"><a href="#tab-publish" class="white-text">Publish</a></li>
                        </ul>
                    </div>
                    <div class="divider"></div>
                    <div id="tab-description" class="col s12 section">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="title" name="title" type="text" class="validate">
                                <label for="title">Title</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" name="outline" class="materialize-textarea lh-20vh sh-30vh"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="start_date" type="date" class="datepicker">
                                <label for="start_date">Start Date/Time</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="stop_date" type="date" class="datepicker">
                                <label for="stop_date">Stop Date/Time</label>
                            </div>
                        </div>
                    </div>
                    <div id="tab-factors" class="col s12">
                        <div id="factors" class="tiny-padding">
                            <p>
                                <strong>Evaluation Factors</strong>
                            </p>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="factor-1" name="factors[]" type="text" class="validate">
                                    <label for="factor-1">Factor...</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 right-align">
                                    <button type="button" class="btn-floating grey"><i class="material-icons small">add</i></button>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div id="comparison-scales" class="grey lighten-3 tiny-padding">
                            <p>
                                <strong>Factors Comparison Scale</strong>
                            </p>
                            <div class="row">
                                <div class="input-field col s9">
                                    <input id="fcv-ls-1" name="fcv-ls[1]" type="text" class="validate">
                                    <label for="fcv-ls-1">Linguistic Variable...</label>
                                </div>
                                <div class="input-field col s3">
                                    <input id="fcv-tfs-1" name="fcs-tfs[1]" type="text" class="validate">
                                    <label for="fcv-tfs-1">TFS</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 right-align">
                                    <button type="button" class="btn-floating grey"><i class="material-icons small">add</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-comments" class="col s12">
                        <div class="row">
                            <div class="input-field col s10">
                                <input id="comment-1" name="comments[1]" type="text" class="validate">
                                <label for="comment-1">Comment...</label>
                            </div>
                            <div class="input-field col s2">
                                <input id="comment-grade-1" name="grades[1]" type="number" min="0" max="100" class="validate">
                                <label for="comment-grade-1">Grade</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 right-align">
                                <button type="button" class="btn-floating grey"><i class="material-icons small">add</i></button>
                            </div>
                        </div>
                    </div>
                    <div id="tab-evaluators" class="col s12">
                        <div class="row no-margin">
                            <div class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix small left">search</i>
                                        <input type="text" id="search-user" class="autocomplete">
                                        <label for="search-user">Search</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <table id="data-table" class="bordered highlight responsive-table shrink margin-btm-1em">
                                    <thead>
                                    <tr>
                                        <th data-field="sn" width="4%">SN</th>
                                        <th data-field="name">User</th>
                                        <th data-field="role" width="15%">Role</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list-box">
                                    <tr id="tmp">
                                        <td colspan="3" class="center-align">
                                            -- Selecting users by searching with name --
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab-subjects" class="col s12">
                        <div class="row no-margin">
                            <div class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix small left">search</i>
                                        <input type="text" id="search-user" class="autocomplete">
                                        <label for="search-user">Search</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <table id="data-table" class="bordered highlight responsive-table shrink margin-btm-1em">
                                    <thead>
                                    <tr>
                                        <th data-field="sn" width="4%">SN</th>
                                        <th data-field="name">User</th>
                                    </tr>
                                    </thead>
                                    <tbody id="list-box">
                                    <tr id="tmp">
                                        <td colspan="2" class="center-align">
                                            -- Selecting users by searching with name --
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab-publish" class="col s12">--</div>
                </div>
            </div>
            <div class="modal-footer center-align">
                <p class="center-align">
                    <button class="btn z-depth-half green darken-5" id="save"><i class="material-icons right">save</i> SAVE</button>
                    <a class="btn z-depth-half grey darken-5" id="x"><i class="material-icons">close</i></a>
                </p>
            </div>
        </form>
    </div>

@endsection
@section('extra_scripts')
    <script src="{{ asset('js/app.utils.js') }}"></script>
    <script src="{{ asset('js/admin-panel.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            var View = window.AppView = {
                listBox: $('#list-box'),
                previewBox: $('#preview-box'),
                Storage: function () {
                    return window.Storage;
                }
            };
            var Storage = window.AppStorage = {
                total: parseInt({{$net_total}}),
                listed: jsonDecode(<?= json_encode($list); ?>),
                infoUrl: '<?= url()->route('admin.exercises.view'); ?>',
                loaded: {},
                View: function () {
                    return window.View;
                }
            };

            View.listBox.on('click focus', 'tr', function () {
                previewDataRow(this, Storage, ExercisePreviewer)
            });

            /*
             $('ul.tabs').tabs();
             $('.datepicker').pickadate({
             selectMonths: true,
             selectYears: 15
             });

             $('#exercise-editor').openModal({
             dismissible: false,
             starting_top: '3%',
             ending_top: '3%'
             });
             */
            $(window).on('resize', function (e) {
                adaptContent();
            });

            buildExercisesTable(Storage.listed, View.listBox, true);
            adaptContent();

            function adaptContent() {
                var Sidebar = $('#sidebar');
                if ($(window).width() > 1024) {
                    Sidebar.pushpin({top: Sidebar.offset().top});
                } else {
                    Sidebar.unbind();
                }
                Sidebar.attr('style', 'max-width:' + parseInt(Sidebar.parent().width()) + 'px;');

                var SearchForm = $('#search-form');
                if ($(window).width() > 600 && Storage.listed.length > 20) {
                    SearchForm.pushpin({top: SearchForm.offset().top - 50});
                } else {
                    SearchForm.unbind();
                    SearchForm.hide();
                }
            }
        });
    </script>
@endsection
