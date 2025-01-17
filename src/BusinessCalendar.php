<?php

namespace MichaelDrennen\BusinessCalendar;

use Carbon\Carbon;
use MichaelDrennen\Calendar\USMarket;

class BusinessCalendar {

    // Days of the week as
    const SUNDAY    = 0;
    const MONDAY    = 1;
    const TUESDAY   = 2;
    const WEDNESDAY = 3;
    const THURSDAY  = 4;
    const FRIDAY    = 5;
    const SATURDAY  = 6;

    public static $easterDates = [ '1900-04-15', '1901-04-07', '1902-03-30', '1903-04-12', '1904-04-03', '1905-04-23', '1906-04-15', '1907-03-31', '1908-04-19', '1909-04-11', '1910-03-27', '1911-04-16', '1912-04-07', '1913-03-23', '1914-04-12', '1915-04-04', '1916-04-23', '1917-04-08', '1918-03-31', '1919-04-20', '1920-04-04', '1921-03-27', '1922-04-16', '1923-04-01', '1924-04-20', '1925-04-12', '1926-04-04', '1927-04-17', '1928-04-08', '1929-03-31', '1930-04-20', '1931-04-05', '1932-03-27', '1933-04-16', '1934-04-01', '1935-04-21', '1936-04-12', '1937-03-28', '1938-04-17', '1939-04-09', '1940-03-24', '1941-04-13', '1942-04-05', '1943-04-25', '1944-04-09', '1945-04-01', '1946-04-21', '1947-04-06', '1948-03-28', '1949-04-17', '1950-04-09', '1951-03-25', '1952-04-13', '1953-04-05', '1954-04-18', '1955-04-10', '1956-04-01', '1957-04-21', '1958-04-06', '1959-03-29', '1960-04-17', '1961-04-02', '1962-04-22', '1963-04-14', '1964-03-29', '1965-04-18', '1966-04-10', '1967-03-26', '1968-04-14', '1969-04-06', '1970-03-29', '1971-04-11', '1972-04-02', '1973-04-22', '1974-04-14', '1975-03-30', '1976-04-18', '1977-04-10', '1978-03-26', '1979-04-15', '1980-04-06', '1981-04-19', '1982-04-11', '1983-04-03', '1984-04-22', '1985-04-07', '1986-03-30', '1987-04-19', '1988-04-03', '1989-03-26', '1990-04-15', '1991-03-31', '1992-04-19', '1993-04-11', '1994-04-03', '1995-04-16', '1996-04-07', '1997-03-30', '1998-04-12', '1999-04-04', '2000-04-23', '2001-04-15', '2002-03-31', '2003-04-20', '2004-04-11', '2005-03-27', '2006-04-16', '2007-04-08', '2008-03-23', '2009-04-12', '2010-04-04', '2011-04-24', '2012-04-08', '2013-03-31', '2014-04-20', '2015-04-05', '2016-03-27', '2017-04-16', '2018-04-01', '2019-04-21', '2020-04-12', '2021-04-04', '2022-04-17', '2023-04-09', '2024-03-31', '2025-04-20', '2026-04-05', '2027-03-28', '2028-04-16', '2029-04-01', '2030-04-21', '2031-04-13', '2032-03-28', '2033-04-17', '2034-04-09', '2035-03-25', '2036-04-13', '2037-04-05', '2038-04-25', '2039-04-10', '2040-04-01', '2041-04-21', '2042-04-06', '2043-03-29', '2044-04-17', '2045-04-09', '2046-03-25', '2047-04-14', '2048-04-05', '2049-04-18', '2050-04-10', '2051-04-02', '2052-04-21', '2053-04-06', '2054-03-29', '2055-04-18', '2056-04-02', '2057-04-22', '2058-04-14', '2059-03-30', '2060-04-18', '2061-04-10', '2062-03-26', '2063-04-15', '2064-04-06', '2065-03-29', '2066-04-11', '2067-04-03', '2068-04-22', '2069-04-14', '2070-03-30', '2071-04-19', '2072-04-10', '2073-03-26', '2074-04-15', '2075-04-07', '2076-04-19', '2077-04-11', '2078-04-03', '2079-04-23', '2080-04-07', '2081-03-30', '2082-04-19', '2083-04-04', '2084-03-26', '2085-04-15', '2086-03-31', '2087-04-20', '2088-04-11', '2089-04-03', '2090-04-16', '2091-04-08', '2092-03-30', '2093-04-12', '2094-04-04', '2095-04-24', '2096-04-15', '2097-03-31', '2098-04-20', '2099-04-12', '2100-03-28', '2101-04-17', '2102-04-09', '2103-03-25', '2104-04-13', '2105-04-05', '2106-04-18', '2107-04-10', '2108-04-01', '2109-04-21', '2110-04-06', '2111-03-29', '2112-04-17', '2113-04-02', '2114-04-22', '2115-04-14', '2116-03-29', '2117-04-18', '2118-04-10', '2119-03-26', '2120-04-14', '2121-04-06', '2122-03-29', '2123-04-11', '2124-04-02', '2125-04-22', '2126-04-14', '2127-03-30', '2128-04-18', '2129-04-10', '2130-03-26', '2131-04-15', '2132-04-06', '2133-04-19', '2134-04-11', '2135-04-03', '2136-04-22', '2137-04-07', '2138-03-30', '2139-04-19', '2140-04-03', '2141-03-26', '2142-04-15', '2143-03-31', '2144-04-19', '2145-04-11', '2146-04-03', '2147-04-16', '2148-04-07', '2149-03-30', '2150-04-12', '2151-04-04', '2152-04-23', '2153-04-15', '2154-03-31', '2155-04-20', '2156-04-11', '2157-03-27', '2158-04-16', '2159-04-08', '2160-03-23', '2161-04-12', '2162-04-04', '2163-04-24', '2164-04-08', '2165-03-31', '2166-04-20', '2167-04-05', '2168-03-27', '2169-04-16', '2170-04-01', '2171-04-21', '2172-04-12', '2173-04-04', '2174-04-17', '2175-04-09', '2176-03-31', '2177-04-20', '2178-04-05', '2179-03-28', '2180-04-16', '2181-04-01', '2182-04-21', '2183-04-13', '2184-03-28', '2185-04-17', '2186-04-09', '2187-03-25', '2188-04-13', '2189-04-05', '2190-04-25', '2191-04-10', '2192-04-01', '2193-04-21', '2194-04-06', '2195-03-29', '2196-04-17', '2197-04-09', '2198-03-25', '2199-04-14', '2200-04-06', '2201-04-19', '2202-04-11', '2203-04-03', '2204-04-22', '2205-04-07', '2206-03-30', '2207-04-19', '2208-04-03', '2209-03-26', '2210-04-15', '2211-03-31', '2212-04-19', '2213-04-11', '2214-03-27', '2215-04-16', '2216-04-07', '2217-03-30', '2218-04-12', '2219-04-04', '2220-04-23', '2221-04-15', '2222-03-31', '2223-04-20', '2224-04-11', '2225-03-27', '2226-04-16', '2227-04-08', '2228-03-23', '2229-04-12', '2230-04-04', '2231-04-24', '2232-04-08', '2233-03-31', '2234-04-20', '2235-04-05', '2236-03-27', '2237-04-16', '2238-04-01', '2239-04-21', '2240-04-12', '2241-04-04', '2242-04-17', '2243-04-09', '2244-03-31', '2245-04-13', '2246-04-05', '2247-03-28', '2248-04-16', '2249-04-01', '2250-04-21', '2251-04-13', '2252-03-28', '2253-04-17', '2254-04-09', '2255-03-25', '2256-04-13', '2257-04-05', '2258-04-25', '2259-04-10', '2260-04-01', '2261-04-21', '2262-04-06', '2263-03-29', '2264-04-17', '2265-04-02', '2266-03-25', '2267-04-14', '2268-04-05', '2269-04-18', '2270-04-10', '2271-04-02', '2272-04-21', '2273-04-06', '2274-03-29', '2275-04-18', '2276-04-02', '2277-04-22', '2278-04-14', '2279-03-30', '2280-04-18', '2281-04-10', '2282-03-26', '2283-04-15', '2284-04-06', '2285-03-22', '2286-04-11', '2287-04-03', '2288-04-22', '2289-04-07', '2290-03-30', '2291-04-19', '2292-04-10', '2293-03-26', '2294-04-15', '2295-04-07', '2296-04-19', '2297-04-11', '2298-04-03', '2299-04-16' ];

