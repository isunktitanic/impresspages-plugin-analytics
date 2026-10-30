/**
 * Cookie consent banner for Google Consent Mode v2.
 * Tracking stays denied until the visitor accepts; the choice is kept in localStorage.
 * Any link to #cookie-settings reopens the banner.
 */
(function () {
    "use strict";
    var config = window.ipAnalyticsConsent;
    var storageKey = 'ipAnalyticsConsent';
    if (!config) {
        return;
    }

    var read = function () {
        try {
            return window.localStorage.getItem(storageKey);
        } catch (e) {
            return null;
        }
    };

    var save = function (choice) {
        try {
            window.localStorage.setItem(storageKey, choice);
        } catch (e) {
            // storage blocked: the choice applies to this page view only
        }
        var state = choice === 'granted' ? 'granted' : 'denied';
        if (typeof window.gtag === 'function') {
            window.gtag('consent', 'update', {
                'analytics_storage': state,
                'ad_storage': state,
                'ad_user_data': state,
                'ad_personalization': state
            });
        }
    };

    var banner = null;
    var previousFocus = null;

    var close = function () {
        if (banner) {
            banner.parentNode.removeChild(banner);
            banner = null;
        }
        if (previousFocus && previousFocus.focus) {
            previousFocus.focus();
        }
    };

    // focus moves into the banner only when the visitor opened it, never on page load
    var open = function (fromVisitor) {
        if (banner) {
            return;
        }
        previousFocus = document.activeElement;
        banner = document.createElement('section');
        banner.className = 'ipAnalyticsConsent';
        banner.setAttribute('role', 'region');
        banner.setAttribute('aria-label', config.title);

        var text = document.createElement('p');
        text.className = 'ipAnalyticsConsent__text';
        text.textContent = config.text + ' ';
        if (config.privacyUrl) {
            var link = document.createElement('a');
            link.href = config.privacyUrl;
            link.textContent = config.privacyLabel;
            text.appendChild(link);
        }

        var actions = document.createElement('div');
        actions.className = 'ipAnalyticsConsent__actions';
        // Both choices are equally easy, as consent rules require
        [['denied', config.decline], ['granted', config.accept]].forEach(function (pair) {
            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'ipAnalyticsConsent__button';
            button.textContent = pair[1];
            button.addEventListener('click', function () {
                save(pair[0]);
                close();
            });
            actions.appendChild(button);
        });

        banner.appendChild(text);
        banner.appendChild(actions);
        document.body.appendChild(banner);
        if (fromVisitor === true) {
            actions.lastChild.focus({preventScroll: true});
        }
    };

    document.addEventListener('click', function (e) {
        var link = e.target.closest ? e.target.closest('a[href$="#cookie-settings"]') : null;
        if (link) {
            e.preventDefault();
            open(true);
        }
    });

    if (!read()) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function () { open(false); });
        } else {
            open(false);
        }
    }

    window.ipAnalyticsConsentOpen = function () { open(true); };
})();
