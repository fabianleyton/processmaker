<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class RequestsPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/requests';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
            '@container' => '#requests-listing',
            '@widgets' => '.card-deck',
            '@vuetable' => '.data-table',
            '@pmql' => '#search-manual input',
            '@search-button' => '#search-actions button:first-of-type',
            '@advanced-search-button' => '#search-actions button:last-of-type',
        ];
    }
}