    /**
     * Given an integer year, this method will return a Carbon object representing the
     * Easter date from that year. Otherwise it will throw an exception.
     * TODO Make the searching through the text file for the year more efficient.
     *
     * @param int $year
     *
     * @return Carbon
     * @throws \Exception
     */
    public static function getEasterForYear( int $year ): string {
        foreach ( self::$easterDates as $date ):
            $datesYear = (int)date( 'Y', strtotime( $date ) );

            if ( $datesYear === $year ):
                return $date;
            endif;
        endforeach;

        throw new \Exception( "Unable to find the date of Easter for the year $year" );
    }


    /**
     * Given an integer year, this method will return an array of strings representing all of the
     * bank holidays for that year.
     * @param int $year
     * @return array
     * @throws \Exception
     */
    public static function getBankHolidaysByYear( int $year ): array {

        $bankHolidays = [];

        // New year's:
        switch ( date( "w", strtotime( "$year-01-01 12:00:00" ) ) ):
            case self::SUNDAY:
                $bankHolidays[] = "$year-01-02";
                break;
            case self::SATURDAY:
                $bankHolidays[] = "$year-01-03";
                break;
            default:
                $bankHolidays[] = "$year-01-01";
        endswitch;


        // Martin Luther King, Jr. Day
        $martinLutherKingJrDay = Carbon::parse( 'third monday of Jan ' . $year );
        $bankHolidays[]        = $martinLutherKingJrDay->format( 'Y-m-d' );

        // Presidents Day
        $presidentsDay  = Carbon::parse( 'third monday of Feb ' . $year );
        $bankHolidays[] = $presidentsDay->format( 'Y-m-d' );

        // Good Friday
        $easter         = self::getEasterForYear( $year );
        $goodFriday     = date( 'Y-m-d', strtotime( "-2 days", strtotime( $easter ) ) );
        $bankHolidays[] = $goodFriday;

        // Memorial Day
        $memorialDay    = Carbon::parse( 'last monday of May ' . $year );
        $bankHolidays[] = $memorialDay->format( 'Y-m-d' );

        // Independence Day
        switch ( date( "w", strtotime( "$year-07-04 12:00:00" ) ) ):
            case self::SUNDAY:
                $bankHolidays[] = "$year-07-05";
                break;
            case self::SATURDAY:
                $bankHolidays[] = "$year-07-03";
                break;
            default:
                $bankHolidays[] = "$year-07-04";
        endswitch;

        // Labor Day
        $laborDay       = Carbon::parse( 'first monday of september ' . $year );
        $bankHolidays[] = $laborDay->format( 'Y-m-d' );

        // Thanksgiving
        $thanksgiving   = Carbon::parse( 'fourth thursday of november ' . $year );
        $bankHolidays[] = $thanksgiving->format( 'Y-m-d' );

        // Day after Thanksgiving
        $di                   = new \DateInterval( 'P1D' );
        $dayAfterThanksgiving = $thanksgiving->add( $di );
        $bankHolidays[]       = $dayAfterThanksgiving->format( 'Y-m-d' );


        // Christmas:
        switch ( date( "w", strtotime( "$year-12-25 12:00:00" ) ) ):
            case self::SUNDAY:
                $bankHolidays[] = "$year-12-26";
                break;
            case self::SATURDAY:
                $bankHolidays[] = "$year-12-24";
                break;
            default:
                $bankHolidays[] = "$year-12-25";
        endswitch;

        // Millennium eve
        if ( $year == 1999 ):
            $bankHolidays[] = "1999-12-31";
        endif;

        return $bankHolidays;
    }

