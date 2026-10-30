# Analytics & Tags for ImpressPages

Adds **Google Tag Manager** and/or **Google Analytics 4** to an ImpressPages 5 site, with a **cookie consent banner** that uses **Google Consent Mode v2**: nothing is tracked until a visitor accepts.

## Features

- Google Tag Manager container and/or GA4 measurement ID, set on the Plugins screen.
- Consent first: an inline script sets every consent type to `denied` before any tag loads. Returning visitors who accepted are restored straight away.
- Accessible banner: Decline and Accept are equally easy, it works with the keyboard and screen readers, adapts to dark mode and doesn't steal focus on page load.
- Any link to `#cookie-settings` reopens the banner, so visitors can change their mind. Add one to your footer or privacy page.
- Not loaded in the admin, the page editor or the theme preview; logged-in administrators are not tracked unless you turn that off.
- IDs are validated (`GTM-…`, `G-…`) before they are printed into the page.

## Requirements

ImpressPages 5.1 (the PHP 8 community fork) on PHP 8.1 or newer.

## Install

1. Copy this repository into your site's `Plugin` folder as **`Plugin/Analytics`** (the folder name must be `Analytics`):
   ```bash
   git clone https://github.com/isunktitanic/impresspages-plugin-analytics.git Plugin/Analytics
   ```
2. In the admin, open **Plugins**, select **Analytics & Tags** and click **Activate**.
3. Enter your Tag Manager container ID and/or GA4 measurement ID and click **Save**.

## Settings

| Setting | What it does |
|---|---|
| Google Tag Manager container ID | `GTM-XXXXXXX`. Leave empty if you don't use Tag Manager. |
| Google Analytics 4 measurement ID | `G-XXXXXXXXXX`. Leave empty if GA4 is configured inside Tag Manager, otherwise visits are counted twice. |
| Show cookie consent banner | On by default. Turn off only if consent is handled elsewhere (for example a consent platform inside Tag Manager). |
| Banner text | The sentence shown in the banner. |
| Privacy policy URL | Optional link in the banner (`https://…` or a site path starting with `/`). |
| Don't track logged-in administrators | On by default, so your own visits don't count. |

## Notes

- The Tag Manager `<noscript>` iframe is left out on purpose: without JavaScript a visitor cannot give consent, so they are not tracked.
- The visitor's choice is stored in the browser (`localStorage`, key `ipAnalyticsConsent`).
- Banner styles use the `.ipAnalyticsConsent` class, so a theme can restyle it.

## License

MIT, see [LICENSE](LICENSE).
