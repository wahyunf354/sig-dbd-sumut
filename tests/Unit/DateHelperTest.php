<?php

namespace Tests\Unit;

use App\Helper\Impl\DateHelperImpl;
use PHPUnit\Framework\TestCase;

class DateHelperTest extends TestCase
{
  private DateHelperImpl $dateHelperImpl;

  protected function setUp(): void
  {
    $this->dateHelperImpl = new DateHelperImpl();
  }

  public function test_success_convert_num_to_name_month()
  {
    $result = $this->dateHelperImpl->numberToMonth(3);

    self::assertEquals('March', $result);
  }

  public function testInValid()
  {
    $this->expectException(\Exception::class);

    $this->dateHelperImpl->numberToMonth(13);
  }
}