    /**
     * Given a string date in the PHP format 'Y-m-d', this method will return true if
     * that date is a bank holiday in the U.S. False otherwise.
     * @param string $argDate A string date formatted Y-m-d, according to PHP
     * @return bool
     * @throws \Exception
     */
    public static function isBankHoliday( string $argDate ) {
        $aDateParts = explode( '-', $argDate );
        if ( count( $aDateParts ) < 3 ) throw new \Exception( "The date you passed into isBankHoliday() was not YYYY-MM-DD, it was " . $argDate );

        $year          = $aDateParts[ 0 ];
        $aBankHolidays = self::getBankHolidaysByYear( $year );

        if ( in_array( $argDate, $aBankHolidays ) ):
            return TRUE;
        endif;

        return FALSE;
    }

    /**
     * Given a string date, this method will return a string representing the last business
     * day of the month. This will take weekends and bank holidays into effect.
     * @param string $argDate
     * @return string
     * @throws \Exception
     */
    public static function getLastBusinessDayOfTheMonth( string $argDate ): string {
        $time = strtotime( $argDate );
        if ( $time === FALSE )
            throw new \Exception( "Unable to find the last business day of the month for this date: " . $argDate );

        $date        = date( "Y-m-t", $time );
        $keepLooking = TRUE;

        do {
            if ( self::isWeekday( $date ) && !self::isBankHoliday( $date ) ) :
                return $date;
            endif;
            $date = date( 'Y-m-d', strtotime( $date . ' -1 day' ) );
        } while ( $keepLooking );

    }

