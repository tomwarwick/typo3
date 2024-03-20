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

namespace TYPO3\CMS\Frontend\Tests\Unit\ContentObject\Exception;

use PHPUnit\Framework\Attributes\Test;
use Psr\Log\NullLogger;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\DateTimeAspect;
use TYPO3\CMS\Core\Core\RequestId;
use TYPO3\CMS\Core\Crypto\Random;
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Http\ImmediateResponseException;
use TYPO3\CMS\Core\Http\PropagateResponseException;
use TYPO3\CMS\Frontend\ContentObject\Exception\ProductionExceptionHandler;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

final class ProductionExceptionHandlerTest extends UnitTestCase
{
    #[Test]
    public function relayPropagateResponseException(): void
    {
        $exception = new PropagateResponseException(new HtmlResponse(''), 1607328584);
        $this->expectException(PropagateResponseException::class);
        $this->expectExceptionCode(1607328584);
        $subject = new ProductionExceptionHandler(new Context(), new Random(), new NullLogger(), new RequestId());
        $subject->handle($exception);
    }

    #[Test]
    public function relayImmediateResponseException(): void
    {
        $exception = new ImmediateResponseException(new HtmlResponse(''), 1533939251);
        $this->expectException(ImmediateResponseException::class);
        $this->expectExceptionCode(1533939251);
        $subject = new ProductionExceptionHandler(new Context(), new Random(), new NullLogger(), new RequestId());
        $subject->handle($exception);
    }

    #[Test]
    public function handleReturnsMessageWithRequestId(): void
    {
        $requestId = new RequestId();
        $exceptionHandler = new ProductionExceptionHandler(new Context(), new Random(), new NullLogger(), $requestId);

        self::assertEquals(
            'Oops, an error occurred! Request: ' . $requestId,
            $exceptionHandler->handle(new \Exception('Some exception', 1629996089))
        );
    }

    #[Test]
    public function handleReturnsCustomErrorMessageWithResolvedErrorCode(): void
    {
        $currentTimestamp = 1629993829;
        $random = '029cca07';

        $randomMock = $this->createMock(Random::class);
        $randomMock->method('generateRandomHexString')->with(8)->willReturn($random);

        $context = new Context();
        $context->setAspect('date', new DateTimeAspect(new \DateTimeImmutable('@' . $currentTimestamp)));
        $exceptionHandler = new ProductionExceptionHandler($context, $randomMock, new NullLogger(), new RequestId());
        $exceptionHandler->setConfiguration([
            'errorMessage' => 'Custom error message: {code}',
        ]);

        self::assertEquals(
            'Custom error message: ' . date('YmdHis', $currentTimestamp) . $random,
            $exceptionHandler->handle(new \Exception('Some exception', 1629996090))
        );
    }

    #[Test]
    public function handleReturnsCustomErrorMessageWithResolvedErrorCodeForLegacyPlaceholder(): void
    {
        $currentTimestamp = 1629993829;
        $random = '029cca07';

        $randomMock = $this->createMock(Random::class);
        $randomMock->method('generateRandomHexString')->with(8)->willReturn($random);

        $context = new Context();
        $context->setAspect('date', new DateTimeAspect(new \DateTimeImmutable('@' . $currentTimestamp)));
        $exceptionHandler = new ProductionExceptionHandler(
            $context,
            $randomMock,
            new NullLogger(),
            new RequestId()
        );
        $exceptionHandler->setConfiguration([
            'errorMessage' => 'Custom error message: %s',
        ]);

        self::assertEquals(
            'Custom error message: ' . date('YmdHis', $currentTimestamp) . $random,
            $exceptionHandler->handle(new \Exception('Some exception', 1629996091))
        );
    }
}
