<?php

require_once 'login.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
.panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px; }
</style>
<title>Self Demand</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">


</head>
<body style="padding-top:20px;">

<div class="container" style="margin-top:75px">
    <div class="row align-items-center justify-content-center">
    <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> Quick Shortcuts</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <a href="payments" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Payments</a>
                          <a href="#" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Bookmarks</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Reports</a>
                          <a href="mk" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <a href="users" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Users</a>
                          <a href="#" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Notes</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Photos</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a>
                        </div>
                    </div>
                    <a href="../../" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-globe"></span> Website</a>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</body>
</html>