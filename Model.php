<?php

namespace Plugin\Analytics;

class Model
{
    /**
     * Only public pages are tracked: never the admin, the page editor or (optionally) logged-in admins.
     */
    public static function isTrackingPage()
    {
        if (ipRoute()->isAdmin() || ipIsManagementState()) {
            return false;
        }
        if (ipAdminId() && ipGetOption('Analytics.skipAdmins', 1)) {
            return false;
        }
        if (ipRequest()->getQuery('ipDesignPreview')) {
            return false;
        }
        return true;
    }

    /**
     * IDs are printed into a script, so only accept the documented formats.
     */
    public static function gtmId()
    {
        $id = strtoupper(trim((string)ipGetOption('Analytics.gtmId', '')));
        return preg_match('/^GTM-[A-Z0-9]{4,12}$/', $id) ? $id : null;
    }

    public static function ga4Id()
    {
        $id = strtoupper(trim((string)ipGetOption('Analytics.ga4Id', '')));
        return preg_match('/^G-[A-Z0-9]{4,16}$/', $id) ? $id : null;
    }

    public static function askConsent()
    {
        return (bool)ipGetOption('Analytics.consentBanner', 1);
    }

    public static function privacyUrl()
    {
        $url = trim((string)ipGetOption('Analytics.privacyUrl', ''));
        return preg_match('#^(https?://|/)#i', $url) ? $url : '';
    }
}
