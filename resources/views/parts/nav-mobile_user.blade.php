<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    3:13 PM
 **/
?>
<li>
    <a href="{{url()->route('profile.view')}}">
        <i class="material-icons right">account_circle</i>
        @if(!empty($user->name()))
            {{$user->name()}}
        @else
            MY PROFILE
        @endif
        <span class="badge font-sm">PROFILE</span>
    </a>
</li>
<li class="divider"></li>
<li>
    <a onclick="event.preventDefault(); $('#logout-form').submit();">
        <i class="material-icons right">lock</i> SIGN ME OUT
    </a>
</li>

