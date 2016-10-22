<?php
/**
 * aspes.msc
 *
 * Author:  Chukwuemeka Nwobodo (jcnwobodo@gmail.com)
 * Date:    10/20/2016
 * Time:    5:18 PM
 **/
?>
<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        thead{
            font-weight: 600;
        }
        tbody tr, a{
            border: none;
            color: black;
        }
        tbody tr:nth-of-type(odd) {
            background-color: whitesmoke;
        }
        tbody tr:hover, tr:hover a{
            background-color: gray;
            color: white;
        }
    </style>
    <title>App. Routes!</title>
</head>
<body>
<h1 style="text-align: center; margin: 5vh 5vh"><?= $text; ?></h1>
<div>
    <table border="1" cellpadding="2" cellspacing="0" style="margin: auto;">
        <thead>
        <tr><td colspan="5"><h3 style="text-align: center">Route Table</h3></td></tr>
        <tr><td>Name</td><td>Methods</td><td width="25%">URL Pattern</td><td>Action</td><td>Middleware</td></tr>
        </thead>
        <tbody>
        <?php
        foreach($routes as $route)
        {
            $methods = array_filter($route->methods(), function($e){return $e!='HEAD';});
            echo
                '<tr>
                <td>'.$route->getName().'</td>
                <td>'.implode(', ', $methods).'</td>
                <td><a href="'.url($route->uri()).'" target="_new">'.$route->getPath().'</td>
                <td>'.$route->getActionName().'</td>
                <td>'.implode(', ', $route->gatherMiddleware()).'</td>
            </tr>';
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
