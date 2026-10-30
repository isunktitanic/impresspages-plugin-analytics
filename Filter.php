<?php

namespace Plugin\Analytics;

class Filter
{
    /**
     * Writes the consent defaults and the tag loaders into <head>.
     * The consent defaults must come first, so nothing tracks before the visitor decides.
     */
    public static function ipHead($head, $info)
    {
        if (!Model::isTrackingPage()) {
            return $head;
        }

        $gtmId = Model::gtmId();
        $ga4Id = Model::ga4Id();
        if (!$gtmId && !$ga4Id) {
            return $head;
        }

        return ipView('view/head.php', array(
            'gtmId' => $gtmId,
            'ga4Id' => $ga4Id,
            'askConsent' => Model::askConsent(),
        ))->render() . $head;
    }
}
