<?php
/**
 * The template for displaying comments
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(
                    /* translators: %s: post title */
                    esc_html__('Um comentário em &ldquo;%s&rdquo;', 'wp-manurios'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    /* translators: 1: number of comments, 2: post title */
                    esc_html(_nx(
                        '%1$s comentário em &ldquo;%2$s&rdquo;',
                        '%1$s comentários em &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'wp-manurios'
                    )),
                    number_format_i18n($comments_number),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h3>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'callback'   => 'wp_manurios_comment',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => __('Comentários anteriores', 'wp-manurios'),
            'next_text' => __('Próximos comentários', 'wp-manurios'),
        ));
        ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php _e('Comentários estão fechados.', 'wp-manurios'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'          => __('Deixe um comentário', 'wp-manurios'),
        'title_reply_to'       => __('Deixe um comentário para %s', 'wp-manurios'),
        'cancel_reply_link'    => __('Cancelar resposta', 'wp-manurios'),
        'label_submit'         => __('Enviar comentário', 'wp-manurios'),
        'comment_field'        => '<div class="form-group mb-3"><label for="comment" class="form-label">' . __('Comentário', 'wp-manurios') . '</label><textarea id="comment" name="comment" class="form-control" rows="5" required></textarea></div>',
        'fields'               => array(
            'author' => '<div class="row"><div class="col-md-6"><div class="form-group mb-3"><label for="author" class="form-label">' . __('Nome', 'wp-manurios') . '</label><input id="author" name="author" type="text" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" required /></div></div>',
            'email'  => '<div class="col-md-6"><div class="form-group mb-3"><label for="email" class="form-label">' . __('Email', 'wp-manurios') . '</label><input id="email" name="email" type="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" required /></div></div></div>',
        ),
    ));
    ?>
</div>

<?php
// Custom comment callback
function wp_manurios_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class('comment-item'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-body card mb-3">
            <div class="card-body">
                <div class="comment-meta">
                    <div class="comment-author">
                        <?php echo get_avatar($comment, 50, '', '', array('class' => 'rounded-circle me-2')); ?>
                        <strong><?php comment_author_link(); ?></strong>
                    </div>
                    <div class="comment-metadata">
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i>
                            <?php comment_date(); ?>
                            <span class="mx-2">|</span>
                            <i class="bi bi-clock"></i>
                            <?php comment_time(); ?>
                        </small>
                    </div>
                </div>
                
                <div class="comment-content">
                    <?php comment_text(); ?>
                </div>
                
                <div class="comment-actions">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'class'     => 'btn btn-sm btn-outline-primary'
                    )));
                    ?>
                </div>
            </div>
        </div>
    <?php
}
?>
