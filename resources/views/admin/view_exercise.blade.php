<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/3/2016
 * Time:    12:59 PM
 **/
$object = json_encode($object);
?>
@extends('admin.exercises')
@section('extra_scripts')
    @parent
    <script type="text/javascript">
        $(function () {
            previewDataObject(<?= $object ?>, window.AppStorage, ExercisePreviewer);
        });
    </script>
@endsection
