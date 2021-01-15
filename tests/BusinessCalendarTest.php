<?php

use PHPUnit\Framework\TestCase;

use MichaelDrennen\BusinessCalendar\BusinessCalendar;

class BusinessDateTest extends TestCase {

    /**
     * @test
     */
    public function testIsBusinessDate() {
        $aBusinessDay = '2019-08-20';
        $isBusinessDay = BusinessCalendar::isBusinessDay( $aBusinessDay );
        $this->assertTrue( $isBusinessDay );
    }

    /**
     * @test
     */
    public function testIsNotBusinessDay() {
        $notBusinessDay = '2019-08-18';
        $isBusinessDay = BusinessCalendar::isBusinessDay( $notBusinessDay );
        $this->assertFalse( $isBusinessDay );

        $notBusinessDay = '2019-07-04';
        $isBusinessDay = BusinessCalendar::isBusinessDay( $notBusinessDay );
        $this->assertFalse( $isBusinessDay );
    }

    /**
     * @test
     */
    public function testIsBankHoliday() {
        $bankHoliday = '2019-07-04';
        $isBankHoliday = BusinessCalendar::isBankHoliday( $bankHoliday );
        $this->assertTrue( $isBankHoliday );
    }

    /**
     * @test
     */
    public function testOutOfRangeEasterThrowsException() {
        $easter1899 = 1899;
        $this->expectExceptionMessage( "Unable to find the date of Easter for the year " . $easter1899 );
        $getEaster1899 = BusinessCalendar::getEasterForYear( $easter1899 );
        echo "You should not ever see: $getEaster1899 since exception should have been thrown.";
    }

    /**
     * @test
     */
    public function testSwitchCasesAreIncludedInBankHolidaysByYearArray() {
        $year = 2023;
        $bankHolidays = BusinessCalendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-01-02", $bankHolidays );

        $year = 2022;
        $bankHolidays = BusinessCalendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-01-03", $bankHolidays );

        $year = 2021;
        $bankHolidays = BusinessCalendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-07-05", $bankHolidays );

        $year = 2020;
        $bankHolidays = BusinessCalendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-07-03", $bankHolidays );

        $year = 1999;
        $bankHolidays = BusinessCalendar::getBankHolidaysByYear( $year );
        $this->assertContains( "$year-12-31", $bankHolidays );
    }

    /**
     * @test
     */
    public function testGetLastBusinessDayOfMonthIsAugThirty2019() {
        $stringDate = '2019-08-01';
        $augThirty2019 = '2019-08-30';
        $lastBusinessDayOfMonth = BusinessCalendar::getLastBusinessDayOfTheMonth( $stringDate );
        $this->assertEquals( $lastBusinessDayOfMonth, $augThirty2019);
    }

    /**
     * @test
     */
    public function testInvalidStringDateThrowsException() {
        $invalidStringDate = 'foo';
        $this->expectExceptionMessage( "Unable to find the last business day of the month for this date: " . $invalidStringDate );
        $lastBusinessDayOfMonth = BusinessCalendar::getLastBusinessDayOfTheMonth( $invalidStringDate );
        echo "You should not ever see: $lastBusinessDayOfMonth since exception should have been thrown.";
    }

    /**
     * @test
     */
    public function testBusinessDateOffsetDaysAwayIsExpectedBusinessDate() {
        $offset = 4;
        $anchorDate = '2019-08-26';
        $expectedBusinessDate = '2019-08-30';
        $businessDate = BusinessCalendar::getBusinessDateThisManyDaysAway( $anchorDate, $offset );
        $this->assertEquals( $businessDate, $expectedBusinessDate);

        $offset = 0;
        $expectedBusinessDate = $anchorDate;
        $businessDate = BusinessCalendar::getBusinessDateThisManyDaysAway( $anchorDate, $offset );
        $this->assertEquals( $businessDate, $expectedBusinessDate);

        $offset = -4;
        $expectedBusinessDate = '2019-08-20';
        $businessDate = BusinessCalendar::getBusinessDateThisManyDaysAway( $anchorDate, $offset );
        $this->assertEquals( $businessDate, $expectedBusinessDate);
    }

    /**
     * @test
     */
    public function testBusinessDateOffsetZeroDaysAwayThrowsException() {
        $offset = 0;
        $anchorDate = '2019-08-31';
        $this->expectExceptionMessage( "You want to get the next business day zero days away, but $anchorDate is not a business day." );
        $businessDate = BusinessCalendar::getBusinessDateThisManyDaysAway( $anchorDate, $offset );
        echo "You should not ever see: $businessDate since exception should have been thrown.";
    }

}