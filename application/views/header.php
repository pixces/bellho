<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>iAdmin Panel</title>
    <base href="<?=SITE_URL; ?>">
    <link rel="shortcut icon" href="<?=SITE_IMAGE; ?>favicon.ico" type="image/x-icon" />
    <link href='http://fonts.googleapis.com/css?family=Ropa+Sans|Roboto|Source+Sans+Pro:900italic,400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>bootstrap.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?=SITE_CSS; ?>style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" ></script>
    <script src="<?=SITE_JS; ?>bootstrap.js" type="text/javascript"></script>
    <script src="<?=SITE_JS; ?>social.js" type="text/javascript"></script>
    <script src="<?=SITE_JS; ?>functions.js" type="text/javascript"></script>
    <script src="<?=SITE_JS; ?>html5shiv.js" type="text/javascript"></script>
    <script src="<?=SITE_JS; ?>pngfix.js" type="text/javascript"></script>
</head>
<body>
<!-- Start Header //-->
<div id="page-top-outer">
    <div class="row-fluid">
        <div class="span12" id="page-top-inner">
            <div class="nav-area top pull-left span10">
                <div id="logo" class="span3">
                    <h3 class="muted">
                        <span>CampaignHUB</span>
                    </h3>
                </div>
                <?php if ($pagetype != 'login') { ?>
                <div class="top-nav span9">
                    <ul class="nav nav-pills">
                        <?php foreach ($navigation as $k=>$v) { ?>
                            <li class="<?=$k; ?> <?php echo $t = ( $pageType == $k ) ? 'active' : ''; ?>">
                                <a class="<?=strtolower($v['name']); ?>" href="<?=$v['url']; ?>">
                                    <i></i><?=$v['name']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
            <div class="top-settings pull-right span2">
                <div class="btn-group pull-right">
                    <button class="btn btn-info"><i class="icon-user"></i>&nbsp; Welcome</button>
                    <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-cog"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <!--
                        <li><a href=""><i class="icon-edit"></i> Update Profile</a></li>
                        <li><a href=""><i class="icon-refresh"></i> Change Password</a></li>
                        -->
                        <li><a href="<?=SITE_URL; ?>/index/logout"><i class="icon-off"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Header -->
<!-- Start Main //-->
<div id="page-body-outer">
    <div id="page-body-inner">
        <div>
            <h1>
                <?=ucwords(strtolower($pageTitle)); ?>
                <?php if($addUrl){ ?>
                    <a class="addlink" href="<?=$addUrl; ?>"><i class="icon-plus-sign icon-white"></i> Add New</a>
                <?php } ?>
            </h1>
            <!-- crumbs
            <div class="crumbs">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a> <span class="divider">/</span></li>
                    <li><a href="#">Library</a> <span class="divider">/</span></li>
                    <li class="active">Data</li>
                </ul>
            </div>
            crumbs end -->
        </div>
        <!-- display notification on all pages -->
        <div class="alert">
            <span class="message">Default message goes here....</span>
        </div>
        <!-- Notification ends -->
        <!-- main content area start -->
        <div>