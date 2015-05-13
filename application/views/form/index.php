<div class="well well-small count-header">
    <div class="pull-left">
        <span class="">Displaying New &nbsp;&nbsp;<?=$pager['min_offset']." - ".$pager['max_offset']." Forms"; ?></span>
    </div>
    <div class="pull-right">
        <?php if ($pager['totalPages'] > 0) { ?>
        <div class="pagination pagination-right">
            <ul>
                <?php if ($pager['current'] > 1 ) { ?>
                <li><a href="<?=SITE_URL."/form/index/".$current_status."/".$pager['prev']."/"; ?>">&laquo; Prev</a></li>
                <?php } else { ?>
                    <li class="disabled"><a>&laquo; Prev</a></li>
                <?php } ?>
                <li class="disabled"><a href="#"><?=$pager['current']; ?></a></li>
                <?php if ($pager['current'] < $pager['totalPages'] ) { ?>
                <li><a href="<?=SITE_URL."/form/index/".$current_status."/".$pager['next']."/"; ?>">Next &raquo;</a></li>
                <?php } else { ?>
                    <li class="disabled"><a href="<?=SITE_URL."/form/index/".$current_status."/".$pager['next']."/"; ?>">Next &raquo;</a></li>
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
    <li  class="item media">
      
        <div class="media-body pull-left">
            <section><span class="title"><?=$post->title; ?></span></section>
            <p><?=  ($post->form_json); ?></p>
        </div>
      
    </li>
    <?php } } else { ?>
        <h5>No Forms found for this Status.<br>Please check other status.</h5>
    <?php } ?>
</ul>