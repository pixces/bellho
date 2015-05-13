<div class="well well-small count-header">
    <div class="pull-left">
        <span class="">Displaying <?=strtoupper($current_status);?>&nbsp;&nbsp;<?=$pager['min_offset']." - ".$pager['max_offset']." Posts"; ?></span>&nbsp;|&nbsp;
        <?php if ($post_summary != 0){ ?>
            <?php foreach($post_summary as $status => $count) { ?>
                <span><a href="<?=SITE_URL; ?>/post/<?=$status; ?>/"><?=ucwords(strtolower($status))." Posts"; ?>&nbsp;<span class="label label-info"><?=$count; ?></span></a></span>
            <?php } ?>
        <?php } else { ?>
            <span><a href="<?=SITE_URL; ?>/post/all/">All Posts <span class="badge badge-info">0</span></a></span>
        <?php } ?>
    </div>
    <div class="pull-right">
        <?php if ($pager['totalPages'] > 0) { ?>
        <div class="pagination pagination-right">
            <ul>
                <?php if ($pager['current'] > 1 ) { ?>
                <li><a href="<?=SITE_URL."/post/".$current_status."/".$pager['prev']."/"; ?>">&laquo; Prev</a></li>
                <?php } else { ?>
                    <li class="disabled"><a>&laquo; Prev</a></li>
                <?php } ?>
                <li class="disabled"><a href="#"><?=$pager['current']; ?></a></li>
                <?php if ($pager['current'] < $pager['totalPages'] ) { ?>
                <li><a href="<?=SITE_URL."/post/".$current_status."/".$pager['next']."/"; ?>">Next &raquo;</a></li>
                <?php } else { ?>
                    <li class="disabled"><a href="<?=SITE_URL."/post/".$current_status."/".$pager['next']."/"; ?>">Next &raquo;</a></li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
<ul class="list-panel">
    <?php if ($postList){ ?>
    <?php foreach($postList as $post){ ?>
    <li id="post-<?=$post->id; ?>" class="item media">
        <input class="pull-left" type="checkbox" name="postId[]" value="<?=$post->id; ?>">
        <a class="pull-left" href="#"><img class="img-polaroid" src="<?=$post->user_profile_image; ?>"></a>
        <div class="media-body pull-left">
            <section><span class="title"><?=$post->user_name; ?></span><span class="muted">&nbsp;&nbsp;<?='@'.$post->user_screen_name; ?></span> </section>
            <p><?=createAside($post->post_text,250); ?></p>
            <section class="muted"><i class="<?='icon-'.$post->source; ?>"></i> <a target="_blank" href="<?=$post->post_url; ?>"><?=strtolower($post->post_url); ?></a></section>
        </div>
        <div class="media-action pull-right">
            <span><i class="icon-search"></i> <?=$post->keyword; ?></span>
            <span><i class="icon-calendar"></i> <?=date('r', $post->date_published_ts); ?></span>
            <span class="button-bar">
                <?php $btnType = ($post->post_status == 'approved') ? 'btn-success' : ( ($post->post_status == 'rejected') ? 'btn-danger' : 'btn-warning'); ?>
                <button class="posts-action btn btn-small <?=$btnType; ?>" type="button" data-type="post" data-action="change-status" id="<?=$post->id; ?>" data-value="<?=$post->post_status; ?>" title="Click to Change Status"><?=ucwords($post->post_status); ?></button>
                <a href="javascript:void(0);" class="posts-action btn btn-mini" data-type="post" data-action="delete" id="<?=$post->id; ?>" title="Delete this Post"><i class="icon-trash"></i></a>
            </span>
        </div>
    </li>
    <?php } } else { ?>
        <h5>No Posts found for this Status.<br>Please check other status or else make new calls.</h5>
    <?php } ?>
</ul>