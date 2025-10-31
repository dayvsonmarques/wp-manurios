    </div><!-- #content -->

    <?php do_action('wp_manurios_footer_top'); ?>
    
    <?php if (!is_page_template('page-jadoo.php')): ?>
    <footer id="colophon" class="site-footer bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <!-- Logo e Descrição -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-widget">
                        <?php if (has_custom_logo()) : ?>
                            <div class="footer-logo mb-3">
                                <?php 
                                $logo_id = get_theme_mod('custom_logo');
                                $logo_image = wp_get_attachment_image_src($logo_id, 'full');
                                if ($logo_image) {
                                    echo '<img src="' . esc_url($logo_image[0]) . '" alt="' . get_bloginfo('name') . '" height="40" class="mb-3">';
                                }
                                ?>
                            </div>
                        <?php else : ?>
                            <h4 class="text-light mb-3"><?php bloginfo('name'); ?></h4>
                        <?php endif; ?>
                        
                        <?php 
                        $description = get_bloginfo('description', 'display');
                        if ($description) :
                        ?>
                            <p class="text-light-emphasis mb-3"><?php echo esc_html($description); ?></p>
                        <?php endif; ?>
                        
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                </div>
                
                <!-- Menu de Navegação -->
                <div class="col-lg-2 col-md-3 col-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="text-light mb-3"><?php _e('Navegação', 'wp-manurios'); ?></h5>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'list-unstyled mb-0',
                            'container'      => false,
                            'fallback_cb'    => false,
                            'depth'          => 1,
                            'link_before'    => '<span class="text-light-emphasis">',
                            'link_after'     => '</span>',
                        ));
                        ?>
                    </div>
                </div>
                
                <!-- Widget Footer 2 -->
                <div class="col-lg-3 col-md-3 col-6 mb-4">
                    <div class="footer-widget">
                        <?php if (is_active_sidebar('footer-2')): ?>
                            <?php dynamic_sidebar('footer-2'); ?>
                        <?php else: ?>
                            <h5 class="text-light mb-3"><?php _e('Links Úteis', 'wp-manurios'); ?></h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><a href="<?php echo esc_url(home_url('/')); ?>" class="text-light-emphasis text-decoration-none"><?php _e('Início', 'wp-manurios'); ?></a></li>
                                <li class="mb-2"><a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="text-light-emphasis text-decoration-none"><?php _e('Política de Privacidade', 'wp-manurios'); ?></a></li>
                                <li class="mb-2"><a href="#" class="text-light-emphasis text-decoration-none"><?php _e('Termos de Uso', 'wp-manurios'); ?></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Widget Footer 3 - Contato -->
                <div class="col-lg-3 col-md-12 mb-4">
                    <div class="footer-widget">
                        <?php if (is_active_sidebar('footer-3')): ?>
                            <?php dynamic_sidebar('footer-3'); ?>
                        <?php else: ?>
                            <h5 class="text-light mb-3"><?php _e('Contato', 'wp-manurios'); ?></h5>
                            <div class="contact-info">
                                <p class="mb-2 text-light-emphasis">
                                    <i class="fas fa-envelope me-2"></i>
                                    <a href="mailto:contato@manurios.com" class="text-light-emphasis text-decoration-none">contato@manurios.com</a>
                                </p>
                                <p class="mb-2 text-light-emphasis">
                                    <i class="fas fa-phone me-2"></i>
                                    <a href="tel:+5511999999999" class="text-light-emphasis text-decoration-none">(11) 99999-9999</a>
                                </p>
                                <!-- Redes Sociais -->
                                <div class="social-links mt-3">
                                    <a href="#" class="text-light me-3" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="text-light me-3" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="text-light me-3" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="text-light" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <hr class="border-secondary my-4">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-light-emphasis">
                        &copy; <?php echo date('Y'); ?> 
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-light text-decoration-none"><?php bloginfo('name'); ?></a>. 
                        <?php _e('Todos os direitos reservados.', 'wp-manurios'); ?>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0 text-light-emphasis">
                        <?php _e('Desenvolvido com', 'wp-manurios'); ?> <i class="fas fa-heart text-danger"></i> <?php _e('em WordPress', 'wp-manurios'); ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
