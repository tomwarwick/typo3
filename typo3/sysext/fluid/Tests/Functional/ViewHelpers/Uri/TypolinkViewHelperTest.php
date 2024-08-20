<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace TYPO3\CMS\Fluid\Tests\Functional\ViewHelpers\Uri;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Core\SystemEnvironmentBuilder;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Routing\PageArguments;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Tests\Functional\SiteHandling\SiteBasedTestTrait;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextFactory;
use TYPO3\CMS\Frontend\Typolink\TypolinkParameter;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;
use TYPO3Fluid\Fluid\View\TemplateView;

final class TypolinkViewHelperTest extends FunctionalTestCase
{
    use SiteBasedTestTrait;

    /**
     * @var array
     */
    protected const LANGUAGE_PRESETS = [
        'EN' => ['id' => 0, 'title' => 'English', 'locale' => 'en_US.UTF8'],
    ];

    protected array $configurationToUseInTestInstance = [
        'FE' => [
            'cacheHash' => [
                'enforceValidation' => false,
            ],
        ],
    ];

    public static function renderDataProvider(): array
    {
        return [
            'uri: default' => [
                '<f:uri.typolink parameter="1" />',
                '/en/',
            ],
            'uri: with add query string' => [
                '<f:uri.typolink parameter="1" addQueryString="untrusted" />',
                '/en/?foo=bar&amp;temp=test&amp;cHash=286759dfcd3f566fa21091a0d77e9831',
            ],
            'uri: with add query string and exclude' => [
                '<f:uri.typolink parameter="1" addQueryString="untrusted" addQueryStringExclude="temp" />',
                '/en/?foo=bar&amp;cHash=afa4b37588ab917af3cfe2cd4464029d',
            ],
            't3://url uri: default' => [
                '<f:uri.typolink parameter="t3://url?url=https://example.org?param=1&other=dude" />',
                'https://example.org?param=1',
            ],
            't3://url uri: with add query string' => [
                '<f:uri.typolink parameter="t3://url?url=https://example.org?param=1&other=dude" addQueryString="untrusted" />',
                'https://example.org?param=1',
            ],
            't3://url uri: with add query string and exclude' => [
                '<f:uri.typolink parameter="t3://url?url=https://example.org?param=1&other=dude" addQueryString="untrusted" addQueryStringExclude="temp" />',
                'https://example.org?param=1',
            ],
            'mailto: uri: default' => [
                '<f:uri.typolink parameter="mailto:foo@typo3.org" />',
                'mailto:foo@typo3.org',
            ],
            'mailto: uri: with add query string' => [
                '<f:uri.typolink parameter="mailto:foo@typo3.org" addQueryString="untrusted" />',
                'mailto:foo@typo3.org',
            ],
            'mailto: uri: with add query string and exclude' => [
                '<f:uri.typolink parameter="mailto:foo@typo3.org" addQueryString="untrusted" addQueryStringExclude="temp" />',
                'mailto:foo@typo3.org',
            ],
            'http://: uri: default' => [
                '<f:uri.typolink parameter="http://typo3.org/foo/?foo=bar" />',
                'http://typo3.org/foo/?foo=bar',
            ],
            'http://: uri: with add query string' => [
                '<f:uri.typolink parameter="http://typo3.org/foo/?foo=bar" addQueryString="untrusted" />',
                'http://typo3.org/foo/?foo=bar',
            ],
            'http://: uri: with add query string and exclude' => [
                '<f:uri.typolink parameter="http://typo3.org/foo/?foo=bar" addQueryString="untrusted" addQueryStringExclude="temp" />',
                'http://typo3.org/foo/?foo=bar',
            ],
        ];
    }

    #[DataProvider('renderDataProvider')]
    #[Test]
    public function render(string $template, string $expected): void
    {
        $this->importCSVDataSet(__DIR__ . '/../../Fixtures/pages.csv');
        $this->writeSiteConfiguration(
            'test',
            $this->buildSiteConfiguration(1, '/'),
            [
                $this->buildDefaultLanguageConfiguration('EN', '/en/'),
            ]
        );
        (new ConnectionPool())->getConnectionForTable('sys_template')->insert('sys_template', [
            'pid' => 1,
            'root' => 1,
            'clear' => 1,
            'config' => <<<EOT
page = PAGE
page.10 = FLUIDTEMPLATE
page.10 {
    template = TEXT
    template.value = $template
}
EOT
        ]);
        $response = $this->executeFrontendSubRequest(
            (new InternalRequest())
            ->withPageId(1)
            ->withQueryParameter('foo', 'bar')
            ->withQueryParameter('temp', 'test')
        );
        self::assertStringContainsString($expected, (string)$response->getBody());
    }

    public static function renderWithAssignedParametersDataProvider(): array
    {
        return [
            'parameter' => [
                '<f:uri.typolink parameter="{parameter}" />',
                [
                    'parameter' => 'http://typo3.org/',
                ],
                'http://typo3.org/',
            ],
            'typolinkParameter object' => [
                '<f:uri.typolink parameter="{parameter}" />',
                [
                    'parameter' => new TypolinkParameter('http://typo3.org/'),
                ],
                'http://typo3.org/',
            ],
            'invalid parameter' => [
                '<f:uri.typolink parameter="{parameter}" />',
                [
                    'parameter' => new \stdClass(),
                ],
                '',
            ],
        ];
    }

    #[DataProvider('renderWithAssignedParametersDataProvider')]
    #[Test]
    public function renderWithAssignedParameters(string $template, array $assigns, string $expected): void
    {
        $context = $this->get(RenderingContextFactory::class)->create();
        $context->getTemplatePaths()->setTemplateSource($template);
        $request = new ServerRequest('http://localhost/');
        $request = $request->withAttribute('applicationType', SystemEnvironmentBuilder::REQUESTTYPE_FE);
        $request = $request->withAttribute('routing', new PageArguments(1, '0', []));
        $request = $request->withAttribute('site', new Site(
            'site',
            1,
            [
                'base' => 'http://localhost/',
                'languages' => [],
            ]
        ));
        $context->setRequest($request);
        $view = new TemplateView($context);
        $view->assignMultiple($assigns);
        self::assertSame($expected, trim($view->render()));
    }
}
