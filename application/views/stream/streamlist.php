<?php if ($count > 0) { ?>
<div align="left">Total <b><span class="count"><?=$count; ?></span></b> Search terms added</div>
<table class="table table-hover">
    <thead>
    <tr>
        <th class="column-mini">#</th>
        <th>Search Term</th>
        <th class="column-small">Posts</th>
        <th class="column-small">Type</th>
        <th class="column-small">Source</th>
        <th class="column-mini"></th>
    </tr>
    </thead>
    <tbody>
    <?php if ($list){ ?>
        <?php foreach($list as $stream){ ?>
            <tr id="stream-<?=$stream->getId(); ?>">
                <td class="column-mini"><input type="checkbox" name="stream_id[]" value="<?=$stream->getId(); ?>" ></td>
                <td class="column-title">
                    <?=$stream->getKeyword(); ?>
                </td>
                <td class="column-small">
                    <span class="badge badge-info">0</span>
                </td>
                <td class="column-small">
                    <?php if ($stream->getIsProfile() == 'y') {
                        echo "Profile";
                    } else if ($stream->getIsPhrase() == 'y') {
                        echo "Exact Match";
                    } else {
                        echo "-";
                    } ?>
                </td>
                <td class="column-small">
                    <?php if ($stream->getIsTwitter() == 'y') { ?><i class="icon-twitter"></i><?php } ?>
                    <?php if ($stream->getIsFacebook() == 'y') { ?><i class="icon-facebook"></i><?php } ?>
                    <?php if ($stream->getIsGplus() == 'y') { ?><i class="icon-gplus"></i><?php } ?>
                </td>
                <td class="column-mini">
                    <?php $btnType = ($stream->getStatus() == 'active') ? 'btn-success' : 'btn-warning'; ?>
                    <button class="stream-action btn btn-small <?=$btnType; ?>" type="button" data-type="stream" data-action="change-status" id="<?=$stream->getId(); ?>" data-value="<?=$stream->getStatus(); ?>" title="Click to Change Status"><?=ucwords($stream->getStatus()); ?></button>
                    <a class="stream-action btn btn-mini" href="javascript:void(0);" id="<?=$stream->getId(); ?>" data-name="<?=$stream->getKeyword(); ?>" data-action="delete" title="Delete search term <?=$stream->getKeyword(); ?>"><i class="icon-trash"></i></a>
                </td>
            </tr>
    <?php } } ; ?>
    </tbody>
</table>
<?php } else { ?>

    <h5>No Keywords added.<br>Please use the form above, to add new Keywords and setup search streams.</h5>

<?php } ?>