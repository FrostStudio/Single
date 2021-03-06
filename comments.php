<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>

    <li id="<?php $comments->theId(); ?>">
        <?php $comments->gravatar('150', ''); ?>
        <div class="comment-meta">
            <span class="comment-author"><?php $comments->author(); ?></span>
            <time class="comment-time"><?php $comments->date('y.m.d'); ?></time>
            <span class="comment-reply"><?php $comments->reply(); ?></span>
        </div>
        <div class="comment-content">
            <?php $comments->content(); ?>
        </div>
<?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
<?php } ?>
    </li>
<?php } ?>
<section id="comments" class="post-comments">
    <h3><?php $this->commentsNum(_t('没有评论'), _t('只有一条评论 (QwQ)'), _t('已有 %d 条评论')); ?></h3>
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <span class="cancel-comment-reply">
            <?php $comments->cancelReply(); ?>
        </span>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <div class="row">
                <?php if($this->user->hasLogin()): ?>
                <div class="col-m-12">
                    <p><?php _e('已登录: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="登出"><?php _e('登出'); ?> &raquo;</a></p>
                    <p>
                        <textarea rows="2" name="text" id="textarea" placeholder="快来评论吧 (*≧ω≦)ﾉ" required=""><?php $this->remember('text'); ?></textarea>
                    </p>
                    <p>
                        <button type="submit" class="btn small">写好了~</button>
                    </p>
                </div>
                <?php else: ?>
                <div class="col-m-6">
                    <p>
                        <input type="text" name="author" id="author" placeholder="昵称 *：" value="<?php $this->remember('author'); ?>" required="">
                    </p>
                    <p>
                        <input type="email" name="mail" id="mail" placeholder="电邮 *：" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                    </p>
                    <p>
                        <input type="url" name="url" id="url" placeholder="http://" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
                    </p>
                </div>
                <div class="col-m-6">
                    <p>
                        <textarea rows="3" name="text" id="textarea" placeholder="快来评论吧 (*≧ω≦)ﾉ" required=""><?php $this->remember('text'); ?></textarea>
                    </p>
                    <p>
                        <button type="submit" class="btn small">写好了~</button>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <?php endif; ?>
    <?php if ($comments->have()): ?>
        <?php $comments->listComments(); ?>
        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    <?php endif; ?>
</section>