    /**
     * Given a string date, this method will return true if the date was a weekend.
     *
     * @see https://www.php.net/manual/en/function.date.php
     *
     * @param string $argDate
     *
     * @return bool
     */
    public static function isWeekend( string $argDate ): bool {
        return ( date( 'N', strtotime( $argDate ) ) >= 6 );
    }


    /**
     * Given a string date, this method will return true if the date was a weekday.
     * This method does not know about bank holidays.
     * @param string $argDate
     * @return bool
     */
    public static function isWeekday( string $argDate ): bool {
        return !( self::isWeekend( $argDate ) );
    }

    /**
     * Given a string date that can be parsed by strtotime(), this method will return true if
     * the given date is not a weekend and not a bank holiday.
     * @param $argDate
     * @return bool
     * @throws \Exception
     */
    public static function isBusinessDay( $argDate ): bool {
        if ( self::isWeekend( $argDate ) ):
            return FALSE;
        endif;

        if ( self::isBankHoliday( $argDate ) ):
            return FALSE;
        endif;

        return TRUE;
    }


    /**
     * Given a string to serve as an anchor date, return the business date closest to the offset number of days away.
     * A positive number for the offset goes into the future. Negative number goes into the past.
     * @param string $anchor
     * @param int $offset
     * @return string
     * @throws \Exception
     */
    public static function getBusinessDateThisManyDaysAway( string $anchor, int $offset ): string {
        $anchor = date( 'Y-m-d', strtotime( $anchor ) );
        if ( $offset == 0 && self::isBusinessDay( $anchor ) ):
            return $anchor;
        elseif ( $offset == 0 ):
            throw new \Exception( "You want to get the next business day zero days away, but $anchor is not a business day." );
        endif;

        if ( $offset > 0 ):
            $offsetDirection = "+";
        else:
            $offsetDirection = "-"; // Look to the past.
            $offset          = abs( $offset );
        endif;

        $counter = 0;
        $newDate = $anchor;
        while ( $counter < $offset ):
            //echo "\nCounter: $counter and Offset: $offset and newDate: $newDate\n";
            $newDate = date( 'Y-m-d', strtotime( $offsetDirection . "1 day", strtotime( $anchor ) ) );
            $anchor  = $newDate;
            if ( self::isBusinessDay( $newDate ) ):
                //echo "\n$newDate is A business day, so " . ($counter + 1) . " \n";
                $counter++;
            else:
                //echo "\n$newDate is NOT A business day.\n";
                // So do not increment the counter.
            endif;
        endwhile;

        return $newDate;
    }


    /**
     * Given a date, this method will return a Carbon instance of the next business date.
     * @param Carbon $date
     * @return Carbon
     * @throws \Exception
     */
    public static function getNextBusinessDay( Carbon $date ): Carbon {
        $isBusinessDate = FALSE;
        do {
            if ( self::isBusinessDay( $date ) ):
                return $date;
            endif;
            $date = $date->addDay();
        } while ( FALSE === $isBusinessDate );
    }


    /**
     * @param Carbon $dateTime
     * @return Carbon
     */
    public static function getNextUSMarketOpen( Carbon $dateTime ): Carbon {
        $usMarket = new USMarket();
        return $usMarket->getnextTradingDaysOpen( $dateTime );
    }
}