<?php

?>
<section id="features" class="py-20 lg:py-32 bg-gray-50">
    <div class="container mx-auto px-4 lg:px-8">
        <?php $book_purchase_url = get_theme_mod( 'book_purchase_url', '' ); ?>
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-2 uppercase">Serviços & Produtos</h2>
            <div class="h-1 w-20 bg-brand-green mx-auto mb-4"></div>
            <p class="text-xl lg:text-2xl text-gray-600 max-w-2xl mx-auto">Soluções em saúde para promover seu bem-estar integral</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="features-grid__item p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
                <div class="w-16 h-16 bg-green-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-green transition-colors">
                    <svg class="w-8 h-8 text-brand-green group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Palestras</h3>
                <p class="text-lg text-gray-600 leading-relaxed">Conteúdos inspiradores sobre saúde física, mental, financeira e profissional para seu evento.</p>
            </div>

            <div class="features-grid__item p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
                <div class="w-16 h-16 bg-green-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-green transition-colors">
                    <svg class="w-8 h-8 text-brand-green group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Livro</h3>
                <p class="text-lg text-gray-600 leading-relaxed">Acesse o link de compra do livro.</p>
                <?php $book_purchase_url = 'https://pag.ae/7ZywmJvEn';
                    if ( ! empty( $book_purchase_url ) ) : ?>
                    <div class="mt-8">
                        <a href="<?php echo esc_url( $book_purchase_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-brand-green hover:text-brand-gold font-semibold group">
                            <span>Comprar</span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="features-grid__item p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
                <div class="w-16 h-16 bg-green-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-green transition-colors">
                    <svg class="w-8 h-8 text-brand-green group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Serviço 1</h3>
                <p class="text-lg text-gray-600 leading-relaxed">Descrição do serviço 1.</p>
            </div>

            <div class="features-grid__item p-10 md:p-12 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all border border-gray-100 hover:border-brand-green group text-center">
                <div class="w-16 h-16 bg-green-50 rounded-lg flex items-center justify-center mx-auto mb-6 group-hover:bg-brand-green transition-colors">
                    <svg class="w-8 h-8 text-brand-green group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 01-2 2H9a2 2 0 01-2-2m12 0a2 2 0 00-2-2H7a2 2 0 00-2 2m14 0v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Produto 2</h3>
                <p class="text-lg text-gray-600 leading-relaxed">Descrição do produto 2.</p>
            </div>
        </div>
    </div>
</section>
