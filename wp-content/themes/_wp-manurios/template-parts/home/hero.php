<?php

?>
<section class="hero-section relative h-[85vh] min-h-[600px] p-0 overflow-hidden">
<?php
if ( function_exists( '_wp_manurios_home_banner_slider' ) ) {
    _wp_manurios_home_banner_slider();
}
?>
<div class="container mx-auto px-4 lg:px-8 w-full absolute top-0 left-0 right-0 z-10 h-full flex items-center">
    <div class="grid lg:grid-cols-2 gap-12 items-center w-full">
        <div></div>
    </div>
</div>
<a href="#about" class="hero-scroll-arrow text-white hover:text-gray-200 transition-all duration-300 cursor-pointer z-20 flex items-center justify-center absolute left-1/2 -translate-x-1/2" style="bottom: 6rem;" aria-label="Ir para próxima seção">
    <svg class="w-8 h-8 lg:w-10 lg:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M19 13l-7 7-7-7m14-6l-7 7-7-7"/>
    </svg>
</a>
</section>
