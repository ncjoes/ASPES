<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    8:05 AM
 **/

$object = json_encode($object);
?>
@extends('admin.exercises')
@section('extra_scripts')
@parent
<script type="text/javascript">
    $(function () {
        previewDataObject(<?= $object ?>, window.AppStorage, ExercisePreviewer);
        //previewDataObject(<?= $object ?>, window.AppStorage, ExercisePreviewer);
    });
</script>
@endsection
