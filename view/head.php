<?php
/**
 * @var string|null $gtmId
 * @var string|null $ga4Id
 * @var bool $askConsent
 */
?>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
<?php if ($askConsent) { ?>
(function () {
    var choice = null;
    try { choice = window.localStorage.getItem('ipAnalyticsConsent'); } catch (e) {}
    var state = choice === 'granted' ? 'granted' : 'denied';
    gtag('consent', 'default', {
        'analytics_storage': state,
        'ad_storage': state,
        'ad_user_data': state,
        'ad_personalization': state,
        'wait_for_update': 500
    });
})();
<?php } ?>
</script>
<?php if ($gtmId) { ?>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?php echo esc($gtmId); ?>');</script>
<?php } ?>
<?php if ($ga4Id) { ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo escAttr($ga4Id); ?>"></script>
<script>gtag('js', new Date()); gtag('config', '<?php echo esc($ga4Id); ?>');</script>
<?php } ?>
