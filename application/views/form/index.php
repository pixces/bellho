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
    <?php if ($formCount){ ?>
    <?php foreach($formCollection as $formData){ ?>
    <li  id="form-<?=$formData['id']; ?>"  class="item media">
        <input class="pull-left" type="checkbox" name="postId[]" value="<?=$post->id; ?>">
        <div class="pull-left">
            <div class="row" style="padding-bottom:10px">
            <section><span class="title span8"><?=$formData['title']; ?></span><span class="muted span2"><i class="icon-calendar"></i>  <?=date('l, d M Y', strtotime($formData['date'])); ?></span> </section>
            </div>
            <ul class="form-list">
                <?php foreach($formData['details'] as $field => $value){ ?>
                <li><b><?=strtoupper($field); ?> : </b><?=$value; ?></li>
                <?php } ?>
            </ul>
        </div>
    </li>
    <?php } } else { ?>
        <h5>No Forms found for this Status.<br>Please check other status.</h5>
    <?php } ?>
</ul>