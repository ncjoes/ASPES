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
    </style>
@endsection
@section('content')
    <div class="container section">
        <div class="white tiny-padding z-depth-0 margin-btm-1em">
            <div class="row">
                <div class="col s12">
                    <h1 class="page-title"><i class="material-icons left">list</i>Manage Exercises</h1>
                </div>
            </div>
            <div class="row" id="r2">
                <div class="col s12">
                    <form onsubmit="return false;" id="search-form">
                        <div class="row">
                            <div class="col s10 m11">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix small left">search</i>
                                        <input type="text" id="search" class="autocomplete">
                                        <label for="search">Search</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col s2 m1 center-align">
                                <button class="btn-floating"><i class="material-icons small">add</i></button>
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
    <section class="hide" id="building-blocks">
        <div id="progress-bar" class="progress blue">
            <div class="indeterminate blue lighten-2"></div>
        </div>
    </section>
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
                infoUrl: '<?= url()->route('admin.exercises.get'); ?>',
                loaded: {},
                View: function () {
                    return window.View;
                }
            };

            buildExercisesTable(Storage.listed, View.listBox, true);

            View.listBox.on('click focus', 'tr', function () {
                previewDataRow(this, Storage, ExercisePreviewer)
            });

            $(window).on('resize load', function (e) {
                if($(window).width() > 600) {
                    var SearchForm = $('#search-form');
                    SearchForm.pushpin({top: SearchForm.offset().top - 50});
                }
                if($(window).width() > 1024) {
                    var Sidebar = $('#sidebar');
                    Sidebar.pushpin({top: Sidebar.offset().top - 100});
                    Sidebar.attr('style', 'max-width:'+parseInt(Sidebar.parent().width())+'px;')
                }
            })
        })
    </script>
@endsection
