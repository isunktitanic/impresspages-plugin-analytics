<?php

namespace Plugin\Analytics;

class Event
{
    public static function ipBeforeController()
    {
        if (!Model::isTrackingPage() || !Model::askConsent() || (!Model::gtmId() && !Model::ga4Id())) {
            return;
        }

        ipAddCss('Plugin/Analytics/assets/consent.css');
        ipAddJsVariable('ipAnalyticsConsent', array(
            'text' => ipGetOption('Analytics.consentText', __('We use cookies to understand how visitors use this site, so we can improve it.', 'Analytics', false)),
            'privacyUrl' => Model::privacyUrl(),
            'privacyLabel' => __('Privacy policy', 'Analytics', false),
            'accept' => __('Accept', 'Analytics', false),
            'decline' => __('Decline', 'Analytics', false),
            'title' => __('Cookies', 'Analytics', false),
        ));
        ipAddJs('Plugin/Analytics/assets/consent.js');
    }
}
