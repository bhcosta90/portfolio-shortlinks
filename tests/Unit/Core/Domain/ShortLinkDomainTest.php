<?php

declare(strict_types=1);

use Core\Domain\ShortLinkDomain;

describe("ShortLinkDomain Unit Test", function(){
    test("creating a object", function(){
        $domain = new ShortLinkDomain(
            url: 'testing',
        );
    });
});
