<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    11/4/2016
 * Time:    3:24 PM
 **/
?>
<li>
    <a class="dropdown-button" data-activates="dropdown-1">
        <i class="material-icons small">person</i>
    </a>
</li>
<ul class="dropdown-content" id="dropdown-1">
    <li>
        <a href="{{url()->route('profile.view')}}" class="font-sm">
            <span class="material-icons font-inherit">edit</span> MY PROFILE
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a onclick="event.preventDefault(); $('#logout-form').submit();" class="font-sm">
            <span class="material-icons font-inherit">lock</span> SIGN ME OUT
        </a>
    </li>
</ul>
