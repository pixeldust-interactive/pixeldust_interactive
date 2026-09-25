<?php
/**
 * Plugin Name: AskMaisy Unified Navigation
 * Description: Keeps the AskMaisy primary navigation identical across the React homepage and WordPress interior templates.
 * Version: 1.0.0
 * Author: Pixeldust
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_footer', function () {
    if ( untrailingslashit( home_url() ) !== 'https://askmaisy.com' ) {
        return;
    }
    ?>
    <style id="askmaisy-unified-nav-css">
    .am-unified-nav-shell{background:#111d32!important}
    .am-unified-nav-wrap{
        width:min(100% - 56px,1260px)!important;
        max-width:1260px!important;
        margin:0 auto!important;
        padding:20px 0!important;
        display:flex!important;
        align-items:center!important;
        justify-content:space-between!important;
        gap:24px!important;
        border-bottom:1px solid rgba(255,255,255,.10)!important;
        list-style:none!important;
        box-sizing:border-box!important;
    }
    .am-unified-brand{
        display:inline-flex!important;
        align-items:center!important;
        gap:12px!important;
        flex:0 0 auto!important;
        color:#fff!important;
        text-decoration:none!important;
    }
    .am-unified-brand img{display:block!important;width:128px!important;height:auto!important;max-height:48px!important;object-fit:contain!important}
    .am-unified-brand span{border-left:1px solid rgba(255,255,255,.28)!important;padding-left:14px!important;color:#fff!important;font-size:22px!important;font-weight:600!important;letter-spacing:-.03em!important}
    .am-unified-links{
        display:flex!important;
        align-items:center!important;
        justify-content:flex-end!important;
        gap:22px!important;
        margin-left:auto!important;
        list-style:none!important;
    }
    .am-unified-links a{
        color:#fff!important;
        text-decoration:none!important;
        font-size:14px!important;
        line-height:1.2!important;
        font-weight:700!important;
        white-space:nowrap!important;
    }
    .am-unified-links a:hover,.am-unified-links a.is-active{color:#c8f04b!important}
    .am-unified-cta{
        display:inline-flex!important;
        align-items:center!important;
        justify-content:center!important;
        gap:22px!important;
        min-height:50px!important;
        padding:0 20px!important;
        border:1px solid #66758b!important;
        border-radius:10px!important;
        color:#fff!important;
        text-decoration:none!important;
        font-size:14px!important;
        font-weight:750!important;
        white-space:nowrap!important;
        background:transparent!important;
        flex:0 0 auto!important;
    }
    .am-unified-cta:hover{border-color:#c8f04b!important;color:#c8f04b!important;background:rgba(200,240,75,.05)!important}
    .am-unified-cta span{font-size:20px!important;line-height:1!important}
    @media(max-width:1100px){
        .am-unified-nav-wrap{width:min(100% - 36px,1260px)!important;gap:16px!important}
        .am-unified-links{gap:14px!important}
        .am-unified-links a{font-size:13px!important}
    }
    @media(max-width:900px){
        .am-unified-nav-wrap{align-items:flex-start!important;flex-wrap:wrap!important}
        .am-unified-links{order:3;width:100%!important;margin:0!important;justify-content:flex-start!important;flex-wrap:wrap!important}
        .am-unified-cta{margin-left:auto!important}
    }
    @media(max-width:560px){
        .am-unified-nav-wrap{width:min(100% - 28px,1260px)!important;padding:15px 0!important}
        .am-unified-brand img{width:100px!important}
        .am-unified-brand span{font-size:18px!important}
        .am-unified-cta{min-height:44px!important;padding:0 14px!important;font-size:13px!important}
        .am-unified-links{gap:10px 14px!important}
        .am-unified-links a{font-size:12px!important}
    }
    </style>
    <script id="askmaisy-unified-nav-js">
    (function(){
        const items = [
            ['SaaS Development','/'],
            ['PIE','https://saas-ideas.com/'],
            ['Small Business Solutions','/ai-consulting-practical-ai-solutions-in-college-station-tx-maisy/'],
            ['Knowledge Hub','/how-maisy-works/'],
            ['Blog','/blog/'],
            ['Contact Us','/contact-us/'],
            ['Signals','/signals/']
        ];
        const normalize = p => (p || '/').replace(/\/+$/,'') || '/';
        const current = normalize(window.location.pathname);
        const links = items.map(([label,href]) => {
            const path = href.indexOf('http') === 0 ? '' : normalize(href);
            const active = path && current === path ? ' is-active' : '';
            const external = href.indexOf('https://saas-ideas.com/') === 0 ? ' target="_blank" rel="noopener"' : '';
            return '<a class="am-unified-link'+active+'" href="'+href+'"'+external+'>'+label+'</a>';
        }).join('');
        const brand = '<a class="am-unified-brand" href="/" aria-label="Maisy home"><img src="https://askmaisy.com/wp-content/uploads/2026/09/Maisy-React-Brand-Mark.jpg" alt="Maisy"><span>Studio</span></a>';
        const cta = '<a class="am-unified-cta" href="/contact-us/">Start a project <span aria-hidden="true">→</span></a>';
        const html = brand + '<nav class="am-unified-links" aria-label="Main navigation">'+links+'</nav>' + cta;

        function mount(){
            const home = document.querySelector('.sl-nav');
            if(home){
                home.classList.add('am-unified-nav-wrap');
                home.innerHTML = html;
                const shell = home.closest('.sl-dark');
                if(shell) shell.classList.add('am-unified-nav-shell');
            }
            const interior = document.querySelector('.mr-site-header .mr-header-inner');
            if(interior){
                interior.classList.add('am-unified-nav-wrap');
                interior.innerHTML = html;
                const shell = interior.closest('.mr-site-header');
                if(shell) shell.classList.add('am-unified-nav-shell');
            }
        }
        if(document.readyState === 'loading') document.addEventListener('DOMContentLoaded', mount, {once:true});
        else mount();
    })();
    </script>
    <?php
}, 100 );
